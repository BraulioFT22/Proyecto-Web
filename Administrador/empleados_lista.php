<?php
include('menu.php');
$nombre = $_SESSION['nombreUser'];
if ($nombre == '') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista de Empleados</title>
    <style>
        /* Estilos CSS para la tabla */
        body {
            text-decoration: none;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .pagina {
            background-color: #f0f0f0;
            border: 1px solid #dddddd;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .pagina .tabla-empleados {
            width: 100%;
            border-collapse: collapse;
        }

        .pagina .fila {
            display: flex;
            padding: 20px 10px;
        }

        .pagina .campo {
            flex: 1;
            padding: 5px;
            text-align: left;
        }

        .pagina .campo:first-child {
            flex-basis: 5%;
        }

        .pagina .campo:nth-child(2),
        .pagina .campo:nth-child(3) {
            flex-basis: 20%;
        }

        .pagina .campo:nth-child(4),
        .pagina .campo:nth-child(5) {
            flex-basis: 25%;
        }

        .pagina .campo:nth-child(6),
        .pagina .campo:nth-child(7),
        .pagina .campo:nth-child(8) {
            flex-basis: 10%;
        }

        .pagina .campo:nth-child(9) {
            flex-basis: 5%;
        }

        .pagina a {
            text-decoration: none;
        }
        
        .pagina a:hover {
            background-color:#A6D6BD;
            border-radius: 1px;
            padding: 5px 10px;
            border-radius: 3px;
            box-shadow: 0px 5px 5px gray;
        }
    </style>
    <script src="jquery-3.3.1.min.js"></script>
    <script>
        function eliminarAjax(id) {
            if (confirm("Este registro se eliminará...")) {
                $.ajax({
                    url: 'empleados_elimina.php',
                    type: 'post',
                    dataType: 'text',
                    data: {
                        id: id
                    },
                    success: function (res) {
                        console.log(res);
                        $('fila').hide();
                    },
                    error: function () {
                        alert('Error: Archivo no encontrado');
                    }
                });
            }
        }
    </script>
</head>
<body>
    <a href="empleados_alta.php">Nuevo Empleado</a>
    <?php
    require "funciones/conecta.php";

    $con = conecta();

    $sql = "SELECT * FROM empleados WHERE status = 1 AND eliminado = 0";

    $res = $con->query($sql);
    $num = $res->num_rows;

    echo "<h2>Lista de Empleados ($num)</h2><br >";

    if ($num > 0) {
        while ($row = $res->fetch_array()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $correo = $row["correo"];
            $rol = $row["rol"];
            $rol2 = ""; /*Rool2 almacena la respuesta gerente o ejecutivo dependiendo de rol1 */
            switch ($rol) {
                case '1':
                    $rol2 = "Gerente";
                    break;
                case '2':
                    $rol2 = "Ejecutivo";
                    break;
            }
            ?>
            <div class="pagina">
                <div class="fila">
                    <div class="campo" id="id">ID: <?php echo $id; ?></div>
                    <div class="campo">Nombre: <?php echo $nombre; ?></div>
                    <div class="campo">Apellidos: <?php echo $apellidos; ?></div>
                    <div class="campo">Correo: <?php echo $correo; ?></div>
                    <div class="campo">Rol: <?php echo $rol2; ?></div>
                    <div class="campo">
                        <a href="empleados_detalle.php?id=<?php echo $id; ?>">Ver detalle</a>
                    </div>
                    <div class="campo">
                        <a href="empleados_editar.php?id=<?php echo $id; ?>">Editar</a>
                    </div>
                    <div class="campo" id="eliminado">
                        <a href="#" onclick="eliminarAjax(<?php echo $id; ?>);">Eliminar</a>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "No se encontraron empleados.";
    }
    ?>
</body>

</html>
