<?php
require "../funciones/conecta.php";
    
$con = conecta();

$nombre = $_REQUEST['nombre'];

$archivo_n = $_FILES['archivo']['name'];
$archivo = $_FILES['archivo']['tmp_name'];
$arreglo = explode(".", $archivo_n);
$len = count($arreglo);
$pos = $len - 1;
$ext = $arreglo[$pos];
$dir = "archivos/";
$dir2 = "../../Usuario/archivos/";
$file_enc = md5_file($archivo);

if($archivo_n != ''){
        $fileName1 = "$file_enc.$ext";
        copy($archivo, $dir.$fileName1);
        copy($archivo, $dir2.$fileName1);
    }

$sql = "INSERT INTO promociones
        (nombre, archivo)
        VALUES('$nombre', '$file_enc')";

$res = $con->query($sql);  
header("Location: promociones_lista.php");
?>
