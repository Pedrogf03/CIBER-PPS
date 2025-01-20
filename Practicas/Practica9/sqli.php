<html>
<head></head>
<body>
<form action="sqli.php" method="get">
Login: <input type="text" name="user">
Pass: <input type="text" name="pass">
<input type="submit">

<?php 
if (isset($_GET["user"])){
   $conexion = mysqli_connect("localhost", "root", "", "demos") or die ("No se puede conectar con el servidor");

   $queEmp = "SELECT * FROM usuarios where user ='".$_GET["user"]."' and pass='".$_GET["pass"]."'";
   $resEmp = mysqli_query($conexion, $queEmp);
   $totEmp = mysqli_num_rows($resEmp);

   if ($totEmp> 0) {
      $rowEmp = mysqli_fetch_assoc($resEmp);
      $usuario=$rowEmp['user'];
      session_create_id();
      session_start();
      session_regenerate_id(true);
      $_SESSION['username'] = $usuario;
      
      echo "<br></br>";
      echo "El usuario es: ".$usuario;
      echo "<br></br>";
      echo "<a href='sqliDatos.php'>Ver datos</a>";
   } else {
      echo "Usuario o password incorrecto";
   }

}
?>
</form>
</body>
</html>