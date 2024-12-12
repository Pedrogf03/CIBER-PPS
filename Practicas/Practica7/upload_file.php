<?php

// Estas son las extensiones que vamos a permitir.
$allowedExtensions = array("pdf", "jpg");
$allowedTypes = array("application/pdf", "image/jpeg");

// Este es el límite de tamaño del archivo (2MB en bytes).
$maxFileSize = 2 * 1024 * 1024; // 2 MB = 2 * 1024 * 1024 bytes

// Obtenemos la extensión y el tipo del archivo que se ha subido.
$fileExtension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
$fileType = mime_content_type($_FILES["file"]["tmp_name"]);

// Saneamiento del nombre del archivo para evitar caracteres no válidos.
$originalFileName = basename($_FILES["file"]["name"]);
$safeFileName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $originalFileName);

if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
} else {
    if (file_exists("upload/" . $safeFileName)) {
        echo $safeFileName . " already exists. ";
    } else {
        // Verificar el tamaño del archivo.
        if ($_FILES["file"]["size"] > $maxFileSize) {
            echo "El archivo excede el tamaño máximo permitido de 2 MB.";
        } else {
            // Verificar si el archivo cumple con las condiciones de extensión y tipo.
            if (in_array($fileExtension, $allowedExtensions) && in_array($fileType, $allowedTypes)) {
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $safeFileName);
                echo "Stored in: " . "upload/" . $safeFileName;
            } else {
                echo "Tipo de archivo no válido. Sólo se permiten archivos .pdf y .jpg";
            }
        }
    }
}

?>
