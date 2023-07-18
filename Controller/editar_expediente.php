<?php
require_once '../Model/expediente.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nota = $_POST['nota'];
    $comentarios = $_POST['comentarios'];
    $idAlumno = $_POST['id_alumno'];
    $idAsignatura = $_POST['id_asignatura'];
 
    $idExp = Expediente::obtenerIdExpediente($idAsignatura,$idAlumno);

    Expediente::editarNotaComentario($idExp, $nota, $comentarios);

    header("Location: ../Controller/ControllerExpediente.php?id_alumno=".$idAlumno);
    exit();
 
}
?>
