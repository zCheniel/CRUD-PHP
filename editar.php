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
        <h1 class="text-center m-4">ROJITO PDVSA</h1>
    </div>

    <?php
        if(!isset($_GET['id_pozo'])){
            header('Location: index.php?mensaje=error');
            exit();
        }

        include_once 'conexion.php';
        $id_pozo = $_GET['id_pozo'];

        $sentencia = $bd->prepare("select * from pozo where id_pozo = ?;");
        $sentencia->execute([$id_pozo]);
        $pozo = $sentencia->fetch(PDO::FETCH_OBJ);
       // print_r($pozo);
    ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                 Cambia el nombre del Pozo:
                </div> 

                <form action="editarProceso.php" class="p-4" method="POST">
                    <div class="mb-3">
                        
                        <input type="text" name="txtpozo" class="form-control" require value="<?php echo $pozo->nombre;?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_pozo" value="<?php echo $pozo->id_pozo;?>">
                        <input type="submit" class="btn btn-success" value="Editar">
                    </div>
                </form>
         </div>

            </div>
        </div>

    </div>
    



    <footer class="contairner-fluid fixed-bottom">
        <div class="row-2">
            <div class="col-md text-light text-center py-3">
                 <button class="btn-2" type="submit" onClick="document.location.href='index.php'"> Volver</button>
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