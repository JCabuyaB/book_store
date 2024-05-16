<section class="form-container">
    <?php

    use helpers\Utils;

    if (isset($update) && isset($user) && is_object($user)) {
        $title = 'Actualizar datos';
        $main_btn = 'Actualizar';
        $alternative_btn = 'Eliminar cuenta';
        $color_btn = 'form-buttons__delete';
        $create_upate = base_url . 'usuario/registrar&id=' . $user->id;
        $alternative_url = base_url . 'usuario/eliminar';
    } else {
        $user = null;
        $title = 'Registrarse';
        $main_btn = 'Confirmar';
        $alternative_btn = 'Iniciar sesión';
        $color_btn = 'form-buttons__alternative';
        $create_upate = base_url . 'usuario/registrar';
        $alternative_url = base_url . 'usuario/index';
    }
    ?>

    <!-- actualizar -->
    <form action="<?= $create_upate ?>" class="form user-form user-register" method="POST">
        <h2 class="form__title"><?= $title ?></h2>
        <?php if (isset($_SESSION['action_status']['failed'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_status']['failed'] ?></p>
        <?php elseif (isset($_SESSION['user_register_error'])) : ?>
            <p class="form__main-alert form__failed"><?= $_SESSION['action_status']['user_register_error'] ?></p>
        <?php elseif (isset($_SESSION['action_status']['success'])) : ?>
            <p class="form__main-alert form__success"><?= $_SESSION['action_status']['success'] ?></p>
        <?php endif; ?>

        <div class="form-columns">
            <div class="form-column">
                <div class="form-group">
                    <input class="form-group__input" type="text" name="name" value="<?= Utils::showUserFormErrors('name', $user);  ?>" required>
                    <label class="form-group__label">Nombre</label>
                    <?php if (isset($_SESSION['errors']['nombre'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['nombre'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- validar si es admin -->
                <?php if (Utils::validarAdminSinRedireccion()) : ?>
                    <div class="form-group">
                        <input class="form-group__input" type="text" name="role" value="<?= Utils::showUserFormErrors('role', $user); ?>" required>
                        <label class="form-group__label">Rol</label>
                        <?php if (isset($_SESSION['errors']['rol'])) : ?>
                            <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['rol'] ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="mail" value="<?= Utils::showUserFormErrors('mail', $user) ?>" required>
                    <label class="form-group__label">Correo electrónico</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['correo'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="password" name="password" required>
                    <label class="form-group__label">Contraseña</label>
                    <?php if (isset($_SESSION['errors']['contra'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['contra'] ?></p>
                    <?php elseif (isset($_SESSION['errors']['comparar_contra'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['comparar_contra'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="password" name="confirm_pass" required>
                    <label class="form-group__label">Confirmar contraseña</label>
                    <?php if (isset($_SESSION['errors']['confirmar_contra'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['confirmar_contra'] ?></p>
                    <?php elseif (isset($_SESSION['errors']['comparar_contra'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['comparar_contra'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input class="form-group__input" type="text" name="department" value="<?= Utils::showUserFormErrors('department', $user); ?>" required>
                    <label class="form-group__label">Departamento</label>
                    <?php if (isset($_SESSION['errors']['departamento'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['departamento'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="city" value="<?= Utils::showUserFormErrors('city', $user); ?>" required>
                    <label class="form-group__label">Municipio</label>
                    <?php if (isset($_SESSION['errors']['municipio'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['municipio'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="address" value="<?= Utils::showUserFormErrors('address', $user); ?>" required>
                    <label class="form-group__label">Direccion</label>
                    <?php if (isset($_SESSION['errors']['direccion'])) : ?>
                        <p class="form-alert form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['direccion'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="<?= $main_btn ?>">
            <a class="form-button form-button <?= $color_btn ?>" href="<?= $alternative_url ?>"><?= $alternative_btn ?></a>
        </div>
    </form>



    <?php
    Utils::eliminarSesion('errors');
    Utils::eliminarSesion('current_data');
    Utils::eliminarSesion('action_status');
    Utils::eliminarSesion('user_register_error');
    ?>
</section>