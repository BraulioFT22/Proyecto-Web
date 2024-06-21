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
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var pass = $('#pass').val();
            var rol = $('#rol').val();

            if (nombre === '' || apellidos === '' || correo === '' || pass === '' || rol === '') {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout(function() {
                    $('#mensaje').html('');
                }, 3000);
            } else {
                document.Forma01.method = 'post';
                document.Forma01.action = 'empleados_salva.php';
                document.Forma01.submit();
            }
        }

        function sale() {
            var correo = $('#correo').val();
            $.ajax({
                url: 'verificar_correo.php',
                type: 'post',
                dataType: 'text',
                data: 'correo=' + correo,
                success: function(res) {
                    if (res == 1) {
                        $('#correo').val('');
                        $('#mensaje').html('Correo ' + correo + ' ya existente');
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
    <a href="./empleados_lista.php" style="display: block; margin-top: 20px; text-align: center; 
    color: #007bff; text-decoration: none; background-color: #f0f0f0; padding: 10px; border-radius: 4px;">Regresar al listado</a>
    <form name="Forma01" method="post" action="empleados_salva.php" enctype="multipart/form-data">
        <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" /> <br>
        <input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos" /> <br>
        <input onblur="sale();" type="text" name="correo" id="correo" placeholder="Correo electrónico" /> <br>
        <input type="text" name="pass" id="pass" placeholder="Escribe el password" /> <br>
        <select name="rol" id="rol">
            <option value="0">Selecciona</option>
            <option value="1">Gerente</option>
            <option value="2">Ejecutivo</option>
        </select>
        <input type="file" id="archivo" name="archivo"><br><br>
        <input onclick="validarCampos();" type="button" value="Enviar" />
    </form>
    <div id="mensaje"></div>
</body>

</html>
