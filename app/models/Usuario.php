<?php
class Usuario {

     public static function existeEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public static function crear($conn, $email, $password, $rol) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(16));
        $stmt = $conn->prepare("INSERT INTO users (email, password, rol, token_activacion) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $hash, $rol, $token);
        $stmt->execute();
        return $conn->insert_id;
    }

    public static function obtenerToken($conn, $email) {
        $stmt = $conn->prepare("SELECT token_activacion FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['token_activacion'];
    }

    public static function activarCuenta($conn, $token) {
        $stmt = $conn->prepare("UPDATE users SET activado = 1, token_activacion = NULL WHERE token_activacion = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public static function estaActivado($conn, $email) {
        $stmt = $conn->prepare("SELECT activado FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['activado'] == 1;
    }

    public static function obtenerPorEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function obtenerTodos($conn) {
        return $conn->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
    }

    public static function obtenerPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
