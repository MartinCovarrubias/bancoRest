<?php namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model {

    protected $table         = 'rol';
    protected $primaryKey    = 'id';

    protected $returnType    = 'array';
    protected $allowedFields = ['nombre'];

    protected $useTimestamps = true; //para usar created_at y updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'nombre'   => 'required|alpha_space|max_length[75]'
    ];

    

    
    protected $skipValidation = false;

 
}