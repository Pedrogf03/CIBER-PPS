<html>
    <head>
        <link rel="stylesheet" type="text/css" href="table.css">
    </head>
    <body>
        <div class="form">
            <form action="sqli2.php" method="get">
                Artículo: <input type="text" name="articulo">
                <input type="submit">
        </div>
        <?php
        if (isset($_GET["articulo"])) {
            $conexion = new mysqli("localhost", "root", "", "demos") or die ("No se puede conectar con el servidor");

            $sql = "SELECT * FROM demos.articulos where Nombre = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('s', $_GET["articulo"]);
            $stmt->execute();

            $result = $stmt->get_result();
            $totEmp = $result->num_rows;

            if ($totEmp > 0) {
                echo '<div  class="table">';
                echo '<table>';
                echo "<tr><th>Artículo</th><th>Precio</th></tr>";
                while ($rowEmp = $result->fetch_assoc()) {
                    echo "<tr><td> " . $rowEmp['Nombre'] . "</td><td> " . $rowEmp['Precio'] . "</td></tr>";
                }
                echo '</table>';
                echo '</div>';
            } else {
                echo "Artículo no encontrado. :(";
            }

            $stmt->close();
            $conexion->close();

        }
        ?>
        </form>
    </body>
</html>
