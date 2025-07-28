<?php
class PaqueteOpcion {
    public static function obtenerPorPaquete($conn, $paquete_id) {
        $stmt = $conn->prepare("SELECT * FROM paquetes_opciones WHERE paquete_id = ?");
        $stmt->bind_param("i", $paquete_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function crear($conn, $data) {
        $stmt = $conn->prepare("INSERT INTO paquetes_opciones (titulo, nombre_portal, descripcion_portal, duracion_dias, veces_dia, precio_subida, precio_total) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiidd", $data['titulo'], $data['nombre_portal'], $data['descripcion_portal'], $data['duracion_dias'], $data['veces_dia'], $data['precio_subida'], $data['precio_total']);
        return $stmt->execute();
    }

    public static function actualizar($conn, $id, $data) {
        $stmt = $conn->prepare("UPDATE paquetes_opciones SET titulo=?, nombre_portal=?, descripcion_portal=?, duracion_dias=?, veces_dia=?, precio_subida=?, precio_total=? WHERE id = ?");
        $stmt->bind_param("sssiiddi", $data['titulo'], $data['nombre_portal'], $data['descripcion_portal'], $data['duracion_dias'], $data['veces_dia'], $data['precio_subida'], $data['precio_total'], $id);
        return $stmt->execute();
    }

    public static function eliminar($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM paquetes_opciones WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function obtenerPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM paquetes_opciones WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function obtenerTodos($conn) {
        return $conn->query("SELECT * FROM paquetes_opciones")->fetch_all(MYSQLI_ASSOC);
    }
}
?>