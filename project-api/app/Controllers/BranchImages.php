<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BranchImagesModel;

class BranchImages extends BaseController{
    use ResponseTrait;
    public function index() {
        $branchimages = new BranchImagesModel;
        $data = $branchimages->select('id, tipo_imagen, branch_office_id')->findAll();
        return $this->respond(['branch_images' => $data], 200);
    }

    public function create() {
        $rules = [
            'imagen' => ['rules' => 'uploaded[imagen]|max_size[imagen,2048]'],
            'tipo_imagen' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'branch_office_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];

        if($this->validate($rules)) {
            $model = new BranchImagesModel();
            $imageFile = $this->request->getFile('imagen');
            $data = [
                'imagen' => file_get_contents($imageFile->getTempName()),
                'tipo_imagen' => $this->request->getVar('tipo_imagen'),
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
            'imagen' => ['rules' => 'uploaded[imagen]|max_size[imagen,2048]'],
            'tipo_imagen' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'branch_office_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];
        if($this->validate($rules)) {
            $model = new BranchImagesModel();
            $imageFile = $this->request->getFile('imagen');
            $data = [
                'imagen' => file_get_contents($imageFile->getTempName()),
                'tipo_imagen' => $this->request->getVar('tipo_imagen'),
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