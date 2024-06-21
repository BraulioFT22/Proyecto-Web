<?php
include("funciones/conecta.php");
include("menu.php");

$con = conecta();

// Consulta SQL para seleccionar los elementos del carrito con pedidos cuyo status no es 1
$sql = "SELECT pp.id_pedido, pp.id_producto, pp.cantidad, pp.precio 
        FROM pedidos_productos pp
        JOIN pedidos p ON pp.id_pedido = p.id
        WHERE p.status != 1";

// Ejecutar la consulta
$res = $con->query($sql);
$num = $res->num_rows;

// Inicializar variable para el total
$total = 0;

// Comienza la impresión de la tabla HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .btn-primary {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-3">Carrito de Compras (<?php echo $num; ?>)</h2>
        <?php if ($num > 0): ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Pedido</th>
                        <th>ID Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $res->fetch_array()): 
                        $subtotal = $row["cantidad"] * $row["precio"];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $row["id_pedido"]; ?></td>
                            <td><?php echo $row["id_producto"]; ?></td>
                            <td><?php echo $row["cantidad"]; ?></td>
                            <td><?php echo $row["precio"]; ?></td>
                            <td><?php echo $subtotal; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                        <td><?php echo $total; ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p class="mt-3">No hay elementos en el carrito.</p>
        <?php endif; ?>
        <a href="carrito.php" class="btn btn-primary">Regresar</a>
        <a href="funciones/cerrar_pedido.php" class="btn btn-primary">Finalizar Pedido</a>
    </div>
</body>
</html>
