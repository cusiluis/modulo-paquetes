<!DOCTYPE html>
<html>
<head>
    <title>Comprar Paquetes</title>
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Paquetes Disponibles</h2>
    <div class="row">
        <?php foreach($paquetes as $p): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header"><?= $p['nombre'] ?></div>
                    <div class="card-body">
                        <p><?= $p['descripcion'] ?></p>
                        <p><strong>$<?= $p['precio'] ?></strong></p>
                        <p><?= $p['cantidad_publicaciones'] ?> publicaciones</p>
                        <p>Duración: <?= $p['duracion_dias'] ?> días</p>
                        <a href="index.php?r=comprar_paquete&id=<?= $p['id'] ?>" class="btn btn-success">Comprar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php?r=dashboard" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
