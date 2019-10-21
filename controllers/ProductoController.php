<?php

require_once 'models/Product.php';

class ProductoController
{
    public function index()
    {
        $producto = new Product();
        $productos = $producto->getRandom(6);
        require_once 'views/products/outstanding.php';
    }


    public function view(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $producto = new Product();
            $producto->setId($id);

            $pro = $producto->getOne();
        }

        require_once 'views/products/view.php';
    }

    public function gestion()
    {
        Util::isAdmin();

        $producto = new Product();
        $productos = $producto->getAllProduct();

        require_once 'views/products/gestion.php';
    }

    public function crear()
    {
        Util::isAdmin();
        require_once 'views/products/create.php';
    }

    public function save()
    {
        Util::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Product();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                //Guardar Imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];


                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        $producto->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);

                    $save = $producto->edit();
                        
                } else {
                    $save = $producto->save();
                    
                }

                if ($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        header("Location:" . RUTE_URL . '/producto/gestion');
    }

    public function edit()
    {
        Util::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $producto = new Product();
            $producto->setId($id);

            $pro = $producto->getOne();
            require_once 'views/products/create.php';
        } else {
            header: ("Location:" . RUTE_URL . '/producto/gestion');
        }
    }

    public function delete()
    {
        Util::isAdmin();

        if (isset($_GET)) {
            $id = $_GET['id'];
            $producto = new Product();
            $producto->setId($id);
            $delete = $producto->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header('Location:' . RUTE_URL . '/producto/gestion');
    }
}
