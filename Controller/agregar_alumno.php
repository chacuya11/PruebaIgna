<?php
require_once '../Model/alumnos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];

    if (Alumnos::insertar($nombre, $apellidos)) {
        $mensaje = urlencode("Alumno agregado correctamente.");
        header("Location: ../Controller/ControllerAlumnos.php?mensaje=$mensaje");
        exit;
    } else {
        $mensaje = urlencode("Alumno no insertado, error..");
        header("Location: ../Controller/ControllerAlumnos.php?mensaje=$mensaje");
        exit;
    }
}
?>
