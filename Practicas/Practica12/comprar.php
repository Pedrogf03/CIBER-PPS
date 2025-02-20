<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Artículo</title>
</head>

<body>
<?php 
if (isset($_POST["articulo"])){
  $conexion = new mysqli("localhost", "root", "", "demos");
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  $queEmp = "SELECT * FROM demos.articulos WHERE Id = ?";
  $stmt = $conexion->prepare($queEmp);

  $stmt->bind_param("i", $_POST["articulo"]);
  $stmt->execute();
  $resEmp = $stmt->get_result();
  $totEmp = $resEmp->num_rows;

  if($totEmp > 0) {
    while($rowEmp = $resEmp->fetch_assoc()) {
      echo 'Comprado el artículo: ' . $rowEmp["Nombre"] . ' con precio: ' . $rowEmp["Precio"];
    }
    
  }
}
?>
</body>
</html>
