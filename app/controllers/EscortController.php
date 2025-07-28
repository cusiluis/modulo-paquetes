<?php
require_once 'app/core/Database.php';
require_once 'app/core/Session.php';
require_once 'app/models/Escort.php';

class EscortController {

    public function listar() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $escorts = Escort::obtenerTodos($db->conn);
        include 'app/views/admin/escorts/index.php';
    }

    public function formulario($id = null) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $escort = $id ? Escort::obtenerPorId($db->conn, $id) : null;
        include 'app/views/admin/escorts/ver_escort.php';
    }

    public function guardar($datos) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        if (isset($datos['ID'])) {
            Escort::actualizar($db->conn, $datos);
        } else {
            Escort::crear($db->conn, $datos);
        }
        header("Location: admin/escorts");
    }

    public function eliminar($id) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        Escort::eliminar($db->conn, $id);
        header("Location: admin/escorts");
    }  
}
