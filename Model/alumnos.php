<?php
require_once("redk.php");

class Alumnos
{
    private $id;
    private $nombre;
    private $apellidos;

    public function __construct($id, $nombre, $apellidos)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }


    public static function EditarAlumno($id, $nombre, $apellidos)
    {
        $db = redk::connectDB();
    
        $query = "UPDATE alumnos SET nombre = '$nombre', apellidos = '$apellidos' WHERE id = $id";
    
        if ($db->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    


    
    public static function obtenerAsignaturasInscritas($id)
    {
        $db = redk::connectDB();
    
        $query = "SELECT a.nombre, a.descripcion FROM asignaturas a
                  INNER JOIN expedientes e ON a.id = e.id_asignatura WHERE e.id_alumno = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        $asignaturas = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $asignatura = new Asignatura($row['nombre'], $row['descripcion']);
            $asignaturas[] = $asignatura;
        }
    
        return $asignaturas;
    }
    
    public static function obtenerNombreApellidosPorId($id)
{
    $db = redk::connectDB();

    $query = "SELECT nombre, apellidos FROM alumnos WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return null;
    }
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

    // Getter y Setter para los apellidos
    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    // Método para insertar un nuevo alumno en la base de datos
    public static function insertar($nombre, $apellidos)
    {
        $db = redk::connectDB();
    
        $query = "INSERT INTO alumnos (nombre, apellidos) VALUES (:nombre, :apellidos)";
        $stmt = $db->prepare($query);
    
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    

    // Método para eliminar un alumno de la base de datos
    public static function eliminar($id_alumno)
    {
        $db = redk::connectDB();

        $query = "DELETE FROM alumnos WHERE id = :id_alumno";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_alumno', $id_alumno, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function obtenerAlumnos()
    {
        $conexion = redk::connectDB();
        $seleccion = "SELECT * FROM alumnos";
        $consulta = $conexion->query($seleccion);
        $alumnos = [];
        while ($registro = $consulta->fetchObject()) {
            $alumnos[] = new Alumnos($registro->id, $registro->nombre, $registro->apellidos);
        }
        return $alumnos;
    }
    
}

