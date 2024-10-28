<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 2</title>
</head>
<body>
<?php
  $numeros = array();

  for($i = 0; $i < 20; $i++) {
    $numeros[$i] = rand(0, 100);
  }

  $pares = array();
  $impares = array();
  foreach($numeros as $num) {
    if($num % 2 == 0) {
      array_push($pares, $num);
    } else {
      array_push($impares, $num);
    }
  }

  $numeros = array_merge($pares, $impares);

  var_dump($numeros);
?>
</body>
</html>