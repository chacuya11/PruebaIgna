<?php
require_once '../Model/Alumnos.php';
require_once '../Model/Asignatura.php';
require_once '../Model/Expediente.php';

    $idAlumno = $_GET['id_alumno'];
    
    $alumno = Alumnos::obtenerNombreApellidosPorId($idAlumno);
    $asignaturasInscritas = alumnos::obtenerAsignaturasInscritas($idAlumno);

    include_once '../View/VistaExpediente.php';
