<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 3</title>
</head>
  <body>
    <?php
    setlocale(LC_TIME, 'es_ES.UTF-8', 'spanish');
    $fecha = strftime("%e de %B de %Y");
    echo("Hoy es día $fecha");
    ?>
  </body>
</html>