<?php
use controllers\Errors;

// mostrar error de recurso no encontrado  
function showError(){
    $error = new Errors();
    $error->not_found();
}