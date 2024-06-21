<?php
include("conecta.php");
session_start();
$con = conecta();

$id_producto = $_POST['id'];
$cantidad = $_POST['cantidad'];

if (isset($_SESSION['idUser'])) {
    $id_usuario = $_SESSION['idUser'];
} else {
    echo "Usuario no definido en la sesión";
    exit;
}

// Realiza una consulta para obtener el id_pedido con status = 0
$sql_pedido = "SELECT id FROM pedidos WHERE id_usuario = '$id_usuario' AND status = 0";
$resultado_pedido = $con->query($sql_pedido);

if ($resultado_pedido->num_rows > 0) {
    // Obtiene el primer resultado de la consulta
    $fila_pedido = $resultado_pedido->fetch_assoc();
    $id_pedido = $fila_pedido['id'];
    
    // Obtener el costo del producto desde la tabla productos
    $sql_producto = "SELECT costo FROM productos WHERE id = '$id_producto'";
    $resultado_producto = $con->query($sql_producto);

    if ($resultado_producto->num_rows > 0) {
        // Obtiene el primer resultado de la consulta
        $fila_producto = $resultado_producto->fetch_assoc();
        $costo = $fila_producto['costo'];

        // Verificar el status del pedido antes de la inserción
        $sql_verifica_pedido = "SELECT status FROM pedidos WHERE id = '$id_pedido'";
        $resultado_verifica_pedido = $con->query($sql_verifica_pedido);
        $fila_verifica_pedido = $resultado_verifica_pedido->fetch_assoc();

        if ($fila_verifica_pedido['status'] == 0) {
            // Ahora puedes usar $id_pedido y $costo en tu consulta de inserción
            $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES('$id_pedido', '$id_producto', '$cantidad', '$costo')";
            if ($con->query($sql) === TRUE) {
                header("LOCATION: ../index.php");
                exit;
            } else {
                echo "Error al insertar el producto en el pedido: " . $con->error;
            }
        } else {
            echo "El pedido no está en un estado pendiente.";
        }
    } else {
        echo "No se encontró el producto en la base de datos.";
    }
} else {
    echo "No se encontró un pedido pendiente para este usuario.";
}

?>
