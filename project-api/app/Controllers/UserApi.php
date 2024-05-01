<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserApiModel;

class UserApi extends BaseController {
    use ResponseTrait;

    public function index() {
        $users_api = new UserApiModel;
        return $this->respond(['users_api' => $users_api->findAll()], 200);
    }
}