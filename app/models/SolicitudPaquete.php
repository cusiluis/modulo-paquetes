<?php

class SolicitudPaquete
{
    public static function crear($conn, $data)
    {
        $stmt = $conn->prepare("
            INSERT INTO solicitudes_paquetes 
            (usuario_id, escort_id, paquete_id, descripcion, es_personalizado) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        $stmt->bind_param(
            "iiisi",
            $data['usuario_id'],
            $data['escort_id'],
            $data['paquete_id'],
            $data['descripcion'],
            $data['es_personalizado']
        );        

        $stmt->execute();
        return $stmt->insert_id;
    }

    public static function obtenerPorUsuario($conn, $usuarioId)
    {
        $stmt = $conn->prepare("
            SELECT 
                    sp.*, 
                    u.nombre AS nombre_escort, 
                    p.nombre AS nombre_paquete, 
                    p.duracion_dias 
                FROM solicitudes_paquetes sp
                JOIN reino01_Escort u ON sp.escort_id = u.ID
                LEFT JOIN paquetes p ON sp.paquete_id = p.id
                WHERE sp.usuario_id = ?
                ORDER BY sp.fecha_creacion DESC
        ");

        // $stmt = $conn->prepare("
        //     SELECT * FROM solicitudes_paquetes 
        //     WHERE usuario_id = ? 
        //     ORDER BY fecha_creacion DESC
        // ");

        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function obtenerPorUsuarioPendiente($conn, $usuarioId)
    {
        $stmt = $conn->prepare("
            SELECT 
                    sp.*, 
                    u.nombre AS nombre_escort, 
                    p.nombre AS nombre_paquete, 
                    p.duracion_dias 
                FROM solicitudes_paquetes sp
                JOIN reino01_Escort u ON sp.escort_id = u.ID
                LEFT JOIN paquetes p ON sp.paquete_id = p.id
                WHERE sp.usuario_id = ? AND sp.estado = 'pendiente'
                ORDER BY sp.fecha_creacion DESC
        ");

        // $stmt = $conn->prepare("
        //     SELECT * FROM solicitudes_paquetes 
        //     WHERE usuario_id = ? 
        //     ORDER BY fecha_creacion DESC
        // ");

        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        return $stmt->get_result();
    }


    public static function obtenerPorEscort($conn, $escortId)
    {
        $stmt = $conn->prepare("
            SELECT * FROM solicitudes_paquetes 
            WHERE escort_id = ? 
            ORDER BY fecha_creacion DESC
        ");
        $stmt->bind_param("i", $escortId);
        $stmt->execute();
        return $stmt->get_result();
    }    

    // public static function obtenerTodas($conn)
    // {
    //     //return $conn->query("SELECT * FROM solicitudes_paquetes ORDER BY fecha_creacion DESC");

    //     $sql = "SELECT sp.*, u.nombre AS nombre_escort
    //     FROM solicitudes_paquetes sp
    //     JOIN reino01_Escort u ON sp.escort_id = u.ID
    //     ORDER BY sp.fecha_creacion DESC";

    //     return $conn->query($sql);

    // }

    public static function obtenerTodas($conn)
    {
        $sql = "SELECT 
                    sp.*, 
                    u.nombre AS nombre_escort, 
                    p.nombre AS nombre_paquete, 
                    p.duracion_dias 
                FROM solicitudes_paquetes sp
                JOIN reino01_Escort u ON sp.escort_id = u.ID
                LEFT JOIN paquetes p ON sp.paquete_id = p.id
                ORDER BY sp.fecha_creacion DESC";
    
        return $conn->query($sql);
    }
    

    public static function actualizarEstado($conn, $id, $estado)
    {
        $stmt = $conn->prepare("UPDATE solicitudes_paquetes SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $id);
        return $stmt->execute();
    }

    public static function obtenerPorId($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM solicitudes_paquetes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
