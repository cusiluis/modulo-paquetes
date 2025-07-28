<h1>Detalle de Escort: <?= htmlspecialchars($escort['Nombre']) ?></h1>

<div class="row">
    <div class="col-md-4">
        <strong>Usuario:</strong> <?= htmlspecialchars($escort['Usuario']) ?><br>
        <strong>Email:</strong> <?= htmlspecialchars($escort['Email']) ?><br>
        <strong>Teléfono:</strong> <?= htmlspecialchars($escort['Telefono']) ?><br>
        <strong>WhatsApp:</strong> <?= $escort['whatsapp'] ? 'Sí' : 'No' ?><br>
        <strong>Telegram:</strong> <?= $escort['telegram'] ? 'Sí' : 'No' ?><br>
        <strong>VIP:</strong> <?= $escort['vip'] ? htmlspecialchars($escort['vip']) : 'No' ?><br>
    </div>

    <div class="col-md-4">
        <strong>Nacionalidad:</strong> <?= htmlspecialchars($escort['Nacionalidad']) ?><br>
        <strong>Idioma:</strong> <?= htmlspecialchars($escort['Idioma']) ?><br>
        <strong>Medidas:</strong> <?= htmlspecialchars($escort['Medidas']) ?><br>
        <strong>Altura:</strong> <?= htmlspecialchars($escort['Altura']) ?><br>
        <strong>Peso:</strong> <?= htmlspecialchars($escort['peso']) ?><br>
        <strong>Edad:</strong> <?= htmlspecialchars($escort['Edad']) ?><br>
        <strong>Pelo:</strong> <?= htmlspecialchars($escort['pelo']) ?><br>
        <strong>Ojos:</strong> <?= htmlspecialchars($escort['ojos']) ?><br>
    </div>

    <div class="col-md-4">
        <strong>Horario:</strong> <?= htmlspecialchars($escort['Horario']) ?><br>
        <strong>Viaje:</strong> <?= htmlspecialchars($escort['Viaje']) ?><br>
        <strong>Web:</strong> <?= htmlspecialchars($escort['Web']) ?><br>
        <strong>Categoría:</strong> <?= htmlspecialchars($escort['CategoriaID']) ?><br>
        <strong>Publicaciones:</strong> <?= htmlspecialchars($escort['diasPublicacion']) ?> días<br>
        <strong>Estado Publicación:</strong> <?= $escort['Publico'] ? 'Público' : 'Oculto' ?><br>
    </div>
</div>

<hr>

<h3>Fotos</h3>
<div class="row">
    <?php for ($i = 1; $i <= 4; $i++): 
        $foto = $escort["Foto$i"];
        if ($foto): ?>
        <div class="col-md-3 mb-3">
            <img src="/uploads/<?= $foto ?>" alt="Foto <?= $i ?>" class="img-fluid img-thumbnail">
        </div>
    <?php endif; endfor; ?>
</div>

<?php if ($escort['Video']): ?>
<h3>Video</h3>
<video width="320" height="240" controls>
    <source src="/uploads/<?= $escort['Video'] ?>" type="video/mp4">
    Tu navegador no soporta video.
</video>
<?php endif; ?>

<hr>

<h3>Comentario / Descripción</h3>
<p><?= nl2br(htmlspecialchars($escort['Comentario'])) ?></p>

<?php if ($escort['Especificaciones']): ?>
<h3>Especificaciones Extras</h3>
<p><?= nl2br(htmlspecialchars($escort['Especificaciones'])) ?></p>
<?php endif; ?>

<hr>

<p><strong>Fecha de Registro:</strong> <?= $escort['fecha_registro'] ?></p>
<p><strong>Paquete ID:</strong> <?= $escort['Pack'] ?></p>
<p><strong>Ciudad ID:</strong> <?= $escort['CiudadID'] ?></p>
<p><strong>Agencia:</strong> <?= $escort['agencia_id'] ? $escort['agencia_id'] : 'Independiente' ?></p>

<a href="/admin_escorts" class="btn btn-secondary mt-3">Volver a la lista</a>
