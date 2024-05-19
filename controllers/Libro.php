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
        Utils::validarAdmin();
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
                if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
                    $archivo = $_FILES['imagen'];
                    $nombre = $archivo['name'];
                    $tipo_archivo = $archivo['type'];

                    if ($tipo_archivo == 'image/png' || $tipo_archivo == 'image/jpeg' || $tipo_archivo == 'image/jpg') {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }

                        $ruta = 'uploads/images/';

                        if (isset($_GET['id'])) {
                            // eliminar imagen si existe
                            $libro_id = $_GET['id'];
                            $libro->__set('id', $libro_id);
                            $book = $libro->getLibro();

                            $libro->__set('imagen', $book->image);
                            $registros_imagen = $libro->verifyImageExists();

                            // si la imagen no existe en otros libros se borra
                            if (!$registros_imagen) {
                                if (is_writable($ruta . $book->image)) {
                                    unlink($ruta . $book->image);
                                }
                            }

                            $libro->__set('imagen', $nombre);
                            move_uploaded_file($archivo['tmp_name'], $ruta . $nombre);
                        } else {
                            $libro->__set('imagen', $nombre);
                            move_uploaded_file($archivo['tmp_name'], $ruta . $nombre);
                        }
                    }
                } elseif (isset($_GET['id'])) {
                    // imagen como estaba
                    // eliminar imagen si existe
                    $libro_id = $_GET['id'];
                    $libro->__set('id', $libro_id);

                    $book = $libro->getLibro();

                    $libro->__set('imagen', $book->image);
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $libro->__set('id', $id);

                    $actualizar = $libro->actualizarLibro();
                } else {
                    $guardar = $libro->crearLibro();
                }

                if (isset($guardar)) {
                    $_SESSION['action_status']['success'] = "Se creó el libro";
                } elseif (isset($actualizar)) {
                    $_SESSION['action_status']['success'] = "Se actualizó el libro";
                } else {
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

    public function eliminar()
    {
        Utils::validarAdmin();
        if (isset($_GET['id'])) {
            $id_libro = $_GET['id'];

            $libro = new ModeloLibro();
            $libro->__set('id', $id_libro);
            $book = $libro->getLibro();

            $libro->__set('imagen', $book->image);
            $registros_imagen = $libro->verifyImageExists();

            $path = 'uploads/images/' . $book->image;
            $delete = $libro->eliminarLibro();

            if ($delete) {
                if (!$registros_imagen) {
                    if (is_writable($path)) {
                        unlink($path);
                    }
                }

                $_SESSION['delete']['ok'] = "Se eliminó el libro";
            } else {
                $_SESSION['delete']['none'] = "No se eliminó el libro";
            }
        } else {
            $_SESSION['action_error'] = "No se completó la solicitud";
        }
        header('Location: ' . base_url . 'libro/administrar');
    }

    public function editar()
    {
        Utils::validarAdmin();
        if (isset($_GET['id'])) {
            $id_libro = $_GET['id'];

            $libro = new ModeloLibro();
            $libro->__set('id', $id_libro);

            $update = $libro->getLibro();

            if ($update) {
                require_once 'views/libro/editar_libro.php';
            } else {
                require_once 'views/usuario/administrar.php';
            }
        } else {
            $_SESSION['action_error'] = "No se completó la solicitud";
        }
    }
}
