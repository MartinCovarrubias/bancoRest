<?php namespace App\Models\CustomRules;

use App\Models\ClienteModel;
use App\Models\CuentaModel;
use App\Models\TipoTransaccionModel;
use App\Models\RolModel;
class MyCustomRules
{
   public function is_valid_cliente(int $id): bool{

    $model = new ClienteModel();
    $cliente = $model->find($id);

    return $cliente == null ? false : true;

 
   }

   public function is_valid_cuenta(int $id): bool{

    $model = new CuentaModel();
    $cuenta = $model->find($id);

    return $cuenta == null ? false : true;

 
   }

   
   public function is_valid_rol(int $id): bool{

      $model = new RolModel();
      $cuenta = $model->find($id);
  
      return $cuenta == null ? false : true;
  
   
     }

   public function is_valid_tipo_transaccion(int $id): bool{

    $model = new TipoTransaccionModel();
    $tipoTransaccion = $model->find($id);

    return $tipoTransaccion == null ? false : true;

 
   }

    
}