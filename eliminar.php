<?php 
    if(!isset($_GET['id_pozo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include 'conexion.php';
    $id_pozo = $_GET['id_pozo'];

    $sentencia = $bd->prepare("DELETE FROM pozo where id_pozo = ?;");
    $resultado = $sentencia->execute([$id_pozo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=eliminado');
    } else {
        header('Location: index.php?mensaje=error');
    }
    
?>