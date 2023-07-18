<?php
require_once '../Model/alumnos.php';
require_once '../Model/asignatura.php';
require_once '../Model/redk.php';

$Alumnos = Alumnos::obtenerAlumnos();
$asignaturas = Asignatura::obtenerAsignaturas();

$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : ''; // esto sirve para cargar el controller con algun error de agregar 

include_once '../View/VistaAlumnos.php';
?>
