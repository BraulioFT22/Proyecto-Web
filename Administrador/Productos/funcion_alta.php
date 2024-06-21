<?php
require "../funciones/conecta.php";
    
$con = conecta();

$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock = $_REQUEST['stock'];

$archivo_n = $_FILES['archivo']['name'];
$archivo_f = $_FILES['archivo']['tmp_name'];
$arreglo = explode(".", $archivo_n);
$len = count($arreglo);
$pos = $len - 1;
$ext = $arreglo[$pos];
$dir = "archivos/";
$dir2 = "../../Usuario/archivos/";
$file_enc = md5_file($archivo_f);

if($archivo_n != ''){
        $fileName1 = "$file_enc.$ext";
        copy($archivo_f, $dir.$fileName1);
        copy($archivo_f, $dir2.$fileName1);
}

$sql = "INSERT INTO productos
        (nombre, codigo, descripcion, costo, stock, archivo_n, archivo_f)
        VALUES('$nombre', '$codigo', '$descripcion', $costo,  '$stock', '$archivo_n', '$file_enc')";

$res = $con->query($sql);  
header("Location: productos_lista.php");
?>
