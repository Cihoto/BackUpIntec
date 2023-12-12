<?php

if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;

    switch ($action) {
        case 'getItems':
            $empresaId = $data->empresaId;
            $marcas = GetItems($empresaId);
            echo json_encode($marcas);
            break;
        case 'AddItems':
            $request = $data->request;
            $empresaId = $data->empresaId;
            $items = AddItems($request,$empresaId);
            echo json_encode($items);
            break;
        default:
            echo 'Invalid action.';
            break;
    }

}else{
    require_once('./ws/bd/bd.php');
}


function GetItems($empresaId){
    
    $conn = new bd();
    $conn->conectar();

    $querySelectMarca ="SELECT i.item,i.id  from item i 
                        INNER JOIN categoria_has_item chi on chi.item_id = i.id
                        INNER JOIN producto p on p.categoria_has_item_id =chi.id 
                        where p.empresa_id = $empresaId
                        GROUP BY i.item";

    $responseBd = $conn->mysqli->query($querySelectMarca);

    while($dataResponseBd = $responseBd->fetch_object()){
        $response []= $dataResponseBd;
    }

    return $response;

}

function AddItems($request,$empresaId){
    $conn =  new bd();
    $conn->conectar();
    $arrayIdsInserted = [];
    $today = date('Y-m-d');

    for($i = 0 ; $i < count($request); $i++){

        $queryInsertCategoria = "INSERT INTO item
                        (item, createAt,  IsDelete,empresa_id)
                        VALUES('".trim($request[$i])."', '".$today."', 0, $empresaId)";
        if($conn->mysqli->query($queryInsertCategoria)){
            array_push($arrayIdsInserted,$conn->mysqli->insert_id);
        }
    }
    
    return $arrayIdsInserted;

  
}
?>