<?php
require_once('../bd/bd.php');
if($json = file_get_contents('php://input')){
   
    $data = json_decode($json);
    $request = $data->request;
    $tipo = $data->tipo;
    if($tipo === "getProject"){
        echo getProjectResume($request);
    }
}

function getProjectResume($request){
    $conn = new bd();
    $conn->conectar();

    $asignados = [];
    $projects = [];


    foreach ($request as $key => $value) {
        $idProject = $value->idProject;
        if(isset($value->asignados)){
            $queryAsignados = "SELECT v.id, v.patente from vehiculo v 
            INNER JOIN proyecto_has_vehiculo phv ON phv.vehiculo_id = v.id 
            INNER JOIN proyecto p on p.id = phv.proyecto_id 
            WHERE p.id = $idProject";
        }
    }

    $query = "SELECT p.nombre_proyecto as proyecto, p.fecha_inicio,
            p.fecha_termino,d.direccion ,d.numero, d.dpto,co.comuna,
            r.region,c.nombre as nombre_cliente, v.patente, p.comentarios
            FROM proyecto p 
            INNER JOIN cliente c on c.id = p.cliente_id 
            INNER JOIN empresa e on e.id = p.empresa_id 
            LEFT JOIN gastos g on g.id = p.gastos_id 
            INNER JOIN lugar l on l.id = p.lugar_id 
            INNER JOIN direccion d on d.id  = l.direccion_id 
            LEFT JOIN arriendos a on a.id  = p.arriendos_id 
            INNER JOIN comuna co on co.id =d.comuna_id 
            INNER JOIN region r on r.id  = co.region_id 
            LEFT JOIN proyecto_has_vehiculo phv ON phv.proyecto_id =p.id 
            LEFT JOIN vehiculo v on v.id = phv.vehiculo_id 
            WHERE p.id = $idProject";

    if($responseBd = $conn->mysqli->query($query)){
        while($dataProject = $responseBd->fetch_object()){
            $projects [] = $dataProject;
        }
    }
    if(isset($queryAsignados)){
        if($responseBd = $conn->mysqli->query($queryAsignados)){
            while($dataAsignados = $responseBd->fetch_object()){
                $asignados [] = $dataAsignados;
            }
        }
    }

    return json_encode(array("dataProject"=>$projects,"asignados"=>$asignados));
}

?>