<section class="carrito">
    <div class="table-container libros">
        <table class="table libros" class="user-form">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Sub total</th>
                </tr>
            </thead>
            <?php $total = 0; ?>
            <?php if (isset($libros) && $libros != null) : ?>
                <tbody>
                    <?php while ($libro = $libros->fetch_object()) : ?>
                        <?php $total+= $libro->total; ?>
                        <tr>
                            <td><?= $libro->title ?></td>
                            <td><?= $libro->autor ?></td>
                            <td><?= $libro->category_name ?></td>
                            <td>
                                <?php if ($libro->image != null) : ?>
                                    <div class="table-image">
                                        <img src="<?= base_url ?>uploads/images/<?= $libro->image ?>" alt="imagen">
                                    </div>
                                <?php else : ?>
                                    <div class="table-image">
                                        <img src="<?= base_url ?>uploads/default.jpg" alt="imagen">
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>$<?= number_format($libro->price) ?></td>
                            <td><?= $libro->quantity ?></td>
                            <td>$<?= number_format($libro->subtotal) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>

    <div class="cart-stats-confirm">
        <h3 class="cart-stats-confirm__total">Valor total: <?= number_format($total) ?></h3>
    </div>
</section>