<?php
require_once 'app/core/Database.php';
require_once 'app/core/Session.php';
require_once 'app/models/Usuario.php';
require_once 'app/models/Paquete.php';
require_once 'app/models/Escort.php';
require_once 'app/models/HistorialPaquete.php';

class AdminController {

    public function dashboard() {
        Session::esAdmin() or die("Acceso denegado");
        include 'app/views/admin/dashboard.php';
    }

    public function listarUsuarios() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $usuarios = Usuario::obtenerTodos($db->conn);
        include 'app/views/admin/usuarios.php';
    }

    public function detalleUsuario($usuarioId) {
        Session::esAdmin() or die("Acceso denegado");

        $db = new Database();

        // Datos usuario
        $usuario = Usuario::obtenerPorId($db->conn, $usuarioId);

        // Paquetes activos
        $paquetes_activos = Paquete::obtenerActivosPorUsuario($db->conn, $usuarioId);

        // Historial de paquetes
        $historial = HistorialPaquete::obtenerPorUsuario($db->conn, $usuarioId);

        // Escorts asociados
        $escorts = Escort::obtenerPorUsuario($db->conn, $usuarioId);

        include 'app/views/admin/usuarios/detalle.php';
    }

    // public function listarPaquetes() {
    //     Session::esAdmin() or die("Acceso denegado");
    //     $db = new Database();
    //     $paquetes = Paquete::obtenerTodos($db->conn);
    //     include 'app/views/admin/paquetes.php';
    // }

    public function crearPaquete($datos) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        Paquete::crear($db->conn, $datos);
        header("Location: index.php?r=admin_paquetes");
    }

    public function historialUsuario($usuarioId) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $usuario = Usuario::obtenerPorId($db->conn, $usuarioId);
        $historial = HistorialPaquete::obtenerPorUsuario($db->conn, $usuarioId);
        include 'app/views/admin/usuarios/historial.php';
    }

    public function impersonar222($usuarioId) {
        Session::verificar() or die("Acceso denegado");
        $_SESSION['impersonate'] = $usuarioId;
        header('Location: index.php?r=dashboard');
    }

    public function impersonar($usuarioId) {
    Session::esAdmin() or die("Acceso denegado");
    Session::impersonar($usuarioId);
    header("Location: index.php?r=dashboard");
    }

    public function salirImpersonacion() {
        Session::terminarImpersonacion();
        header("Location: index.php?r=admin");
    }

}
?>
