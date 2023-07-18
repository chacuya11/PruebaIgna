<?php
require_once("redk.php");

class Expediente
{
    private $id;
    private $id_alumno;
    private $id_asignatura;
    private $nota;
    private $comentarios;

    public function __construct($id_alumno, $id_asignatura, $nota, $comentarios)
    {
        $this->id_alumno = $id_alumno;
        $this->id_asignatura = $id_asignatura;
        $this->nota = $nota;
        $this->comentarios = $comentarios;
    }

    // Getter y Setter para el ID
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter y Setter para el ID del alumno
    public function getIdAlumno()
    {
        return $this->id_alumno;
    }

    public function setIdAlumno($id_alumno)
    {
        $this->id_alumno = $id_alumno;
    }

    // Getter y Setter para el ID de la asignatura
    public function getIdAsignatura()
    {
        return $this->id_asignatura;
    }

    public function setIdAsignatura($id_asignatura)
    {
        $this->id_asignatura = $id_asignatura;
    }

    // Getter y Setter para la nota
    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    // Getter y Setter para los comentarios
    public function getComentarios()
    {
        return $this->comentarios;
    }

    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }

    public static function obtenerNotaComentario($idAlumno, $idAsignatura)
{
    $db = redk::connectDB();

    $query = "SELECT nota, comentarios FROM expedientes WHERE id_alumno = :idAlumno AND id_asignatura = :idAsignatura";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':idAlumno', $idAlumno);
    $stmt->bindParam(':idAsignatura', $idAsignatura);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return [
            'nota' => $result['nota'],
            'comentarios' => $result['comentarios']
        ];
    } else {
        return null;
    }
}

public static function obtenerIdExpediente($idAsignatura, $idUsuario)
{
    $db = redk::connectDB();

    $query = "SELECT id FROM expedientes WHERE id_asignatura = :idAsignatura AND id_alumno = :idUsuario";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':idAsignatura', $idAsignatura);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['id'];
    } else {
        return null;
    }
}

public static function editarNotaComentario($idExpediente, $nota, $comentarios)
{
    $db = redk::connectDB();

    $query = "UPDATE expedientes SET nota = :nota, comentarios = :comentarios WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nota', $nota);
    $stmt->bindParam(':comentarios', $comentarios);
    $stmt->bindParam(':id', $idExpediente);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}



public static function editarExpediente($idExpediente, $nota, $comentarios)
{
    $db = redk::connectDB();

    $query = "UPDATE expedientes SET nota = :nota, comentarios = :comentarios WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nota', $nota);
    $stmt->bindParam(':comentarios', $comentarios);
    $stmt->bindParam(':id', $idExpediente);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

    public static function verificarInscripcion($idAlumno, $idAsignatura)
    {
        $db = redk::connectDB();
    
        $idAlumno = $db->quote($idAlumno);
        $idAsignatura = $db->quote($idAsignatura);
    
        $query = "SELECT COUNT(*) FROM expedientes WHERE id_alumno = $idAlumno AND id_asignatura = $idAsignatura";
    
        $result = $db->query($query);
        $count = $result->fetchColumn();
    
        return $count > 0;
    }
    


    public static function insertarExpediente($idAlumno, $idAsignatura, $nota, $comentarios)
    {
        $db = redk::connectDB();
    
        $query = "INSERT INTO expedientes (id_alumno, id_asignatura, nota, comentarios) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(1, $idAlumno);
        $stmt->bindParam(2, $idAsignatura);
        $stmt->bindParam(3, $nota);
        $stmt->bindParam(4, $comentarios);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Método para eliminar un expediente de la base de datos por una id
    public static function eliminarPorId($id)
    {
        $db = redk::connectDB();
    
        $query = "DELETE FROM expedientes WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
    
}




