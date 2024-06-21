<?php
// Verificar si se recibió el ID correctamente
if(isset($_POST['id'])) {

    require "../funciones/conecta.php";
    $con = conecta();

    $id = $_POST['id'];
    $sql = "UPDATE promociones SET eliminado = 1 WHERE id = $id";
    $res = $con->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if($res) {
        echo "La promocion con ID $id ha sido eliminado correctamente.";
    } else {
        echo "Error: No se pudo eliminar la promocion.";
    }
    } else {
        echo "Error: No se recibió el ID correctamente.";
    }
?>
