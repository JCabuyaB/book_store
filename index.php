<?php
session_start();
ob_start();
require_once 'autoload.php';
require_once 'config/parameters.php';
require_once 'views/layout/header.php';

// uses
use  helpers\Utils;

// controlador lateral
// controlador
if (isset($_GET['controller'])) {
    $controller_name = $_GET['controller'];
} elseif (!isset($_GET['controller'])) {
    $controller_name = default_controller;
}

// crear objeto y ejecutar accion
if (isset($controller_name) && !empty($controller_name)) {
    $controller_context = controller_context . $controller_name;
    $controller = new $controller_context;

    // accion
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = default_action;
    }

    // verificar si existe el metodo
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Utils::showError();
    }
} else {
    Utils::showError();
}


require_once 'views/layout/footer.php';
