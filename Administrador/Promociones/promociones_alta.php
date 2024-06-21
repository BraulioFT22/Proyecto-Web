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
    <title>Formularios</title>
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
        select,
        input[type="file"] {
            width: calc(100% - 22px); /* Ajusta el ancho para considerar el padding */
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="button"],
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="button"]:hover,
        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #mensaje {
            color: red;
            margin-top: 10px;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            border-color: #45a049;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function validarCampos() {
            var nombre = $('#nombre').val();

            if (nombre === '') {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout(function() {
                    $('#mensaje').html('');
                }, 3000);
            } else {
                document.Forma01.method = 'post';
                document.Forma01.action = 'funcion_alta.php';
                document.Forma01.submit();
            }
        }
    </script>

</head>
<body>
    <a href="./promociones_lista.php" style="display: block; margin-top: 20px; text-align: center; 
    color: #007bff; text-decoration: none; background-color: #f0f0f0; padding: 10px; border-radius: 4px;">Regresar al listado</a>
    <form name="Forma01" method="post" action="promociones_alta.php" enctype="multipart/form-data">
        <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre" /> <br>
        <input type="file" id="archivo" name="archivo"><br><br>
        <input onclick="validarCampos();" type="button" value="Enviar" />
    </form>
    <div id="mensaje"></div>
</body>

</html>
