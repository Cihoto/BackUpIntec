<?php

if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    
    if(isset($data->vehicleData)){
        $datav = $data->vehicleData;
    }

    switch ($action) {
        case 'getCategorias':
            $empresaId = $data->empresaId;
            $categorias = GetCategorias($empresaId);
            echo json_encode($categorias);
            break;
        case 'AddCategorias':
            $request = $data->request;
            $empresaId = $data->empresaId;
            $categorias = AddCategorias($request,$empresaId);
            echo json_encode($categorias);
            break;
        default:
            echo 'Invalid action.';
            break;
    }

}else{
    require_once('./ws/bd/bd.php');
}


function GetCategorias($empresaId){
    
    $conn = new bd();
    $conn->conectar();

    $querySelectCategorias ="SELECT c.id,c.nombre  from categoria c 
                            INNER JOIN categoria_has_item chi on chi.categoria_id = c.id 
                            INNER JOIN producto p on p.categoria_has_item_id =chi.id 
                            where p.empresa_id = $empresaId
                            GROUP BY c.nombre";

    $responseBd = $conn->mysqli->query($querySelectCategorias);

    while($dataResponseBd = $responseBd->fetch_object()){
        $response []= $dataResponseBd;
    }

    return $response;

}

function AddCategorias($request,$empresaId){
    
    $conn =  new bd();
    $conn->conectar();
    $arrayIdsInserted = [];
    $today = date('Y-m-d');

    for($i = 0 ; $i < count($request); $i++){

        $queryInsertCategoria = "INSERT INTO categoria
                        (nombre, createAt,IsDelete,empresa_id)
                        VALUES('".trim($request[$i])."','".$today."',0,$empresaId)";

        if($conn->mysqli->query($queryInsertCategoria)){
            array_push($arrayIdsInserted,$conn->mysqli->insert_id);
        }
    }
    return $arrayIdsInserted;
}

?>



