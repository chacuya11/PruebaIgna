<?php
require_once '../Model/alumnos.php';
require_once '../Model/telefono.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['telefono'])) {
    $telefono = $_GET['telefono'];

    if (telefono::eliminarPorTelefono($telefono)) {
        $mensaje = 'El número de teléfono '.$telefono.' ha sido eliminado correctamente.'; //los mensajes no los va mostrar porque redirije, pero dejo la estructura por posible cambios.
    } else {
        $mensaje = 'Error al eliminar el número de teléfono.';
    }
} else {
    $mensaje = 'Número de teléfono no especificado.';
}

include_once '../Controller/ControllerAlumnos.php';
?>

