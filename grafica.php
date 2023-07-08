<?php
  if((array_key_exists("start",$_POST)&&array_key_exists("end",$_POST)) || array_key_exists("date",$_GET)){
    $start = $_POST['start']??$_GET['date'];
    $end = $_POST['end']??$_GET['date'];
    include_once "conexion.php";
    $sentencia = $bd -> query("select * from medicion M INNER JOIN pozo P ON P.id_pozo=M.pozo_id WHERE P.id_pozo=".$_GET['id_pozo']." AND M.fecha BETWEEN '$start' AND '$end'");
    $medicion = $sentencia -> fetchAll(PDO::FETCH_OBJ);
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="styles/index.css">
<link rel="stylesheet" href="styles/login.css">
<title>CRUD</title>
</head>
<body>
    <div class="container-fluid">
       <h1 class="text-center m-5">GRAFICA DEL POZO</h1>
    </div>

    <h4 style="text-align: center;">Ingrese la de fecha y hora:</h4>
    <form method="POST" style="margin-left:33%; margin-top:2%; margin-bottom:2%; " action="grafica.php?id_pozo=<?php echo $_GET['id_pozo'] ?>">
      <input step="any" type="datetime-local" name="start" value="<?php echo array_key_exists("start",$_POST)?$_POST['start']:(array_key_exists("date",$_GET)?$_GET['date']:"") ?>">
      <input step="any" type="datetime-local" name="end" value="<?php echo array_key_exists("end",$_POST)?$_POST['end']:(array_key_exists("date",$_GET)?$_GET['date']:"") ?>">
      <!-- <input type="date" name="start" value="<?php echo array_key_exists("start",$_POST)?$_POST['start']:(array_key_exists("date",$_GET)?explode(" ", $_GET['date'])[0]:"") ?>">
      <input type="date" name="end" value="<?php echo array_key_exists("end",$_POST)?$_POST['end']:(array_key_exists("date",$_GET)?explode(" ", $_GET['date'])[0]:"") ?>"> -->
      <input type="submit" class="btn"  name="btn">
    </form>
    <canvas id="grafica" style="margin-bottom:100px;"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>  
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
  
(async () => {
    // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
    const medicion = <?php echo json_encode($medicion) ?>;
    console.log('medicion: ', medicion);
    // Decodificar como JSON
    const respuesta = {
      etiquetas: medicion.map(({psi}, index) => index),
      datos: medicion.map(({psi}) => psi)
    };
    // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
    // Obtener una referencia al elemento canvas del DOM
    const $grafica = document.querySelector("#grafica");
    const etiquetas = respuesta.etiquetas; // <- Aquí estamos pasando el valor traído usando AJAX
    // Podemos tener varios conjuntos de datos. Comencemos con uno
    const datosVentas2020 = {
        label: "PSI",
        // Pasar los datos igualmente desde PHP
        data: respuesta.datos, // <- Aquí estamos pasando el valor traído usando AJAX
        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
        borderWidth: 1, // Ancho del borde
    };
    new Chart($grafica, {
        type: 'line', // Tipo de gráfica
        data: {
            labels: etiquetas,
            datasets: [
                datosVentas2020,
                // Aquí más datos...
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
})();
</script>
<footer class="contairner-fluid fixed-bottom">
        <div class="row-2">
            <div class="col-md text-light text-center py-3">
                 <button class="btn-2" type="submit" onClick="document.location.href='index.php'"> Volver</button>
            </div>
        </div>
    </footer>
</body>
</html>