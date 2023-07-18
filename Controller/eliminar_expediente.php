<?php
    require_once '../Model/expediente.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_expediente'])) {

    $id_expediente = $_GET['id_expediente']; //recoge la id


    if (Expediente::eliminarPorId($id_expediente)) {

        $mensaje = urlencode("Expediente borrado correctamente");
        header("Location: ../Controller/ControllerAlumnos.php?mensaje=$mensaje");
        exit;
    } else {
        $mensaje = urlencode("Expediente no borrado correctamente");
        header("Location: ../Controller/ControllerAlumnos.php?mensaje=$mensaje");
        exit;
    }
} else {
    //por si se llega de forma erronea te envia de nuevo a la pagina de alumnos
    header("Location: ../Controller/ControllerAlumnos.php");
    exit;
}
