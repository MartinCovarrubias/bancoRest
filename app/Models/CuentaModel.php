<?php namespace App\Models;

use CodeIgniter\Model;

class CuentaModel extends Model{

    protected $table         = 'cuenta';
    protected $primaryKey    = 'id';

    protected $returnType    = 'array';
    protected $allowedFields = ['moneda', 'fondo', 'cliente_id'];

    protected $useTimestamps  = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'moneda'   => 'required|alpha_space|max_length[3]',
        'fondo' => 'required|numeric',
        'cliente_id' => 'required|integer|is_valid_cliente',
    ];

    protected $skipValidation = false;
}