<?php

use helpers\Utils; ?>
<section class="carrito">
    <?php if (isset($pedidos)) : ?>
        <h2 class="main__title">Pedidos</h2>

        <div class="table-container libros">
            <table class="table libros" class="user-form">
                <thead>
                    <tr>
                        <th># Pedido</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Destinatario</th>
                        <th>Libros</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (isset($_SESSION['action_status']['success'])) : ?>
                        <tr id="table-alert" class="form__success">
                            <td colspan="2"><i class="bi bi-info-circle"></i> <?= $_SESSION['action_status']['success'] ?></td>
                        </tr>
                    <?php elseif (isset($_SESSION['action_status']['failed'])) : ?>
                        <tr id="table-alert" class="form__failed">
                            <td colspan="2"><i class="bi bi-info-circle"></i> <?= $_SESSION['action_status']['failed'] ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php while ($pedido = $pedidos->fetch_object()) : ?>
                        <tr>
                            <td><?= $pedido->cod ?></td>
                            <td><?= $pedido->sale_date ?></td>
                            <td><b><?= $pedido->sale_state ?></b></td>
                            <td><?= $pedido->name ?></td>
                            <td><?= $pedido->libros ?></td>
                            <td>$<?= number_format($pedido->total) ?></td>

                            <td>
                                <div class="acciones">
                                    <a class="table-button form__success" href="<?= base_url ?>compra/ver&id=<?= $pedido->cod ?>">Ver</a>
                                    <?php if (isset($_SESSION['admin'])) : ?>
                                        <a class="table-button form__success" href="<?= base_url ?>compra/actualizar&id=<?= $pedido->cod ?>">Estado</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php Utils::eliminarSesion('action_status'); ?>
    <?php else : ?>

        <h2 class="main__title">Carrito vacío</h2>
    <?php endif; ?>
</section>