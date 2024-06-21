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
    <?php
    require "funciones/conecta.php";

    $con = conecta();

    $sql = "SELECT * FROM pedidos WHERE status = 1";

    $res = $con->query($sql);
    $num = $res->num_rows;

    echo "<h2>Lista de Pedidos($num)</h2><br >";

    if ($num > 0) {
        while ($row = $res->fetch_array()) {
            $id = $row["id"];
            $fecha = $row["fecha"];
            $id_usuario = $row["id_usuario"];
            $status = $row["status"];
            $status2 = ""; 
            switch ($status) {
                case '1':
                    $status2 = "Cerrado";
                    break;
                case '2':
                    $status = "abierto";
                    break;
            }
            ?>
            <div class="pagina">
                <div class="fila">
                    <div class="campo" id="id">ID: <?php echo $id; ?></div>
                    <div class="campo">Fecha: <?php echo $fecha; ?></div>
                    <div class="campo">id_usuario: <?php echo $id_usuario; ?></div>
                    <div class="campo">Estado: <?php echo $status2; ?></div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "No se encontraron Pedidos.";
    }
    ?>
</body>

</html>
