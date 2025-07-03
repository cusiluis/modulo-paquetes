<!DOCTYPE html>
<html>
<head>
    <title>Mi Panel</title>
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Bienvenido Usuario</h2>
<?php if (Session::estaImpersonando()): ?>
    <div class="alert alert-info">
        <strong>Modo Impersonación:</strong> Estás visualizando como otro usuario.
        <a href="index.php?r=salir_impersonacion" class="btn btn-sm btn-danger">Volver a modo administrador</a>
    </div>
<?php endif; ?>

    <h4>Paquete Activo</h4>
    <?php if ($paqueteActivo): ?>
        <div class="alert alert-success">
            <strong><?= $paqueteActivo['nombre'] ?></strong><br>
            Válido hasta: <?= $paqueteActivo['fecha_fin'] ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No tienes un paquete activo.</div>
    <?php endif; ?>

    <h4>Historial de Paquetes</h4>
    <table class="table">
        <thead><tr><th>Paquete</th><th>Inicio</th><th>Fin</th><th>Estado</th></tr></thead>
        <tbody>
            <?php foreach($historial as $h): ?>
                <tr>
                    <td><?= $h['nombre'] ?></td>
                    <td><?= $h['fecha_inicio'] ?></td>
                    <td><?= $h['fecha_fin'] ?></td>
                    <td><?= ucfirst($h['estado']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?r=ver_paquetes" class="btn btn-primary">Ver Paquetes Disponibles</a>
    <a href="index.php?r=logout" class="btn btn-secondary">Salir</a>
</div>
</body>
</html>
