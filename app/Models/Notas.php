<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Notas extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'notas';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = 
        [
            "id_alumnos",
            "id_modulos",
            "nota"
        ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findClassById(string $id)
    {
        $notas = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$notas) 
            throw new Exception('Class does not exist for specified ID');

        return $notas;
    }
}
