<?php

namespace controllers;

use models\Editorial as ModelEditorial;

use helpers\Utils;

class Editorial
{
    public function index()
    {
        Utils::validarAdmin();
        $edit = new ModelEditorial();
        $editoriales = $edit->listarEditoriales();

        require_once  'views/editorial/editoriales.php';
    }

    public function crear()
    {
        Utils::validarAdmin();
        if (isset($_POST)) {
            $nombre_editorial = isset($_POST['editorial']) ? $_POST['editorial'] : false;

            if (empty($nombre_editorial)) {
                $_SESSION['error'] = "La editorial no puede estar vacía";
            } else {
                $editorial = new ModelEditorial();
                $editorial->__set('nombre_editorial', $nombre_editorial);

                $result = $editorial->crearEditorial();
                if ($result) {
                    $_SESSION['action_status']['success'] = "Se creó la editorial";
                } else {
                    $_SESSION['action_status']['failed'] = "No se creó la editorial";
                }
            }
        } else {
            $_SESSION['action_error'] = "No se pudo completar la acción";
        }

        header('Location: ' . base_url . 'editorial/index');
    }

    public function editar()
    {
        Utils::validarAdmin();
        if (isset($_GET['id']) && isset($_GET['name'])) {
            $_SESSION['action_update']['id'] = $_GET['id'];
            $_SESSION['action_update']['name'] = $_GET['name'];
        } elseif (isset($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $nombre = isset($_POST['editorial']) ? $_POST['editorial'] : false;

            if (!empty($id) && !empty($nombre)) {
                $editorial = new ModelEditorial();
                $editorial->__set('id', $id);
                $editorial->__set('nombre_editorial', $nombre);

                $update = $editorial->actualizarEditorial();
                if($update){
                    $_SESSION['action_status']['success'] = 'Se actualizó la editorial';
                } else {
                    $_SESSION['action_status']['failed'] = 'No se actualizó la editorial';
                }
            } else {
                $_SESSION['action_error'] = "No se pudo completar la acción";
            }
        } else {
            $_SESSION['action_error'] = "No se pudo completar la acción";
        }
        header('Location: ' . base_url . 'editorial/index');
    }

    public function  eliminar()
    {
        Utils::validarAdmin();
        if(isset($_GET['id'])){
            $id_edit = $_GET['id'];

            $editorial = new ModelEditorial();
            $editorial->__set('id', $id_edit);

            $eliminar = $editorial->eliminarEditorial();

            if ($eliminar) {
                $_SESSION['delete']['ok'] = 'Se eliminó la categoría';
            } else {
                $_SESSION['delete']['none'] = 'Se eliminó la categoría';
            }
        }else{
            $_SESSION['action_error'] = "No se pudo completar la acción";
        }
        header('Location: ' . base_url . 'editorial/index');
    }
}
