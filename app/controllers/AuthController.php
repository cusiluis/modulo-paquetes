<?php
require_once 'app/core/Database.php';
require_once 'app/models/Usuario.php';
require_once 'app/core/Session.php';

class AuthController {

    public function loginForm() {
        include 'app/views/login.php';
    }

    public function login($email, $password) {
        $db = new Database();
        $usuario = Usuario::obtenerPorEmail($db->conn, $email);

        if (!Usuario::estaActivado($db->conn, $email)) {
            die("Debes activar tu cuenta desde el correo electrónico.");
        }

        if ($usuario && password_verify($password, $usuario['password'])) {
            Session::iniciar($usuario['id'], $usuario['rol']);
            header('Location: dashboard');
        } else {
            $error = "Credenciales incorrectas";
            include 'app/views/login.php';
        }
    }

    public function logout() {
        Session::cerrar();
        header('Location: /login');
    }
}
?>
