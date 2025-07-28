<?php
require_once 'app/models/PaqueteOpcion.php';
require_once 'app/core/Database.php';
require_once 'app/core/Session.php';
include APP_ROOT . '/app/core/globales.inc.php';

class PaqueteOpcionController {

    public function listar() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $opciones = PaqueteOpcion::obtenerTodos($db->conn);
        include 'app/views/admin/paquetes/listar_opciones.php';
    }

    public function crearForm() {
        Session::esAdmin() or die("Acceso denegado");
        include 'app/views/admin/paquetes/crear_opciones.php';
    }

    public static function crear() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        // echo "<pre>";
        // print_r($_POST);exit;
        // Armar arreglo para guardar
        $data = [
            'titulo' => $_POST['titulo'],
            'nombre_portal' => $_POST['nombre_portal'],
            'descripcion_portal' => $_POST['descripcion_portal'],
            'duracion_dias' => $_POST['duracion_dias'],
            'veces_dia' => $_POST['veces_dia'],
            'precio_subida' => $_POST['precio_subida'],
            'precio_total' => $_POST['precio_total']
        ];

        PaqueteOpcion::crear($db->conn, $data);
        header('Location: '.BASE_URL.'paquetes/listar_opciones');
    }

    public static function editarForm($id) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $opcion = PaqueteOpcion::obtenerPorId($db->conn, $id);
        include 'app/views/admin/paquetes/editar_opciones.php';
    }

    public static function actualizar() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();

        $id = $_POST['id'];
        $data = [
            'titulo' => $_POST['titulo'],
            'nombre_portal' => $_POST['nombre_portal'],
            'descripcion_portal' => $_POST['descripcion_portal'],
            'duracion_dias' => $_POST['duracion_dias'],
            'veces_dia' => $_POST['veces_dia'],
            'precio_subida' => $_POST['precio_subida'],
            'precio_total' => $_POST['precio_total']
        ];

        PaqueteOpcion::actualizar($db->conn, $id, $data);
        header('Location: '.BASE_URL.'paquetes/listar_opciones');
    }

    public static function eliminar($id) {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        PaqueteOpcion::eliminar($db->conn, $id);
        header('Location:  '.BASE_URL.'paquetes/listar_opciones');
    }


    public function toggleActivoOP() {
        $db = new Database();
        $id = $_POST['id'];
        $activo = $_POST['activo'];

        $stmt = $db->conn->prepare("UPDATE paquetes_opciones SET activo = ? WHERE id = ?");
        $stmt->bind_param("ii", $activo, $id);
        $stmt->execute();

        echo json_encode(['success' => true]);
    }





}
?>