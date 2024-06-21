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
            var nombre = $('#nombre').val();
            var correo = $('#correo').val();
            var pass = $('#pass').val();

            if (correo === '' || pass === '' || nombre === '') {
                $('#mensaje').html('Faltan campos por llenar'); 
            } else {
                $('#mensaje').html(''); // Limpiar mensaje de error si no hay campos vacíos
                document.Forma01.method = 'post';
                document.Forma01.action = 'funciones/funcion_registrar.php';
                document.Forma01.submit();
            }
        }
    </script>

</head>

<body>
    <h2>Registrate</h2>
    <form name="Forma01" method="post" action="funciones/funcion_registrar.php">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" /> <br>
        <input type="text" name="correo" id="correo" placeholder="Correo electrónico" /> <br>
        <input type="text" name="pass" id="pass" placeholder="Escribe el password" /> <br>
        <br>
        <input onclick="validarCampos();" type="button" value="Enviar" />
    </form>
    <div id="mensaje"></div>
</body>

</html>