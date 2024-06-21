<?php
require "funciones/conecta.php";
session_start();

$con = conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $passEnc = md5($pass);

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND pass = '$passEnc'";
    $res = $con->query($sql);
    $num = $res->num_rows;

    if ($num === 1) {
        $row = $res->fetch_array();
        $_SESSION['idUser'] = $row["id"];
        $_SESSION['nombreUser'] = $row["nombre"];
        $_SESSION['correoUser'] = $row["correo"];

        $id_usuario = $_SESSION['idUser'];
        $fecha = date("Y-m-d");
        $status = 0;


        $sql2 = "INSERT INTO pedidos (fecha, id_usuario, status) VALUES ('$fecha', '$id_usuario', '$status')";
        $con->query($sql2);

        header("Location: index.php");
        exit();
    } else {
        echo "Usuario No existente";
    }
} else {
    echo "Error en la consulta";
}
?>
