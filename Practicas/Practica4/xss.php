<html>
  <head></head>
  <body>
    <form action="" method="get">
        Introduce Nombre: <input type="text" name="nombre">
        <input type="submit">
    </form>

    <?php 
      if (isset($_GET["nombre"])) {
        // Sanear la entrada del usuario
        $nombre = htmlspecialchars($_GET["nombre"], ENT_QUOTES, 'UTF-8');
        echo "Hola " . $nombre;
      }
    ?>
  </body>
</html>
