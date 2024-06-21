<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .banner {
            width: calc(33.33% - 40px); /* 33.33% del ancho de la pantalla menos el espacio de padding */
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Evitar que la sombra se recorte */
        }

        .banner img {
            width: 100%;
            display: block;
        }
    </style>
</head>

<body>
    <?php
    require "funciones/conecta.php";
    $con = conecta();

    $sql = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 1";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $img = $row['archivo'];   // Obtener el nombre del archivo de la imagen
        $ext = '.jpg';
        $rutaImg = "archivos/" . $img . $ext;   // se concatenan el nombre + jpg
    }

    $con->close();
    ?>

    <div class="banner">
        <img src="<?php echo $rutaImg ?>" alt="">
    </div>
</body>

</html>
