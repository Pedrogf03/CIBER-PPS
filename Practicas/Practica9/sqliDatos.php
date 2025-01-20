<html>
<head></head>
<body>

<?php 
session_start();
echo 'Hola, soy el usuario: '. $_SESSION['username'];
?>
</form>
</body>
</html>