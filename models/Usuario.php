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

    #region GETTERS Y SETTERS
    // id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    // nombre
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    // rol
    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    // correo
    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    // password
    public function getContra()
    {
        return $this->contra;
    }

    public function setContra($contra)
    {
        $this->contra = $contra;

        return $this;
    }

    // departamento
    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    // municipio
    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    // direccion
    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }
    #endregion
    
    #region  CRUD
    // metodos del usuario
    public function crear_usuario(){
        // flag para validar en el controlador
        $result = false;

        $query = "INSERT INTO tbl_usuarios VALUES(null, '{$this->nombre}', 'user', '{$this->correo}', '{$this->contra}', '{$this->departamento}', '{$this->municipio}', '{$this->direccion}');";

        $connection = $this->db->getConnection();
        $insert = $connection->query($query);

        if($insert && $connection->affected_rows > 0){
            $result = true;
        }

        return $result;
    } 
    
    public function listar_usuarios(){

    }

    public  function actualizar_usuario(){

    }

    public function eliminar_usuario(){

    }
    #endregion
}
