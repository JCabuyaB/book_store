<section class="form-container login">
    <form action="<?= base_url ?>usuario/login" class="form user-form" method="POST">
        <h2 class="form__title">Acceder</h2>
        <?php if (isset($_SESSION['action_status']['failed'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_status']['failed'] ?></p>
        <?php elseif (isset($_SESSION['user_login_error'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['user_login_error'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['success'])) : ?>
            <p class="form__main-alert form__success"><?= $_SESSION['action_status']['success'] ?></p>
        <?php elseif (isset($_SESSION['action_error'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_error'] ?></p>
        <?php elseif (isset($_SESSION['action_error_cart'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_error_cart'] ?></p>
        <?php endif; ?>

        <div class="form-group">
            <input class="form-group__input" type="text" name="email" value="<?= isset($_SESSION['current_data']['email']) ? $_SESSION['current_data']['email'] : '' ?>" required>
            <label class="form-group__label"><i class="bi bi-envelope-at-fill"></i>Usuario</label>
            <?php if (isset($_SESSION['errors']['usuario'])) : ?>
                <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['usuario'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <input class="form-group__input" type="password" name="password" value="<?= isset($_SESSION['current_data']['password']) ? $_SESSION['current_data']['password'] : '' ?>" required>
            <label class="form-group__label"><i class="bi bi-person-fill-lock"></i>Contraseña</label>
            <?php if (isset($_SESSION['errors']['contra'])) : ?>
                <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['contra'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="Siguiente">
            <a class="form-button form-buttons__alternative" href="<?= base_url ?>usuario/registrarse">Registrarse</a>
        </div>
    </form>
    <?php
    use Helpers\Utils; 
    Utils::eliminarSesion('errors');
    Utils::eliminarSesion('action_status');
    Utils::eliminarSesion('current_data'); 
    Utils::eliminarSesion('user_login_error'); 
    Utils::eliminarSesion('action_error_cart');
    ?>
</section>