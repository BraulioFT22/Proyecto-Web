<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>D-Products</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <link rel="stylesheet" href="css/contacto.css"> <!-- Asegúrate de que esta ruta sea correcta -->
  <style>
    /* Aquí puedes agregar tus estilos personalizados */
    .container-contact100 {
      padding: 50px 0;
    }
    .contact100-form {
      max-width: 500px;
      margin: auto;
      background-color: #f9f9f9;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    .contact100-form-title {
      font-size: 24px;
      margin-bottom: 30px;
      text-align: center;
      color: #333;
    }
    .wrap-input100 {
      position: relative;
      margin-bottom: 20px;
    }
    .input100 {
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      font-size: 16px;
    }
    .wrap-contact100 .contact100-pic {
      display: none; /* Si no quieres mostrar la imagen, puedes ocultarla */
    }
    .contact100-form-btn {
      width: 100%;
      background-color: #333;
      color: #fff;
      border: none;
      padding: 15px;
      font-size: 18px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .contact100-form-btn:hover {
      background-color: #555;
    }
  </style>
</head>
<body>

  <!--Navbar-->
  <?php include("menu.php"); ?>

  <!--Formulario-->
  <div class="bg-contact100">
    <div class="container-contact100">
      <div class="wrap-contact100">
        <form method="post" action="funciones/enviar_correo.php" class="contact100-form validate-form">
          <span class="contact100-form-title">Contactanos</span>
          <div class="wrap-input100 validate-input" data-validate="Name is required">
            <input class="input100" type="text" name="name" placeholder="Name">
          </div>
          <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="email" name="email" placeholder="Email">
          </div>
          <div class="wrap-input100 validate-input" data-validate="Message is required">
            <textarea class="input100" name="message" placeholder="Message"></textarea>
          </div>
          <div class="container-contact100-form-btn">
            <button type="submit" class="contact100-form-btn" name="enviar">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
<footer class="footer-custom">
        <div class="container">
            <p>&copy; 2024 Tech-Products || Braulio Flores Toscano Todos los derechos reservados.</p>
            <p>
                <a href="#">Política de Privacidad</a> |
                <a href="#">Términos de Servicio</a> |
                <a href="contacto.php">Contacto</a>
            </p>
        </div>
    </footer>
</html>
