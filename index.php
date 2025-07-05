<?php
session_start();
require_once './app/core/Session.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

switch (true) {

    case $uri === '' || $uri === 'login':
        require './app/controllers/AuthController.php';
        (new AuthController())->loginForm();
        break;

    case $uri === 'login_post':
        if (isset($_POST['email'], $_POST['password'])) {
            require './app/controllers/AuthController.php';
            (new AuthController())->login($_POST['email'], $_POST['password']);
        } else {
            header("Location: /login");
        }
        break;

    case $uri === 'dashboard':
        if (!Session::verificar()) {
            header('Location: /login');
            exit;
        }
        $rol = Session::rol();
        if ($rol == 'admin') {
            include './app/views/admin/dashboard.php';
        } else {
            //include './app/views/user/dashboard.php';
            require './app/controllers/UsuarioPaqueteController.php';
            $c = new UsuarioPaqueteController();
            $c->dashboard();
        }
        break;

    case $uri === 'admin/usuarios':
        require './app/controllers/AdminController.php';
        $c = new AdminController();
        $c->listarUsuarios();
        break;

    case $uri === 'usuarios/historial':
        require './app/controllers/AdminController.php';
        $c = new AdminController();
        $c->historialUsuario($_GET['usuario']);
        break;
    
    case preg_match('#^usuarios/detalle/(\d+)$#', $uri, $matches) ? true : false:
        require './app/controllers/AdminController.php';
        (new AdminController())->detalleUsuario($matches[1]);
        break;

    case preg_match('#^admin/escort/(\d+)$#', $uri, $matches) ? true : false:
        require './app/controllers/EscortController.php';
        (new EscortController())->formulario($matches[1]);
        break;        

    case $uri === 'admin/paquetes':
        require './app/controllers/PaqueteController.php';
        $c = new PaqueteController();
        $c->listarPaquetes();
        break;

    case $uri === 'paquete_crear':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->crear();
        break;

    case $uri === 'paquete_editar':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->editar();
        break;

    case $uri === 'paquete_eliminar':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->eliminar();
        break;



///// ADMIN USUARIOS ESCORT - AGENCIA

    case $uri === 'user/ver_paquetes':
        require './app/controllers/UsuarioPaqueteController.php';
        $c = new UsuarioPaqueteController();
        $c->verPaquetes();
        break;

    case $uri === 'user/comprar_paquete':
        require './app/controllers/UsuarioPaqueteController.php';
        $c = new UsuarioPaqueteController();
        $c->comprarPaquete($_GET['id']);
        break;











    case $uri === 'logout':
        require './app/controllers/AuthController.php';
        (new AuthController())->logout();
        break;        










    case $uri === 'registro':
        require './app/controllers/RegistroController.php';
        (new RegistroController())->formulario();
        break;

    case $uri === 'registro_post':
        require './app/controllers/RegistroController.php';
        (new RegistroController())->procesar($_POST);
        break;

    default:
        if (preg_match('#^activar/([a-zA-Z0-9]+)$#', $uri, $matches)) {
            require './app/controllers/ActivacionController.php';
            (new ActivacionController())->activar($matches[1]);
        } else {
            echo "Página no encontrada.";
        }
}
?>
