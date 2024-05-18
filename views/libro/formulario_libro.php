<?php

use helpers\Utils;

if (isset($_SESSION['action_update'])) {
    $url = base_url . 'libro/editar';
} else {
    $url = base_url . 'libro/crear';
}

?>

<section class="form-container">
    <form action="<?= $url ?>" class="user-form libro" method="POST" enctype="multipart/form-data">
        <?php if (isset($_SESSION['action_update'])) : ?>
            <h2 class="form__title">Actualizar libro</h2>
        <?php else : ?>
            <h2 class="form__title">Nuevo libro</h2>
        <?php endif; ?>

        <!-- mostrar estado(error o éxito) de la accion -->
        <?php if (isset($_SESSION['action_error'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_error'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['failed'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_status']['failed'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['success'])) : ?>
            <p class="form__main-alert form__success"><?= $_SESSION['action_status']['success'] ?></p>
        <?php endif; ?>

        <!-- id para actualizar -->
        <?php if (isset($_SESSION['action_update']['id'])) : ?>
            <input type="hidden" name="id" value="<?= $_SESSION['action_update']['id'] ?>" readonly>
        <?php endif; ?>

        <div class="form-columns">
            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="isbn" class="form-group__input" value="<?= 'value' ?>" required>
                    <label class="form-group__label">ISBN</label>
                    <?php if (isset($_SESSION['errors']['isbn'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['isbn'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <textarea type="text" name="sinopsis" class="form-group__input book sinopsis" value="<?= 'value' ?>" required></textarea>
                    <label class="form-group__label">Sinopsis</label>
                    <?php if (isset($_SESSION['errors']['sinopsis'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['sinopsis'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="titulo" class="form-group__input" value="<?= 'value' ?>" required>
                    <label class="form-group__label">Título</label>
                    <?php if (isset($_SESSION['errors']['titulo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['titulo'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="editorial" class="form-group__input" value="<?= 'value' ?>" required>
                    <label class="form-group__label">Editorial</label>
                    <?php if (isset($_SESSION['errors']['editorial'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['editorial'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="precio" class="form-group__input" value="<?= 'value' ?>" required>
                    <label class="form-group__label">Precio</label>
                    <?php if (isset($_SESSION['errors']['precio'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['precio'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="autor" class="form-group__input" value="<?= 'value' ?>" required>
                    <label class="form-group__label">Autor</label>
                    <?php if (isset($_SESSION['errors']['autor'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['autor'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="categoria" class="form-group__input" value="<?= 'value' ?>" required>
                    <label class="form-group__label">categoria</label>
                    <?php if (isset($_SESSION['errors']['categoria'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['categoria'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="stock" class="form-group__input" value="<?= 'value' ?>" required>
                    <label class="form-group__label">Stock</label>
                    <?php if (isset($_SESSION['errors']['stock'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['stock'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="file" name="imagen" class="form-group__input book imagen" value="<?= 'value' ?>">
            <label class="form-group__label">Imagen</label>
            <?php if (isset($_SESSION['errors']['imagen'])) : ?>
                <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['imagen'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="Continuar">
        </div>
    </form>

    <div class="table-container libros">
        <table class="table libros" class="user-form">
            <thead>
                <tr>
                    <th>Isbn</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Sinopsis</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Editorial</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php if (isset($libros) && $libros != null) : ?>
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

                    <?php while ($libro = $libros->fetch_object()) : ?>
                        <tr>
                            <td><?= $libro->isbn ?></td>
                            <td><?= $libro->title ?></td>
                            <td><?= $libro->autor ?></td>
                            <td><?= $libro->synopsis ?></td>

                            <td>
                                <?php if ($libro->image != null) : ?>
                                    <img src="<?= base_url ?>uploads/images<?= $libro->image ?>" alt="imagen">
                                <?php else : ?>
                                    Sin imagen
                                <?php endif; ?>
                            </td>

                            <td><?= $libro->categoria ?></td>
                            <td><?= $libro->editorial ?></td>
                            <td><?= $libro->precio ?></td>
                            <td><?= $libro->stock ?></td>
                            <td>
                                <div class="acciones">
                                    <a class="table-button form__success" href="<?= base_url ?>libro/editar&id=<?= $libro->id ?>">Editar</a>
                                    <a class="table-button form__failed" href="<?= base_url ?>libro/eliminar&id=<?= $libro->id ?>">Eliminar</a>
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
    Utils::eliminarSesion('errors');
    Utils::eliminarSesion('delete');
    Utils::eliminarSesion('action_update');
    ?>
</section>