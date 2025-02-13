<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Localidad;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Localidades extends BaseController
{
    public function index()
    {
        $model = new Localidad();

        return $this->getResponse(
            [
                'message' => 'Localidades retrieved successfully',
                'localidades' => $model->findAll()
            ]
        );
    
    }

    /**
    * Create a new Localidad
    */
   public function store()
   {
        $rules = [
            'name' => 'required',
        ];
        $input = $this->getRequestInput($this->request);

        if(!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $model = new Localidad();
        $model->save($input);
        $hero = $model->where('id', $model->getInsertID())->first();
        return $this->getResponse(
            [
                'message' => 'Localidad added successfully',
                'hero' => $hero
            ]
        );
   }

    /**
    * Get a single class by CODE
    */
    public function show($id)
    {
        try {
            $model = new Localidad();
            $hero = $model->findLocalidadById($id);
 
            return $this->getResponse(
                [
                    'message' => 'Localidad retrieved successfully',
                    'hero' => $hero
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find hero for specified ID',
                    'error' => $e->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    /**
    * Update a Localidad
    */
  public function update($id)
   {
       try {
            $model = new Localidad();
            $model->findLocalidadById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $hero = $model->findLocalidadById($id);

            return $this->getResponse(
                [
                    'message' => 'Localidad updated successfully',
                    'hero' => $hero
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
             $model = new Localidad();
             $hero = $model->findLocalidadById($id);
             $model->delete($hero);
 
             return $this
                 ->getResponse(
                     [
                         'message' => 'Localidad deleted successfully',
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
