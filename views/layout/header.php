<!DOCTYPE html>
<html lang="es ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Marinilla</title>
    <link rel="shortcut icon" href="<?= base_url ?>assets/img/page/book.png" type="image/x-icon">

    <!-- iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- estilos layout -->
    <link rel="stylesheet" href="<?= base_url ?>assets/css/layout/header.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/layout/footer.css">

    <!-- estilos paginas -->
    <link rel="stylesheet" href="<?= base_url ?>assets/css/landing/landing.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/errors/errors.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/books/books.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/general.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/forms/forms.css">
</head>

<body class="body">
    <header class="header">
        <nav class="menu">
            <a href="<?= base_url ?>" class="menu__item">Inicio</a>
            <a href="#" class="menu__item">database</a>
            <a href="#" class="menu__item">database</a>
            <a href="#" class="menu__item">database</a>
            <a href="#" class="menu__item">database</a>
            <?php if(isset($_SESSION['user'])) : ?>
                <ul class="user-menu menu__item--emphasis">
                    <li class="user-menu__item"><?=$_SESSION['user']->mail?></li>
                    <ul class="user-submenu">
                        <li class="user-submenu__item submenu-guide-arrow"><a class="user-submenu__item-text" href="<?=base_url?>usuario/registrarse">Actualizar datos</a></li>
                        <li class="user-submenu__item"><a class="user-submenu__item-text" href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
                    </ul>
                </ul>
            <?php else : ?>
                <a href="<?= base_url ?>usuario/index" class="menu__item menu__item--emphasis">Iniciar Sesión</a>
            <?php endif; ?>
        </nav>
    </header>