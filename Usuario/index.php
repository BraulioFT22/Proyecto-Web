<?php
session_start();
if (!isset($_SESSION['nombreUser']) || empty($_SESSION['nombreUser'])) {
    header("Location: login.php");
    exit();
}
$nombre = $_SESSION['nombreUser'];
?>
<?php
require "funciones/conecta.php";
function obtenerProductoAleatorio($con)
{
    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 1";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        return $res->fetch_assoc();
    } else {
        return false;
    }
}

// Función para obtener un producto aleatorio para el banner
function obtenerProductoAleatorioBanner($con)
{
    $sql = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 1";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        return $res->fetch_assoc();
    } else {
        return false;
    }
}

$con = conecta(); // Abre la conexión después de definir las funciones

// Consulta para obtener el producto aleatorio para el banner
$producto_banner = obtenerProductoAleatorioBanner($con);

if ($producto_banner) {
    $rutaImgB = "archivos/" . $producto_banner['archivo'] . ".jpg";
}

?>

<!DOCTYPE html>
<html lang="en">
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <?php include("menu.php"); ?>
    <div class="container">
        <div class="banner text-center">
            <img id="banner" src="<?php echo $rutaImgB ?>" alt="Banner promocional" class="img-fluid">
        </div>
        <div class="row">
            <?php
            // Generar los formularios con productos aleatorios
            for ($i = 1; $i <= 6; $i++) {
                $producto = obtenerProductoAleatorio($con); 
                if ($producto) {
                    $id = $producto['id']; 
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
            }
            ?>
        </div>
    </div>
    <!--Footer-->
    <footer class="footer-custom">
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Derechos reservados:
                        </h6>
                        <p>
                            © 2023 Tech-Products. Todos los derechos reservados. El contenido, diseño y elementos visuales de este sitio web están protegidos
                            por las leyes de propiedad intelectual. Queda estrictamente prohibida la reproducción total o parcial sin la autorización expresa de D-Products.
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Términos y Condiciones:
                        </h6>
                        <p>
                            Al acceder y utilizar nuestro sitio web, aceptas cumplir con nuestros términos y condiciones. Estos términos rigen tu uso de Tech-Products, incluida la compra de productos. Por favor, lee detenidamente nuestros términos y condiciones antes de realizar cualquier transacción. Si tienes alguna pregunta, no dudes en ponerte en contacto con nuestro equipo de atención al cliente.
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Redes sociales:
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Facebook</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Instagram</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">YouTube</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Twitter</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2023 Copyright:
            <a class="text-reset fw-bold">D-Products Inc.</a>
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
