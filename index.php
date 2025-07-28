<?php
session_start();
require_once './app/core/Session.php';

// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $uri = trim($uri, '/');
define('APP_ROOT', realpath(__DIR__));

$basePath = '';
$basePath = '/modulo-paquetes'; // Ajusta según el nombre del subdirectorio
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Quitar el subdirectorio del URI
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

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
            header("Location: '.$basePath.'/login");
        }
        break;

    case $uri === 'dashboard':
        if (!Session::verificar()) {
            header('Location: '.$basePath.'/login');
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

    case $uri === 'admin/paquetes/crear':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->formularioCrear();
        break;

    case $uri === 'paquetes/guardar' && $_SERVER['REQUEST_METHOD'] === 'POST':
        require './app/controllers/PaqueteController.php';
        PaqueteController::crearPaquete();
        break;

    // case preg_match('#^paquetes/actualizar98989/(\d+)$#', $uri, $matches) ? true : false:
    //     require './app/controllers/PaqueteController.php';
    //     PaqueteController::actualizar($_GET['id']);
    //     break;


    case $uri === 'admin/paquetes':
        require './app/controllers/PaqueteController.php';
        $c = new PaqueteController();
        $c->listarPaquetes();
        break;

    case $uri === 'paquete_crear':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->crear();
        break;

    
    case preg_match('#^paquetes/actualizar/(\d+)$#', $uri, $matches) ? true : false:
        require './app/controllers/PaqueteController.php';
        PaqueteController::formularioEditar($matches[1]);
        break;    


    case $uri === 'paquetes/editar' && $_SERVER['REQUEST_METHOD'] === 'POST':
        require './app/controllers/PaqueteController.php';
        PaqueteController::actualizar();
        break;

    case $uri === 'paquetes/toggle_activo':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->toggleActivo();
        break;


        case $uri === 'paquete_editar':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->editar();
        break;

    case $uri === 'paquete_eliminar':
        require './app/controllers/PaqueteController.php';
        (new PaqueteController())->eliminar();
        break;

   case $uri === 'paquetes/listar_opciones':
        require './app/controllers/PaqueteOpcionController.php';
        $c = new PaqueteOpcionController();
        $c->listar();
        break;        

   case $uri === 'paquetes/crear_opciones':
        require './app/controllers/PaqueteOpcionController.php';
        $c = new PaqueteOpcionController();
        $c->crearForm();
        break;         

    case $uri === 'paquetes/guarda_opciones' && $_SERVER['REQUEST_METHOD'] === 'POST':
        require './app/controllers/PaqueteOpcionController.php';
        PaqueteOpcionController::crear();
        break;

    case preg_match('#^paquetes/actualizar_opciones/(\d+)$#', $uri, $matches) ? true : false:
        require './app/controllers/PaqueteOpcionController.php';
        PaqueteOpcionController::editarForm($matches[1]);
        break;

    case $uri === 'paquetes/edita_opciones' && $_SERVER['REQUEST_METHOD'] === 'POST':
        require './app/controllers/PaqueteOpcionController.php';
        PaqueteOpcionController::actualizar();
        break;

    case preg_match('#^paquetes/elimina_opciones/(\d+)$#', $uri, $matches) ? true : false:
        require './app/controllers/PaqueteOpcionController.php';
        PaqueteOpcionController::eliminar($matches[1]);
        break;

    case $uri === 'opciones_paquetes/toggle_activo':
        require './app/controllers/PaqueteOpcionController.php';
        (new PaqueteOpcionController())->toggleActivoOP();
        break;

   case $uri === 'paquetes/listar_solicitudes':
        require './app/controllers/SolicitudPaqueteController.php';
        $c = new SolicitudPaqueteController();
        $c->verSolicitudesAdmin();
        break;  

    case $uri === 'paquetes/asignar_paquete':
        require './app/controllers/UsuarioPaqueteController.php';
        $c = new UsuarioPaqueteController();
        $c->asignarPaqueteEscort($_GET['id'], $_GET['usuario_id'], $_GET['escort_id'], $_GET['duracion_dias'], $_GET['paquete_id'], $_GET['estado']);
        break;   

    case $uri === 'paquetes/rechazar_solicitud':
        require './app/controllers/SolicitudPaqueteController.php';
        $c = new SolicitudPaqueteController();
        $estado_r ="rechazado";
        $c->cambiarEstado($_GET['id'], $estado_r);
        break; 







///// ADMIN USUARIOS ESCORT - AGENCIA



    case $uri === 'user/paquetes/solicitar_paquete':
        require './app/controllers/SolicitudPaqueteController.php';
        $c = new SolicitudPaqueteController();
        $c->solicitarForm();
        break;


    case $uri === 'user/paquetes/enviar_solicitud' && $_SERVER['REQUEST_METHOD'] === 'POST':
        require './app/controllers/SolicitudPaqueteController.php';
        SolicitudPaqueteController::enviarSolicitud();
        break;









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
