<?php
class Order
{

    private $id;
    private $usuario_id;
    private $comuna;
    private $ciudad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function getUsuario_id()
    {
        return $this->usuario_id;
    }

    function getComuna()
    {
        return $this->comuna;
    }

    function getCiudad()
    {
        return $this->ciudad;
    }

    function getDireccion()
    {
        return $this->direccion;
    }

    function getCoste()
    {
        return $this->coste;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getHora()
    {
        return $this->hora;
    }


    function setId($id)
    {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    function setComuna($comuna)
    {
        $this->comuna = $this->db->real_escape_string($comuna);
    }

    function setCiudad($ciudad)
    {
        $this->ciudad = $this->db->real_escape_string($ciudad);
    }

    function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste)
    {
        $this->coste = $coste;
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setHora($hora)
    {
        $this->hora = $hora;
    }


    public function getAllProduct()
    {
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $productos;
    }

    public function save()
    {
        $sql = "INSERT INTO pedidos VALUES(null,{$this->getUsuario_id()},'{$this->getComuna()}','{$this->getCiudad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(),CURTIME())";

        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function getOne(){
    $producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
    return $producto->fetch_object();
    }


    public function getOneByUser()
    {
        $sql = "SELECT p.id, p.coste  FROM pedidos p "
            //. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
            . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getProductsByOrder($id)
    {
        /*$sql = "SELECT * FROM productos WHERE id IN(SELECT producto_id FROM lineas_pedidos WHERE
        pedido_id = {$id})";*/

        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
        . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
        . "WHERE lp.pedido_id = {$id}";
        $productos = $this->db->query($sql);
        return $productos;
    }


    public function saveLine()
    {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']})";
            $save = $this->db->query($insert);
        }

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function getAllByUser()
    {
        $sql = "SELECT p.* FROM pedidos p " 
            . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $pedido = $this->db->query($sql);
        
        return $pedido;
    }

    public function updateOneStatus(){
    $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
    $sql .= " WHERE id={$this->getId()}";
        $save = $this->db->query($sql);

      
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    
}
