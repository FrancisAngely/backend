<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Localidad extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'localidades';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = 
        [
            "name"
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

    public function findLocalidadById(string $id)
    {
        $class = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$class) 
            throw new Exception('Class does not exist for specified ID');

        return $class;
    }
}
