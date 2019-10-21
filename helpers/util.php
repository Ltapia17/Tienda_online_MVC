<?php

class Util{

    public static function deleteSession($nameSession){
        if(isset($_SESSION[$nameSession])){
        $_SESSION[$nameSession] = null;
        unset($_SESSION[$nameSession]);
        }

        return $nameSession;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".RUTE_URL);
        }else{
            return true;
        }
    }
        public static function isUser(){
            if(!isset($_SESSION['identity'])){
                header("Location:".RUTE_URL);
            }else{
                return true;
            }
        }
        


    public static function showCategory(){
        require_once 'models/Category.php';
        $categoria = new Category();
        $categorias = $categoria->getAllCategorias();
        return $categorias;
    }

    public static function statsCart (){
        $stats = array(
            'count' =>0,
            'total' => 0
        );
        
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            foreach($_SESSION['carrito'] as $value){
                $stats['total'] += $value['precio']*$value['unidades'];
            }
        }
        return $stats;
    }

    public static function showStatus($status){
        $value = 'Pendiente';

        if($status == 'confirm'){
            $value = 'Pendiente';
        }elseif($status == 'preparation'){
            $value = 'En preparacion';
        }elseif($status == 'ready'){
            $value = 'Preparado';
        }elseif($status == 'sended'){
            $value = 'Enviado';
        }
        return $value;
    }
}