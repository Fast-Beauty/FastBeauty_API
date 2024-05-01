<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User_api extends BaseController {
    use ResponseTrait;

    public function index() {
        $users_api = new UserModel;
        return $this->respond(['users_api' => $users_api->findAll()], 200);
    }
}