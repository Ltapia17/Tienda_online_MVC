<?php 

require_once 'models/Category.php';
require_once 'models/Product.php';

class CategoriaController{
    public function index(){
        Util::isAdmin();
        $categoria = new Category();
        $categorias = $categoria->getAllCategorias();
        
        require_once 'views/category/categoria.php';
    }

    public function view(){

        if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Conseguir categoria
			$categoria = new Category();
			$categoria->setId($id);
            $categoria = $categoria->getOneCategory();

            $producto = new Product();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/category/view.php';
    }

    public function crear(){
        Util::isAdmin();
        require_once 'views/category/create.php';
    }

    public function save(){
        Util::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
        $categoria = new Category();
        $categoria->setNombre($_POST['nombre']);
        $save = $categoria->save();
        }else{
            echo "Algo salio mal";
        }
        header("Location:".RUTE_URL."/categoria/index");
    }
}