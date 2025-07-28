<?php
require_once 'app/core/Database.php';
require_once 'app/models/Paquete.php';
require_once 'app/models/HistorialPaquete.php';
require_once 'app/models/SolicitudPaquete.php';
require_once 'app/models/Escort.php';
require_once 'app/core/Session.php';
include APP_ROOT . '/app/core/globales.inc.php';

class UsuarioPaqueteController {

    public function dashboard() {
        Session::verificar() or die("Acceso denegado");

        $db = new Database();
        $paqueteActivo = HistorialPaquete::obtenerActivo($db->conn, $_SESSION['user_id']);
        $historial = HistorialPaquete::obtenerPorUsuario($db->conn, $_SESSION['user_id']);
        $paquetes = Paquete::obtenerTodosDisponibles($db->conn);
        $solicitudes = SolicitudPaquete::obtenerPorUsuarioPendiente($db->conn, $_SESSION['user_id']);
        $escorts = Escort::obtenerPorUsuario($db->conn, $_SESSION['user_id']);

        include 'app/views/user/dashboard.php';
    }

    public function verPaquetes() {
        Session::verificar() or die("Acceso denegado");

        $db = new Database();
        $paquetes = Paquete::obtenerTodosDisponibles($db->conn);

       // include 'app/views/user/paquetes.php';
    }

    public function comprarPaquete($paqueteId) {
        Session::verificar() or die("Acceso denegado");

        $db = new Database();
        $paquete = Paquete::obtenerPorId($db->conn, $paqueteId);

        if (!$paquete) die("Paquete no encontrado");

        // Aquí simulas compra, en real sería tras pago validado
        HistorialPaquete::asignarPaquete($db->conn, $_SESSION['user_id'], $paqueteId, $paquete['duracion_dias']);
        header("Location: /dashboard");
    }


    public static function asignarPaqueteEscort($idSolicitud, $usuario_id, $escort_id, $duracion_dias, $paqueteId, $nuevoEstado) {
        Session::verificar() or die("Acceso denegado");

        $db = new Database();
        $paquete = Paquete::obtenerPorId($db->conn, $paqueteId);

        if (!$paquete) die("Paquete no encontrado");

        // Aquí simulas compra, en real sería tras pago validado

        HistorialPaquete::asignarPaqueteEscortHistorial($db->conn, $usuario_id, $escort_id, $paqueteId, $duracion_dias);

        SolicitudPaquete::actualizarEstado($db->conn, $idSolicitud, $nuevoEstado);

        header('Location: '.BASE_URL.'paquetes/listar_solicitudes');
    }


}
?>
