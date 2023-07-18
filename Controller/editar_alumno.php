<?php
require_once "../Model/alumnos.php";

if (isset($_POST["nombre"]) && isset($_POST["apellidos"])) {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $idAlumno = $_POST["id_alumno"];

    // Aquí puedes realizar la lógica para actualizar los datos del alumno en la base de datos

    // Ejemplo de actualización de datos
    $alumno = Alumnos::EditarAlumno($idAlumno,$nombre,$apellidos);
}


    include_once '../Controller/ControllerAlumnos.php';

   
?>
