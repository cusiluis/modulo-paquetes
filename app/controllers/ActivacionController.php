<?php
require_once '../app/core/Database.php';
require_once '../app/models/Usuario.php';

class ActivacionController {

    public function activar($token) {
        $db = new Database();
        if (Usuario::activarCuenta($db->conn, $token)) {
            include '../app/views/activacion_exitosa.php';
        } else {
            include '../app/views/activacion_error.php';
        }
    }
}
?>
