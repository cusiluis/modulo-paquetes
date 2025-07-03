<?php //include '../app/views/admin/partials/header.php'; ?>

<h2>Gestión de Paquetes</h2>
<a href="index.php?r=paquetes_crear" class="btn btn-primary">Nuevo Paquete</a>

<table class="table">
    <thead>
        <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Duración</th><th>Acciones</th></tr>
    </thead>
    <tbody>
        <?php foreach($paquetes as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['nombre'] ?></td>
                <td>$<?= $p['precio'] ?></td>
                <td><?= $p['duracion_dias'] ?> días</td>
                <td>
                    <a href="#">Editar</a> | <a href="#">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php //include '../app/views/admin/partials/footer.php'; ?>
