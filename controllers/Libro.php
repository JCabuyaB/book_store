<?php

namespace controllers;

use models\Libro as ModeloLibro;

use helpers\Utils;

class Libro
{
    public function index()
    {
        $libro = new ModeloLibro();
        $libros = $libro->listarLibros();
        require_once 'views/libro/libros.php';
    }

    public function administrar()
    {
        Utils::validarAdmin();
        $libro = new ModeloLibro();
        $libros = $libro->listarLibros();
        require_once 'views/libro/formulario_libro.php';
    }

    public function crear()
    {
        if (isset($_POST)) {
            $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : false;
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
            $autor = isset($_POST['autor']) ? $_POST['autor'] : false;
            $sinopsis = isset($_POST['sinopsis']) ? $_POST['sinopsis'] : false;
            $id_categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $id_editorial = isset($_POST['editorial']) ? $_POST['editorial'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;

            $errors = array();

            if (empty($isbn)) {
                $errors['isbn'] = "El ISBN no puede estar vacío";
            }

            if (empty($titulo)) {
                $errors['titulo'] = "El título no puede estar vacío";
            }

            $validar_autor = Utils::validarTexto($autor, 'autor');
            if ($validar_autor) {
                $errors['autor'] = $validar_autor;
            }

            $validar_sinopsis = Utils::validarTexto($sinopsis, 'campo');
            if ($validar_sinopsis) {
                $errors['sinopsis'] = $validar_sinopsis;
            }

            if (empty($id_categoria) || !is_numeric($id_categoria)) {
                $errors['categoria'] = "El valor debe ser numérico";
            }

            if (empty($id_editorial) || !is_numeric($id_editorial)) {
                $errors['editorial'] = "El valor debe ser numérico";
            }

            if (empty($precio) || !is_numeric($precio)) {
                $errors['precio'] = "El valor debe ser numérico";
            }

            if (empty($stock) || !is_numeric($stock)) {
                $errors['stock'] = "El valor debe ser numérico";
            }

            if (count($errors) == 0) {
                $libro = new ModeloLibro();
                $libro->__set('isbn', $isbn);
                $libro->__set('titulo', $titulo);
                $libro->__set('autor', $autor);
                $libro->__set('sinopsis', $sinopsis);
                $libro->__set('id_categoria', $id_categoria);
                $libro->__set('id_editorial', $id_editorial);
                $libro->__set('precio', $precio);
                $libro->__set('stock', $stock);

                // guardar imagen
                if(isset($_FILES['imagen'])){
                    $archivo = $_FILES['imagen'];
                    $nombre = $archivo['name'];
                    $tipo_archivo = $archivo['type'];

                    if($tipo_archivo == 'image/png' || $tipo_archivo == 'image/jpeg' || $tipo_archivo == 'image/jpg'){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }
                        
                        $ruta = 'uploads/images';

                        $libro->__set('imagen', $nombre);

                        move_uploaded_file($archivo['tmp_name'], $ruta . $nombre);
                    }
                }



                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $libro->__set('id', $id);

                    $actualizar = $libro->actualizarLibro();
                } else {
                    $guardar = $libro->crearLibro();
                }


                if($guardar){
                    $_SESSION['action_status']['success'] = "Se creó el libro";
                }else{
                    $_SESSION['action_status']['failed'] = "No se procesó la solicitud";
                }
            } else {
                $_SESSION['errors'] = $errors;
                $_SESSION['current_data'] = $_POST;
            }
        } else {
            $_SESSION['action_error'] = "No se completó la solicitud";
        }

        header('Location: ' . base_url . 'libro/administrar');
    }

    public function eliminar(){
        if(isset($_GET['id'])){
            $id_libro = $_GET['id'];

            $libro = new ModeloLibro();
            $libro->__set('id', $id_libro);

            $delete = $libro->eliminarLibro();

            if($delete){
                $_SESSION['delete']['ok'] = "Se eliminó el libro";
            }else{
                $_SESSION['delete']['none'] = "No se eliminó el libro";
            }
        }else{
            $_SESSION['action_error'] = "No se completó la solicitud";
        }
        header('Location: ' . base_url . 'libro/administrar');
    }

    public function editar()
    {
        if(isset($_GET['id'])){
            $id_libro = $_GET['id'];

            $libro = new ModeloLibro();
            $libro->__set('id', $id_libro);
            $book_data = $libro->getLibro();
        }else{
            $_SESSION['action_error'] = "No se completó la solicitud";
        }

        header('Location: ' . base_url . 'libro/administrar');
    }
}
