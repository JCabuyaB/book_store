<section class="form-container login">
    <form action="<?=base_url?>usuario/login" class="form user-form">
        <h2 class="form__title">Acceder</h2>

        <div class="form-group">
            <input class="form-group__input" type="text" name="email" required>
            <label class="form-group__label">Usuario</label>
        </div>

        <div class="form-group">
            <input class="form-group__input" type="password" name="password" required>
            <label class="form-group__label">Contraseña</label>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="Siguiente">
            <a class="form-button form-buttons__alternative" href="<?=base_url?>usuario/registrarse">Registrarse</a>
        </div>
    </form>
    <?php eliminar_session('#') ?>
</section>