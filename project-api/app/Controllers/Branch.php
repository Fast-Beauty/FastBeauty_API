<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BranchModel;

class Branch extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $branch = new BranchModel;
        return $this->respond(['branch_office' => $branch->findAll()], 200);
    }

    public function create()
    {
        $rules = [
            'name' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'nit' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'addres' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'google_location' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'phone' => ['rules' => 'required|min_length[8]|max_length[255]']

        ];

        if ($this->validate($rules)) {
            $model = new BranchModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'nit' => $this->request->getVar('nit'),
                'addres' => $this->request->getVar('addres'),
                'google_location' => $this->request->getVar('google_location'),
                'phone' => $this->request->getVar('phone')

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

    public function update($id)
    {
        $rules = [
            'name' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'nit' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'addres' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'google_location' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'phone' => ['rules' => 'required|min_length[8]|max_length[255]']
        ];
        if ($this->validate($rules)) {
            $model = new BranchModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'nit' => $this->request->getVar('nit'),
                'addres' => $this->request->getVar('addres'),
                'google_location' => $this->request->getVar('google_location'),
                'phone' => $this->request->getVar('phone')
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

    public function delete($id)
    {
        $model = new BranchModel();
        $model->where('id', $id)->delete($id);
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }
}
