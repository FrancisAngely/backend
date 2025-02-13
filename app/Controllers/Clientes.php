<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cliente;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Clientes extends BaseController
{
    public function index()
    {
        $model = new Cliente();

        return $this->getResponse(
            [
                'message' => 'Clientes retrieved successfully',
                'clientes' => $model->findAll()
            ]
        );
    }
 public function datatable()
    {
       $model = new Cliente(); 
  return $this->getResponse([
                'message' => 'Clientes retrieved successfully',
                'data' => $model->findAll()
            ]);
    }


    /**
    * Create a new Cliente
    */
   public function store()
   {
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
        ];
        $input = $this->getRequestInput($this->request);

        /*if(!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
            );
        }*/

        $model = new Cliente();
        $model->save($input);
         $cliente = $model->where('id', $model->getInsertID())->first();
        return $this->getResponse(
            [
                'message' => 'Cliente added successfully',
                'cliente' => $cliente
            ]
        );
   }

    /**
    * Get a single class by CODE
    */
    public function show($id)
    {
        try {
            $model = new Cliente();
            $cliente = $model->findClienteById($id);
 
            return $this->getResponse(
                [
                    'message' => 'Cliente retrieved successfully',
                    'cliente' => $cliente
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
    * Update a Cliente
    */
  public function update($id)
   {
       try {
            $model = new Cliente();
            $model->findClienteById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $cliente = $model->findClienteById($id);

            return $this->getResponse(
                [
                    'message' => 'Cliente updated successfully',
                    'cliente' => $cliente
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
             $model = new Cliente();
             $usuario = $model->findClienteById($id);
             $model->delete($usuario);
 
             return $this
                 ->getResponse(
                     [
                         'message' => 'Cliente deleted successfully',
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
