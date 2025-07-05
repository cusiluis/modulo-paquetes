<?php
require_once 'app/core/Database.php';
require_once 'app/models/Paquete.php';
require_once 'app/models/HistorialPaquete.php';
require_once 'app/core/Session.php';

class UsuarioPaqueteController {

    public function dashboard() {
        Session::verificar() or die("Acceso denegado");

        $db = new Database();
        $paqueteActivo = HistorialPaquete::obtenerActivo($db->conn, $_SESSION['user_id']);
        $historial = HistorialPaquete::obtenerPorUsuario($db->conn, $_SESSION['user_id']);
        $paquetes = Paquete::obtenerTodosDisponibles($db->conn);

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
}
?>
