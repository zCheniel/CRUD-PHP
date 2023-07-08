<!-- Validacion del lado del servidor -->
<?php
    //print_r($_POST);
    
    if(empty($_POST["oculto"]) || empty($_POST["medicion"])){
        header('Location: agregar.php?mensaje=falta');
        exit();
    }

    include_once 'conexion.php';
    $medicion = $_POST["medicion"];
    $pozo_id = $_POST["pozo_id"];

    $sentencia = $bd->prepare("INSERT INTO medicion(psi,pozo_id) VALUES(?,?);");
    $resultado = $sentencia->execute([$medicion,$pozo_id]);

    if ($resultado) {
        echo "<script>window.location.href='agregar.php?mensaje=registrado&id_pozo=$pozo_id';</script>";
    } else {
        echo "<script>window.location.href='agregar.php?mensaje=error&id_pozo=$pozo_id';</script>";
        exit();
    }
    
?>