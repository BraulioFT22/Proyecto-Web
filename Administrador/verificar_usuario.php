<?php
require "funciones/conecta.php";
$con = conecta();
session_start();


$correo = $_POST['correo'];
$pass = $_POST['pass'];
$passEnc = md5($pass);

$sql = "SELECT * FROM empleados WHERE correo = '$correo' 
        AND pass = '$passEnc' AND status = 1 
        AND eliminado = 0 ";
$res = $con->query($sql);
$num = $res->num_rows;

if ($num === 1) {
        $row = $res->fetch_array();
        $id = $row["id"];
        $nombre = $row["nombre"].' '.$row["apellidos"];
        $correo = $row["correo"];

        $_SESSION['idUser'] = $id;
        $_SESSION['nombreUser'] = $nombre;
        $_SESSION['correoUser'] = $correo;
        header("Location: bienvenido.php");
        exit(); 
    } elseif ($num === 0) {
        // Usuario no encontrado
        echo "Usuario No existente";
    } else {
        // Manejar otros casos si es necesario
        echo "Error en la consulta";
    }

?>

