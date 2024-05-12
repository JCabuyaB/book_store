<?php
require_once 'helpers/utils.php';

spl_autoload_register(
    function ($class) {
        // convertir la clase en ruta
        $path = str_replace(DIRECTORY_SEPARATOR, '/', $class) . '.php';
        if(file_exists($path)){
            require_once $path;
        }else{
            showError();
        }
    }
);
