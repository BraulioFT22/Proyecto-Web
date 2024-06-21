<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            border-color: #45a049;
        }
        h2 {
            text-align: center; /* Centrar el título */
            margin-bottom: 20px; /* Espacio entre el título y el formulario */
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function validarCampos() {
            var correo = $('#correo').val();
            var pass = $('#pass').val();

            if (correo === '' || pass === '') {
                $('#mensaje').html('Faltan campos por llenar'); 
            } else {
                $('#mensaje').html(''); // Limpiar mensaje de error si no hay campos vacíos
                document.Forma01.method = 'post';
                document.Forma01.action = 'verificar_usuario.php';
                document.Forma01.submit();
            }
        }

            //NO SE ESTA REALIZANDO EL AJAX, SE REDIRECCIONA CON EL ARCHIVO DE VERIFICA_USUARIO
        function verificar_usuario() {
            var correo = $('#correo').val();
            var pass = $('#pass').val();

            $.ajax({
                url: 'verificar_usuario.php',
                type: 'post',
                dataType: 'text',
                data: {
                    correo: correo,
                    pass :pass
                },
                success: function(res) {
                    console.log(res);
                    if (res === "1") {
                        window.location.href = 'bienvenido.php';
                    } else if (res === "0") {
                        $('#mensaje').html('Usuario inactivo');
                    }else{
                        $('#mensaje').html('Usuario No existente');
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
    <h2>Inicio de Sesion</h2>
    <form name="Forma01" method="post" action="bienvenido.php">
        <input type="text" name="correo" id="correo" placeholder="Correo electrónico" /> <br>
        <input type="text" name="pass" id="pass" placeholder="Escribe el password" /> <br>
        <br>
        <input onclick="validarCampos(); verificar_usuario();" type="button" value="Enviar" />
    </form>
    <div id="mensaje"></div>
</body>

</html>