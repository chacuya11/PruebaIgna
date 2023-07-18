<?php
require_once '../Model/redk.php';
require_once '../Model/Expediente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idAlumno = $_POST['selectAlumnoAsignatura'];
    $idAsignatura = $_POST['selectAsignatura'];
    $nota = $_POST['inputNota'];
    $comentario = $_POST['inputComentario'];


    
    if (Expediente::verificarInscripcion($idAlumno, $idAsignatura)) {
        $mensaje = urlencode("El alumno ya está inscrito en esta asignatura.");
        header("Location: ../Controller/Controlleralumnos.php?mensaje=$mensaje");
        exit;
    } else {
        if (Expediente::insertarExpediente($idAlumno, $idAsignatura, $nota, $comentario)) {
            $mensaje = urlencode("Insertado correctamente.");
            header("Location: ../Controller/Controlleralumnos.php?mensaje=$mensaje");
            exit;
        } else {
            echo "Error";
        }
    }
    



}
?>