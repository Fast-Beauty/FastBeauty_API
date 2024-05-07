<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ServicesImagesModel;

class Services extends BaseController {
    use ResponseTrait;

    public function index() {
        $services = new ServicesImagesModel;
        return $this->respond(['services' => $services->findAll()], 200);
    }


}