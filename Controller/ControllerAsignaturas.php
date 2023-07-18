<?php
require_once '../Model/asignatura.php';
require_once '../Model/redk.php';

$asignaturas=Asignatura::obtenerAsignaturas();

include_once '../View/VistaAsignaturas.php';
