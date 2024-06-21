<?php
require "../funciones/conecta.php";

$con = conecta();

include('menu.php');
$nombre = $_SESSION['nombreUser'];
if ($nombre == '') {
    header("Location: ../login.php");
    exit;
}
$nombre = $codigo = $descripcion = $costo = $stock = '';  // Inicializamos las variables para evitar errores de variables indefinidas

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM productos WHERE id = $id";

    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();

        // Asignar los valores a las variables
        $nombre = $row['nombre'];
        $codigo = $row['codigo'];
        $descripcion = $row['descripcion'];
        $img = $row['archivo_f'];   //obtener la direccion o nombre de la img 
        $ext = '.jpg';
        $rutaImg = $img . $ext;   // se concatenan el nombre + jpg
        $costo = $row['costo'];
        $stock = $row['stock'];
    } else {
        echo "No se encontró ningún empleado con el ID proporcionado.";
    }
} else {
    echo "No se proporcionó un ID de empleado.";
}

$con->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar productos</title>
    <style>
        /* Estilos CSS para el formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 20px 20px 15px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="button"]:hover {
            background-color: #45a049;
        }

        #mensaje {
            color: red;
            margin-top: 10px;
        }

        h2 {
            text-align: center;
            /* Centrar el título */
            margin-bottom: 20px;
            /* Espacio entre el título y el formulario */
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function validarCampos() {
            var nombre = $('#nombre').val();
            var codigo = $('#codigo').val();
            var descripcion = $('#descripcion').val();
            var costo = $('#costo').val();
            var stock = $('#stock').val();

            if (nombre === '' || codigo === '' || descripcion === '' || costo === '' || stock === '') {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout(function() {
                    $('#mensaje').html('');
                }, 3000);
            } else {
                document.Forma01.method = 'post';
                document.Forma01.action = 'funcion_actualiza.php';
                document.Forma01.submit();
            }
        }

        function sale() {
            var codigo = $('#codigo').val();
            $.ajax({
                url: 'funcion_verificar_codigo.php',
                type: 'post',
                dataType: 'text',
                data: 'codigo=' + codigo,
                success: function(res) {
                    if (res == 1) {
                        $('#codigo').val('');
                        $('#mensaje').html('Codigo ' + codigo + ' ya existente');
                        setTimeout(function() {
                            $('#mensaje').html('');
                        }, 3000);
                    }
                },
                error: function() {
                    alert('Error: Archivo no encontrado');
                }
            });
        }
    </script>

</head>

<body>

    <a href="./productos_lista.php" style="display: block; margin-top: 20px; text-align: center; 
    color: #007bff; text-decoration: none; background-color: #f0f0f0; padding: 10px; border-radius: 4px;">Regresar al listado</a>
    <form name="Forma01" method="post" action="productos_alta.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input value="<?php echo $nombre; ?>" type="text" name="nombre" id="nombre" placeholder="Escribe el nombre" /> <br>
        <input value="<?php echo $codigo; ?>" onblur="sale();" type="text" name="codigo" id="codigo" placeholder="Escribe el codigo" /> <br>
        <input value="<?php echo $descripcion; ?>"type="text" name="descripcion" id="descripcion" placeholder="Descripcion" /> <br>
        <input value="<?php echo $costo; ?>" type="text" name="costo" id="costo" placeholder="Costo" /> <br>
        <input value="<?php echo $stock; ?>" type="text" name="stock" id="stock" placeholder="stock" /> <br>
        <input type="file" id="archivo" name="archivo"><br><br>
        <input onclick="validarCampos();" type="button" value="Enviar" />
    </form>
    <div id="mensaje"></div>
</body>

</html>