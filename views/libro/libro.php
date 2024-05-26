<main class="main">
    <section class="book">
        <?php if (isset($book)) : ?>
            <div class="book-left">
                <div class="book-thumb">
                    <?php if ($book->image != null) : ?>
                        <img class="book-thumb__img" src="<?= base_url ?>uploads/images/<?= $book->image ?>" alt="libro">
                    <?php else : ?>
                        <img class="book-thumb__img" src="<?= base_url ?>uploads/default.jpg" alt="libro">
                    <?php endif; ?>
                </div>
            </div>

            <div class="book-right">
                <div class="main-book-info">
                    <div class="main-book-texts">
                        <h3 class="main-book-texts__title"><?= $book->title ?></h3>
                        <h4 class="main-book-texts__autor"><?= $book->autor ?> (Autor) <i class="main-book-texts__pencil bi bi-pencil-fill"></i></h4>
                        <p class="main-book-texts__synopsis"><?= substr($book->synopsis, 0, 500) . '...' ?></p>
                    </div>

                    <div class="main-book-actions">
                        <div class="main-book-left-bottom">
                            <p class="main-book-actions__price">Precio $<?= number_format($book->price) ?></p>
                            <p class="main-book-actions__stock">Quedan <?= $book->stock ?> unidades</p>
                        </div>

                        <div class="main-book-right-bottom">
                            <a href="<?= base_url ?>libro/" class="main-book-actions__btn">Todos los libros</a>
                            <a href="<?= base_url ?>carrito/add&id=<?= $book->id ?>" class="main-book-actions__btn">Añadir al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>