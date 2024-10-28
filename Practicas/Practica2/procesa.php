<?php 
  // Se inicia la sesión
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
  // Si el usuario está guardado en la sesión, nos lleva a menu.php
  if(isset($_SESSION['user'])) header("Location: menu.php");

  if((isset($_POST['user']) && $_POST['user'] != "") && (isset($_POST['passwd']) && $_POST['passwd']) != "") {
    // Si se han recibido los datos del usuario por POST y no están en blanco

    $user = $_POST['user'];
    $passwd = $_POST['passwd'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practica1";

    // Conexión con la BBDD
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para obtener el usuario y contraseña
    $sql = "SELECT * FROM usuario WHERE user = ? AND passwd = ?";
    $result = $conn->prepare($sql);
    $result->bind_param('ss', $user, $passwd);
    $result->execute();
    $result->store_result();

    if($result->num_rows == 1) {
      // Si se recibe un registro, se guarda en la sesión el usuario y nos lleva a menu.php
      $_SESSION['user'] = $user;
      header("Location: menu.php");
      exit();
    } else {
      // Si no, imprime un mensaje por pantalla
      echo "<h1>USUARIO NO VALIDO</h1>";
    }

    $result->close();
    $conn->close();

  } else {
    // Si no, imprime un mensaje por pantalla
    echo "<h1>ACCESO NO AUTORIZADO</h1>";
  }
  ?>
</body>
</html>