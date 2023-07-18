<?php
require_once("redk.php");


class Telefono
{
    private $id;
    private $id_alumno;
    private $telefono;

    public function __construct($id_alumno, $telefono)
    {
        $this->id_alumno = $id_alumno;
        $this->telefono = $telefono;
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

    // Getter y Setter para el teléfono
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    // Método para insertar un nuevo teléfono en la base de datos
    public static function agregarTelefono($id_alumno, $telefono)
    {
        $db = redk::connectDB();
    
        $id_alumno = $db->quote($id_alumno);
        $telefono = $db->quote($telefono);
    
        $query = "INSERT INTO telefonos (id_alumno, telefono) VALUES ($id_alumno, $telefono)";
    
        if ($db->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    // Método para eliminar un teléfono de la base de datos
    public function eliminar()
    {
        $db = redk::connectDB();

        $query = "DELETE FROM telefonos WHERE id = $this->id";

        if ($db->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public static function eliminarPorTelefono($telefono)
{
    $db = redk::connectDB();

    // Escapar el valor del teléfono para evitar inyección de SQL
    $telefono = $db->quote($telefono);

    $query = "DELETE FROM telefonos WHERE telefono = $telefono";

    if ($db->query($query)) {
        return true;
    } else {
        return false;
    }
}

    public static function obtenerTelefonosDeAlumno($idAlumno)
    {
        $db = redk::connectDB();

    $query = "SELECT telefono FROM telefonos WHERE id_alumno = :idAlumno";
    $statement = $db->prepare($query);
    $statement->bindParam(':idAlumno', $idAlumno);
    $statement->execute();

    $telefonos = $statement->fetchAll(PDO::FETCH_COLUMN); // sin el fetch da error al hacer la consulta

    return $telefonos;
    }
    

}
