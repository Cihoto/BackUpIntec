<?php
    require_once('../bd/bd.php');
    
    $conn = new bd();

    $conn ->conectar();

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    


    $vehicleArray = $data;
    $returnErrArray = [];
    $countTotal = 0;
    $counter = 0;


    foreach ($vehicleArray as $key => $value){

        $patente = $value->patente;
        $empresaId = $value->empresaId;
        
     
        $query = "INSERT INTO vehiculo
                (patente, IsDelete, empresa_id)
                VALUES('".$patente."', 0, $empresaId)";
        if($conn->mysqli->query($query)){
            $counter++;
        }
        $countTotal ++;
    }

    echo json_encode(array("data"=>'Se han ingresado '.$counter.' de '.$countTotal));
?>