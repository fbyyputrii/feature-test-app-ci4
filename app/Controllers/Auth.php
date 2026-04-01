<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {

        if (!$this->request->isAJAX()) {
            return redirect()->to('/login');
        }

        $input    = $this->request->getPost('login');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember'); // checkbox

        if (empty($input) || empty($password)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Login dan password wajib diisi'
            ]);
        }

        $user = $this->userModel
            ->select('users.*, roles.name as role')
            ->join('roles', 'roles.id = users.role_id')
            ->groupStart()
            ->where('username', $input)
            ->orWhere('email', $input)
            ->orWhere('phone', $input)
            ->groupEnd()
            ->where('is_active', 1)
            ->first();

        if (!$user) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'User tidak ditemukan'
            ]);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Password salah'
            ]);
        }

        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'role_id'    => $user['role_id'],
            'role'       => $user['role'],
            'isLoggedIn' => true,
        ]);

        log_activity('login', 'auth', 'User login: ' . $user['username']);

        if (!empty($remember)) {
            try {
                $token = bin2hex(random_bytes(32));

                $this->userModel->update($user['id'], ['remember_token' => $token]);

        
                helper('cookie');
                set_cookie([
                    'name'     => 'remember_token',
                    'value'    => $token,
                    'expire'   => 60 * 60 * 24 * 30, // 30 hari
                    'path'     => '/',
                    'secure'   => false, 
                    'httponly' => true,
                    'samesite' => 'Lax',
                ]);
            } catch (\Exception $e) {
                log_message('error', 'Remember Me gagal: ' . $e->getMessage());
            }
        }

        return $this->response->setJSON([
            'status'   => 'success',
            'redirect' => '/dashboard'
        ]);
    }

    // logout
    public function logout()
    {
        $session = session();
        helper('cookie');

        $userId = $session->get('user_id');

        if (!empty($userId)) {
            $this->userModel
                ->set('remember_token', null)
                ->where('id', $userId)
                ->update();
        }

        delete_cookie('remember_token');

        $session->destroy();

        return redirect()->to('/login');
    }
}
