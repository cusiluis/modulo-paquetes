<?php
class Paquete {

    public static function obtenerTodos($conn) {
        $sql = "SELECT * FROM paquetes WHERE activo = 1";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public static function crear($conn, $data) {
        $includesString = isset($data['includes']) ? implode(',', $data['includes']) : null;

        $stmt = $conn->prepare("INSERT INTO paquetes (
            nombre, descripcion, imagen, precio, duracion_dias, mensaje_accion,
            es_personalizado, frecuencia, cantidad_publicaciones, includes_ids
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "sssdisssis",
            $data['nombre'],
            $data['descripcion'],
            $data['imagen'],
            $data['precio'],
            $data['duracion_dias'],
            $data['mensaje_accion'],
            $data['es_personalizado'],
            $data['frecuencia'],
            $data['cantidad_publicaciones'],
            $includesString
        );

        $stmt->execute();
        return $stmt->insert_id;
    }


    public static function actualizar($conn, $id, $data) {

        $includesString = isset($data['includes']) ? implode(',', $data['includes']) : null;

        $stmt = $conn->prepare("UPDATE paquetes 
            SET nombre = ?, 
                descripcion = ?, 
                imagen = ?, 
                precio = ?, 
                duracion_dias = ?, 
                mensaje_accion = ?, 
                es_personalizado = ?, 
                frecuencia = ?, 
                cantidad_publicaciones = ?, 
                includes_ids = ?, 
                actualizado_en = NOW()
            WHERE id = ?");

        $stmt->bind_param(
            "sssdisisssi",
            $data['nombre'],                  // s
            $data['descripcion'],            // s
            $data['imagen'],                 // s
            $data['precio'],                 // d
            $data['duracion_dias'],          // i
            $data['mensaje_accion'],         // s
            $data['es_personalizado'],       // i
            $data['frecuencia'],             // s
            $data['cantidad_publicaciones'], // s (puede ser i si es estrictamente entero)
            $includesString,                 // s
            $id                              // i
        );

        $stmt->execute();
        return true;
    }




    public static function obtenerOpcionesIncluidas($conn, $paqueteId) {
        $paquete = self::obtenerPorId($conn, $paqueteId);
        //print_r($paquete);exit;
        if (empty($paquete['includes_ids'])) return [];

        $ids = explode(',', $paquete['includes_ids']);
        $in = implode(',', array_fill(0, count($ids), '?'));

        $types = str_repeat('i', count($ids));
        $stmt = $conn->prepare("SELECT * FROM paquetes_opciones WHERE id IN ($in)");
        $stmt->bind_param($types, ...$ids);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }







    public static function crear_old($conn, $datos) {
        $stmt = $conn->prepare("INSERT INTO paquetes (nombre, descripcion, precio, cantidad_publicaciones, duracion_dias, es_personalizado) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiis", $datos['nombre'], $datos['descripcion'], $datos['precio'], $datos['cantidad_publicaciones'], $datos['duracion_dias'], $datos['es_personalizado']);
        return $stmt->execute();
    }

    public static function actualizar_old($conn, $datos) {
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
