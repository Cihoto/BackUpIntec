<?php

//IF PARA AJAX CALL
    if($json = file_get_contents('php://input')){
        $data = json_decode($json);
        $request = $data->request;
        $tipo = $data->tipo;

        if($tipo === "addtoProject"){
            echo addToProject($request);
        }
    }

function getPersonal($empresaId){
    require_once ('../bd/bd.php');
    $conn = new bd();
    $conn->conectar();
    $personal= [];
    $queryPersonal = "SELECT  p.id, CONCAT(p.nombre,' ',p.apellido) as nombre, c.cargo, es.especialidad  from personal p 
                        INNER JOIN especialidad es on es.id  = p.especialidad_id 
                        INNER JOIN cargo c ON c.id = p.cargo_id 
                        INNER JOIN empresa e on e.id = p.empresa_id 
                        where e.id = $empresaId";

    if($responseBd = $conn->mysqli->query($queryPersonal)){
        while($dataPersonal = $responseBd->fetch_object()){
            $personal [] = $dataPersonal;
        }
    }
    $conn->desconectar();
    return $personal;
}


function addtoProject($request){
    require_once ('../bd/bd.php');

    $conn = new bd();
    $conn ->conectar();

    $arrayResponse = [];
    
    foreach($request as $req){

        $idProject = $req->idProject;
        $idPersonal = $req->idPersonal;
        $query = "INSERT INTO intec.personal_has_proyecto
            (personal_id, proyecto_id)
            VALUES($idPersonal, $idProject)";

        if($conn->mysqli->query($query)){
            array_push($arrayResponse, array("Asignado"=>array("id"=>$idPersonal)));
        }else{
            array_push($arrayResponse, array("NoAsignado"=>array("id"=>$idPersonal)));
        }
    }
    $conn->desconectar();
}
?>