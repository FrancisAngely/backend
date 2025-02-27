<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Role extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'roles';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = 
        [
            "role"
        ];

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findRoleById(string $id)
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
