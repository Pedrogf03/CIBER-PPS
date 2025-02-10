<?php

//Inicializamos la sesión
session_start();

//Eliminamos las variables de sesión
$_SESSION = array();

//Destruir la sesión
session_destroy();

header("location: index.php");