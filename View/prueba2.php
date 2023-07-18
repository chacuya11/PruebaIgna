<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba2</title>

    <link rel="stylesheet" href="../build/css/bootstrap.css">   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    

</head>




<header class=" hero bg-dark d-flex justify-content-around align-items-center">
        <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"> <i class="bi bi-list-task text-white fs-2"></i></button>
        <p class="text-white fs-2 d-none d-lg-block"><span>Redk</span> PruebaTecnica 2
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
                    <a href="../Controller/ControllerAsignaturas.php" class="nav-link text-white">
                        <i class="bi bi-basket"></i> Asignaturas
                    </a>
                </li>
                <li>
                    <a href="../View/Prueba2.php" class="nav-link text-white active">
                    <i class="bi bi-chat-right-dots"></i> Prueba 2 Formulario
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <div class="container mt-5">
        <h2 class="mb-4">Formulario Prueba 2</h2>
        <div class="form-group">
            <label for="texto">Introduce tu texto, solo letras a-z</label>
            <input type="text" class="form-control" id="texto">
        </div>
        <div class="form-group mt-3">
            <label for="ArrayNumeros">Array de numeros</label>
            <div class="form-control" id="ArrayNumeros"></div>
        </div>
    </div>

    <script>

        const texto = document.getElementById('texto');
        const ArrayNumeros = document.getElementById('ArrayNumeros');

        texto.addEventListener('input', function () {

            const text = this.value.toLowerCase(); // la hace siempre minuscula
            console.log(text);
            let numerocompleto = '';
            for (let i = 0; i < text.length; i++) {
                
                const charCode = text.charCodeAt(i) - 96; //hay que quitarle 96 siempre para que llegue a su respectiva posicion
               

                if (charCode >= 1 && charCode <= 26) {
                    numerocompleto += charCode.toString();
                }
            }
            ArrayNumeros.innerText = numerocompleto;

            // revisa si el numero es par o impar sacando el resto, y aplica un estilo, si pasa de ciertos numeros ya no funciona en javascript
            if (numerocompleto % 2 == 0) {
                ArrayNumeros.style.background = "green";
                
            }else{
                ArrayNumeros.style.background = "red";
            }

        });

        texto.addEventListener('keypress', function (event) { // funcion que tenia en un ejercicio de cuando di clases, no permite meter ningun tipo de caracter que no sea letra
            const charCode = event.which ? event.which : event.keyCode;
            if ((charCode < 97 || charCode > 122) && (charCode < 65 || charCode > 90)) {
                event.preventDefault();
            }
        });
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>