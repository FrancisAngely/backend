<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Alumno extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'alumnos';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = 
        [
            "nombre",
            "apellidos"
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

    public function findStudentById(string $id)
    {
        $alumno = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$alumno) 
            throw new Exception('Student does not exist for specified ID');

        return $alumno;
    }
}