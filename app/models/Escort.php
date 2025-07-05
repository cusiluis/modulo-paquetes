<?php
class Escort {

    public static function obtenerTodos($conn) {
        $sql = "SELECT ID, Nombre, Email, Telefono, Publico, vip, CiudadID FROM reino01_Escort ORDER BY fecha_registro DESC";
        return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public static function obtenerPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM reino01_Escort WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function crear($conn, $datos) {
        $stmt = $conn->prepare("INSERT INTO reino01_Escort (usuario_id, fechaPublicacion, diasPublicacion, Publico, Usuario, Contrasenia, Nombre, Pack, Medidas, Altura, Nacionalidad, Idioma, Viaje, Horario, Email, Web, Comentario, CategoriaID, Foto1, Telefono, PaisID, ProvinciaID, CiudadID, Titulo, Edad, fecha_registro, peso, pelo, ojos, vip, agencia_id) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiisssssssssssisissiiisisiisss",
            $datos['usuario_id'], $datos['diasPublicacion'], $datos['Publico'],
            $datos['Usuario'], $datos['Contrasenia'], $datos['Nombre'],
            $datos['Pack'], $datos['Medidas'], $datos['Altura'],
            $datos['Nacionalidad'], $datos['Idioma'], $datos['Viaje'],
            $datos['Horario'], $datos['Email'], $datos['Web'],
            $datos['Comentario'], $datos['CategoriaID'], $datos['Foto1'],
            $datos['Telefono'], $datos['PaisID'], $datos['ProvinciaID'],
            $datos['CiudadID'], $datos['Titulo'], $datos['Edad'],
            $datos['peso'], $datos['pelo'], $datos['ojos'],
            $datos['vip'], $datos['agencia_id']
        );
        $stmt->execute();
    }

    public static function actualizar($conn, $datos) {
        $stmt = $conn->prepare("UPDATE reino01_Escort SET Nombre=?, Email=?, Telefono=?, Publico=?, vip=?, CiudadID=? WHERE ID=?");
        $stmt->bind_param("sssissi",
            $datos['Nombre'], $datos['Email'], $datos['Telefono'],
            $datos['Publico'], $datos['vip'], $datos['CiudadID'], $datos['ID']
        );
        $stmt->execute();
    }

    public static function eliminar($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM reino01_Escort WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public static function obtenerPorUsuario($conn, $usuarioId) {
        $sql = "SELECT * FROM reino01_Escort WHERE usuario_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

}
