<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeesModel;

class Employees extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $employees = new EmployeesModel;
        return $this->respond(['employees' => $employees->findAll()], 200);
    }

    public function create()
    {
        $rules = [
            'users_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];

        if ($this->validate($rules)) {
            $model = new EmployeesModel();
            $data = [
                'users_id' => $this->request->getVar('users_id')
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
            'users_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];
        if ($this->validate($rules)) {
            $model = new EmployeesModel();
            $data = [
                'users_id' => $this->request->getVar('users_id')
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
        $model = new EmployeesModel();
        $model->where('id', $id)->delete($id);
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }
}
