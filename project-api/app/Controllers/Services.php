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

    public function create() {
        $rules = [
            'name' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'description' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'price' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'time' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'branch_office_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];

        if($this->validate($rules)) {
            $model = new ServicesModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'price' => $this->request->getVar('price'),
                'time' => $this->request->getVar('time'),
                'branch_office_id' => $this->request->getVar('branch_office_id')
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
            'name' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'description' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'price' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'time' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'branch_office_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];
        if($this->validate($rules)) {
            $model = new ServicesModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'price' => $this->request->getVar('price'),
                'time' => $this->request->getVar('time'),
                'branch_office_id' => $this->request->getVar('branch_office_id')
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
        $model = new ServicesModel();
        $model->where('id', $id)->delete($id);
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }

}