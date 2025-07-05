<?php include '../app/views/includes/header_admin.php'; ?>
<h2><?= $escort ? 'Editar' : 'Nuevo' ?> Escort</h2>
<form method="POST" action="/admin/escorts/guardar">
<?php if ($escort): ?><input type="hidden" name="ID" value="<?= $escort['ID'] ?>"><?php endif; ?>
Nombre: <input type="text" name="Nombre" value="<?= $escort['Nombre'] ?? '' ?>"><br>
Email: <input type="email" name="Email" value="<?= $escort['Email'] ?? '' ?>"><br>
Teléfono: <input type="text" name="Telefono" value="<?= $escort['Telefono'] ?? '' ?>"><br>
Ciudad ID: <input type="text" name="CiudadID" value="<?= $escort['CiudadID'] ?? '' ?>"><br>
VIP: <input type="text" name="vip" value="<?= $escort['vip'] ?? '' ?>"><br>
<button>Guardar</button>
</form>
<?php include '../app/views/includes/footer_admin.php'; ?>
