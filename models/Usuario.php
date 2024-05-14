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

    private function escapar_datos($dato){
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
    public function verificar_existencia_usuario(){
        //flag 
        $result = false;

        $query = "SELECT * FROM tbl_usuarios WHERE mail = '{$this->getCorreo()}';";

        $connection = $this->db->getConnection();
        $existe = $connection->query($query);

        if($existe && $existe->num_rows == 1){
            $result = true;
        }

        return $result;
    }

    public function crear_usuario(?string $rol_data){
        // flag para validar en el controlador
        $result = false;
                
        if(isset($rol_data) && is_string($rol_data)){
            $rol = $rol_data;
        }else{
            $rol = 'user';
        }

        $this->setRol($rol);

        $query = "INSERT INTO tbl_usuarios VALUES(null, '{$this->nombre}', '{$this->getRol()}', '{$this->correo}', '{$this->contra}', '{$this->departamento}', '{$this->municipio}', '{$this->direccion}');";

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

    public function iniciar_sesion(){
        $result = false;

        $query = "SELECT * FROM tbl_usuarios WHERE mail = '{$this->getCorreo()}';";
        
        $connection = $this->db->getConnection();
        $existe = $connection->query($query);

        if($existe && $existe->num_rows == 1){
            $user = $existe->fetch_object();

            $confirm_user = password_verify($this->getContra(), $user->password);

            if($confirm_user){
                $result = $user;
            }else{
                $result = "Credenciales incorrectas";
            }
        }else{
            $result = "El usuario no existe";
        }

        return $result;
    }
}
