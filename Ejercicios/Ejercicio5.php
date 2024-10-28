<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Bicicleta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 300px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        #resumen {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h1>Pedido de Bicicleta</h1>

<form id="pedidoForm" action="" method="POST">
    <label for="nombre">Nombre del Cliente:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="modelo">Modelo de Bicicleta:</label>
    <select id="modelo" name="modelo" required>
        <option value="Mountain Bike">Mountain Bike</option>
        <option value="Plegable">Plegable</option>
        <option value="Eléctrica">Eléctrica</option>
    </select>

    <label>Extras:</label>
    <input type="checkbox" id="luces" name="extras[]" value="Luces">
    <label for="luces">Luces</label><br>
    <input type="checkbox" id="bombin" name="extras[]" value="Bombín">
    <label for="bombin">Bombín</label><br>
    <input type="checkbox" id="canasta" name="extras[]" value="Canasta">
    <label for="canasta">Canasta</label>

    <label for="candado">Código del Candado:</label>
    <input type="password" id="candado" name="candado" required>

    <label for="observaciones">Observaciones:</label>
    <textarea id="observaciones" name="observaciones" rows="4"></textarea>

    <input type="submit" value="Enviar Pedido">
</form>

<?php
// Procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tienda_bicicletas";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $extras = isset($_POST['extras']) ? implode(", ", $_POST['extras']) : 'Ninguno';
    $candado = $_POST['candado'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';

    // Validar que no estén vacíos los campos requeridos
    if (empty($nombre) || empty($modelo) || empty($candado)) {
        echo "Faltan campos requeridos.";
        exit;
    }

    // Preparar y ejecutar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO pedidos (nombre_cliente, modelo, extras, codigo_candado, observaciones) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $modelo, $extras, $candado, $observaciones);

    if ($stmt->execute()) {
        echo "Pedido realizado con éxito.";
    } else {
        echo "Error al realizar el pedido: " . $stmt->error;
    }

    // Cerrar conexiones
    $stmt->close();
    $conn->close();
}
?>

</body>
</html>