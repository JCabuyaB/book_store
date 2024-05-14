<?php

namespace controllers;

use models\Usuario as ModeloUsuario;

class Usuario
{
    #region vistas
    public function index()
    {
        require_once 'views/usuario/login.php';
    }

    public function registrarse()
    {
        require_once 'views/usuario/registro.php';
    }
    #endregion

    #region CRUD
    public function registrar()
    {
        if (isset($_POST)) {
            // variables
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
            $correo = isset($_POST['email']) ? $_POST['email'] : false;
            $contra = isset($_POST['pass']) ? $_POST['pass'] : false;
            $confirmar_contra = isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            // errores
            $errors = array();

            // validar datos
            $validar_nombre = validar_texto($nombre, 'nombre');
            if ($validar_nombre) {
                $errors['nombre'] = $validar_nombre;
            }

            $validar_rol = validar_texto($rol, 'rol');
            if ($validar_rol) {
                $errors['rol'] = $validar_rol;
            }

            $validar_correo = validar_email($correo);
            if ($validar_correo) {
                $errors['correo'] = $validar_correo;
            }

            $validar_contra = validar_contra($contra);
            if ($validar_contra) {
                $errors['contra'] = $validar_contra;
            }

            $validar_confirmar_contra = validar_contra($confirmar_contra);
            if ($validar_confirmar_contra) {
                $errors['confirmar_contra'] = $validar_confirmar_contra;
            }

            $validar_departamento = validar_texto($departamento, 'departamento');
            if ($validar_departamento) {
                $errors['departamento'] = $validar_departamento;
            }

            $validar_municipio = validar_texto($municipio, 'municipio');
            if ($validar_municipio) {
                $errors['municipio'] = $validar_municipio;
            }

            $comparar_contra = comparar_contra($contra, $confirmar_contra);
            if ($comparar_contra) {
                $errors['comparar_contra'] = $comparar_contra;
            }

            if (empty($direccion)) {
                $errors['direccion'] = "La direccion no puede estar vacía";
            }

            // hacer una accion en base a si hay errores o  no
            if (count($errors) == 0) {
                // encriptar contraseña
                $contra_segura = password_hash($contra, PASSWORD_BCRYPT, ['cost' => 4]);

                // insertar registro
                $usuario = new ModeloUsuario();
                $usuario->setCorreo($correo);

                $existe = $usuario->verificar_existencia_usuario();

                if ($existe) {
                    $_SESSION['action_status']['failed'] = "El usuario ya existe";
                } else {
                    $usuario->setNombre($nombre);
                    $usuario->setContra($contra_segura);
                    $usuario->setDepartamento($departamento);
                    $usuario->setMunicipio($municipio);
                    $usuario->setDireccion($direccion);

                    // funcion para insertar
                    $result = $usuario->crear_usuario(null);

                    if ($result) {
                        $_SESSION['action_status']['success'] = 'Usuario registrado';
                    } else {
                        $_SESSION['action_status']['failed'] = 'Registro fallido';
                    }
                }
            } else {
                $_SESSION['current_data'] = $_POST;
                $_SESSION['errors'] = $errors;
            }
        } else {
            $_SESSION['user_register_error'] = 'Registro fallido';
        }

        header('Location: ' . base_url . 'usuario/registrarse');
    }
    #endregion

    public function login()
    {
        if (isset($_POST)) {
            $usuario = isset($_POST['email']) ? $_POST['email'] : false;
            $contra = isset($_POST['password']) ? $_POST['password'] : false;

            $errors = array();

            $usuario_validado = validar_email($usuario);
            if ($usuario_validado) {
                $errors['usuario'] = $usuario_validado;
            }

            $contra_validada = validar_contra($contra);
            if ($contra_validada) {
                $errors['contra'] = $contra_validada;
            }

            if (count($errors) == 0) {
                $user = new ModeloUsuario();
                $user->setCorreo($usuario);
                $user->setContra($contra);

                $login = $user->iniciar_sesion();

                if ($login && is_object($login)) {
                    $_SESSION['user'] = $login;
                    header('Location: ' . base_url);
                    exit();
                } else {
                    $_SESSION['current_data'] = $_POST;
                    $_SESSION['action_status']['failed'] = $login;
                }
            } else {
                $_SESSION['current_data'] = $_POST;
                $_SESSION['errors'] = $errors;
            }
        } else {
            $_SESSION['user_login_error'] = 'Inicio de sesión fallido';
        }
        header('Location: ' . base_url . 'usuario/index');
    }

    public function logout(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
        header('Location: ' . base_url .'usuario/index');
    }
}
