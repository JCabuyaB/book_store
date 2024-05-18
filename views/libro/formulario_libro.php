<?php

use controllers\ComplementsInfo;
use helpers\Utils;

// lista de editoriales y categorias
$editoriales = ComplementsInfo::getEditoriales();
$categorias = ComplementsInfo::getCategorias();

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
        <?php if (isset($_SESSION['current_data']['id'])) : ?>
            <input type="hidden" name="id" value="<?= $_SESSION['current_data']['id'] ?>" readonly>
        <?php endif; ?>

        <div class="form-columns">
            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="isbn" class="form-group__input" value="<?= isset($_SESSION['current_data']['isbn']) ? $_SESSION['current_data']['isbn'] : '' ?>" required>
                    <label class="form-group__label">ISBN</label>
                    <?php if (isset($_SESSION['errors']['isbn'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['isbn'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <textarea type="text" name="sinopsis" class="form-group__input book sinopsis" required><?= isset($_SESSION['current_data']['sinopsis']) ? $_SESSION['current_data']['sinopsis'] : '' ?></textarea>
                    <label class="form-group__label">Sinopsis</label>
                    <?php if (isset($_SESSION['errors']['sinopsis'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['sinopsis'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="titulo" class="form-group__input" value="<?= isset($_SESSION['current_data']['titulo']) ? $_SESSION['current_data']['titulo'] : '' ?>" required>
                    <label class="form-group__label">Título</label>
                    <?php if (isset($_SESSION['errors']['titulo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['titulo'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <select name="editorial" class="form-group__input" required>
                        <?php if (isset($editoriales) && $editoriales != null) : ?>
                            <option value="" style="display: none;"></option>
                            <?php while ($editorial = $editoriales->fetch_object()) : ?>
                                <option value="<?= $editorial->id ?>" <?= isset($_SESSION['current_data']['editorial']) && $_SESSION['current_data']['editorial'] == $editorial->id ? 'selected' : '' ?>><?= $editorial->editorial_name ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>

                    <label class="form-group__label">Editorial</label>
                    <?php if (isset($_SESSION['errors']['editorial'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['editorial'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="precio" class="form-group__input" value="<?= isset($_SESSION['current_data']['precio']) ? $_SESSION['current_data']['precio'] : '' ?>" required>
                    <label class="form-group__label">Precio</label>
                    <?php if (isset($_SESSION['errors']['precio'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['precio'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="autor" class="form-group__input" value="<?= isset($_SESSION['current_data']['autor']) ? $_SESSION['current_data']['autor'] : '' ?>" required>
                    <label class="form-group__label">Autor</label>
                    <?php if (isset($_SESSION['errors']['autor'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['autor'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <select name="categoria" class="form-group__input" required>
                        <option value="" style="display: none;"></option>
                        <?php if (isset($categorias) && $categorias != null) : ?>
                            <?php while ($categoria = $categorias->fetch_object()) : ?>
                                <option value="<?= $categoria->id ?>" <?= isset($_SESSION['current_data']['categoria']) && $_SESSION['current_data']['categoria'] == $categoria->id ? 'selected' : '' ?>><?= $categoria->category_name ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>

                    <label class="form-group__label">categoría</label>
                    <?php if (isset($_SESSION['errors']['categoria'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['categoria'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="stock" class="form-group__input" value="<?= isset($_SESSION['current_data']['stock']) ? $_SESSION['current_data']['stock'] : '' ?>" required>
                    <label class="form-group__label">Stock</label>
                    <?php if (isset($_SESSION['errors']['stock'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['stock'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="file" name="imagen" class="form-group__input book imagen">
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
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Sinopsis</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Editorial</th>
                    <th>Precio</th>
                    <th>#Und</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <?php if (isset($libros) && $libros != null) : ?>
                <tbody>
                    <?php if (isset($_SESSION['delete']['ok'])) : ?>
                        <tr id="table-alert" class="form__success">
                            <td colspan="9" style="text-align: center;"><i class="bi bi-info-circle"></i> <?= $_SESSION['delete']['ok'] ?></td>
                        </tr>
                    <?php elseif (isset($_SESSION['delete']['none'])) : ?>
                        <tr id="table-alert" class="form__failed">
                            <td colspan="9" style="text-align: center;"><i class="bi bi-info-circle"></i> <?= $_SESSION['delete']['none'] ?></td>
                        </tr>
                    <?php elseif (isset($_SESSION['update']['ok'])) : ?>
                        <tr id="table-alert" class="form__success">
                            <td colspan="9" style="text-align: center;"><i class="bi bi-info-circle"></i> <?= $_SESSION['update']['ok'] ?></td>
                        </tr>
                    <?php elseif (isset($_SESSION['update']['none'])) : ?>
                        <tr id="table-alert" class="form__failed">
                            <td colspan="9" style="text-align: center;"><i class="bi bi-info-circle"></i> <?= $_SESSION['update']['none'] ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php while ($libro = $libros->fetch_object()) : ?>
                        <tr>
                            <td><?= $libro->title ?></td>
                            <td><?= $libro->autor ?></td>
                            <td><?= substr($libro->synopsis, 0, 15) . '...' ?></td>

                            <td>
                                <?php if ($libro->image != null) : ?>
                                    <div class="table-image">
                                        <img src="<?= base_url ?>uploads/images<?= $libro->image ?>" alt="imagen">
                                    </div>
                                <?php else : ?>
                                    Sin imagen
                                <?php endif; ?>
                            </td>

                            <td><?= $libro->categoria ?></td>
                            <td><?= $libro->editorial ?></td>
                            <td><?= $libro->price ?></td>
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
    Utils::eliminarSesion('current_data');
    Utils::eliminarSesion('action_error');
    Utils::eliminarSesion('action_status');
    Utils::eliminarSesion('errors');
    Utils::eliminarSesion('delete');
    ?>
</section>