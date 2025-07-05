<?php
require_once 'app/core/Database.php';
require_once 'app/models/Paquete.php';

class PaqueteController {


    public function listarPaquetes() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $paquetes = Paquete::obtenerTodos($db->conn);
        include 'app/views/admin/paquetes.php';
    }

    public function crear() {
        $db = new Database();
        $datos = json_decode(file_get_contents("php://input"), true);

        if (Paquete::crear($db->conn, $datos)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear paquete.']);
        }
    }

    public function editar() {
        $db = new Database();
        $datos = json_decode(file_get_contents("php://input"), true);

        if (Paquete::actualizar($db->conn, $datos)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar paquete.']);
        }
    }

    public function eliminar() {
        $db = new Database();
        $datos = json_decode(file_get_contents("php://input"), true);

        if (Paquete::eliminar($db->conn, $datos['id'])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar paquete.']);
        }
    }
}
?>
