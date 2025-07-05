<?php include '../app/views/includes/header_admin.php'; ?>
<h2>Lista de Escorts</h2>
<a href="/admin/escorts/nuevo">Nuevo Escort</a>
<table border="1"><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Ciudad</th><th>Acciones</th></tr>
<?php foreach($escorts as $e): ?>
<tr>
<td><?= $e['ID'] ?></td><td><?= $e['Nombre'] ?></td><td><?= $e['Email'] ?></td><td><?= $e['Telefono'] ?></td><td><?= $e['CiudadID'] ?></td>
<td><a href="/admin/escorts/editar/<?= $e['ID'] ?>">Editar</a> | <a href="/admin/escorts/eliminar/<?= $e['ID'] ?>">Eliminar</a></td>
</tr>
<?php endforeach; ?>
</table>
<?php include '../app/views/includes/footer_admin.php'; ?>
