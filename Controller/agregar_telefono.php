<?php
require_once '../Model/alumnos.php';
require_once '../Model/telefono.php';

if (isset($_POST['telefono']) && isset($_POST['alumno_id'])) {
    $telefono = $_POST['telefono'];
    $alumno_id = $_POST['alumno_id'];

    telefono::agregarTelefono($alumno_id,$telefono);

}

include_once '../Controller/ControllerAlumnos.php';
?>
