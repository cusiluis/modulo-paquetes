<?php
require_once '../app/core/Database.php';
require_once '../app/core/Session.php';
require_once '../app/models/SolicitudPaquete.php';
require_once '../app/models/Paquete.php';
require_once '../app/models/HistorialPaquete.php';

class AdminSolicitudController {

    public function listarSolicitudes() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $solicitudes = SolicitudPaquete::obtenerPendientes($db->conn);
        include '../app/views/admin/solicitudes.php';
    }

    public function responderForm($id) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $solicitud = SolicitudPaquete::obtenerPorId($db->conn, $id);
        include '../app/views/admin/responder_solicitud.php';
    }

    public function responder($id, $estado, $respuesta) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        SolicitudPaquete::responder($db->conn, $id, $estado, $respuesta);
        header("Location: index.php?r=admin_solicitudes");
    }
}
?>
