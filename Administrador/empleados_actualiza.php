<?php
require "funciones/conecta.php";

$con = conecta();

$id = $_REQUEST['id']; // Obtener el ID del empleado que se está actualizando
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];

// Verificar si se subió una nueva imagen
if ($_FILES['archivo']['name'] != '') {
    $archivo_n = $_FILES['archivo']['name'];
    $archivo_f = $_FILES['archivo']['tmp_name'];
    $arreglo = explode(".", $archivo_n);
    $len = count($arreglo);
    $pos = $len - 1;
    $ext = $arreglo[$pos];
    $dir = "archivos/";
    $file_enc = md5_file($archivo_f);

    // Copiar la nueva imagen al directorio de archivos
    $fileName1 = "$file_enc.$ext";
    copy($archivo_f, $dir.$fileName1);
} else {
    // Si no se subió una nueva imagen, mantener la imagen existente
    $sql_imagen = "SELECT archivo_f FROM empleados WHERE id = $id";
    $res_imagen = $con->query($sql_imagen);
    $row_imagen = $res_imagen->fetch_assoc();
    $archivo_n = $row_imagen['archivo_n'];
    $archivo_f = $row_imagen['archivo_f'];
}

$passEnc = md5($pass);

$sql = "UPDATE empleados
        SET nombre = '$nombre',
            apellidos = '$apellidos',
            correo = '$correo',
            pass = '$passEnc',
            rol = $rol,
            archivo_n = '$archivo_n',
            archivo_f = '$archivo_f'
        WHERE id = $id";

$res = $con->query($sql);
header("Location: empleados_lista.php");
?>
