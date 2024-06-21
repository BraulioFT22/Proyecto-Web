<?php
include("conecta.php");
$con = conecta();

if (isset($_GET['id_pedido'])) {

    $id_pedido = $_GET['id_pedido'];

    $sql = "DELETE FROM pedidos_productos WHERE id_producto = $id_pedido LIMIT 1"; // Cambio aquí
    if ($con->query($sql) === TRUE) {
        header("LOCATION: ../carrito.php");
    } else {
        echo "Error al eliminar el pedido: " . $con->error;
    }
    $con->close();
} else {
    echo "No se ha proporcionado un ID de pedido válido.";
}
?>
