<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Role;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Roles extends BaseController
{
    public function index()
    {
        $model = new Role();

        return $this->getResponse(
            [
                'message' => 'Roles retrieved successfully',
                'roles' => $model->findAll()
            ]
        );
    }
    public function datatable()
    {
        $model = new Role();
        return $this->getResponse([
            'message' => 'Roles retrieved successfully',
            'data' => $model->findAll(),
            'recordsTotal' => count($model->findAll()),
            'recordsFiltered' => 5,
        ]);
    }

    /**
     * Create a new Role
     */
    public function store()
    {
        $rules = [
            'role' => 'required'
        ];
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $model = new Role();
        $model->save($input);

        return $this->getResponse(
            [
                'message' => 'Role added successfully',
                'role' => $model
            ]
        );
    }

    /**
     * Get a single class by CODE
     */
    public function show($id)
    {
        try {
            $model = new Role();
            $usuario = $model->findRoleById($id);

            return $this->getResponse(
                [
                    'message' => 'Role retrieved successfully',
                    'usuario' => $usuario
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
     * Update a Role
     */
    public function update($id)
    {
        try {
            $model = new Role();
            $model->findRoleById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $usuario = $model->findRoleById($id);

            return $this->getResponse(
                [
                    'message' => 'Role updated successfully',
                    'usuario' => $usuario
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
            $model = new Role();
            $usuario = $model->findRoleById($id);
            $model->delete($usuario);

            return $this
                ->getResponse(
                    [
                        'message' => 'Role deleted successfully',
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
