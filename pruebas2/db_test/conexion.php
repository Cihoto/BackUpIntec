<?php
$dbname="intec";
$host="mysql.aguirrebena.cl";
$user="eduagdo";
$password="Uai.eduardo";


$link= mysqli_connect($host, $user, $password, $dbname);
if(!$link)
    echo "no conectado";
else
    echo "conectado";
?>
