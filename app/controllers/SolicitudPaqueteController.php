<?php
require_once 'app/models/SolicitudPaquete.php';
require_once 'app/models/Paquete.php';
require_once 'app/models/HistorialPaquete.php';
require_once 'app/core/Database.php';
require_once 'app/core/Session.php';
include APP_ROOT . '/app/core/globales.inc.php';

class SolicitudPaqueteController {

    public static function solicitarForm() {
        //Session::verificar() or die("Acceso denegado");

        $db = new Database();
        $conn = $db->conn;

        $usuarioId = $_SESSION['user_id'];
        $result = $conn->query("SELECT * FROM reino01_Escort WHERE usuario_id = $usuarioId AND Publico = 1");
        $escorts = $result->fetch_all(MYSQLI_ASSOC);

        $paquetes = Paquete::obtenerTodos($db->conn);
        //print_r($escorts);

        include 'app/views/user/paquetes/solicitar_paquete.php';
    }

    public static function enviarSolicitud() {
        //Session::verificar() or die("Acceso denegado");
        //print_r($_POST); exit;
        $db = new Database();


        $es_personalizado = isset($_POST['es_personalizado']) ? 1 : 0;
        //print_r($es_personalizado);exit;
        // Armar arreglo para guardar
        $data = [
            'usuario_id' => $_POST['usuario_id'],
            'escort_id' => $_POST['escort_id'],
            'paquete_id' => $_POST['paquete_id'],
            'es_personalizado' => $es_personalizado,
            'descripcion' => $_POST['descripcion']
        ];

        SolicitudPaquete::crear($db->conn, $data);
        header('Location: '.BASE_URL.'dashboard?ps=200');
    }

    public static function verSolicitudesAdmin() {
        Session::esAdmin() or die("Acceso denegado");

        $db = new Database();
        $solicitudes = SolicitudPaquete::obtenerTodas($db->conn);
        include 'app/views/admin/paquetes/solicitudes_paquetes.php';
    }

    public static function cambiarEstado($id, $nuevoEstado) {
        Session::esAdmin() or die("Acceso denegado");

        $db = new Database();

        SolicitudPaquete::actualizarEstado($db->conn, $id, $nuevoEstado);
        header('Location: index.php?r=admin_solicitudes');
    }
}
?>
