<?php
// Iniciar sesión
session_start();
$_SESSION = array();
include("simple-php-captcha/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

// Comprobar Si se ha enviado el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Comprobar que el usuario está autorizado a entrar
    $usuario = $_REQUEST['usuario'];
    $clave = $_REQUEST['clave'];

    //Conexión y consulta a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "demos")
    or die ("No se puede conectar con el servidor");

    /* Version 1*/
    $consulta = "SELECT * FROM usuarios where user = '$usuario' and pass = '$clave'";
    $resultado = mysqli_query($conexion, $consulta);

    $num_filas = mysqli_num_rows($resultado);

    var_dump($_SESSION['captcha']['code']);

    //Los datos introducidos son correctos. Se registra la sesión y se redirige al menu.
    if($num_filas > 0 /*&& $captcha == $_SESSION['captcha']['code']*/){
        $usuario_valido = $usuario;

        $_SESSION["usuario_valido"] = $usuario_valido;
		
        header("location: menu.php");
		//echo "logged in";
    }else{
        $error = "Acceso no autorizado";
    }

    //Cerramos la conexión a la base de datos
    mysqli_close($conexion);
}
?>

<html>
<head>
    <title>Aplicación Login</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
// Sesión iniciada
if (isset($_SESSION["usuario_valido"])) {
    header("location: menu.php");
   //echo " logged in";
}

// Sesión no iniciada
else
{
    ?>
    <p class='parrafocentrado'>Acceso a la aplicación.<br>Para entrar debe identificarse</p>

    <form class="entrada" name="login" action="index.php" method="POST">
        <p>
            <label class="etiqueta-entrada">Usuario: </label>
            <input type="text" name="usuario"/>
        </p>
        <p>
            <label class="etiqueta-entrada">Contraseña: </label>
            <input type="password" name="clave"/>
        </p>
        <p>
            <img src="<?php echo $_SESSION['captcha']['image_src'] ?>" alt="CAPTCHA code">
        </p>
        <p>
            <input type="text" name="captcha">
        </p>
        <p><input type="submit" value="entrar"/></p>
    </form>

    <p class='parrafocentrado'><?php if(isset($error)) echo $error; ?></p>

    <?php
}
?>

</body>
</html>

