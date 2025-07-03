<!DOCTYPE html>
<html>
<head>
    <title>Registro de Cuenta</title>
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Crear Cuenta</h2>
    <form method="POST" action="index.php?r=registro_post">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Confirmar Contraseña:</label>
            <input type="password" name="confirm" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tipo de Cuenta:</label>
            <select name="rol" class="form-control" required>
                <option value="escort">Escort Independiente</option>
                <option value="agencia">Agencia de Escorts</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrarme</button>
        <a href="index.php?r=login" class="btn btn-link">Ya tengo cuenta</a>
    </form>
</div>
</body>
</html>
