<?php

namespace App\Controllers\API;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class Usuarios extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new UsuarioModel());
    }

  public function index()
{
    $usuarios = $this->model->findAll();
    return $this->respond($usuarios);
}

  public function create()
  {
      try{
          $usuario = $this->request->getJSON();
          if($this->model->insert($usuario)):
            $usuario->id = $this->model->insertID();
            return $this->respondCreated($usuario);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

      }catch(\Exception $e){
          return $this->failServerError($e,'Error al crear el usuario');
      }
  }

  public function edit($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $usuario = $this->model->find($id);
            if($usuario == null)
              return $this->failNotFound('No se encontro el usuario con el id: '.$id);
            return $this->respond($usuario);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function update($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $usuarioVerificado = $this->model->find($id);
            if( $usuarioVerificado == null)
              return $this->failNotFound('No se encontro el usuario con el id: '.$id);
           $usuario = $this->request->getJSON();
           if($this->model->update($id, $usuario)):
            $usuario->id = $id;
            return $this->respondUpdated($usuario);
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
            $usuarioVerificado = $this->model->find($id);
            if( $usuarioVerificado == null)
              return $this->failNotFound('No se encontro el usuario con el id: '.$id);
          
           if($this->model->delete($id)):
           
            return $this->respondDeleted($usuarioVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el usuario');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

}
