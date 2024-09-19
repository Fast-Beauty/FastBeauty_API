<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AppointmentsModel;

class Appointments extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $appointments = new AppointmentsModel;
        $data = $appointments->select('id, status, date, hora, clients_id, Employees_id, services_id')->findAll();
        return $this->respond(['appointments' => $data], 200);
    }

    public function create()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $rules = [
            'status' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'date' => ['rules' => 'required|valid_date[Y-m-d H:i:s]'],
            'hora' => ['rules' => 'required|valid_date[H:i:s]'],
            'clients_id' => ['rules' => 'required|min_length[1]|max_length[255]'],
            'Employees_id' => ['rules' => 'required|min_length[1]|max_length[255]'],
            'services_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];

        if ($this->validate($rules)) {
            $model = new AppointmentsModel();
            $data = [
                'status' => $this->request->getVar('status'),
                'date' => $this->request->getVar('date'),
                'hora' => $this->request->getVar('hora'),
                'clients_id' => $this->request->getVar('clients_id'),
                'Employees_id' => $this->request->getVar('Employees_id'),
                'services_id' => $this->request->getVar('services_id')
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
            'status' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'date' => ['rules' => 'required|valid_date[Y-m-d H:i:s]'],
            'hora' => ['rules' => 'required|valid_date[H:i:s]'],
            'clients_id' => ['rules' => 'required|min_length[1]|max_length[255]'],
            'Employees_id' => ['rules' => 'required|min_length[1]|max_length[255]'],
            'services_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];
        if ($this->validate($rules)) {
            $model = new AppointmentsModel();
            $data = [
                'status' => $this->request->getVar('status'),
                'date' => $this->request->getVar('date'),
                'hora' => $this->request->getVar('hora'),
                'clients_id' => $this->request->getVar('clients_id'),
                'Employees_id' => $this->request->getVar('Employees_id'),
                'services_id' => $this->request->getVar('services_id')
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
        $model = new AppointmentsModel();
        $model->where('id', $id)->delete($id);
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }
}
