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

  if($_SESSION['user']['role'] == "user" || $_SESSION['user']['role'] == "admin") {
    ?>
    <h1>Estás en el menú de usuario</h1>
    <hr/>
    <a href="logout.php">Desconectar</a>
    <?php
  }
  ?>
</body>
</html>