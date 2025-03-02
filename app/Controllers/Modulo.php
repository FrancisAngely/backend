<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modulos;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Modulo extends BaseController
{
    public function index()
    {
        $model = new Modulos();

        return $this->getResponse(
            [
                'message' => 'Students retrieved successfully',
                'modulos' => $model->findAll()
            ]
        );
    }


    public function datatable()
    {
        $model = new Modulos();
        return $this->getResponse([
            'message' => 'Modulos retrieved successfully',
            'data' => $model->findAll(),
            'recordsTotal' => count($model->findAll()),
            'recordsFiltered' => 5,
        ]);
    }

    /**
     * Create a new Student
     */
    public function store()
    {
        $rules = [
            'modulo' => 'required',
        ];
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $model = new Modulos();
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
            $model = new Modulos();
            $modulos = $model->findClassById($id);

            return $this->getResponse(
                [
                    'message' => 'Modulos retrieved successfully',
                    'modulos' => $modulos
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
     * Update a Student
     */
    public function update($id)
    {
        try {
            $model = new Modulos();
            $model->findClassById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $modulos = $model->findClassById($id);

            return $this->getResponse(
                [
                    'message' => 'Modulos updated successfully',
                    'modulos' => $modulos
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
            $model = new Modulos();
            $student = $model->findClassById($id);
            $model->delete($student);

            return $this
                ->getResponse(
                    [
                        'message' => 'Modulo deleted successfully',
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