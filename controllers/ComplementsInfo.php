<?php
namespace controllers;

use Models\Categoria;
use Models\Editorial;

class ComplementsInfo{
    public static function getEditoriales(){
        $editorial = new Editorial();

        $editoriales = $editorial->listarEditoriales();

        return $editoriales;
    } 

    public static function getCategorias(){
        $categoria = new Categoria();

        $categorias = $categoria->listarCategorias();

        return $categorias;
    }
}
