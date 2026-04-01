<?php

use App\Models\LogModel;

function log_activity($action, $module, $description)
{
    $logModel = new LogModel();

    $logModel->save([
        'user_id' => session()->get('user_id'),
        'action' => $action,
        'module' => $module,
        'description' => $description,
        'created_at' => date('Y-m-d H:i:s')
    ]);
}