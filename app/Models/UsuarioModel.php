<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{

    protected $table         = 'usuario';
    protected $primaryKey    = 'id';

    protected $returnType    = 'array';
    protected $allowedFields = ['nombre', 'username', 'password','rol_id'];

    protected $useTimestamps  = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'nombre'   => 'required|alpha_space|max_length[65]',
        'username' => 'required|alpha_numeric_space|max_length[10]',
        'password' => 'required|alpha_numeric_space|max_length[10]',
        'rol_id' => 'required|integer|is_valid_rol',
    ];

    protected $skipValidation = false;
}