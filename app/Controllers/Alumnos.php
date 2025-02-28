<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Alumno;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Alumnos extends BaseController
{
    public function index()
    {
        $model = new Alumno();

        return $this->getResponse(
            [
                'message' => 'Students retrieved successfully',
                'alumnos' => $model->findAll()
            ]
        );
    }

    public function datatable()
    {
        $model = new Alumno();
        return $this->getResponse([
            'message' => 'Alumnos retrieved successfully',
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
            'nombre' => 'required',
            'apellidos' => 'required',
        ];
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $model = new Alumno();
        $model->save($input);

        return $this->getResponse(
            [
                'message' => 'Student added successfully',
                'alumno' => $input
            ]
        );
    }

    /**
     * Get a single student by ID
     */
    public function show($id)
    {
        try {
            $model = new Alumno();
            $student = $model->findStudentById($id);

            return $this->getResponse(
                [
                    'message' => 'Student retrieved successfully',
                    'student' => $student
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find student for specified ID',
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
            $model = new Alumno();
            $model->findStudentById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $student = $model->findStudentById($id);

            return $this->getResponse(
                [
                    'message' => 'Student updated successfully',
                    'student' => $student
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
     * Delete a Student
     */
    public function destroy($id)
    {
        try {
            $model = new Alumno();
            $student = $model->findStudentById($id);
            $model->delete($student);

            return $this
                ->getResponse(
                    [
                        'message' => 'Student deleted successfully',
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
