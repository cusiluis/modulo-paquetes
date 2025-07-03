<?php
require_once 'app/core/Session.php';
class LoginController {
    public function formulario() {
        include 'app/views/login.php';
    }
    public function autenticar($datos) {
        $email = $datos['email'];
        $password = $datos['password'];
        if ($email === "admin@admin.com" && $password === "admin123") {
            Session::iniciar(1, 'admin');
            header("Location: /panel");
        } elseif ($email === "user@user.com" && $password === "user123") {
            Session::iniciar(2, 'escort');
            header("Location: /panel");
        } else {
            die("Credenciales incorrectas.");
        }
    }
}
?>
