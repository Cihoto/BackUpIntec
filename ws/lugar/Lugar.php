<?php
if ($_POST){
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    // Realiza la acción correspondiente según el valor de 'action'
    switch($action) {
        case 'addLugar':
            $request = $data->request;
            $result = addLugar($request);
            break;
        default:
            $result = false;
            break;
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo $result;
} else {
    require_once('./ws/bd/bd.php');
}


    function addLugar($request){
        $conn = new bd();
        $conn ->conectar();

        $today = date('Y-m-d');
        $lugar="";
        $direccion_id="";

        foreach($request as $req){
            $lugar= $req->lugar;
            $direccion_id = $req->direccion_id;
        }
        $query = "INSERT INTO lugar
                (lugar, createAt, direccion_id)
                VALUES('".$lugar."', '".$today."', $direccion_id )";
        if($conn->mysqli->query($query)){
            $insert_id = $conn->mysqli->insert_id;
            $conn->desconectar();
            return json_encode(array("id_lugar"=> $insert_id)) ;
        }else{
            $conn->desconectar();
            return false;
        }
    } 


?>