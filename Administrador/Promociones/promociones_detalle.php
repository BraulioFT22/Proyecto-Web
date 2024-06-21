<?php
require "../funciones/conecta.php";

include('menu.php');
$nombre = $_SESSION['nombreUser'];
if ($nombre == '') {
    header("Location: ../login.php");
    exit;
}
$con = conecta();

$nombre = $id = $status = $img = ''; // Inicializamos las variables para evitar errores de variables indefinidas
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM promociones WHERE id = $id";

    $res = $con->query($sql);  

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        
        // Asignar los valores a las variables
        $id = $row['id'];
        $nombre = $row['nombre'];
        $status = $row['status'];
        $activo;
        switch ($status) {
            case '1':
                $activo = "SI";
                break;
            case '2':
                $activo = "NO";
                break;
        }
        $img = $row['archivo'];   // Obtener el nombre del archivo de la imagen
        $ext = '.jpg';
        $rutaImg = "archivos/" . $img . $ext;   // se concatenan el nombre + jpg
    } else {
        echo "No se encontró ningúna promocion con el ID proporcionado.";
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
    <style>
        /* Estilos CSS para el formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 20px 20px 15px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="button"]:hover {
            background-color: #45a049;
        }

        #mensaje {
            color: red;
            margin-top: 10px;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            border-color: #45a049;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block; /* Para alinear la imagen correctamente */
            margin: 0 auto; /* Centrar la imagen horizontalmente */
            border: 1px solid #ccc; /* Borde gris claro */
            border-radius: 8px;
            margin-top: 20px; /* Espacio entre la imagen y el formulario */
        }

        h2 {
            text-align: center; /* Centrar el título */
            margin-bottom: 20px; /* Espacio entre el título y el formulario */
        }
    </style>
</head>

<body>

    <a href="./promociones_lista.php">Regresar al listado</a>
    <h2>Detalles del Producto</h2>
    <form name="Forma01" method="post">
        <input value="<?php echo 'ID:' . $id; ?>" type="text" name="id" id="id" /><br>
        <input value="<?php echo 'NOMBRE: ' . $nombre; ?>" type="text" name="nombre" id="nombre" /><br>
        <input value="<?php echo 'ACTIVO: ' . $activo; ?>" type="text" name="nombre" id="nombre" /><br>
        <?php
        // Verificar si la imagen existe
        if (file_exists($rutaImg)) {
            // Mostrar la imagen si existe
            echo "<img src=$rutaImg>";
        } else {
            echo '<p>Imagen no disponible</p>';
        }
        ?>
    </form>
</body>

</html>
