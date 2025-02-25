<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Usuarios extends BaseController
{
    public function index()
    {
        $model = new Usuario();

        return $this->getResponse(
            [
                'message' => 'Usuarios retrieved successfully',
                'usuarios' => $model->findAll()
            ]
        );
    }
 public function datatable()
    {
       $model = new Usuario(); 
  return $this->getResponse([
                'message' => 'Usuarios retrieved successfully',
                'data' => $model->findAll(),
                 'recordsTotal'=>count($model->findAll()),
                'recordsFiltered'=>5,
            ]);
    }

   public function store()
   {
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
        ];
        $input = $this->getRequestInput($this->request);

        if(!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $model = new Usuario();
        $model->save($input);

        return $this->getResponse(
            [
                'message' => 'Usuario added successfully',
                'class' => $model
            ]
        );
   }

    public function show($id)
    {
        try {
            $model = new Usuario();
            $usuario = $model->findUsuarioById($id);
 
            return $this->getResponse(
                [
                    'message' => 'Usuario retrieved successfully',
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
 
 public function login()
    {
       
       try {
   
        
        $email=$this->request->getVar('email');
        $password=$this->request->getVar('password');
        
            $model = new Usuario();
            $usuario = $model->findUsuarioLogin($email,$password);
 
            return $this->getResponse(
                [
                    'message' => 'Usuario retrieved successfully',
                    'usuario' => $usuario,
                    'token' => "valido"
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
    * Update a Usuario
    */
  public function update($id)
   {
       try {
            $model = new Usuario();
            $model->findUsuarioById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $usuario = $model->findUsuarioById($id);

            return $this->getResponse(
                [
                    'message' => 'Usuario updated successfully',
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
             $model = new Usuario();
             $usuario = $model->findUsuarioById($id);
             $model->delete($usuario);
 
             return $this
                 ->getResponse(
                     [
                         'message' => 'Usuario deleted successfully',
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
