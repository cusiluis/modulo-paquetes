<?php include '../public/adminlte/header.php'; ?>
<h2>Solicitudes de Paquetes Personalizados</h2>
<table class="table">
    <thead><tr><th>ID</th><th>Usuario</th><th>Descripción</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach ($solicitudes as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= $s['email'] ?></td>
            <td><?= $s['descripcion'] ?></td>
            <td><a href="index.php?r=admin_responder_solicitud&id=<?= $s['id'] ?>" class="btn btn-primary">Responder</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php include '../public/adminlte/footer.php'; ?>
