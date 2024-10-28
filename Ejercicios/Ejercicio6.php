<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 6</title>
</head>
<body>
  <?php
  // Comprueba si se ha recibido el nombre
  if(isset($_POST["nombre"])) {
    // Guarda el nombre en la sesión
    $_SESSION["nombre"] = $_POST["nombre"];
  }

  // Cerrar sesión si se ha recibido el parámetro 'logout'
  if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./Ejercicio6.php");
    exit();
  }

  // Comprueba si existe la variable nombre en la sesión
  if(isset($_SESSION['nombre'])) {
    // Se guarda en una variable
    $nombre = $_SESSION['nombre'];
    ?>
    <!-- Se muestra el nombre -->
    <h1>Tu nombre es <?=$nombre?></h1>
    <!-- Botón para cerrar la sesión -->
    <form action="./Ejercicio6.php" method="POST">
      <button type="submit" name="logout" value="1">Cerrar sesión</button>
    </form>
    <?php
  // Si no existe la variable nombre en la sesión
  } else {
    ?>
    <!-- Se muestra un formulario para introducir el nombre -->
    <form action="./Ejercicio6.php" method="POST">
      <input type="text" name="nombre">
      <input type="submit" value="Enviar">
    </form>
    <?php
  }
  ?>
</body>
</html>