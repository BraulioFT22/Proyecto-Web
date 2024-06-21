<?php
require "../funciones/conecta.php";

$con = conecta();

$id = $_REQUEST['id']; // Obtener el ID del producto que se está actualizando
$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock = $_REQUEST['stock'];

// Inicializar la variable para el nombre del archivo
$fileName1 = '';

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
}

// Actualizar los datos del producto
$sql = "UPDATE productos
        SET nombre = '$nombre',
            codigo = '$codigo',
            descripcion = '$descripcion',
            costo = '$costo',
            stock = $stock";

// Si se subió una nueva imagen, también actualizamos la columna de imagen
if (!empty($fileName1)) {
    $sql .= ", archivo_f = '$fileName1'";
}

$sql .= " WHERE id = $id";

$res = $con->query($sql);

// Redireccionar al listado de productos después de la actualización
header("Location: productos_lista.php");
?>
