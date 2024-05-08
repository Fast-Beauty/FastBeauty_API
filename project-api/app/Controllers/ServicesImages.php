<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ServicesImagesModel;

class ServicesImages extends BaseController {
    use ResponseTrait;

    public function index() {
        $servicesimages = new ServicesImagesModel;
        return $this->respond(['servicesimages' => $servicesimages->findAll()], 200);
    }

    public function create() {
        $rules = [
            'url' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'type' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'size' => ['rules' => 'required|min_length[2]|max_length[255]'],
        
        ];

        if($this->validate($rules)) {
            $model = new ServicesImagesModel();
            $data = [
                'url' => $this->request->getVar('url'),
                'type' => $this->request->getVar('type'),
                'size' => $this->request->getVar('size'),
            
            ];
            $model->save($data);

            return $this->respond(['message' => 'Created Successfully'], 200);
        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);
        }
    }
    
    public function update($id) {
        $rules = [
            'url' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'type' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'size' => ['rules' => 'required|min_length[2]|max_length[255]'],
        
        ];
        if($this->validate($rules)) {
            $model = new ServicesImagesModel();
            $data = [
                'url' => $this->request->getVar('url'),
                'type' => $this->request->getVar('type'),
                'size' => $this->request->getVar('size'),
            
            ];
            $model->update($id, $data);
    
            return $this->respond(['message' => 'Updated Successfully'], 200);
        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);
        }
    }

    public function delete($id) {
        $model = new ServicesImagesModel();
        $model->where('id', $id)->delete($id);
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }


}