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
  // Si el usuario ya está logueado, se redirige a la página correspondiente
  if(isset($_SESSION['user'])) {
    // Si el usuario es admin, se redirige a menu_admin.php, si no, a menu.php
    $redirectPage = $_SESSION['user']['role'] == "admin" ? "menu_admin.php" : "menu.php";
    header("Location: $redirectPage");
    exit();
  }

  // Si se recibe un usuario y contraseña, se procede a comprobar si son correctos
  if((isset($_POST['user']) && $_POST['user'] != "") && (isset($_POST['passwd']) && $_POST['passwd']) != "") {

    $user = $_POST['user'];
    $passwd = $_POST['passwd'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practica13";

    // Conexión con la BBDD
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para comprobar si el usuario y contraseña son correctos y obtener el rol
    $sql = "SELECT * FROM usuario WHERE user = ? AND passwd = ?";
    $result = $conn->prepare($sql);
    $result->bind_param('ss', $user, $passwd);
    $result->execute();
    $result->store_result();

    if($result->num_rows == 1) {
      // Obtener los datos del usuario
      $result->bind_result($id, $user, $passwd, $role);
      $result->fetch();
      
      // Guardar en la sesión el usuario y el rol
      $_SESSION['user']['name'] = $user;
      $_SESSION['user']['role'] = $role;
      
      // Redirigir según el rol
      if ($role == "admin") {
        header("Location: menu_admin.php");
      } else {
        header("Location: menu.php");
      }
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