<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>

    <link rel="stylesheet" href="../build/css/bootstrap.css">   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

</head>


<?php
require_once '../Model/alumnos.php';
require_once '../Model/telefono.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
     ?>
<script>
    //coge el mensaje enviado desde agregar por si hay algun error
    document.addEventListener("DOMContentLoaded", function() {

        const urlParams = new URLSearchParams(window.location.search);
        const mensaje = urlParams.get("mensaje");

  
        if (mensaje) {
            alert(mensaje);
        }
    });
</script>



<header class=" hero bg-dark d-flex justify-content-around align-items-center">
        <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"> <i class="bi bi-list-task text-white fs-2"></i></button>
        <p class="text-white fs-2 d-none d-lg-block"><span>Redk</span> PruebaTecnica
        <p>
        <div class="dropdown my-2 d-flex justify-content-center align-items-center">
            <button class="btn btn-secondary dropdown-toggle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle text-white me-2 "></i> IGNACIO ZAMUDIO PELÁEZ
            </button>
        </div>
    </header>
    <!--  ASIDE-->
    <div class="offcanvas offcanvas-start bg-dark text-white" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header d-flex justify-content-center">
            <h2 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Navegación</h2>
            <button type="button" class="btn btn-dark text-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="offcanvas-body ">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="../Controller/ControllerAlumnos.php" class="nav-link text-white active">
                        <i class="bi bi-person-bounding-box"></i> Alumnos
                    </a>
                </li>
                <li>
                    <a href="../Controller/ControllerAsignaturas.php" class="nav-link text-white">
                        <i class="bi bi-basket"></i> Asignaturas
                    </a>
                </li>
                <li>
                    <a href="../View/Prueba2.php" class="nav-link text-white">
                    <i class="bi bi-chat-right-dots"></i> Prueba 2 Formulario
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <section class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-3">
            <button class="btn btn-primary btn-block h-100" data-bs-toggle="modal" data-bs-target="#modalAgregarTelefono">
                <i class="bi bi-phone fs-2"></i>
                <h3 class="pt-2 text-dark">Agregar Teléfono</h3>
            </button>
        </div>
        <div class="col-md-4 mb-3">
            <button class="btn btn-primary btn-block h-100" data-bs-toggle="modal" data-bs-target="#modalAgregarAlumno">
                <i class="bi bi-person-plus fs-2"></i>
                <h3 class="pt-2 text-dark">Agregar Alumno</h3>
            </button>
        </div>
        <div class="col-md-4 mb-3">
            <button class="btn btn-primary btn-block btn-lg h-100" data-bs-toggle="modal" data-bs-target="#modalAgregarAsignatura">
                <i class="bi bi-book fs-2"></i>
                <h3 class="pt-2 text-dark">Agregar Asignatura</h3>
            </button>
        </div>
    </div>
</section>







