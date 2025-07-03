<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST" action="/login_post">
        <input type="email" name="email" class="form-control" placeholder="Email" required><br>
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required><br>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
</body>
</html>
