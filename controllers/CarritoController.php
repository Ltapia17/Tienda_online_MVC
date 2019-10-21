<?php

require_once 'models/product.php';

class CarritoController
{
    public function index()
    {
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = $_SESSION['carrito'];
        }else{
            $carrito = array();
        }

        require_once 'views/cart/cart-view.php';
    }

    public function addCart()
    { 
        if(isset($_GET['id'])){
            $product_id = $_GET['id'];

        }else{
            header("Location:".RUTE_URL);
        }
        
        if(isset($_SESSION['carrito'])){
            $counter = 0;
            foreach($_SESSION['carrito'] as $index => $elemento){
                if($elemento['id_producto'] == $product_id){
                    $_SESSION['carrito'] [$index] ['unidades']++;
                    $counter++;
                }
            }
        }
        if(!isset($counter) || $counter == 0){

            $product = new Product();
            $product->setId(($product_id));
            $product = $product->getOne();

            if(is_object($product)){
                $_SESSION['carrito'] [] = array(
                    "id_producto" => $product->id,
                    "precio" => $product->precio,
                    "unidades" => 1,
                    "producto" => $product

                );
            }
            
        }

        header('Location:'.RUTE_URL.'/carrito/index');
        
    }

    public function delete()
    {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'] [$index]);
            
        }
        header("Location:".RUTE_URL."/carrito/index");
     }

     public function up()
    {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'] [$index] ['unidades']++;
            
        }
        header("Location:".RUTE_URL."/carrito/index");
     }

     public function down()
    {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'] [$index] ['unidades']--;
            if($_SESSION['carrito'] [$index] ['unidades'] == 0){
                unset($_SESSION['carrito'] [$index]);
            }
            
        }
        header("Location:".RUTE_URL."/carrito/index");
     }

    public function deleteAll()
    { 
        unset($_SESSION['carrito']);
        header("Location:".RUTE_URL."/carrito/index");
    }
}
