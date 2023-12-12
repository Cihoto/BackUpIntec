<?php
if ($_POST) {
    require_once('../bd/bd.php');
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;

    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'CloseSession':
            $response = CloseSession();
            
            echo json_encode($response);
            break;
        default:
            echo 'Invalid action.';
            break;
    }
}else{
    require_once('./ws/bd/bd.php');
}
function CloseSession(){
    session_start();
    session_destroy();
    return true;
}
?>