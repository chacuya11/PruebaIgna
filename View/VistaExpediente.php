<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>

    <link rel="stylesheet" href="../build/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

</head>

<body>

    <?php
    require_once '../Model/asignatura.php';
    require_once '../Model/expediente.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <header class=" hero bg-dark d-flex justify-content-around align-items-center">
        <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"></button>
        <p class="text-white fs-2 d-none d-lg-block"><span>Redk</span> PruebaTecnica</p>
        <div class="dropdown my-2 d-flex justify-content-center align-items-center">
            <button class="btn btn-secondary dropdown-toggle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle text-white me-2 "></i> IGNACIO ZAMUDIO PELÁEZ
            </button>
        </div>
    </header>

    <!--  ASIDE -->
    <div class="offcanvas offcanvas-start bg-dark text-white" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header d-flex justify-content-center">
            <h2 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Navegación</h2>
            <button type="button" class="btn btn-dark text-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="offcanvas-body">
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
            </ul>
        </div>
    </div>

    <div class="row Expediente-container">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <h2 class="mt-5"><?= $alumno["nombre"] . " " . $alumno["apellidos"]; ?></h2>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Asignatura</th>
                        <th>Nota</th>
                        <th>Comentario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($asignaturasInscritas as $asignatura) : ?>
                        <?php
                        $idAsignatura = Asignatura::obtenerIdPorNombre($asignatura->getNombre());
                        $infoNotaComentario = Expediente::obtenerNotaComentario($idAlumno, $idAsignatura);
                        ?>
                        <tr>
                            <td class="text-center"><?= $asignatura->getNombre() ?></td>
                            <td class="text-center"><?= $infoNotaComentario['nota'] ?></td>
                            <td class="text-center"><?= $infoNotaComentario['comentarios'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-editar-expediente" data-bs-toggle="modal" data-bs-target="#modalEditarExpediente"
                                    data-id-expediente="<?= $idExpediente ?>"
                                    data-id-alumno="<?= $idAlumno ?>"
                                    data-id-asignatura="<?= $idAsignatura ?>"
                                    data-nota="<?= $infoNotaComentario['nota'] ?>"
                                    data-comentarios="<?= $infoNotaComentario['comentarios'] ?>">
                                    Editar Expediente
                                </button>
                                <a href="../Controller/eliminar_expediente.php?id_expediente=<?= expediente::obtenerIdExpediente($idAsignatura,$idAlumno) ?>" class="btn btn-danger btn-borrar">Borrar Expediente</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <a href="../Controller/ControllerAlumnos.php" class="btn btn-primary m-1">Volver</a>
        <a href="../Controller/exportarPDF.php?id_alumno=<?= $idAlumno ?>" class="btn btn-primary m-1">GenerarPDF</a>

    </div>

    <!-- Modal para el expediente -->
    <div class="modal fade" id="modalEditarExpediente" tabindex="-1" aria-labelledby="modalEditarExpedienteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarExpedienteLabel">Editar Expediente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="editar_expediente.php" method="POST">
                        <div class="mb-3">
                            <label for="inputNota" class="form-label">Nota:</label>
                            <input type="text" class="form-control" id="inputNota" name="nota" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputComentarios" class="form-label">Comentarios:</label>
                            <textarea class="form-control" id="inputComentarios" name="comentarios" required></textarea>
                        </div>
                        <input type="hidden" id="inputIdAsignatura" name="id_asignatura" value="">
                        <input type="hidden" id="inputIdAlumno" name="id_alumno" value="">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalEditarExpediente = document.getElementById('modalEditarExpediente');

            modalEditarExpediente.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var idAsignatura = button.getAttribute('data-id-asignatura');
                var idAlumno = button.getAttribute('data-id-alumno');

                var inputIdAsignatura = modalEditarExpediente.querySelector('#inputIdAsignatura');
                var inputIdAlumno = modalEditarExpediente.querySelector('#inputIdAlumno');

                inputIdAsignatura.value = idAsignatura;
                inputIdAlumno.value = idAlumno;
            });
        });
    </script>

</body>

</html>
