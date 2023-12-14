<?php
session_start();
$empresa_id = $_SESSION["empresa_id"];
$absolute_path = getcwd();
$target_path = $absolute_path . "\documents\buss$empresa_id" . "\documents";
// echo $target_path;
// $files = ;

if(!file_exists( $absolute_path."\documents\buss$empresa_id" )){
    mkdir($absolute_path."\documents\buss$empresa_id",0777);
}
if(!file_exists( $absolute_path."\documents\buss$empresa_id\documents" )){
    mkdir($absolute_path."\documents\buss$empresa_id\documents");
}

$nombreArchivo = $_FILES['files']['name'];
$rutaArchivo = $target_path."\bsd$nombreArchivo";
echo $rutaArchivo;
if (move_uploaded_file($_FILES['files']['tmp_name'], $rutaArchivo)){
    echo 'Archivo subido con éxito: ' . $rutaArchivo;
} else {
    echo 'Error al subir el archivo.';
}