<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ServicesModel;

class Services extends BaseController {
    use ResponseTrait;

    public function index() {
        $services = new ServicesModel;
        return $this->respond(['services' => $services->findAll()], 200);
    }


}