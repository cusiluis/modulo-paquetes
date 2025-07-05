<?php
class HistorialPaquete {

    public static function obtenerPorUsuario($conn, $usuarioId) {
        $stmt = $conn->prepare(
            "SELECT h.*, p.nombre 
             FROM historial_paquetes h 
             JOIN paquetes p ON h.paquete_id = p.id 
             WHERE h.usuario_id = ? 
             ORDER BY h.fecha_inicio DESC"
        );
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function asignarPaquete($conn, $usuarioId, $paqueteId, $diasDuracion) {
        $hoy = date('Y-m-d');

        // Consultar último paquete activo o reciente
        $stmt = $conn->prepare(
            "SELECT * FROM historial_paquetes 
            WHERE usuario_id = ? 
            ORDER BY fecha_fin DESC 
            LIMIT 1"
        );
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $ultimo = $stmt->get_result()->fetch_assoc();

        if ($ultimo) {
            $fechaFin = $ultimo['fecha_fin'];
            $idPaquetePrevio = $ultimo['paquete_id'];

            if ($fechaFin < $hoy) {
                // Expirado: se renueva
                $stmt2 = $conn->prepare("UPDATE historial_paquetes SET estado = 'renovado' WHERE id = ?");
                $stmt2->bind_param("i", $ultimo['id']);
                $stmt2->execute();
            } elseif ($fechaFin >= $hoy) {
                if ($idPaquetePrevio == $paqueteId) {
                    $stmt2 = $conn->prepare("UPDATE historial_paquetes SET estado = 'renovado' WHERE id = ?");
                    $stmt2->bind_param("i", $ultimo['id']);
                    $stmt2->execute();
                } elseif ($paqueteId > $idPaquetePrevio) {
                    $stmt2 = $conn->prepare("UPDATE historial_paquetes SET estado = 'mejorado' WHERE id = ?");
                    $stmt2->bind_param("i", $ultimo['id']);
                    $stmt2->execute();
                }
            }
        }

        // Insertar nuevo paquete
        $fin = date('Y-m-d', strtotime("+$diasDuracion days"));
        $stmt3 = $conn->prepare(
            "INSERT INTO historial_paquetes (usuario_id, paquete_id, fecha_inicio, fecha_fin, estado) 
            VALUES (?, ?, ?, ?, 'activo')"
        );
        $stmt3->bind_param("iiss", $usuarioId, $paqueteId, $hoy, $fin);
        $stmt3->execute();
    }


    public static function obtenerActivo($conn, $usuarioId) {
        $hoy = date('Y-m-d');
        $stmt = $conn->prepare(
            "SELECT h.*, p.nombre 
             FROM historial_paquetes h 
             JOIN paquetes p ON h.paquete_id = p.id 
             WHERE h.usuario_id = ? AND h.fecha_fin >= ? AND h.estado = 'activo'
             ORDER BY h.fecha_fin DESC LIMIT 1"
        );
        $stmt->bind_param("is", $usuarioId, $hoy);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
