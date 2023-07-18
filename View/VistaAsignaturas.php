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


<?php
require_once '../Model/asignatura.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>

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
                    <a href="../Controller/ControllerAlumnos.php" class="nav-link text-white ">
                        <i class="bi bi-person-bounding-box"></i> Alumnos
                    </a>
                </li>
                <li>
                    <a href="../Controller/ControllerAsignaturas.php" class="nav-link text-white active">
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


    <div class="row asignaturas-container">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h2 class="mt-5">Asignaturas(No editables)</h2>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asignaturas as $asignatura) : ?>
                    <tr>
                        <td class="text-center"><?= $asignatura->getNombre() ?></td>
                        <td class="text-center"><?= $asignatura->getDescripcion() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>