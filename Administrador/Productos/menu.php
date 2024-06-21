<?php
session_start();
$nombre = $_SESSION['nombreUser'];
?>

<!DOCTYPE html>
<head>
    <title>Navbar</title>
    <style>
        /* Estilos para la navbar */
        .navbar {
            overflow: hidden;
            background-color: #333;
            border-radius: 5px;
            margin-bottom: 50px;
        }

        .navbar a {
            float: left;
            display: block;
            color: aquamarine;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 17px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.active {
            background-color: #024D4A;
            color: white;
        }

        /* Clear floats (clearfix) */
        .navbar::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<div class="navbar">
    <a href="../bienvenido.php">Inicio</a>
    <a href="../empleados_lista.php">Empleados</a>
    <a href="productos_lista.php">Productos</a>
    <a href="">Promociones</a>
    <a href="">Pedidos</a>
    <a href="">Sesion: <?php echo $nombre ?></a>
    <a href="cerrar_sesion.php">Cerrar Sesion</a>
</div>

</html>
