<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados para la navbar */
        .navbar-custom {
            background-color: #333;
            border-radius: 5px;
            margin-bottom: 50px;
        }

        .navbar-custom .nav-link {
            color: aquamarine !important;
            font-size: 17px;
            transition: background-color 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            background-color: #575757;
            color: white !important;
        }

        #logo {
            width: 80px;
            height: 60px;
            padding: 10px;
        }

        /* Estilos personalizados para el footer */
        .footer-custom {
            background-color: #333;
            color: aquamarine;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
            border-radius: 5px;
        }

        .footer-custom a {
            color: aquamarine;
            text-decoration: none;
        }

        .footer-custom a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <img id="logo" src="archivos/logo.png" alt="">
            <a class="navbar-brand text-aquamarine" href="#">Tech-Products</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productos_lista.php">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">CONTACTO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php">CARRITO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="funciones/cerrar_sesion.php">Cerrar sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido de la página -->
    <div class="container">
        <!-- Tu contenido aquí -->
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
