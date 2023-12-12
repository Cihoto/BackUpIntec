<?php
if(session_id() == '') {
    session_start();
}
if(!isset($_SESSION['empresa_id'])){
    header("Location: login.php");
    die();
}else{
    $personal_ids = json_encode($_SESSION["personal_ids"]);
}
?>

