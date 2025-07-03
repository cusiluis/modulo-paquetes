<?php
class Paquete {

    public static function obtenerTodos($conn) {
        $sql = "SELECT * FROM paquetes";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function crear($conn, $datos) {
        $stmt = $conn->prepare("INSERT INTO paquetes (nombre, descripcion, precio, cantidad_publicaciones, duracion_dias, es_personalizado) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiis", $datos['nombre'], $datos['descripcion'], $datos['precio'], $datos['cantidad_publicaciones'], $datos['duracion_dias'], $datos['es_personalizado']);
        $stmt->execute();
    }

     public static function obtenerTodosDisponibles($conn) {
        $sql = "SELECT * FROM paquetes WHERE es_personalizado = 0";
        return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public static function obtenerPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM paquetes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
