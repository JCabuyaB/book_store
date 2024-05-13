<?php
namespace controllers;

use models\Usuario as ModeloUsuario;

class Usuario{
    #region vistas
    public function index(){
        require_once 'views/usuario/login.php';
    }

    public function registrarse()
    {
        require_once 'views/usuario/registro.php';
    }
    #endregion

    #region CRUD
    public function registrar(){
        if(isset($_POST)){
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
            if($validar_nombre){
                $errors['nombre'] = $validar_nombre;
            }

            $validar_rol = validar_texto($rol, 'rol');
            if($validar_rol){
                $errors['rol'] = $validar_rol;
            }

            $validar_correo = validar_email($correo);
            if($validar_correo){
                $errors['correo'] = $validar_correo;
            }

            $validar_contra = validar_contraseña($contra);
            if($validar_contra){
                $errors['contra'] = $validar_contra;
            }

            $validar_confirmar_contra = validar_contraseña($confirmar_contra);
            if($validar_confirmar_contra){
                $errors['confirmar_contra'] = $validar_confirmar_contra;
            }

            $validar_departamento = validar_texto($departamento, 'departamento');
            if($validar_departamento){
                $errors['departamento'] = $validar_departamento;
            }

            $validar_municipio = validar_texto($municipio, 'municipio');
            if($validar_municipio){
                $errors['municipio'] = $validar_municipio;
            }

            $comparar_contra = comparar_contraseña($contra, $confirmar_contra);
            if($comparar_contra){
                $errors['comparar_contra'] = $comparar_contra;
            }

            if(empty($direccion)){
                $errors['direccion'] = "La direccion no puede estar vacía";
            }

            // hacer una accion en base a si hay errores o  no
            if(count($errors) == 0){
                // encriptar contraseña
                $contra_segura = password_hash($contra, PASSWORD_BCRYPT, ['cost'=>4]);

                // insertar registro
                $usuario = new ModeloUsuario();
                $usuario->setNombre($nombre);
                $usuario->setCorreo($correo);
                $usuario->setContra($contra_segura);
                $usuario->setDepartamento($departamento);
                $usuario->setMunicipio($municipio);
                $usuario->setDireccion($direccion);

                // funcion para insertar
                $result = $usuario->crear_usuario();

                if($result){
                    $_SESSION['action_status'] = "success";
                }else{
                    $_SESSION['action_status'] = "failed";
                }

            }else{
                $_SESSION['current_data'] = $_POST;
                $_SESSION['errors'] = $errors;
            }
        }else{
            $_SESSION['user_register_error'] = "Registro fallido";
        }

        header('Location: ' . base_url . 'usuario/registrarse');
    }
    #endregion
}