<div class="container">
<div class="row alumnos-container">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h2 class="mt-5">Alumnos</h2>
        <table class="table table-bordered table-striped">
        <thead class="thead-dark">
    <tr class="text-center">
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Asignaturas</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Alumnos as $alumno) : ?>
                    <tr>
                        <td class="text-center"><?= $alumno->getNombre() ?></td>
                        <td class="text-center"><?= $alumno->getApellidos() ?></td>
                        <td class="text-center">
                            <?php
                            $asignaturasInscritas = alumnos::obtenerAsignaturasInscritas($alumno->getId());
                            foreach ($asignaturasInscritas as $asignatura) {
                                echo $asignatura->getNombre() . '<br>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            $telefonos = Telefono::obtenerTelefonosDeAlumno($alumno->getId());
                            foreach ($telefonos as $telefono) : ?>
                                <div class="d-flex justify-content-center align-items-center">
                                    <span><?= $telefono ?></span>
                                    <div class="ms-1 mt-1">
                                        <button class="btn btn-danger btn-sm" onclick="eliminarTelefono(<?= $alumno->getId() ?>, '<?= $telefono ?>')">Borrar</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                         </td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-editar" data-bs-toggle="modal" data-bs-target="#modalEditar"
                                data-id="<?= $alumno->getId() ?>"
                                data-nombre="<?= $alumno->getNombre() ?>"
                                data-apellidos="<?= $alumno->getApellidos() ?>">
                                Editar Alumno
                            </button>
                            <a href="../Controller/ControllerExpediente.php?id_alumno=<?= $alumno->getId() ?>" class="btn btn-primary btn-ver-expediente">Ver Expediente</a>
                            <a href="../Controller/eliminar_alumno.php?id_alumno=<?= $alumno->getId() ?>" class="btn btn-danger btn-borrar">Borrar Alumno</a>
                        </td>
                        
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<div class="modal fade" id="modalAgregarAsignatura" tabindex="-1" aria-labelledby="modalAgregarAsignaturaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarAsignaturaLabel">Agregar Nueva Asignatura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="agregar_asignatura.php" method="POST">
          <div class="mb-3">
            <label for="selectAlumnoAsignatura" class="form-label">Alumno:</label>
            <select class="form-select" id="selectAlumnoAsignatura" name="selectAlumnoAsignatura" required>
              <?php foreach ($Alumnos as $alumno) : ?>
                <option value="<?php echo $alumno->getId(); ?>"><?php echo $alumno->getNombre() . ' ' . $alumno->getApellidos(); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="selectAsignatura" class="form-label">Asignatura:</label>
            <select class="form-select" id="selectAsignatura" name="selectAsignatura" required>
              <?php foreach ($asignaturas as $asignatura) : ?>
                <option value="<?php echo $asignatura->getId(); ?>"><?php echo $asignatura->getNombre(); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="inputNota" class="form-label">Nota:</label>
            <input type="number" class="form-control" id="inputNota" name="inputNota" required>
          </div>
          <div class="mb-3">
            <label for="inputComentario" class="form-label">Comentario:</label>
            <textarea class="form-control" id="inputComentario" name="inputComentario" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="modalAgregarTelefono" tabindex="-1" aria-labelledby="modalAgregarTelefonoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarTelefonoLabel">Agregar Nuevo Teléfono</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- no meto validacion de numeros de telefono, para dejarlo un poco libre a diferentes paises, solo he puesto 9 digitos -->
        <form action="agregar_telefono.php" method="POST">
          <div class="mb-3">
            <label for="selectAlumno" class="form-label">Alumno:</label>
            <select class="form-select" id="selectAlumno" name="alumno_id" required>
              <?php foreach ($Alumnos as $alumno) : ?>
                <option value="<?php echo $alumno->getId(); ?>"><?php echo $alumno->getNombre() . ' ' . $alumno->getApellidos(); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
          <label for="inputTelefono" class="form-label">Teléfono:</label>
    <input type="text" class="form-control" id="inputTelefono" name="telefono" pattern="[0-9]{9}" required>
    <small class="form-text text-muted">El número solo admite 9 digitos.</small>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="editar_alumno.php" method="POST">
                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="inputNombre" name="nombre" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputApellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="inputApellidos" name="apellidos" value="" required>
                    </div>
                    <input type="hidden" id="inputIdAlumno" name="id_alumno">

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAgregarAlumno" tabindex="-1" aria-labelledby="modalAgregarAlumnoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarAlumnoLabel">Agregar Nuevo Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../Controller/agregar_alumno.php" method="POST">
                    <div class="mb-3">
                        <label for="inputNombreAlumno" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="inputNombreAlumno" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputApellidosAlumno" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="inputApellidosAlumno" name="apellidos" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Alumno</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    function eliminarTelefono(idAlumno, telefono) {
        if (confirm('¿Seguro que quieres borrar el teléfono de este alumno?')) {
            window.location.href = '../Controller/eliminar_telefono.php?telefono=' + telefono;
        }
    }
</script>

<script>
    // Script para recuperar datos del formulario y meterlos en el modal
    document.addEventListener("DOMContentLoaded", function () {
        
        var btnEditar = document.querySelectorAll(".btn-editar");

      
        var inputNombre = document.getElementById("inputNombre");
        var inputApellidos = document.getElementById("inputApellidos");

       
        btnEditar.forEach(function (btn) {
            btn.addEventListener("click", function () {
                
                var id = this.getAttribute("data-id");
                var nombre = this.getAttribute("data-nombre");
                var apellidos = this.getAttribute("data-apellidos");
                inputNombre.value = nombre;
                inputApellidos.value = apellidos;
            });
        });
        document.getElementById("formEditarAlumno").addEventListener("submit", function () {
            document.getElementById("nombre").value = inputNombre.value;
            document.getElementById("apellidos").value = inputApellidos.value;
        });
    });
    var modalEditar = document.getElementById('modalEditar');
    modalEditar.addEventListener('show.bs.modal', function(event) {
        // Obtener el botón que activó el modal
        var botonEditar = event.relatedTarget;

        // Obtener la ID del alumno desde el atributo data-id
        var idAlumno = botonEditar.getAttribute('data-id');

        // Asignar la ID del alumno al campo oculto
        var inputIdAlumno = modalEditar.querySelector('#inputIdAlumno');
        inputIdAlumno.value = idAlumno;
    });
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>