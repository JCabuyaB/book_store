<!DOCTYPE html>
<html lang="es ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Marinilla</title>
    <!-- fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- layout -->
    <link rel="stylesheet" href="assets/css/layout/header.css">
    <link rel="stylesheet" href="assets/css/layout/footer.css">

    <!-- paginas -->
    <link rel="stylesheet" href="assets/css/landing/landing.css">
    <link rel="stylesheet" href="assets/css/books/books.css">
    <link rel="stylesheet" href="assets/css/general.css">
</head>

<body class="body">
    <header class="header">
        <nav class="menu">
            <a href="#" class="menu__item">Inicio</a>
            <a href="#" class="menu__item">database</a>
            <a href="#" class="menu__item">database</a>
            <a href="#" class="menu__item">database</a>
            <a href="#" class="menu__item">database</a>
            <a href="#" class="menu__item">Iniciar Sesión</a>
            <a href="#" class="menu__item menu__item--emphasis">Registrarse</a>
        </nav>
    </header>


    <main class="main">
        <section class="books">
            <figure class="book-cover">
                <img class="book-cover__img" src="uploads/default.jpg" alt="">
            </figure>

            <figure class="book-cover">
                <img class="book-cover__img" src="uploads/default.jpg" alt="">
            </figure>

            <figure class="book-cover">
                <img class="book-cover__img" src="uploads/default.jpg" alt="">
            </figure>

            <figure class="book-cover">
                <img class="book-cover__img" src="uploads/default.jpg" alt="">
            </figure>

            <figure class="book-cover">
                <img class="book-cover__img" src="uploads/default.jpg" alt="">
            </figure>

            <figure class="book-cover">
                <img class="book-cover__img" src="uploads/default.jpg" alt="">
            </figure>

            <!-- back face -->

            <article class="book-info">
                <h3 class="book-info__title">Lorem</h3>
                <p class="book-info__description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dicta, quisquam.</p>
            </article>

           
        </section>
    </main>

    <footer class="footer">
        Desarrollado por Sena Company &copy; <?= date('Y') ?>
    </footer>
</body>

</html>