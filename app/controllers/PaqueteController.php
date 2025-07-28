<?php
require_once 'app/core/Database.php';
require_once 'app/models/Paquete.php';
require_once 'app/models/PaqueteOpcion.php';
include APP_ROOT . '/app/core/globales.inc.php';

class PaqueteController {


    public function listarPaquetes() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $paquetes = Paquete::obtenerTodos($db->conn);
        include 'app/views/admin/paquetes.php';
    }

    public function formularioCrear() {
        Session::esAdmin() or die("Acceso denegado");
        $db = new Database();
        $includes = PaqueteOpcion::obtenerTodos($db->conn);
        include 'app/views/admin/paquetes/crear.php';
    }


    public static function crearPaquete() {
        // echo "<pre>";
        // print_r($_POST);
        $db = new Database();
        // Procesar imagen
        $imageName = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['imagen']['tmp_name'];
            $originalName = basename($_FILES['imagen']['name']);
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $imageName = uniqid('img_') . '.' . strtolower($extension);
            $uploadDir = __DIR__ . '/../../public/uploads/paquetes/';
            move_uploaded_file($tmpName, $uploadDir . $imageName);
        }
        $es_personalizado = isset($_POST['es_personalizado']) ? 1 : 0;
        //print_r($es_personalizado);exit;
        // Armar arreglo para guardar
        $data = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'imagen' => $imageName,
            'mensaje_accion' => $_POST['mensaje_accion'],
            'precio' => $_POST['precio'],
            'cantidad_publicaciones' => $_POST['cantidad_publicaciones'],
            'duracion_dias' => $_POST['duracion_dias'],
            'frecuencia' => $_POST['frecuencia'],
            'es_personalizado' => $es_personalizado,
            'includes' => $_POST['includes']
        ];
        //print_r($data);exit;
        Paquete::crear($db->conn, $data);
        header('Location: '.BASE_URL.'admin/paquetes');
        exit;
    }


    public static function formularioEditar($paqueteId) {
        Session::esAdmin() or die("Acceso denegado");
        //print_r($paqueteId);exit;
        $db = new Database();
        $paquete = Paquete::obtenerPorId($db->conn, $paqueteId);
        $includes =  PaqueteOpcion::obtenerTodos($db->conn);
        //print_r($includes);exit;
        include 'app/views/admin/paquetes/editar.php';
    }

    public static function actualizar() {
        $db = new Database();
        // Obtener ID
        $id = $_POST['id'];
        // print_r($_POST);
        // echo "<br>";
        // Procesar nueva imagen si se sube una
        $imagen = $_POST['imagen_actual'] ?? null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['imagen']['tmp_name'];
            $originalName = basename($_FILES['imagen']['name']);
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $imageName = uniqid('img_') . '.' . strtolower($extension);
            $uploadDir = __DIR__ . '/../../public/uploads/paquetes/';
            move_uploaded_file($tmpName, $uploadDir . $imageName);
            $imagen = $imageName;
        }

        $es_personalizado = isset($_POST['es_personalizado']) ? 1 : 0;
        //print_r($es_personalizado);exit;
        $data = [
            'id' => $id,
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'imagen' => $imagen,
            'precio' => floatval($_POST['precio']),
            'duracion_dias' => intval($_POST['duracion_dias']),
            'mensaje_accion' => $_POST['mensaje_accion'],
            'es_personalizado' => $_POST['es_personalizado'],
            'frecuencia' => $_POST['frecuencia'],
            'cantidad_publicaciones' => intval($_POST['cantidad_publicaciones']),
            'includes' => $_POST['includes']
        ];
        
        Paquete::actualizar($db->conn, $id, $data);
        header('Location: '.BASE_URL.'admin/paquetes');
        exit;
    }



    public function toggleActivo() {
        $db = new Database();
        $id = $_POST['id'];
        $activo = $_POST['activo'];

        $stmt = $db->conn->prepare("UPDATE paquetes SET activo = ? WHERE id = ?");
        $stmt->bind_param("ii", $activo, $id);
        $stmt->execute();

        echo json_encode(['success' => true]);
    }











    public function crear() {
        $db = new Database();
        $datos = json_decode(file_get_contents("php://input"), true);

        if (Paquete::crear($db->conn, $datos)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear paquete.']);
        }
    }

    public function editar() {
        $db = new Database();
        $datos = json_decode(file_get_contents("php://input"), true);

        if (Paquete::actualizar($db->conn, $datos)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar paquete.']);
        }
    }

    public function eliminar() {
        $db = new Database();
        $datos = json_decode(file_get_contents("php://input"), true);

        if (Paquete::eliminar($db->conn, $datos['id'])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar paquete.']);
        }
    }
}
?>
