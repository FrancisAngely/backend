<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Contacto;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Contactos extends BaseController
{
    public function index()
    {
        $model = new Contacto();

        return $this->getResponse(
            [
                'message' => 'Contactos retrieved successfully',
                'contactos' => $model->findAll()
            ]
        );
    }
 public function datatable()
    {
       $model = new Contacto(); 
  return $this->getResponse([
                'message' => 'Contactos retrieved successfully',
                'data' => $model->findAll()
            ]);
    }


    /**
    * Create a new Contacto
    */
   public function store()
   {
        $rules = [
         'nombre' => 'required',
         'email' => 'required',
         'asunto' => 'required',
         'mensaje' => 'required',
        ];
        $input = $this->getRequestInput($this->request);

        /*if(!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
            );
        }*/

        $model = new Contacto();
        $model->save($input);
         $contacto = $model->where('id', $model->getInsertID())->first();
        return $this->getResponse(
            [
                'message' => 'Contacto added successfully',
                'contacto' => $contacto
            ]
        );
   }

    /**
    * Get a single class by CODE
    */
    public function show($id)
    {
        try {
            $model = new Contacto();
            $contacto = $model->findContactoById($id);
 
            return $this->getResponse(
                [
                    'message' => 'Contacto retrieved successfully',
                    'contacto' => $contacto
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
    * Update a Contacto
    */
  public function update($id)
   {
       try {
            $model = new Contacto();
            //$model->findContactoById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $contacto = $model->findContactoById($id);

            return $this->getResponse(
                [
                    'message' => 'Contacto updated successfully',
                    'contacto' => $contacto
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
             $model = new Contacto();
             $c = $model->findContactoById($id);
             $model->delete($c);
 
             return $this
                 ->getResponse(
                     [
                         'message' => 'Contacto deleted successfully',
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
