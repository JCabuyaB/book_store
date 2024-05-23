<?php

use helpers\Utils;

?>

<section class="form-container">
    <!-- actualizar -->
    <form action="<?= base_url ?>compra/n" class="form user-form user-register" method="POST">
        <h2 class="form__title">Finalizar Compra</h2>
        <?php if (isset($_SESSION['action_error'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_error'] ?></p>
        <?php endif; ?>

        <div class="form-columns">
            <div class="form-column">
                <div class="form-group">
                    <input class="form-group__input" type="text" name="name" value="" required>
                    <label class="form-group__label"><i class="bi bi-person-fill"></i>Nombre</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> ERROR</p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="name" value="" required>
                    <label class="form-group__label"><i class="bi bi-person-fill"></i>Nombre</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> ERROR</p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="name" value="" required>
                    <label class="form-group__label"><i class="bi bi-person-fill"></i>Nombre</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> ERROR</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input class="form-group__input" type="text" name="name" value="" required>
                    <label class="form-group__label"><i class="bi bi-person-fill"></i>Nombre</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> ERROR</p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="name" value="" required>
                    <label class="form-group__label"><i class="bi bi-person-fill"></i>Nombre</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> ERROR</p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="name" value="" required>
                    <label class="form-group__label"><i class="bi bi-person-fill"></i>Nombre</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> ERROR</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="Finalizar compra">
        </div>
    </form>



    <?php
    Utils::eliminarSesion('action_error');
    // Utils::eliminarSesion('errors');
    // Utils::eliminarSesion('current_data');
    // Utils::eliminarSesion('action_status');
    ?>
</section>