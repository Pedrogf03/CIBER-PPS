<?php

//Inicializamos la sesión
session_start();

if (isset($_SESSION["usuario_valido"])) {
?>

<h1>Logged in</h1>




<hr>

<p> <a href='logout.php'>Desconectar</a> </p>

<?php


}else{
   echo "Acceso no autorizado";
}


?>


