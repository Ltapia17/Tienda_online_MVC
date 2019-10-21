<?php
require_once 'models/User.php';
class UsuarioController
{
    public function index()
    { }

    public function registro()
    {
        require_once './views/users/registro.php';
    }

    public function save()
    {
        if (isset($_POST)) {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($nombre && $apellido && $password && $email) {



                $user = new User();
                $user->setNombre($nombre);
                $user->setApellido($apellido);
                $user->setPassword($password);
                $user->setEmail($email);

                $save = $user->save();
                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else { 
                $_SESSION['register'] = "failed";
            }   
        } else {
            $_SESSION['register'] = "failed";
        }
        header("Location:" . RUTE_URL . '/usuario/registro');
    }

    public function login(){
        if(isset($_POST)){

            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);

            $identity = $user->login();

            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;

                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'identificacion fallida';
            }
        }
        header("Location:".RUTE_URL);
    }


    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("Location:".RUTE_URL);
    }
}
