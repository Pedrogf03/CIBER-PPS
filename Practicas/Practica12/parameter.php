<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Artículos</title>
</head>

<body>
<?php
$conexion = new mysqli("localhost", "root", "", "demos");
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

$queEmp = "SELECT * FROM demos.articulos";

$resEmp = $conexion->query($queEmp);
$totEmp = $resEmp->num_rows;

if ($totEmp> 0) {
?>
  <div class="table">
    <table>
      <tr>
        <th>Artículo</th>
        <th>Precio</th>
        <th>Acción</th>
      </tr>
      <?php
      while($rowEmp = $resEmp->fetch_assoc()) {
        ?>
        <tr>
          <td><?=$rowEmp['Nombre']?></td>
          <td><?=$rowEmp['Precio']?></td>
          <td>
            <form action="comprar.php" method="post">
              <input type="hidden" name="articulo" value="<?=$rowEmp['Id']?>">
              <button type="submit">Comprar</button>
            </form>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>
<?php
}
?>
</body>

</html>
