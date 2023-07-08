<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="styles/index.css">
<title>CRUD</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <header class="py-3">
                    <img class="text-center" src="assets/1280px-PDV_S.A._logo.svg.png">
                </header>
            </div>
        </div>
    </div>

    <?php
        if(!isset($_GET['id_medicion'])){
            header('Location: agregar.php?mensaje=error');
            exit();
        }

        include_once 'conexion.php';
        $id_medicion = $_GET['id_medicion'];

        $sentencia = $bd->prepare("select * from medicion where id_medicion = ?;");
        $sentencia->execute([$id_medicion]);
        $medicion = $sentencia->fetch(PDO::FETCH_OBJ);
       //print_r($medicion);
    ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                 Edita el nombre del Pozo:
                </div> 

                <form action="editarProcesoMed.php?id_pozo=<?php echo $_GET['id_pozo']; ?>" class="p-4" method="POST">
                    <div class="mb-3">
                        <label  class="form-label">Medicion (psi):</label>
                        <input type="number" name="medicion" class="form-control" require value="<?php echo $medicion->psi;?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_medicion" value="<?php echo $medicion->id_medicion;?>">
                        <input type="submit" class="btn-2" value="Editar">
                    </div>
                </form>
         </div>

            </div>
        </div>

    </div>
    



    <footer class="contairner-fluid fixed-bottom">
        <div class="row-2">
            <div class="col-md text-light text-center py-3">
                 <button class="btn-2" type="submit" onClick="document.location.href='agregar.php'"> Volver</button>
            </div>
        </div>
    </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>