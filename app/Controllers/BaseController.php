<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

abstract class BaseController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();

        helper(['cookie', 'rbac']);

        if (!$session->get('isLoggedIn')) {

            $rememberToken = get_cookie('remember_token');

            if ($rememberToken) {

                $user = $this->userModel
                    ->select('users.*, roles.name as role')
                    ->join('roles', 'roles.id = users.role_id')
                    ->where('remember_token', $rememberToken)
                    ->first();

                if ($user) {
                    $session->set([
                        'user_id'    => $user['id'],
                        'username'   => $user['username'],
                        'role_id'    => $user['role_id'],
                        'role'       => $user['role'], 
                        'isLoggedIn' => true,
                    ]);
                }
            }
        }
    }
}