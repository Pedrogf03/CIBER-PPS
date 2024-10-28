<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
  // Si el usuario no está guardado en la sesión, nos lleva a index.php
  if(!isset($_SESSION['user'])) header("Location: index.php");
  ?>
  <h1>Logged in</h1>
  <hr/>
  <a href="logout.php">Desconectar</a>
</body>
</html>