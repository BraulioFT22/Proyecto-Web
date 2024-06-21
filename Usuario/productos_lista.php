<?php

require "funciones/conecta.php";
session_start();
if (!isset($_SESSION['nombreUser']) || empty($_SESSION['nombreUser'])) {
    header("Location: login.php");
    exit();
}
$nombre = $_SESSION['nombreUser'];

// Consulta para obtener todos los productos
function obtenerTodosLosProductos($con)
{
    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
    $res = $con->query($sql);

    $productos = [];
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $productos[] = $row;
        }
    }
    return $productos;
}

$con = conecta(); // Abre la conexión después de definir las funciones
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Aleatorios</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .banner {
            margin-bottom: 30px;
        }
        .banner img {
            border: 5px solid #17a2b8;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .formulario img {
            max-width: 100%;
            height: 150px;
            width: 200px;
            display: block;
            border-radius: 8px;
            margin-top: 20px;
        }
        .formulario {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .formulario:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2), 0 0 8px rgba(0, 0, 0, 0.6); /* Aplicar sombra adicional al pasar el mouse */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-weight: bold;
        }
        .btn-primary, .btn-secondary {
            margin-top: 10px;
        }
        button[type="submit"] {
            background-color: #28a745; /* Color de fondo verde */
            color: #fff; /* Color del texto blanco */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            padding: 10px 20px; /* Espaciado interno */
            cursor: pointer; /* Cursor de puntero al pasar sobre el botón */
            transition: background-color 0.3s ease; /* Transición suave del color de fondo */
            width: 100%;
        }

        /* Cambio de color al pasar el mouse */
        button[type="submit"]:hover {
            background-color: #218838; /* Color de fondo más oscuro al pasar el mouse */
        }
        .footer-custom {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
        }
        .footer-custom h6, .footer-custom p {
            color: #ffffff;
        }
        .footer-custom a {
            color: #ffc107;
        }
        .footer-custom a:hover {
            color: #ffffff;
        }
        .footer-custom .text-reset {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <?php include("menu.php"); ?>
    <div class="container">
        <div class="row">
            <?php
            // Obtener todos los productos
            $productos = obtenerTodosLosProductos($con);

            // Generar los formularios con todos los productos
            foreach ($productos as $producto) {
                $id = $producto['id']; // Obtener el ID del producto
            ?>
                <div class="col-md-4">
                    <div class="formulario">
                    <form name="Forma<?php echo $i; ?>" method="post" action="funciones/agregar_carrito.php">
                        <img src="archivos/<?php echo $producto['archivo_f'] . '.jpg'; ?>" alt="Producto">
                        <div class="form-group">
                            <input value="<?php echo $producto['id']; ?>" type="text" name="id" id="id" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <input value="<?php echo  $producto['nombre']; ?>" type="text" name="nombre" id="nombre" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <input value="<?php echo $producto['codigo']; ?>" type="text" name="codigo" id="codigo" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <input value="<?php echo $producto['costo']; ?>" type="text" name="costo" id="costo" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" required />
                        </div>
                        <button type="submit">Comprar</button>
                            <a href="detalles.php?id=<?php echo $id; ?>" class="btn btn-secondary btn-block">Ver detalle</a>
                        <div id="mensaje"></div>
                    </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <footer class="footer-custom">
        <div class="container">
            <p>&copy; 2024 Tech-Products || Braulio Flores Toscano Todos los derechos reservados.</p>
            <p>
                <a href="#">Política de Privacidad</a> |
                <a href="#">Términos de Servicio</a> |
                <a href="contacto.php">Contacto</a>
            </p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php
// Cierra la conexión después de utilizarla
$con->close();
?>
