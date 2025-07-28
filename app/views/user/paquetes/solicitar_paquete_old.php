<!DOCTYPE html>
<html>
<head>
    <title>Solicitar Paquete Personalizado</title>
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Solicitud de Paquete Personalizado</h2>
    <form method="POST" action="index.php?r=enviar_solicitud">
        <div class="form-group">
            <label>Describe tus necesidades:</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
        <a href="index.php?r=dashboard" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
