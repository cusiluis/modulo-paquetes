<?php
require_once '../app/core/Database.php';
require_once '../app/core/Session.php';
require_once '../app/models/Usuario.php';
require_once '../config/mail_config.php';


class RegistroController {

    public function formulario() {
        include '../app/views/registro.php';
    }

    public function procesar($datos) {
        $email = trim($datos['email']);
        $password = $datos['password'];
        $confirm = $datos['confirm'];
        $rol = $datos['rol']; // Debe ser 'escort' o 'agencia'

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password) || $password !== $confirm) {
            die("Datos inválidos o contraseñas no coinciden.");
        }

        if (!in_array($rol, ['escort', 'agencia'])) {
            die("Rol inválido.");
        }

        $db = new Database();
        if (Usuario::existeEmail($db->conn, $email)) {
            die("El correo ya está registrado.");
        }

        $userId = Usuario::crear($db->conn, $email, $password, $rol);

        Session::iniciar($userId, $rol);
        header("Location: index.php?r=dashboard");
    }

    public function procesar22($datos) { //revisar es para eñ envio de correo
        // ... Validaciones previas

        $db = new Database();
        if (Usuario::existeEmail($db->conn, $email)) die("Correo ya registrado.");

        $userId = Usuario::crear($db->conn, $email, $password, $rol);
        $token = Usuario::obtenerToken($db->conn, $email);
        enviarCorreoActivacion($email, $token);

        echo "Registro exitoso. Revisa tu correo para activar la cuenta.";
    }


}
?>
