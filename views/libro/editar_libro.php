<?php

use controllers\ComplementsInfo;
use helpers\Utils;

// lista de editoriales y categorias
$editoriales = ComplementsInfo::getEditoriales();
$categorias = ComplementsInfo::getCategorias();
?>

<section class="form-container">
    <form action="<?= base_url ?>libro/crear&id=<?=$update->id?>" class="user-form libro" method="POST" enctype="multipart/form-data">
        <h2 class="form__title">Actualizar libro</h2>


        <!-- mostrar estado(error o éxito) de la accion -->
        <?php if (isset($_SESSION['action_error'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_error'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['failed'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_status']['failed'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['success'])) : ?>
            <p class="form__main-alert form__success"><?= $_SESSION['action_status']['success'] ?></p>
        <?php endif; ?>

        <div class="form-columns">
            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="isbn" class="form-group__input" value="<?= isset($update->isbn) ? $update->isbn : '' ?>" required>
                    <label class="form-group__label">ISBN</label>
                    <?php if (isset($_SESSION['errors']['isbn'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['isbn'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <textarea type="text" name="sinopsis" class="form-group__input book sinopsis" required><?= isset($update->synopsis) ? $update->synopsis : '' ?></textarea>
                    <label class="form-group__label">Sinopsis</label>
                    <?php if (isset($_SESSION['errors']['sinopsis'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['sinopsis'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="titulo" class="form-group__input" value="<?= isset($update->title) ? $update->title : '' ?>" required>
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
                                <option value="<?= $editorial->id ?>" <?= isset($update->id_edit) && $update->id_edit == $editorial->id ? 'selected' : '' ?>><?= $editorial->editorial_name ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>

                    <label class="form-group__label">Editorial</label>
                    <?php if (isset($_SESSION['errors']['editorial'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['editorial'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="precio" class="form-group__input" value="<?= isset($update->price) ? $update->price : '' ?>" required>
                    <label class="form-group__label">Precio</label>
                    <?php if (isset($_SESSION['errors']['precio'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['precio'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input type="text" name="autor" class="form-group__input" value="<?= isset($update->autor) ? $update->autor : '' ?>" required>
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
                                <option value="<?= $categoria->id ?>" <?= isset($update->id_cat) && $update->id_cat == $categoria->id ? 'selected' : '' ?>><?= $categoria->category_name ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>

                    <label class="form-group__label">categoría</label>
                    <?php if (isset($_SESSION['errors']['categoria'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['categoria'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="text" name="stock" class="form-group__input" value="<?= isset($update->stock) ? $update->stock : '' ?>" required>
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

    <?php
    Utils::eliminarSesion('current_data');
    Utils::eliminarSesion('action_error');
    Utils::eliminarSesion('action_status');
    Utils::eliminarSesion('errors');
    ?>
</section>