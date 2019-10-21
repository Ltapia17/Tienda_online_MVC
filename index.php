<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/config.php';
require_once 'helpers/util.php';
require_once 'views/includes/header.php';
require_once 'views/includes/sidebar.php';



function showError()
{
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    $nameController = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && (!isset($_GET['action']))) {
    $nameController = CONTROLLER_DEFAULT;
} else {
    showError();
}

if (class_exists($nameController)) {
    $controller = new $nameController();

    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();
    } elseif (!isset($_GET['controller']) && (!isset($_GET['action']))) {
        $ActionDefault = ACTION_DEFAULT;
        $controller->index();
    } else {
        showError();
    }
} else {
    showError();
}

require_once 'views/includes/footer.php';
