<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Usuario extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'usuarios';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = 
        [
            "nombre",
            "apellido",
            "email",
            "id_roles",
        ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    //protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findUsuarioById($id)
    {   
        $usuario = $this
            ->select('s.*, c.role as roles_name')
            ->from('usuarios s')
            ->where(['s.id' => $id])
            ->join('roles c', 'c.id = s.id_roles', 'left')
            ->asArray()->first();

        if (!$usuario) throw new Exception('Could not find usuario for specified ID');

        return $usuario;
    }
  public function findUsuarioLogin($email,$password)
    {   
        $usuario = $this
            ->select('s.*, c.role as roles_name')
            ->from('usuarios s')
          
          ->where(['s.email' => $email])
          ->where(['s.password' => $password])
            ->join('roles c', 'c.id = s.id_roles', 'left')
            ->asArray()->first();

        if (!$usuario) throw new Exception('Could not find usuario for specified ID');

        return $usuario;
    }
 
 
}
