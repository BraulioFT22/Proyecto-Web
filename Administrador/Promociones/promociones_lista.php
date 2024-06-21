<?php
include('menu.php');
$nombre = $_SESSION['nombreUser'];
if ($nombre == '') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista de Productos</title>
    <style>
        /* Estilos CSS para la tabla */
        body {
            text-decoration: none;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        a {
            padding-bottom: 10px;
        }

        .pagina {
            background-color: #f0f0f0;
            border: 1px solid #dddddd;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
            max-width: 1000px;
            /* Establece un ancho máximo para el contenedor principal */
            margin: 0 auto;
            /* Centra el contenedor principal horizontalmente */
        }

        .pagina .tabla {
            width: 100%;
            border-collapse: collapse;
        }

        .pagina .fila {
            display: flex;
            flex-wrap: wrap;
            /* Permite que las filas se envuelvan cuando el espacio es insuficiente */
            margin-bottom: 20px;
            /* Margen inferior para separar las filas */
        }

        .pagina .campo {
            flex: 0 0 calc(20% - 40px);
            /* Ancho de 20% del contenedor principal con margen */
            padding: 20px 20px;
            /* Espaciado interior */
            text-align: center;
            /* Alineación del texto */
            box-sizing: border-box;
            /* Incluye el borde y el relleno en el ancho del elemento */
            margin-right: 10px;
            /* Margen derecho para separar los elementos dentro de la fila */
            
        }

        .pagina .campo:first-child {
            flex-basis: 100%;
            /* El primer campo ocupa toda la fila */
        }

        .pagina .campo img {
            max-width: 100%;
            /* La imagen se ajusta al ancho del campo */
            height: auto;
            /* Mantiene la proporción de aspecto de la imagen */
            border-radius: 8px;
            /* Borde redondeado */
        }

        .pagina a {
            text-decoration: none;
        }

        .pagina a:hover {
            background-color: #A6D6BD;
            border-radius: 1px;
            padding: 5px 10px;
            border-radius: 3px;
            box-shadow: 0px 5px 5px gray;
        }

        .campo {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <script src="jquery-3.3.1.min.js"></script>
    <script>
        function eliminarAjax(id) {
            if (confirm("Este registro se eliminará...")) {
                $.ajax({
                    url: 'funcion_elimina.php',
                    type: 'post',
                    dataType: 'text',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        console.log(res);
                        $('fila').hide();
                    },
                    error: function() {
                        alert('Error: Archivo no encontrado');
                    }
                });
            }
        }
    </script>
</head>

<body>
    <a href="promociones_alta.php">Nueva Promocion</a>
    <?php
    require "../funciones/conecta.php";

    $con = conecta();

    $sql = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0";

    $res = $con->query($sql);
    $num = $res->num_rows;

    if ($num > 0) {
        while ($row = $res->fetch_array()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            $img = $row["archivo"];
            $ext = '.jpg';
            $rutaImg = "archivos/" . $img . $ext;   // se concatenan el nombre + jpg
    ?>
            <div class="pagina">
                <div class="fila">
                    <div class="campo"><img src="<?php echo $rutaImg; ?>" alt="<?php echo $nombre; ?>"></div>
                    <div class="campo">Nombre: <?php echo $nombre; ?></div>
                    <div class="campo">
                        <a href="promociones_detalle.php?id=<?php echo $id; ?>">Ver detalle</a>
                    </div>
                    <div class="campo">
                        <a href="#" onclick="eliminarAjax(<?php echo $id; ?>);">Eliminar</a>
                    </div>
                </div>
            </div>

    <?php
        }
    } else {
        echo "No se encontraron Productos.";
    }
    ?>
</body>

</html>
