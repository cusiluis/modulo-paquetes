<?php
class SolicitudPaquete {

    public static function crear($conn, $usuarioId, $descripcion) {
        $stmt = $conn->prepare(
            "INSERT INTO solicitudes_paquetes (usuario_id, descripcion, estado) 
             VALUES (?, ?, 'pendiente')"
        );
        $stmt->bind_param("is", $usuarioId, $descripcion);
        $stmt->execute();
    }

    public static function obtenerPendientes($conn) {
        return $conn->query(
            "SELECT s.*, u.email FROM solicitudes_paquetes s 
             JOIN users u ON s.usuario_id = u.id 
             WHERE s.estado = 'pendiente' 
             ORDER BY s.creado_en DESC"
        )->fetch_all(MYSQLI_ASSOC);
    }

    public static function obtenerPorId($conn, $id) {
        $stmt = $conn->prepare(
            "SELECT s.*, u.email FROM solicitudes_paquetes s 
             JOIN users u ON s.usuario_id = u.id 
             WHERE s.id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function responder($conn, $id, $estado, $respuesta) {
        $stmt = $conn->prepare(
            "UPDATE solicitudes_paquetes SET estado = ?, respuesta_admin = ? WHERE id = ?"
        );
        $stmt->bind_param("ssi", $estado, $respuesta, $id);
        $stmt->execute();
    }
}
?>
