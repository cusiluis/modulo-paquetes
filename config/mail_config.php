<?php
function enviarCorreoActivacion($email, $token) {
    $url = "http://tusitio.com/index.php?r=activar&token=" . urlencode($token);
    $asunto = "Activa tu cuenta";
    $mensaje = "Gracias por registrarte. Haz clic aquí para activar tu cuenta:\n$url";
    $cabeceras = "From: noreply@tusitio.com";
    mail($email, $asunto, $mensaje, $cabeceras);
}
?>
