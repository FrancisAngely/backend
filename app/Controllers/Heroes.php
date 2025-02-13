<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Hero;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Heroes extends BaseController
{
    public function index()
    {
        $model = new Hero();

        return $this->getResponse(
            [
                'message' => 'Heroes retrieved successfully',
                'heroes' => $model->findAll()
            ]
        );
    
    }

    /**
    * Create a new Hero
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

        $model = new Hero();
        $model->save($input);
        $hero = $model->where('id', $model->getInsertID())->first();
        return $this->getResponse(
            [
                'message' => 'Hero added successfully',
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
            $model = new Hero();
            $hero = $model->findHeroById($id);
 
            return $this->getResponse(
                [
                    'message' => 'Hero retrieved successfully',
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
    * Update a Hero
    */
  public function update($id)
   {
       try {
            $model = new Hero();
            $model->findHeroById($id);

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $hero = $model->findHeroById($id);

            return $this->getResponse(
                [
                    'message' => 'Hero updated successfully',
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
             $model = new Hero();
             $hero = $model->findHeroById($id);
             $model->delete($hero);
 
             return $this
                 ->getResponse(
                     [
                         'message' => 'Hero deleted successfully',
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
