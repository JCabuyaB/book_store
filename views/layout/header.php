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
    <link rel="stylesheet" href="<?= base_url ?>assets/css/usuario/admin.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/errors/errors.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/books/books.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/general.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/forms/forms.css">
</head>

<body class="body">
    <header class="header">
        <nav class="nav">
            <ul class="menu">
                <li class="menu__item"><a href="<?= base_url ?>" class="menu__item--text">Inicio</a></li>
                <li class="menu__item"><a href="#" class="menu__item--text">database</a></li>
                <li class="menu__item"><a href="#" class="menu__item--text">database</a></li>
                <li class="menu__item"><a href="#" class="menu__item--text">database</a></li>
                <li class="menu__item"><a href="#" class="menu__item--text">database</a></li>
                <li class="menu__item"><a href="#" class="menu__item--text">database</a></li>
                <li class="menu__item menu__item--user-container">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a class="menu__item--text menu__item--main-text" href="#"><?= $_SESSION['user']->mail ?></a>
                        <ul class="user-menu">
                            <ul class="user-submenu">
                                <li class="user-submenu__item submenu-guide-arrow"><a class="user-submenu__item-text user-submenu__item-text--top" href="<?= base_url ?>usuario/actualizar&id=<?= $_SESSION['user']->id ?>">Mi cuenta</a></li>
                                <?php if (isset($_SESSION['admin'])) : ?>
                                    <li class="user-submenu__item"><a class="user-submenu__item-text" href="<?= base_url ?>usuario/administrar">Administración</a></li>
                                <?php else : ?>
                                    <li class="user-submenu__item"><a class="user-submenu__item-text" href="<?= base_url ?>usuario/administrar">Mis pedidos</a></li>
                                <?php endif; ?>
                                <li class="user-submenu__item"><a class="user-submenu__item-text user-submenu__item-text--bottom" href="<?= base_url ?>usuario/logout">Cerrar sesión</a></li>
                            </ul>
                        </ul>
                    <?php else : ?>
                <li class="menu__item"><a class="menu__item--text menu__item--emphasis" href="<?= base_url ?>usuario/index">Iniciar Sesión</a></li>
            <?php endif; ?>
            </li>
            </ul>
        </nav>

        <div class="search">
            <form action="<?= base_url ?>libro/buscar" class="search-form" autocomplete="off">
                <input type="text" name="busqueda" class="search-form__input" placeholder="buscar libro">
                <input type="submit" value="Buscar" class="search-form__button">
            </form>
        </div>
    </header>