<?php
session_start();

if (isset($_SESSION['usuario'])) {
    echo "sesion_activa";
} else {
    echo "sesion_no_activa";
}
?>