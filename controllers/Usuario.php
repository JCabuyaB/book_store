<?php

namespace controllers;

use helpers\Utils;
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
        Utils::validarLogout();
        require_once 'views/usuario/registro.php';
    }

    public function eliminar()
    {
        require_once 'views/usuario/eliminar.php';
    }

    public function administrar()
    {
        Utils::validarAdmin();
        require_once 'views/usuario/administrar.php';
    }
    #endregion

    #region CRUD
    public function registrar()
    {
        if (isset($_POST)) {
            // variables
            $nombre = isset($_POST['name']) ? $_POST['name'] : false;
            $rol = isset($_POST['role']) ? $_POST['role'] : $rol ?? 'user';
            $correo = isset($_POST['mail']) ? $_POST['mail'] : false;
            $contra = isset($_POST['password']) ? $_POST['password'] : false;
            $confirmar_contra = isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : false;
            $departamento = isset($_POST['department']) ? $_POST['department'] : false;
            $municipio = isset($_POST['city']) ? $_POST['city'] : false;
            $direccion = isset($_POST['address']) ? $_POST['address'] : false;
            // errores
            $errors = array();

            // validar datos
            $validar_nombre = Utils::validarTexto($nombre, 'nombre');
            if ($validar_nombre) {
                $errors['nombre'] = $validar_nombre;
            }

            $validar_rol = Utils::validarTexto($rol, 'rol');
            if ($validar_rol) {
                $errors['rol'] = $validar_rol;
            }

            $validar_correo = Utils::validarEmail($correo);
            if ($validar_correo) {
                $errors['correo'] = $validar_correo;
            }

            $validar_contra = Utils::validarContra($contra);
            if ($validar_contra) {
                $errors['contra'] = $validar_contra;
            }

            $validar_confirmar_contra = Utils::validarContra($confirmar_contra);
            if ($validar_confirmar_contra) {
                $errors['confirmar_contra'] = $validar_confirmar_contra;
            }

            $validar_departamento = Utils::validarTexto($departamento, 'departamento');
            if ($validar_departamento) {
                $errors['departamento'] = $validar_departamento;
            }

            $validar_municipio = Utils::validarTexto($municipio, 'municipio');
            if ($validar_municipio) {
                $errors['municipio'] = $validar_municipio;
            }

            $comparar_contra = Utils::compararContra($contra, $confirmar_contra);
            if ($comparar_contra) {
                $errors['comparar_contra'] = $comparar_contra;
            }

            if (empty($direccion)) {
                $errors['direccion'] = 'La direccion no puede estar vacía';
            }

            // hacer una accion en base a si hay errores o  no
            if (count($errors) == 0) {
                // instanciar modelo
                $usuario = new ModeloUsuario();
                $usuario->setCorreo($correo);

                $existe = $usuario->verificarExistenciaUsuario();

                if ($existe && !isset($_SESSION['user'])) {
                    $_SESSION['action_status']['failed'] = 'El usuario ya existe';
                    $_SESSION['current_data'] = $_POST;
                } else {
                    // encriptar contraseña
                    $contra_segura = password_hash($contra, PASSWORD_BCRYPT, ['cost' => 4]);

                    $usuario->setNombre($nombre);
                    $usuario->setRol($rol);
                    $usuario->setContra($contra_segura);
                    $usuario->setDepartamento($departamento);
                    $usuario->setMunicipio($municipio);
                    $usuario->setDireccion($direccion);

                    // validar si hay id para la actualizacion o no
                    if (isset($_GET['id'])) {
                        $id_usuario = $_GET['id'];
                        $usuario->setId($id_usuario);
                        // actualizar usuario
                        $result = $usuario->actualizarUsuario();

                        $user_update = $usuario->consultaUsuario();

                        $_SESSION['user'] = $user_update;
                    } else {
                        // insertar usuario
                        $result = $usuario->insertarUsuario();
                    }

                    if ($result && !isset($_GET['id'])) {
                        $_SESSION['action_status']['success'] = 'Usuario registrado';
                    } elseif ($result && isset($_GET['id'])) {
                        $_SESSION['action_status']['success'] = 'Usuario actualizado';
                        $_SESSION['current_data'] = $_POST;
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

        if (isset($_GET['id'])) {
            header('Location: ' . base_url . '/usuario/actualizar&id=' . $_GET['id']);
        } else {
            header('Location: ' . base_url . 'usuario/registrarse');
        }
    }

    public function actualizar()
    {
        Utils::validarLogin();
        if (isset($_GET['id'])) {
            $update = true;

            $user = $_SESSION['user'];

            require_once 'views/usuario/registro.php';
        } else {
            Utils::redirectHome();
        }
    }

    public function eliminar_cuenta()
    {
        if (isset($_POST) || isset($_SESSION['user_flag'])) {
            $contra = isset($_POST['delete_pass']) ? $_POST['delete_pass'] : '';

            $errors = array();

            if (empty($contra)) {
                $errors['contra'] = "La contraseña no puede estar vacía";
            }

            $user_pass = $_SESSION['user']->password;
            $validar_pass = password_verify($contra, $user_pass);
            if (!$validar_pass) {
                $errors['pass_confirm'] = "Credenciales incorrectas";
            }

            if (count($errors) == 0) {
                $user_id = $_SESSION['user']->id;

                $usuario = new ModeloUsuario();
                $usuario->setId($user_id);
                $eliminar = $usuario->eliminarUsuario();

                if ($eliminar) {
                    $_SESSION['action_status']['success'] = 'Usuario eliminado';
                    unset($_SESSION['user']);
                    $_SESSION['user_flag'] = true;
                } else {
                    $_SESSION['action_status']['failed'] = 'No se pudo eliminar el usuario';
                    $_SESSION['user_flag'] = false;
                }
            } else {
                $_SESSION['errors'] = $errors;
            }
        } else {
            $_SESSION['user_delete_error'] = 'Ocurrió un error al procesar la solicutud';
        }
        header('Location: ' . base_url . 'usuario/eliminar');
    }
    #endregion

    public function login()
    {
        if (isset($_POST)) {
            $usuario = isset($_POST['email']) ? $_POST['email'] : false;
            $contra = isset($_POST['password']) ? $_POST['password'] : false;

            $errors = array();

            $usuario_validado = Utils::validarEmail($usuario);
            if ($usuario_validado) {
                $errors['usuario'] = $usuario_validado;
            }

            $contra_validada = utils::validarContra($contra);
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

                    if ($login->role == "admin") {
                        $_SESSION['admin'] = true;
                    }

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

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header('Location: ' . base_url . 'usuario/index');
    }
}
