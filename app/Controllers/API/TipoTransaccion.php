<?php

namespace App\Controllers\API;

use App\Models\TipoTransaccionModel;
use CodeIgniter\RESTful\ResourceController;

class TipoTransaccion extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new TipoTransaccionModel());
    }

  public function index()
{
    $TipoTransacciones = $this->model->findAll();
    return $this->respond($TipoTransacciones);
}

  public function create()
  {
      try{
          $tipoTransaccion = $this->request->getJSON();
          if($this->model->insert($tipoTransaccion)):
            $tipoTransaccion->id = $this->model->insertID();
            return $this->respondCreated($tipoTransaccion);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

      }catch(\Exception $e){
          return $this->failServerError($e,'Error al crear el tipo de transaccion');
      }
  }

  public function edit($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $tipoTransaccion = $this->model->find($id);
            if($tipoTransaccion == null)
              return $this->failNotFound('No se encontro el tipo de transaccion con el id: '.$id);
            return $this->respond($tipoTransaccion);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function update($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $tipoTransaccionVerificado = $this->model->find($id);
            if( $tipoTransaccionVerificado == null)
              return $this->failNotFound('No se encontro el tipo de transaccion con el id: '.$id);
           $tipoTransaccion = $this->request->getJSON();
           if($this->model->update($id, $tipoTransaccion)):
            $tipoTransaccion->id = $id;
            return $this->respondUpdated($tipoTransaccion);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function delete($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $tipoTransaccionVerificado = $this->model->find($id);
            if( $tipoTransaccionVerificado == null)
              return $this->failNotFound('No se encontro el tipo de transaccion con el id: '.$id);
          
           if($this->model->delete($id)):
           
            return $this->respondDeleted($tipoTransaccionVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el tipo de transaccion');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

}
