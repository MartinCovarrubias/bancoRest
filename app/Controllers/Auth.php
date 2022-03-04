<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        helper('secure_password');
    }

    public function login()
    {
        Try{
           $username = $this->request->getPost('username');
           $password = $this->request->getPost('password');

           $usuarioModel = new UsuarioModel();
          $validateUsuario = $usuarioModel->where('username',$username)->first();

           if($validateUsuario == null)
           return $this->failNotFound('Usuario no encontrado');

            if (verifyPassword($password, $validateUsuario['password'])):

                $jwt = $this->generateJWT($validateUsuario);
                return $this->respond(['token'=>$jwt],201);

            else:
                return $this->failValidationErrors('Contraseña incorrecta');
                endif;

        }catch (\Exception $e){
            return $this->failServerError($e,"Error al intentar iniciar sesión");
        }
    }

    protected function generateJWT($usuario){
        $key = Services::getSecretKey();
        $time = time();
        $payload = [
            'aud' => base_url(),
            'iat' =>  $time, //tiempo en que se genero el token
            'exp' => $time + 60, //tiempo de expiracion del token dato entero
            'data'=>[
            'nombre'=> $usuario ['nombre'],
            'username'=> $usuario ['username'],
            'rol'=> $usuario ['rol_id']
            ]
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}