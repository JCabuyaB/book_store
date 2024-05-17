<?php

namespace controllers;

use helpers\Utils;

use models\Categoria as ModelCategoria;

class Categoria
{
    public function index()
    {
        Utils::validarAdmin();

        $categoria = new ModelCategoria();
        $categorias = $categoria->listarCategorias();

        require_once 'views/categoria/categorias.php';
    }


    public function nueva_categoria()
    {
        Utils::validarAdmin();
        if (isset($_POST)) {
            $nombre_categoria = isset($_POST['category']) ? $_POST['category'] : false;


            if (empty($nombre_categoria)) {
                $_SESSION['error'] = 'La categoría no puede estar vacía';
            } elseif (preg_match('/[0-9]/', $nombre_categoria)) {
                $_SESSION['error'] = 'La categoría no puede tener numeros';
            } else {
                $categoria = new ModelCategoria();
                $categoria->__set('nombre_categoria', $nombre_categoria);

                $result = $categoria->crearCategoria();

                if ($result) {
                    $_SESSION['action_status']['success'] = "Se creó la categoría";
                } else {
                    $_SESSION['action_status']['failed'] = "No se creó la categoría";
                }
            }
        } else {
            $_SESSION['action_error'] = "No se pudo completar la acción";
        }
        header('Location: ' . base_url . 'categoria/index');
    }

    public function eliminar()
    {
        Utils::validarAdmin();
        if (isset($_GET['id'])) {
            $id_cat = $_GET['id'];
            $categoria = new ModelCategoria();
            $categoria->__set('id', $id_cat);

            $eliminar = $categoria->eliminarCategoria();

            if ($eliminar) {
                $_SESSION['delete']['ok'] = 'Se eliminó la categoría';
            } else {
                $_SESSION['delete']['none'] = 'Se eliminó la categoría';
            }
        }
        header('Location: ' . base_url . 'categoria/index');
    }

    public function editar()
    {
        Utils::validarAdmin();
        if (isset($_GET['id']) && isset($_GET['name'])) {
            $_SESSION['action_update']['id'] = $_GET['id'];
            $_SESSION['action_update']['name'] = $_GET['name'];
        } elseif (isset($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $name = isset($_POST['category']) ? $_POST['category'] : false;

            if(!empty($id) && !isset($nombre)){
                $categoria = new ModelCategoria();
                $categoria->__set('id', $id);
                $categoria->__set('nombre_categoria', $name);

                $actualizar = $categoria->actualizarCategoria();

                if ($actualizar) {
                    $_SESSION['action_status']['success'] = 'Se actualizó la categoría';
                } else {
                    $_SESSION['action_status']['failed'] = 'No se actualizó la categoría';
                }
            }

            
        }
        header('Location: ' . base_url . 'categoria/index');
    }
}
