<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeesImagesModel;

class EmployeesImages extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        header('Access-Control-Allow-Origin: *'); // Permite todas las orígenes. Cambia '*' por tu dominio si es necesario.
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $employeesimages = new EmployeesImagesModel;
        $data = $employeesimages->select('id, Employees_id, imagen, tipo_imagen')->findAll();
        foreach ($data as &$item) {
            $item['imagen'] = base64_encode($item['imagen']); // Encode BLOB to base64
        }
        return $this->respond(['employees_images' => $data], 200);
    }

    public function create()
    {
        $rules = [
            'imagen' => ['rules' => 'uploaded[imagen]|max_size[imagen,2048]'],
            'tipo_imagen' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'Employees_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];

        if ($this->validate($rules)) {
            $model = new EmployeesImagesModel();
            $imageFile = $this->request->getFile('imagen');
            $data = [
                'imagen' => file_get_contents($imageFile->getTempName()),
                'tipo_imagen' => $this->request->getVar('tipo_imagen'),
                'Employees_id' => $this->request->getVar('Employees_id')
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
            'imagen' => ['rules' => 'uploaded[imagen]|max_size[imagen,2048]'],
            'tipo_imagen' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'Employees_id' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];
        if ($this->validate($rules)) {
            $model = new EmployeesImagesModel();
            $imageFile = $this->request->getFile('imagen');
            $data = [
                'imagen' => file_get_contents($imageFile->getTempName()),
                'tipo_imagen' => $this->request->getVar('tipo_imagen'),
                'Employees_id' => $this->request->getVar('Employees_id')
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
        $model = new EmployeesImagesModel();
        $model->where('id', $id)->delete($id);
        return $this->respond(['message' => 'Deleted Successfully'], 200);
    }
}
