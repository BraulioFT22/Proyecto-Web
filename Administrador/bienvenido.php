<!DOCTYPE html>
<?php
include('menu.php');
$nombre = $_SESSION['nombreUser'];
if ($nombre == '') {
    header("Location: login.php");
    exit;
}
?>
<html>
<head>
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }
        
        h1 {
            color: #333;
        }
        
        p {
            color: #666;
            font-size: 18px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <h1>Bienvenido <?php echo $nombre;?></h1>
    <p>¡Gracias por iniciar sesión! Este es un mensaje de bienvenida.</p>
</body>
</html>
