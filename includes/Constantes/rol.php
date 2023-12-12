<?php
if(session_id() == '') {
    session_start();
}
if(!isset($_SESSION['empresa_id'])){
    header("Location: login.php");
    die();
}else{

    $rol_id = $_SESSION["rol_id"];
}
// $rol_id = 3;

$disabled = "";
if(in_array("7", $rol_id) || in_array("1", $rol_id) || in_array("2", $rol_id)){

}else{
    $disabled = "readonly ='readonly'";
}

?>
<p style="display: none;font-size: 15px;" id="rol_id"><?php var_dump($rol_id); ?></p>

