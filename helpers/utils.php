<?php
use controllers\Errors;

// mostrar error de recurso no encontrado  
function showError(){
    $error = new Errors();
    $error->index();
}


//eliminar session
function eliminar_session($session_name){
    if(isset($_SESSION[$session_name])){
        unset($_SESSION[$session_name]);
    }
}

// validar texto
function validar_texto($nombre, $campo){
    $result = false;

    if(empty($nombre)){
       $result = 'El ' . $campo . ' no puede estar vacío'; 
    }elseif(preg_match('/[0-9]/', $nombre)){
       $result = 'El ' . $campo . ' no puede tener numeros'; 
    }

    return $result;
}

#region usuario
function validar_email($email){
    $result = false;

    if(empty($email)){
        $result = "El correo no puede estar vacío";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = "El correo no es válido";
    }

    return $result;
}

function validar_contra($pass){
    $result = false;

    if(empty($pass)){
        $result = "La contraseña no puede estar vacía";
    }elseif(strlen($pass) < 7){
        $result = "La contraseña debe tener 7 o más caracteres";
    }elseif(!preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', $pass)){
        $result = "la contraseña debe tener numeros y letras";
    }

    return $result;
}

function comparar_contra($pass, $confirm_pass){
    $result = false;

    if($pass !== $confirm_pass){
        $result = "Las contraseñas no coinciden";
    }

    return $result;
}
#endregion