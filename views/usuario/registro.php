<section class="form-container">
    <form action="<?= base_url ?>/usuario/registrar" class="form user-form user-register" method="POST">
        <h2 class="form__title">Registrarse</h2>

        <div class="form-columns">
            <div class="form-column">
                <div class="form-group">
                    <input class="form-group__input" type="text" name="nombre" value="<?= isset($_SESSION['current_data']['nombre']) ? $_SESSION['current_data']['nombre'] : '' ?>" required>
                    <label class="form-group__label">Nombre</label>
                    <?php if (isset($_SESSION['errors']['nombre'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['nombre'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- validar si es admin -->
                <div class="form-group">
                    <input class="form-group__input" type="text" name="rol" value="<?= isset($_SESSION['current_data']['rol']) ? $_SESSION['current_data']['rol'] : '' ?>" required>
                    <label class="form-group__label">Rol</label>
                    <?php if (isset($_SESSION['errors']['rol'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['rol'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="email" value="<?= isset($_SESSION['current_data']['email']) ? $_SESSION['current_data']['email'] : '' ?>" required>
                    <label class="form-group__label">Correo electrónico</label>
                    <?php if (isset($_SESSION['errors']['correo'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['correo'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="password" name="pass" value="<?= isset($_SESSION['current_data']['pass']) ? $_SESSION['current_data']['pass'] : '' ?>" required>
                    <label class="form-group__label">Contraseña</label>
                    <?php if (isset($_SESSION['errors']['contra'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['contra'] ?></p>
                    <?php elseif (isset($_SESSION['errors']['comparar_contra'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['comparar_contra'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="password" name="confirm_pass" value="<?= isset($_SESSION['current_data']['confirm_pass']) ? $_SESSION['current_data']['confirm_pass'] : '' ?>" required>
                    <label class="form-group__label">Confirmar contraseña</label>
                    <?php if (isset($_SESSION['errors']['confirmar_contra'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['confirmar_contra'] ?></p>
                    <?php elseif (isset($_SESSION['errors']['comparar_contra'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['comparar_contra'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-column">
                <div class="form-group">
                    <input class="form-group__input" type="text" name="departamento" value="<?= isset($_SESSION['current_data']['departamento']) ? $_SESSION['current_data']['departamento'] : '' ?>" required>
                    <label class="form-group__label">Departamento</label>
                    <?php if (isset($_SESSION['errors']['departamento'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['departamento'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="municipio" value="<?= isset($_SESSION['current_data']['municipio']) ? $_SESSION['current_data']['municipio'] : '' ?>" required>
                    <label class="form-group__label">Municipio</label>
                    <?php if (isset($_SESSION['errors']['municipio'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['municipio'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-group__input" type="text" name="direccion" value="<?= isset($_SESSION['current_data']['direccion']) ? $_SESSION['current_data']['direccion'] : '' ?>" required>
                    <label class="form-group__label">Direccion</label>
                    <?php if (isset($_SESSION['errors']['direccion'])) : ?>
                        <p class="form-group__error"><i class="bi bi-info-circle"></i> <?= $_SESSION['errors']['direccion'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="Confirmar">
            <a class="form-button form-button form-buttons__alternative" href="<?= base_url ?>usuario/index">Iniciar sesión</a>
        </div>
    </form>
    <?php eliminar_session('errors'); ?>
    <?php eliminar_session('current_data'); ?>
</section>