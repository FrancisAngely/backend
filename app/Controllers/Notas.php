<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Notas as NotasModel;
use App\Models\Alumno as Student;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Notas extends BaseController
{
    public function index()
    {
        $model = new NotasModel();

        return $this->getResponse(
            [
                'message' => 'Notas retrieved successfully',
                'notas' => $model->findAll()
            ]
        );
    }

    public function datatable()
    {
        $model = new NotasModel();
        return $this->getResponse([
            'message' => 'Notas retrieved successfully',
            'data' => $model->findAll(),
            'recordsTotal' => count($model->findAll()),
            'recordsFiltered' => 5,
        ]);
    }
    public function store()
    {
        $rules = [
            'id_alumnos' => 'required',
            'id_modulos' => 'required',
            'nota' => 'required',
        ];
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $model = new NotasModel();
        $model->save($input);

        return $this->getResponse(
            [
                'message' => 'Student added successfully',
                'class' => $model
            ]
        );
    }

    /**
     * Get a single class by CODE
     */
    public function show($id)
    {
        try {
            $model = new NotasModel();
            $notas = $model->findClassById($id);

            return $this->getResponse(
                [
                    'message' => 'Notas retrieved successfully',
                    'notas' => $notas
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find usuario for specified ID',
                    'error' => $e->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update a Class
     */
    public function update($id)
    {
        try {
            $model = new NotasModel();
            $model->findClassById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $class = $model->findClassById($id);

            return $this->getResponse(
                [
                    'message' => 'Class updated successfully',
                    'client' => $class
                ]
            );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Delete a Class
     */
    public function destroy($id)
    {
        try {
            $model = new NotasModel();
            $client = $model->findClassById($id);
            $model->delete($client);

            return $this
                ->getResponse(
                    [
                        'message' => 'Class deleted successfully',
                    ]
                );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}