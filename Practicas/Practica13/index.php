<?php 
  // Inicio de la sesión
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Práctica 2</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <?php
    // Si el usuario está guardado en la sesión, nos lleva a procesa.php
    if(isset($_SESSION['user']))  {
      header("Location: procesa.php");
      exit();
    }
  ?>
    <div class="content">
      <form action="./procesa.php" method="POST">
        <h1>Acceso a la aplicación</h1>
        <h3>Para entrar debe identificarse</h3>
        <div>
          <label for="user">Usuario</label>
          <input type="text" name="user" />
        </div>
        <div>
          <label for="passwd">Contraseña</label>
          <input type="text" name="passwd" />
        </div>
        <button type="submit">Entrar</button>
      </form>
    </div>
</body>
</html>
