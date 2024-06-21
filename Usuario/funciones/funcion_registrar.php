<?php
require "conecta.php";
    
$con = conecta();

$nombre = $_REQUEST['nombre'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$passEnc = md5($pass);

$sql = "INSERT INTO usuarios
        (nombre, correo, pass)
        VALUES('$nombre', '$correo', '$passEnc')";

$res = $con->query($sql);  
header("Location: ../login.php");
?>
