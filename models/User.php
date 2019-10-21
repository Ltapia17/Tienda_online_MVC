<?php

class User
{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $imagen;
    private $rol;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getApellido()
    {
        return $this->apellido;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT,['cost' =>4]);
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function getRol()
    {
        return $this->rol;
    }


    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellido($apellido)
    {
        $this->apellido = $this->db->real_escape_string($apellido);
    }

    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
    function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function save()
    {
    $sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre()}','{$this->getApellido()}','{$this->getEmail()}','{$this->getPassword()}','user',null)";
        $save = $this->db->query($sql);

            $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;

        

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $user = $login->fetch_object();

            $verify = password_verify($password, $user->password);

            if($verify){
                $result = $user;
            }
            
        }
            return $result;
    }
}
