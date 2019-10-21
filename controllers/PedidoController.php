<?php

require_once 'models/order.php';

class PedidoController
{
    public function hacer()
    {
        require_once 'views/order/do.php';
    }

    public function confirm()
    {
        if (isset($_SESSION['identity'])) {
            $userId = $_SESSION['identity']->id;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $comuna = isset($_POST['comuna']) ? $_POST['comuna'] : false;

            $stats = Util::statsCart();
            $cost = $stats['total'];

            if ($ciudad && $direccion && $comuna) {

                $pedido = new Order();
                $pedido->setUsuario_id($userId);
                $pedido->setComuna($comuna);
                $pedido->setDireccion($direccion);
                $pedido->setCiudad($ciudad);
                $pedido->setCoste($cost);
                $save = $pedido->save();

                $saveLine = $pedido->saveLine();

                if ($save && $saveLine) {
                    $_SESSION['pedido'] = "complete";
                } else {
                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed";
            }

            header("Location:" . RUTE_URL . '/pedido/confirmed');
        } else {
            header("Location:" . RUTE_URL);
        }
    }

    public function confirmed()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Order();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();
            $pedidoProducto = new Order();
            $productos = $pedidoProducto->getProductsByOrder($pedido->id);
        }
        require_once 'views/order/confirm.php';
    }


    public function mis_pedidos()
    {
        Util::isUser();
        $userId = $_SESSION['identity']->id;
        $pedido = new Order();


        $pedido->setUsuario_id($userId);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/order/myorders.php';
    }

    public function detalle()
    {
        Util::isUser();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $pedido = new Order();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            $pedido_producto = new Order();
            $productos = $pedido_producto->getProductsByOrder($id);


            require_once 'views/order/detail.php';
        } else {
            header("Location:" . RUTE_URL . '/pedido/myorders');
        }
    }

    public function gestion()
    {
        Util::isAdmin();
        $gestion = true;

        $pedido = new Order();
        $pedidos = $pedido->getAllProduct();

        require_once 'views/order/myorders.php';
    }

    public function estado()
    {
        Util::isAdmin();

        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];


            $pedido = new Order();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedidos = $pedido->updateOneStatus();

            header("Location:" . RUTE_URL . '/pedido/detalle&id=' . $id);
        } else {
            header("Location:" . RUTE_URL);
        }
    }
}
