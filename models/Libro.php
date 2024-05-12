<?php
namespace models;

use config\Database;

class Libro
{
    private $isbn;
    private $titulo;
    private $autor;
    private $sinopsis;
    private $id_categoria;
    private $id_editorial;
    private $precio;
    private $stock;
    private $base_datos;

    public function __construct()
    {
        $this->base_datos = Database::connect();
    }


    #region GETTERS Y  SETTERS
    // isbn
    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    //  titulo
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    //  autor
    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    // sinopsis
    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    public function setSinopsis($sinopsis)
    {
        $this->sinopsis = $sinopsis;

        return $this;
    }

    // categoria
    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    public function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

    // editorial
    public function getId_editorial()
    {
        return $this->id_editorial;
    }

    public function setId_editorial($id_editorial)
    {
        $this->id_editorial = $id_editorial;

        return $this;
    }

    // precio
    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    // stock
    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
    #endregion

    #region  CRUD
    public function crear_libro(){

    }

    public function listar_libros(){

    }

    public function actualizar_libro(){

    }

    public function eliminar_libro(){
        
    }
    #endregion
}
