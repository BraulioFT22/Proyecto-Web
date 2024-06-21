<?php
require "../funciones/conecta.php";
$con = conecta();
session_start();

$codigo = $_POST['codigo'];

$sql = "SELECT * FROM productos WHERE codigo = '$codigo' 
        AND status = 1 AND eliminado = 0 ";
$res = $con->query($sql);
$num = $res->num_rows;
echo $num;

?>