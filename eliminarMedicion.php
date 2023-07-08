<?php 
    if(!isset($_GET['id_medicion'])){
        header('Location: agregar.php?mensaje=error');
        exit();
    }

    include 'conexion.php';
    $id_medicion = $_GET['id_medicion'];
    $pozo_id = $_GET["id_pozo"];

    $sentencia = $bd->prepare("DELETE FROM medicion where id_medicion = ?;");
    $resultado = $sentencia->execute([$id_medicion]);

    if ($resultado === TRUE) {
        header('Location: agregar.php?mensaje=eliminado&id_pozo='.$pozo_id);
    } else {
        header('Location: agregar.php?mensaje=error&id_pozo='.$pozo_id);
    }
    
?>