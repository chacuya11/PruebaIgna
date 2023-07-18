<?php
require_once("redk.php");

class Asignatura
{
    private $id;
    private $nombre;
    private $descripcion;

    public function __construct($nombre, $descripcion)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
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

    // Getter y Setter para el nombre
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    // Getter y Setter para la descripción
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    // Método para insertar una nueva asignatura en la base de datos
    public function insertar()
    {
        $db = redk::connectDB();

        $nombre = $db->escape_string($this->nombre);
        $descripcion = $db->escape_string($this->descripcion);

        $query = "INSERT INTO asignaturas (nombre, descripcion) VALUES ('$nombre', '$descripcion')";

        if ($db->query($query)) {
            $this->id = $db->insert_id;
            return true;
        } else {
            return false;
        }
    }

    public static function obtenerIdPorNombre($nombre)
{
    $db = redk::connectDB();

    $query = "SELECT id FROM asignaturas WHERE nombre = :nombre";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['id'];
    } else {
        return null;
    }
}

    public static function obtenerAsignaturas()
    {
        $db = redk::connectDB();
    
        $query = "SELECT * FROM asignaturas";
        $result = $db->query($query);
    
        $asignaturas = [];
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $asignatura = new Asignatura($row['nombre'], $row['descripcion']);
            $asignatura->setId($row['id']);
            $asignaturas[] = $asignatura;
        }
    
        return $asignaturas;
    }
    
    

}


