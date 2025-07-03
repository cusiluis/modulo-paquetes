<?php
require_once '../app/core/Database.php';
require_once '../app/core/Session.php';
require_once '../app/models/SolicitudPaquete.php';

class SolicitudPaqueteController {

    public function solicitarForm() {
        Session::verificar() or die("Acceso denegado");
        include '../app/views/user/solicitar_paquete.php';
    }

    public function enviarSolicitud($descripcion) {
        Session::verificar() or die("Acceso denegado");

        $db = new Database();
        SolicitudPaquete::crear($db->conn, $_SESSION['user_id'], $descripcion);
        header('Location: index.php?r=dashboard');
    }
}
?>
