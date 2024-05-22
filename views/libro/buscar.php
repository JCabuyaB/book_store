<main class="main">
    <section class="books">
        <?php if (is_object($libros) && $libros->num_rows > 0) : ?>
            <?php while ($book = $libros->fetch_object()) : ?>
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <!-- front face -->
                        <figure class="flip-card-front">
                            <?php if ($book->image == null) : ?>
                                <img class="flip-card-front__img" src="<?= base_url ?>uploads/default.jpg" alt="portada">
                            <?php else : ?>
                                <img class="flip-card-front__img" src="<?= base_url ?>uploads/images/<?= $book->image ?>" alt="portada">
                            <?php endif; ?>
                        </figure>

                        <!-- back face -->
                        <article class="flip-card-back">
                            <div class="flip-card-back-texts">
                                <h3 class="flip-card-back-texts__title"><?= $book->title ?></h3>
                                <span class="flip-card-back-texts__autor">Autor: <?= $book->autor ?></span>
                                <p class="flip-card-back-texts__description"><?= $book->synopsis ?></p>
                            </div>
                            <div class="flip-card-back-bottom">
                                <span class="flip-card-back-bottom__stock">Unidades: <?= $book->stock ?></span>
                                <a href="<?=base_url?>compra/carrito&id=<?=$book->id?>" class="flip-card-back-bottom__btn">Añadir al carrito</a>
                            </div>
                        </article>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
</main>