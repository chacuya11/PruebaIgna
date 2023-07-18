<?php
// Incluir los archivos necesarios de TCPDF
require_once '../Model/redk.php';
require_once '../Model/Expediente.php';
require_once '../Model/alumnos.php';
require_once '../Model/asignatura.php';
require('../fpfd/fpdf.php');

$id_alumno = $_GET["id_alumno"];

$alumno = Alumnos::obtenerNombreApellidosPorId($id_alumno);
$asignaturasInscritas = alumnos::obtenerAsignaturasInscritas($id_alumno);



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);


// 1º Datos del alumno
$texto1="Alumno: ".$alumno["nombre"] . " " . $alumno["apellidos"];
$pdf->SetXY(50, 20);
$pdf->MultiCell(120,10,$texto1,1,"L");



// 3º Una tabla con los articulos comprados

// La cabecera de la tabla (en azulito sobre fondo rojo)
$pdf->SetXY(30, 50);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(0,255,255);
$pdf->Cell(70,10,"Asignatura",1,0,"C",true);
$pdf->Cell(35,10,"Nota.",1,0,"C",true);
$pdf->Cell(50,10,"Comentario",1,0,"C",true);

// Los datos (en negro)
$pdf->SetTextColor(0,0,0);

$y = 60; // Coordenada Y inicial

foreach ($asignaturasInscritas as $asignatura){
    $idAsignatura = Asignatura::obtenerIdPorNombre($asignatura->getNombre());
    $infoNotaComentario = Expediente::obtenerNotaComentario($id_alumno, $idAsignatura);
    $pdf->SetXY(30, $y);
    $pdf->Cell(70,10,$asignatura->getNombre(),1,0,"L");
    $pdf->Cell(35,10,$infoNotaComentario['nota'],1,0,"C");
    $pdf->Cell(50,10,$infoNotaComentario['comentarios'],1,0,"C");

    $y += 10; // Incrementar la coordenada Y para la siguiente fila
}




// El documento enviado al navegador
$pdf->Output();



?>