<?php

namespace models;

use config\Database;

class Usuario
{
    private $id;
    private $nombre;
    private $rol;
    private $correo;
    private $contra;
    private $departamento;
    private $municipio;
    private $direccion;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    private function escapar_datos($dato)
    {
        $connection = $this->db->getConnection();


        $escape_result = $connection->real_escape_string($dato);

        return $escape_result;
    }
    #region GETTERS Y SETTERS
    // id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $this->escapar_datos($id);

        return $this;
    }

    // nombre
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->escapar_datos($nombre);

        return $this;
    }

    // rol
    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $this->escapar_datos($rol);

        return $this;
    }

    // correo
    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $this->escapar_datos($correo);

        return $this;
    }

    // password
    public function getContra()
    {
        return $this->contra;
    }

    public function setContra($contra)
    {
        $this->contra = $this->escapar_datos($contra);

        return $this;
    }

    // departamento
    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $this->escapar_datos($departamento);

        return $this;
    }

    // municipio
    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $this->escapar_datos($municipio);

        return $this;
    }

    // direccion
    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $this->escapar_datos($direccion);

        return $this;
    }
    #endregion

    // metodos del usuario
    #region  CRUD
    public function verificarExistenciaUsuario()
    {
        //flag 
        $result = false;

        $query = "SELECT * FROM tbl_usuarios WHERE mail = '{$this->getCorreo()}';";

        $connection = $this->db->getConnection();
        $existe = $connection->query($query);

        if ($existe && $existe->num_rows == 1) {
            $result = true;
        }

        return $result;
    }

    public function insertarUsuario()
    {
        // flag para validar en el controlador
        $result = false;

        $query = "INSERT INTO tbl_usuarios VALUES(null, '{$this->nombre}', '{$this->rol}', '{$this->correo}', '{$this->contra}', '{$this->departamento}', '{$this->municipio}', '{$this->direccion}');";

        $connection = $this->db->getConnection();
        $insert = $connection->query($query);

        if ($insert && $connection->affected_rows > 0) {
            $result = true;
        }

        return $result;
    }

    public function consultaUsuario()
    {
        $result = false;

        $query = "SELECT * FROM tbl_usuarios WHERE id = {$this->getId()};";

        $connection = $this->db->getConnection();

        $search =  $connection->query($query);

        if ($search && $search->num_rows == 1) {
            $result = $search->fetch_object();
        }

        return $result;
    }

    public  function actualizarUsuario()
    {
        $result = false;

        $query = "UPDATE tbl_usuarios SET name = '{$this->getNombre()}', role = '{$this->getRol()}', mail = '{$this->getCorreo()}', password = '{$this->getContra()}', department = '{$this->getDepartamento()}', city = '{$this->getMunicipio()}', address = '{$this->getDireccion()}' WHERE id = {$this->getId()};";

        $connection = $this->db->getConnection();
        $update = $connection->query($query);

        if ($update && $connection->affected_rows > 0) {
            $result = true;
        }

        return $result;
    }

    public function eliminarUsuario()
    {
        $retult = false;
        $query = "DELETE FROM tbl_usuarios WHERE id = {$this->getId()};";

        $connection = $this->db->getConnection();
        $eliminar = $connection->query($query);

        if ($eliminar && $connection->affected_rows > 0) {
            $result = true;
        }

        return $result;
    }

    public function listarUsuarios(){
        $query = "SELECT * FROM tbl_usuarios WHERE id <> '{$this->getId()}';";

        $connection = $this->db->getConnection();

        $select = $connection->query($query);

        return $select;
    }
    #endregion

    public function iniciar_sesion()
    {
        $result = false;

        $query = "SELECT * FROM tbl_usuarios WHERE mail = '{$this->getCorreo()}';";

        $connection = $this->db->getConnection();
        $existe = $connection->query($query);

        if ($existe && $existe->num_rows == 1) {
            $user = $existe->fetch_object();

            $confirm_user = password_verify($this->getContra(), $user->password);

            if ($confirm_user) {
                $result = $user;
            } else {
                $result = "Credenciales incorrectas";
            }
        } else {
            $result = "El usuario no existe";
        }

        return $result;
    }
}
