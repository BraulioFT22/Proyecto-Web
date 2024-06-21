<?php
require "funciones/conecta.php";

include('menu.php');
$nombre = $_SESSION['nombreUser'];
if ($nombre == '') {
    header("Location: login.php");
    exit;
}
$con = conecta();

$nombre = $apellidos = $correo = $rol = $activo = ''; // Inicializamos las variables para evitar errores de variables indefinidas
$rol2 = $activo2 = '';
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM empleados WHERE id = $id";

    $res = $con->query($sql);  

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        
        // Asignar los valores a las variables
        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $correo = $row['correo'];
        $rol = $row['rol'];
        $img = $row['archivo_f'];   //obtener la direccion o nombre de la img 
        $ext = '.jpg';
        $rutaImg = "archivos/" . $img . $ext;   // se concatenan el nombre + jpg
        $rol2;
        switch ($rol) {
            case '1':
                $rol2 = "Gerente";
                break;
            case '2':
                $rol2 = "Ejecutivo";
                break;
        }
        $activo = $row['status'];
        $activo2;
        switch ($activo) {
            case '1':
                $activo2 = "si";
                break;
            case '2':
                $activo2 = "no";
                break;
        }
    } else {
        echo "No se encontró ningún empleado con el ID proporcionado.";
    }
} else {
    echo "No se proporcionó un ID de empleado.";
}

$con->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Detalles del Empleado</title>
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

    <a href="./empleados_lista.php">Regresar al listado</a>
    <h2>Detalles del Empleado</h2>
    <form name="Forma01" method="post" action="empleados_salva.php">
        <input value="<?php echo $nombre; ?>" type="text" name="nombre" id="nombre" /><br>
        <input value="<?php echo $apellidos; ?>" type="text" name="apellidos" id="apellidos" /><br>
        <input value="<?php echo $correo; ?>" type="text" name="correo" id="correo" /> <br>
        <input value="<?php echo $rol2; ?>" type="text" name="rol" id="rol" /> <br>
        <input value="<?php echo $activo2; ?>" type="text" name="activo" id="activo">
        <img src="<?php echo $rutaImg; ?>">
    </form>
</body>

</html>
