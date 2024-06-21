<?php
// Lógica de la sesión
session_start();
if (!isset($_SESSION['nombreUser']) || empty($_SESSION['nombreUser'])) {
    header("Location: login.php");
    exit();
}
$nombre = $_SESSION['nombreUser'];

// Conexión a la base de datos
require "funciones/conecta.php";
$con = conecta();

// Lógica para obtener el ID del producto
$nombre = $codigo = $descripcion = $costo = $stock = ''; // Inicializamos las variables para evitar errores de variables indefinidas
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM productos WHERE id = $id";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();

        // Asignar los valores a las variables
        $nombre = $row['nombre'];
        $codigo = $row['codigo'];
        $descripcion = $row['descripcion'];
        $img = $row['archivo_f'];   // Obtener el nombre del archivo de la imagen
        $costo = $row['costo'];
        $stock = $row['stock'];
        $ext = '.jpg';
        $rutaImg = "archivos/" . $img . $ext;   // se concatenan el nombre + jpg
    } else {
        echo "No se encontró ningún producto con el ID proporcionado.";
    }
} else {
    echo "No se proporcionó un ID de producto.";
}

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-top: 10px solid #007bff;
            border-left: 10px solid #28a745;
            border-right: 10px solid #ffc107;
        }
        .form-control {
            margin-bottom: 10px;
        }
        .btn-primary, .btn-secondary {
            margin-top: 10px;
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 20px auto;
            border: 3px solid #17a2b8;
            border-radius: 8px;
        }
        .header-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-container h2 {
            color: #007bff;
            font-weight: bold;
        }
        .back-link {
            color: #ffffff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .back-link:hover {
            color: #ffffff;
            background-color: #218838;
            border-color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="header-container">
                <h2>Detalles del Producto</h2>
            </div>
            <form name="Forma01" method="post" action="empleados_salva.php">
                <div class="form-group">
                    <input value="<?php echo 'NOMBRE: ' . $nombre; ?>" type="text" name="nombre" id="nombre" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <input value="<?php echo 'CODIGO: ' . $codigo; ?>" type="text" name="codigo" id="codigo" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <input value="<?php echo 'DESCRIPCION: ' . $descripcion; ?>" type="text" name="descripcion" id="descripcion" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <input value="<?php echo 'COSTO: ' . $costo; ?>" type="text" name="costo" id="costo" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <input value="<?php echo 'STOCK: ' . $stock; ?>" type="text" name="stock" id="stock" class="form-control" readonly />
                </div>
                <?php
                // Verificar si la imagen existe
                if (isset($rutaImg) && file_exists($rutaImg)) {
                    echo "<img src=$rutaImg alt='Imagen del producto'>";
                } else {
                    echo '<p>Imagen no disponible</p>';
                }
                ?>
                <a href="index.php" class="btn btn-primary btn-block">Regresar al listado</a>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
