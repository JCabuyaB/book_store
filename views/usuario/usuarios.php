<section class="carrito">
    <!-- recorrer carrito -->
    <div class="table-container libros">
        <table class="table libros" class="user-form">
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Rol</th>
                    <th>Correo electrónico</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Direccion</th>
                </tr>
            </thead>

            <?php if (isset($usuarios) && $usuarios != null) : ?>
                <tbody>
                    <?php while ($usuario = $usuarios->fetch_object()) : ?>
                        <tr>
                            <td><?= $usuario->name ?></td>
                            <td><?= $usuario->role ?></td>
                            <td><?= $usuario->mail ?></td>
                            <td><?= $usuario->department ?></td>
                            <td><?= $usuario->city ?></td>
                            <td><?= $usuario->address ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</section>