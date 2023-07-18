<?php
    require_once '../Model/alumnos.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_alumno'])) {

    $id_alumno = $_GET['id_alumno']; //recoge la id


    if (Alumnos::eliminar($id_alumno)) {

        $mensaje = urlencode("Alumno borrado correctamente");
        header("Location: ../Controller/ControllerAlumnos.php?mensaje=$mensaje");
        exit;
    } else {
        $mensaje = urlencode("Alumno no borrado correctamente");
        header("Location: ../Controller/ControllerAlumnos.php?mensaje=$mensaje");
        exit;
    }
} else {
    //por si se llega de forma erronea te envia de nuevo a la pagina de alumnos
    header("Location: ../Controller/ControllerAlumnos.php");
    exit;
}
