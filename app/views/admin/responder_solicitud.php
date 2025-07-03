<?php include '../public/adminlte/header.php'; ?>
<h2>Responder Solicitud #<?= $solicitud['id'] ?></h2>
<p><strong>Usuario:</strong> <?= $solicitud['email'] ?></p>
<p><strong>Descripción:</strong> <?= $solicitud['descripcion'] ?></p>

<form method="POST" action="index.php?r=admin_responder_post">
    <input type="hidden" name="id" value="<?= $solicitud['id'] ?>">
    <div class="form-group">
        <label>Respuesta del Administrador:</label>
        <textarea name="respuesta" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label>Estado:</label>
        <select name="estado" class="form-control">
            <option value="aprobado">Aprobar</option>
            <option value="rechazado">Rechazar</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Enviar Respuesta</button>
    <a href="index.php?r=admin_solicitudes" class="btn btn-secondary">Cancelar</a>
</form>
<?php include '../public/adminlte/footer.php'; ?>
