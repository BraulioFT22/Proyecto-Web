<?php
include("conecta.php");
session_start();
$con = conecta();

// Obtener el ID del usuario de la sesión
if (isset($_SESSION['idUser'])) {
    $id_usuario = $_SESSION['idUser'];
} else {
    echo "Usuario no definido en la sesión";
    exit;
}

// Cambiar el status a 1 de todos los pedidos del usuario con status = 0
$sql = "UPDATE pedidos SET status = 1 WHERE id_usuario = '$id_usuario' AND status = 0";

if ($con->query($sql) === TRUE) {
    // Insertar un nuevo pedido pendiente
    $fecha = date('Y-m-d H:i:s');
    $status = 0;
    $sql_nuevo_pedido = "INSERT INTO pedidos (fecha, id_usuario, status) VALUES ('$fecha', '$id_usuario', '$status')";

    if ($con->query($sql_nuevo_pedido) === TRUE) {
        header("LOCATION: gracias.php");
        exit;
    } else {
        echo "Error al crear un nuevo pedido pendiente: " . $con->error;
    }
} else {
    echo "Error al cerrar el pedido: " . $con->error;
}
?>
