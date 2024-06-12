<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BranchImagesModel;

class BranchImages extends BaseController{
    use ResponseTrait;
    public function index() {
        $branchimages = new BranchImagesModel;
        return $this->respond(['branch_images' => $branchimages->findAll()], 200);
    }

    public function create() {
        $rules = [
            'url' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'type' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'size' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'branch_office_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];

        if($this->validate($rules)) {
            $model = new BranchImagesModel();
            $data = [
                'url' => $this->request->getVar('url'),
                'type' => $this->request->getVar('type'),
                'size' => $this->request->getVar('size'),
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
            'url' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'type' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'size' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'branch_office_id' => ['rules' => 'required|min_length[1]|max_length[255]'],
        ];
        if($this->validate($rules)) {
            $model = new BranchImagesModel();
            $data = [
                'url' => $this->request->getVar('url'),
                'type' => $this->request->getVar('type'),
                'size' => $this->request->getVar('size'),
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
        $model = new BranchImagesModel();
        $model->where('id', $id)->delete($id);
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }

}