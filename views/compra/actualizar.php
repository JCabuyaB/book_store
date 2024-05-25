<section class="form-container editorial">
    <form action="<?= base_url ?>compra/actualizar_estado" class="user-form" method="POST">
        <h2 class="form__title">Estado pedido # <?= $estado->cod ?></h2>

        <input type="hidden" name="id" value="<?= $estado->cod ?>">

        <div class="form-group">
            <input type="text" name="estado" class="form-group__input" value="<?= $estado->sale_state ?>" required>
            <label class="form-group__label">Estado</label>
        </div>

        <div class="form-buttons">
            <input class="form-button form-buttons__submit" type="submit" value="Continuar">
            <a class="form-button form-buttons__alternative" href="<?= base_url ?>compra/compras">Volver</a>
        </div>
    </form>
</section>