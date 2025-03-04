<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Has entrado</title>
</head>
<body>
  <?php
  // Si el usuario no está guardado en la sesión, nos lleva a index.php
  if(!isset($_SESSION['user'])) header("Location: index.php");

  // Si el usuario no es admin, no puede acceder a esta página
  if($_SESSION['user']['role'] == "user") {
    ?>
    <h1>NO TIENES ACCESO A ESTA PÁGINA</h1>
    <hr/>
    <a href="logout.php">Desconectar</a>
    <?php
  } else {
    ?>
    <h1>Estás en el menú de administración</h1>
    <hr/>
    <a href="logout.php">Desconectar</a>
    <?php
  }
  ?>
</body>
</html>

