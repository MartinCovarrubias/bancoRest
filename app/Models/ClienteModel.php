<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model {

    protected $table         = 'cliente';
    protected $primaryKey    = 'id';

    protected $returnType    = 'array';
    protected $allowedFields = ['nombre', 'apellido', 'telefono', 'correo'];

    protected $useTimestamps = true; //para usar created_at y updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'nombre'   => 'required|alpha_space|max_length[75]',
        'apellido' => 'required|alpha_space|max_length[75]',
        'telefono' => 'required|alpha_numeric_space|max_length[8]',
        'correo'   => 'required|valid_email|max_length[85]',
    ];

    protected $validationMessages = [
        'correo' => [
            'valid_email' => 'El campo correo debe contener un correo valido'
        ],
    ];


    
    protected $skipValidation = false;

 
}