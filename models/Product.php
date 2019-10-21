<?php

class Product
{

    private $id;
    private $nombre;
    private $descripcion;
    private $categoria_id;
    private $precio;
    private $stock;
    private $fecha;
    private $imagen;

    private $db;

    public function __construct()
    {
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

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getCategoria_id()
    {
        return $this->categoria_id;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getStock()
    {
        return $this->stock;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }

    function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getAllProduct()
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

    public function save()
    {
        $sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}')";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function getAllCategory(){
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
        . "INNER JOIN categorias c ON c.id = p.categoria_id " 
        . "WHERE p.categoria_id = {$this->getCategoria_id()} "
        . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        
        return $productos;
    }

    public function getOne()
    {
        $producto = $this->db->query("SELECT * FROM productos WHERE id={$this->getId()}");
        return $producto->fetch_object();
    }

    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function edit()
    {

        $sql = "UPDATE productos SET nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}',precio={$this->getPrecio()},stock={$this->getStock()},categoria_id={$this->getCategoria_id()}";

        

        if ($this->getImagen() != null) {
            $sql .= ",imagen='{$this->getImagen()}'";
        }

        

        $sql .= " WHERE id={$this->id}";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
}