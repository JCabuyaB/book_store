<?php

namespace helpers;

use controllers\Errors;

class Utils
{
    // mostrar error de recurso no encontrado  
    public static function showError()
    {
        $error = new Errors();
        $error->index();
    }

    // validar texto
    public static function validarTexto($nombre, $campo)
    {
        $result = false;

        if (empty($nombre)) {
            $result = 'El ' . $campo . ' no puede estar vacío';
        } elseif (preg_match('/[0-9]/', $nombre)) {
            $result = 'El ' . $campo . ' no puede tener numeros';
        }

        return $result;
    }

    #region usuario
    public static function validarEmail($email)
    {
        $result = false;

        if (empty($email)) {
            $result = 'El correo no puede estar vacío';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = 'El correo no es válido';
        }

        return $result;
    }

    public static function validarContra($pass)
    {
        $result = false;

        if (empty($pass)) {
            $result = 'La contraseña no puede estar vacía';
        } elseif (strlen($pass) < 7) {
            $result = 'La contraseña debe tener 7 o más caracteres';
        } elseif (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', $pass)) {
            $result = 'La contraseña debe tener numeros y letras';
        }

        return $result;
    }

    public static function compararContra($pass, $confirm_pass)
    {
        $result = false;

        if ($pass !== $confirm_pass) {
            $result = 'Las contraseñas no coinciden';
        }

        return $result;
    }

    public static function showUserFormErrors($input, ?object $user){
        if(isset($_SESSION['current_data'])){
            return $_SESSION['current_data'][$input];
        }elseif(isset($user)){
            return $user->$input;
        }else{
            return '';
        }
    }
    #endregion
    #region sesiones
    //eliminar session
    public static function eliminarSesion($session_name)
    {
        if (isset($_SESSION[$session_name])) {
            unset($_SESSION[$session_name]);
        }
    }

    public static function validarLogin()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            header('Location: ' . base_url);
        }
    }

    public static function validarLogout()
    {
        if (!isset($_SESSION['user'])) {
            return true;
        } else {
            header('Location: ' . base_url);
        }
    }

    // validar que el usuario sea administrador
    public static function validarAdmin()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['admin'])) {
            return true;
        } else {
            header('Location: ' . base_url);
        }
    }

    public static function validarUsuario()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            header('Location: ' . base_url);
        }
    }

    public static function validarAdminSinRedireccion()
    {
        if (isset($_SESSION['admin'])) {
            return true;
        } else {
            return false;
        }
    }
    #endregion

    #region redirects
    public static function redirectHome(){
        header('Location: ' . base_url);
    }
    #endregion
}
