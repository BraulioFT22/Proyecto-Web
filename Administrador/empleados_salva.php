<?php
require "funciones/conecta.php";
    
$con = conecta();

$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$passEnc = md5($pass);

$archivo_n = $_FILES['archivo']['name'];
$archivo_f = $_FILES['archivo']['tmp_name'];
$arreglo = explode(".", $archivo_n);
$len = count($arreglo);
$pos = $len - 1;
$ext = $arreglo[$pos];
$dir = "archivos/";
$file_enc = md5_file($archivo_f);

if($archivo_n != ''){
        $fileName1 = "$file_enc.$ext";
        copy($archivo_f, $dir.$fileName1);
    }

$sql = "INSERT INTO empleados
        (nombre, apellidos, correo, pass, rol, archivo_n, archivo_f)
        VALUES('$nombre', '$apellidos', '$correo', '$passEnc', $rol, '$archivo_n', '$file_enc')";

$res = $con->query($sql);  
header("Location: empleados_lista.php");
?>
