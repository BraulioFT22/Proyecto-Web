
<?php
require "funciones/conecta.php";
    
$con = conecta();
$ban = 0;

if (isset($_REQUEST['correo'])) { //verifica si esta definida y no es nula
    $correo = $_REQUEST['correo'];
    if ($correo){
        $correo_existente_sql = "SELECT correo FROM empleados WHERE correo = '$correo'";
        $correo_existente_res = $con->query($correo_existente_sql);
        if ($correo_existente_res->num_rows > 0) {
            $ban = 1;
        }else {
            echo "No se proporcionó un correo.";
        }
    }
}
echo $ban;
?>