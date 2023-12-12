<?php

if(session_id() == '') {
    session_start();
}
if(!isset($_SESSION['empresa_id'])){
    header("Location: login.php");
    die();
}else{

    $empresaId = $_SESSION["empresa_id"];
}

// $empresaId = 1;
?>

<p style="display:none;font-size: 40px;" id="empresaId"><?=$empresaId?></p>