<?php
require_once 'app/core/Database.php';
require_once 'app/models/Paquete.php';

class PaqueteController {

    public function listar() {
        $db = new Database();
        $paquetes = Paquete::obtenerTodos($db->conn);
        include 'app/views/admin/paquetes/listar.php';
    }

    public function crear($datos) {
        $db = new Database();
        Paquete::crear($db->conn, $datos);
        header('Location: index.php?r=paquetes');
    }
}
?>
