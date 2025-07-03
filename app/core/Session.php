<?php
class Session {

    public static function iniciar($userId, $rol) {
        session_start();
        $_SESSION['user_id'] = $userId;
        $_SESSION['rol'] = $rol;
    }

    public static function verificar() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public static function rol() {
        return $_SESSION['rol'] ?? null;
    }

    public static function esAdmin() {
        session_start();
        return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
    }

    public static function impersonar($usuarioId) {
        if (!self::esAdmin()) die("Acceso denegado");
        
        if (!isset($_SESSION['impersonando'])) {
            // Guarda el contexto original
            $_SESSION['impersonando'] = [
                'user_id' => $_SESSION['user_id'],
                'rol' => $_SESSION['rol']
            ];
        }
        
        // Actualiza sesión como el usuario objetivo
        $_SESSION['user_id'] = $usuarioId;
        $_SESSION['rol'] = 'escort'; // O recuperas el rol real desde la BD si quieres más exactitud
    }

    public static function terminarImpersonacion() {
        if (isset($_SESSION['impersonando'])) {
            $_SESSION['user_id'] = $_SESSION['impersonando']['user_id'];
            $_SESSION['rol'] = $_SESSION['impersonando']['rol'];
            unset($_SESSION['impersonando']);
        }
    }

    public static function estaImpersonando() {
        return isset($_SESSION['impersonando']);
    }

    public static function cerrar() {
        session_start();
        session_destroy();
    }
}
?>
