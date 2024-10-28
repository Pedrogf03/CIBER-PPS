<?php
// Inicia la sesión
session_start();

// Elimina la sesión
session_unset();
session_destroy();

// Nos lleva de vuelta al index.php
header("Location: index.php");

?>