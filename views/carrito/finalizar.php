<?php

use helpers\Utils;

?>

<section class="form-container">
    <!-- actualizar -->
    <?php if (isset($_SESSION['user'])) : ?>
        <form action="<?= base_url ?>compra/" class="form user-form user-register" method="POST">
            <h2 class="form__title">Verifique sus datos y su pedido</h2>
            <?php if (isset($_SESSION['action_error'])) : ?>
                <p class="form__main-alert form__failed"><?= $_SESSION['action_error'] ?></p>
            <?php endif; ?>

            <div class="form-columns">
                <div class="form-column">
                    <div class="form-group">
                        <input class="form-group__input" type="text" name="name" value="<?= $_SESSION['user']->name ?>" required>
                        <label class="form-group__label"><i class="bi bi-person-fill"></i>Nombre</label>
                    </div>

                    <div class="form-group">
                        <input class="form-group__input" type="text" name="name" value="<?= $_SESSION['user']->department ?>" required>
                        <label class="form-group__label"><i class="bi bi-person-fill"></i>Departamento</label>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <input class="form-group__input" type="text" name="name" value="<?= $_SESSION['user']->address ?>" required>
                        <label class="form-group__label"><i class="bi bi-person-fill"></i>Direccion</label>
                    </div>

                    <div class="form-group">
                        <input class="form-group__input" type="text" name="name" value="<?= $_SESSION['user']->city ?>" required>
                        <label class="form-group__label"><i class="bi bi-person-fill"></i>Municipio</label>
                    </div>
                </div>
            </div>

            <div class="form-buttons">
                <a href="<?= base_url ?>usuario/actualizar&id=<?= $_SESSION['user']->id ?>" class="form-button form-buttons__alternative">Actualizar datos personales</a>
                <input class="form-button form-buttons__submit" type="submit" value="Finalizar compra">
            </div>
        </form>

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
                                        <a class="table-button form__success" href="<?= base_url ?>libro/ver&id=<?= $carrito[$index]['id_libro'] ?>">Ver</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>
        <div class="cart-stats-confirm">
            <h3 class="cart-stats-confirm__total">Valor total: $<?= Utils::calcularTotal() ?></h3>
        </div>
    <?php else : ?>
        <?php header('Location: ' . base_url . 'usuario/') ?>
    <?php endif; ?>



    <?php
    Utils::eliminarSesion('errors');
    // Utils::eliminarSesion('current_data');
    // Utils::eliminarSesion('action_status');
    ?>
</section>