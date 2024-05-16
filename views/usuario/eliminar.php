<section class="form-container">
    <?php use helpers\Utils; ?>
    <?php if (isset($_SESSION['user'])) : ?>
        <form action="<?= base_url ?>usuario/eliminar_cuenta" class="form user-form" method="POST">
            <h2 class="form__title">Confirmar identidad</h2>
            <?php if (isset($_SESSION['action_status']['failed'])) : ?>
                <p class="form__main-alert form__failed"><?= $_SESSION['action_status']['failed'] ?></p>
            <?php elseif (isset($_SESSION['user_delete_error'])) : ?>
                <p class="form__main-alert form__failed"><?= $_SESSION['user_delete_error'] ?></p>
            <?php endif; ?>

            <div class="form-group">
                <input class="form-group__input" type="password" name="delete_pass" required>
                <label class="form-group__label">Contraseña</label>
                <?php if (isset($_SESSION['errors']['contra'])) : ?>
                    <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['contra'] ?></p>
                <?php elseif (isset($_SESSION['errors']['pass_confirm'])) : ?>
                    <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['pass_confirm'] ?></p>
                <?php endif; ?>
            </div>

            <div class="form-buttons">
                <input class="form-button form-buttons__delete" type="submit" value="Eliminar cuenta">
            </div>
        </form>
    <?php elseif (isset($_SESSION['user_flag'])) : ?>
        <div class="form user-form">
            <?php if (isset($_SESSION['action_status']['success'])) : ?>
                <h2 class="form__title"><?= $_SESSION['action_status']['success'] ?></h2>
            <?php endif; ?>

            <div class="form-buttons">
                <a class="form-button form-buttons__alternative" href="<?= base_url ?>usuario/index">Iniciar sesión</a>
                <a class="form-button form-buttons__alternative" href="<?= base_url ?>usuario/registrarse">Registrarse</a>
            </div>
        </div>
    <?php else : ?>
        <?php Utils::showError(); ?>
    <?php endif; ?>

    <?php
    Utils::eliminarSesion('action_status');
    Utils::eliminarSesion('errors');
    Utils::eliminarSesion('user_delete_error');
    Utils::eliminarSesion('user_flag');
    ?>

</section>