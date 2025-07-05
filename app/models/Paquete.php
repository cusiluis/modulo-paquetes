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
        return $stmt->execute();
    }

    public static function actualizar($conn, $datos) {
        $stmt = $conn->prepare("UPDATE paquetes SET nombre = ?, descripcion = ?, precio = ?, cantidad_publicaciones = ?, duracion_dias = ?, es_personalizado = ? WHERE id = ?");
        $stmt->bind_param("ssdiisi", $datos['nombre'], $datos['descripcion'], $datos['precio'], $datos['cantidad_publicaciones'], $datos['duracion_dias'], $datos['es_personalizado'], $datos['id']);
        return $stmt->execute();
    }

    public static function eliminar($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM paquetes WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
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

    public static function obtenerActivosPorUsuario($conn, $usuarioId) {
        $sql = "SELECT * FROM historial_paquetes WHERE usuario_id = ? AND fecha_fin >= NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
