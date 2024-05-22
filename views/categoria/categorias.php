<?php

use helpers\Utils;

if (isset($_SESSION['action_update'])) {
    $url = base_url . 'categoria/editar';
} else {
    $url = base_url . 'categoria/nueva_categoria';
}
?>

<section class="form-container categorias">
    <form action="<?= $url ?>" class="user-form" method="POST">
        <?php if (isset($_SESSION['action_update'])) : ?>
            <h2 class="form__title">Actualizar categoría</h2>
        <?php else : ?>
            <h2 class="form__title">Crear categoría</h2>
        <?php endif; ?>

        <?php if (isset($_SESSION['action_error'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_error'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['failed'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_status']['failed'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['success'])) : ?>
            <p class="form__main-alert form__success"><?= $_SESSION['action_status']['success'] ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['action_update']['id'])) : ?>
            <input type="hidden" name="id" value="<?= $_SESSION['action_update']['id'] ?>" readonly>
        <?php endif; ?>

        <div class="form-group">
            <input type="text" name="category" class="form-group__input" value="<?= isset($_SESSION['action_update']['name']) ? $_SESSION['action_update']['name'] : '' ?>" required>
            <label class="form-group__label">Nombre categoría</label>
            <?php if (isset($_SESSION['error'])) : ?>
                <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['error'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="Continuar">
        </div>
    </form>

    <div class="table-container">
        <table class="table categorias" class="user-form">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php if (isset($categorias) && $categorias != null) : ?>
                <tbody>
                    <?php if (isset($_SESSION['delete']['ok'])) : ?>
                        <tr id="table-alert" class="form__success">
                            <td colspan="2"><i class="bi bi-info-circle"></i> <?= $_SESSION['delete']['ok'] ?></td>
                        </tr>
                    <?php elseif (isset($_SESSION['delete']['none'])) : ?>
                        <tr id="table-alert" class="form__failed">
                            <td colspan="2"><i class="bi bi-info-circle"></i> <?= $_SESSION['delete']['none'] ?></td>
                        </tr>
                    <?php elseif (isset($_SESSION['update']['ok'])) : ?>
                        <tr id="table-alert" class="form__success">
                            <td colspan="2"><i class="bi bi-info-circle"></i> <?= $_SESSION['update']['ok'] ?></td>
                        </tr>
                    <?php elseif (isset($_SESSION['update']['none'])) : ?>
                        <tr id="table-alert" class="form__failed">
                            <td colspan="2"><i class="bi bi-info-circle"></i> <?= $_SESSION['update']['none'] ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php while ($categoria = $categorias->fetch_object()) : ?>
                        <tr>
                            <td><?= $categoria->category_name ?></td>
                            <td>
                                <div class="acciones">
                                    <a class="table-button form__success" href="<?= base_url ?>categoria/editar&id=<?= $categoria->id ?>&name=<?= urlencode($categoria->category_name) ?>">Editar</a>
                                    <a class="table-button form__failed" href="<?= base_url ?>categoria/eliminar&id=<?= $categoria->id ?>">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>

    <?php
    Utils::eliminarSesion('action_error');
    Utils::eliminarSesion('action_status');
    Utils::eliminarSesion('error');
    Utils::eliminarSesion('delete');
    Utils::eliminarSesion('action_update');
    ?>
</section>