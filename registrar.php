<!-- Validacion del lado del servidor -->
<?php
    //print_r($_POST);
    
    if(empty($_POST["oculto"]) || empty($_POST["txtpozo"])){
        header('Location: index.php?mensaje=falta');
        exit();
    }

    include_once 'conexion.php';
    $nombre = $_POST["txtpozo"];

    $sentencia = $bd->prepare("INSERT INTO pozo(nombre) VALUES(?);");
    $resultado = $sentencia->execute([$nombre]);

    if ($resultado) {
        echo "<script>window.location.href='index.php?mensaje=registrado';</script>";
    } else {
        echo "<script>window.location.href='index.php?mensaje=error';</script>";
        exit();
    }
    
?>