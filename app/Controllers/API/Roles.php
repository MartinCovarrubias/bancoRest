<?php

namespace App\Controllers\API;

use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;

class Roles extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new RolModel());
    }

  public function index()
{
    $roles = $this->model->findAll();
    return $this->respond($roles);
}

  public function create()
  {
      try{
          $rol = $this->request->getJSON();
          if($this->model->insert($rol)):
            $rol->id = $this->model->insertID();
            return $this->respondCreated($rol);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

      }catch(\Exception $e){
          return $this->failServerError($e,'Error al crear el rol');
      }
  }

  public function edit($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $rol = $this->model->find($id);
            if($rol == null)
              return $this->failNotFound('No se encontro el rol con el id: '.$id);
            return $this->respond($rol);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function update($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $rolVerificado = $this->model->find($id);
            if( $rolVerificado == null)
              return $this->failNotFound('No se encontro el rol con el id: '.$id);
           $rol = $this->request->getJSON();
           if($this->model->update($id, $rol)):
            $rol->id = $id;
            return $this->respondUpdated($rol);
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
            $rolVerificado = $this->model->find($id);
            if( $rolVerificado == null)
              return $this->failNotFound('No se encontro el rol con el id: '.$id);
          
           if($this->model->delete($id)):
           
            return $this->respondDeleted($rolVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el rol');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

}
