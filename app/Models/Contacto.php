<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Contacto extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'contactos';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = 
        [
            "nombre","email","asunto","mensaje"
        ];

    // Dates
   // protected $useTimestamps        = false;
    //protected $dateFormat           = 'datetime';
    //protected $createdField         = 'created_at';
    //protected $updatedField         = 'updated_at';
    //protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findContactoById(string $id)
    {
        $contacto = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$contacto) 
            throw new Exception('Class does not exist for specified ID');

        return $contacto;
    }
}
