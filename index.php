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
            include './app/views/user/dashboard.php';
        }
        break;

    case $uri === 'admin_usuarios':
        require './app/controllers/AdminController.php';
        $c = new AdminController();
        $c->listarUsuarios();
        break;

    case $uri === 'admin_paquetes':
        require './app/controllers/AdminController.php';
        $c = new AdminController();
        $c->listarPaquetes();
        break;

    case $uri === 'paquetes':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->listar();
        break;


    case $uri === 'registro':
        require './app/controllers/RegistroController.php';
        (new RegistroController())->formulario();
        break;

    case $uri === 'registro_post':
        require './app/controllers/RegistroController.php';
        (new RegistroController())->procesar($_POST);
        break;



    case $uri === 'logout':
        require './app/controllers/AuthController.php';
        (new AuthController())->logout();
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
