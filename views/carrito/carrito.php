<?php

use helpers\Utils; ?>

<section class="carrito">
    <?php if (isset($carrito) && count($_SESSION['cart']) > 0) : ?>
        <!-- recorrer carrito -->
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
                        <th>Acciones</th>
                    </tr>
                </thead>

                <?php if (isset($carrito) && $carrito != null) : ?>
                    <tbody>
                        <?php foreach ($carrito as $index => $value) : ?>
                            <?php $libro = $carrito[$index]['libro']; ?>
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
                                <td>$<?= number_format($carrito[$index]['precio']) ?></td>
                                <td><?= $carrito[$index]['unidades'] ?></td>
                                <td>$<?= Utils::calcularSubtotal($index) ?></td>
                                <td>
                                    <div class="acciones">
                                        <a class="table-button form__failed" href="<?= base_url ?>carrito/eliminar&id=<?= $index ?>">Eliminar</a>
                                        <a class="table-button form__success" href="<?= base_url ?>/libro/ver&id=<?=$carrito[$index]['id_libro']?>">Ver</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>
        <div class="cart-stats">
            <div class="cart-actions">
                <a class="cart-stats__vaciar" href="<?= base_url ?>carrito/vaciar"><i class="bi bi-trash-fill"></i> Vaciar el carrito</a>
                <a class="cart-stats__vaciar" href="<?= base_url ?>carrito/finalizar"><i class="bi bi-cart-check-fill"></i> Finalizar pedido</a>
            </div>
            <h3 class="cart-stats__total">Valor total: $<?= Utils::calcularTotal() ?></h3>
        </div>
    <?php else : ?>
        <h2 class="main__title">Carrito vacío</h2>
    <?php endif; ?>
</section>