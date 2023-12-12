<?php

if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    
    if(isset($data->vehicleData)){
        $datav = $data->vehicleData;
    }



    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'getVehiculos':
            // Recibe el parámetro empresaId
            $empresaId = $data->empresaId;
            
            // Llama a la función getVehiculos y devuelve el resultado
            $vehiculos = getVehiculos($empresaId);
            echo json_encode($vehiculos);
            break;
        
        case 'getAvailableVehiculos':
            // Recibe el parámetro empresaId
            $request = $data->request->arrayRequest;
            // Llama a la función getAvailableVehiculos y devuelve el resultado
            $vehiculos = getAvailableVehiculos($request);
            echo json_encode($vehiculos);
            break;
        
        case 'addVehicleToProject':
            // Recibe el parámetro request
            $request = $data->request;
            
            // Llama a la función addtoProject y devuelve el resultado
            $response = addVehicleToProject($request);
            echo json_encode($response);
            break;
        
        case 'dropAssigmentVehicles':
            // Recibe el parámetro request
            $idProject = $data->idProject;
            // Llama a la función addtoProject y devuelve el resultado
            $deleteIds = dropAssigmentVehicles($idProject);
            echo json_encode($deleteIds);
            break;
        
        case 'getAssigned':
            // Recibe el parámetro empresaId
            $empresaId = $_POST['empresaId'];
            
            // Llama a la función getAssigned y devuelve el resultado
            $assigned = getAssigned($empresaId);
            echo json_encode($assigned);
            break;
        
        case 'deleteVehicle':
            // Recibe el parámetro arrayIdVehicles
            $arrayIdVehicles = $data->arrayIdVehicles;
            
            // Llama a la función deleteVehicle y devuelve el resultado
            $response = deleteVehicle($arrayIdVehicles);
            echo $response;
            break;
        
        case 'addVehicle':
            // Recibe el parámetro vehicleData
            $vehicleData = $data->vehicleData;
            $empresaId = $data->empresaId;
            
            // Llama a la función addVehicle y devuelve el resultado
            $response = addVehicle($vehicleData,$empresaId);
            echo $response;
            break;
        
        default:
            echo 'Invalid action.';
            break;
    }
}else{
    require_once('./ws/bd/bd.php');
}



function getVehiculos($empresaId)
{
    $conn = new bd();
    $conn->conectar();
    $vehiculos = [];
    $queryVehiculos = "SELECT v.id,v.patente,v.ownCar,v.tripValue,tv.tipo FROM vehiculo v 
    LEFT JOIN persona p ON p.id = v.persona_id
    INNER JOIN tipo_vehiculo tv ON tv.id = v.tipoVehiculo_id
    INNER JOIN empresa e ON e.id = v.empresa_id 
    WHERE e.id = $empresaId AND v.IsDelete = 0";

    if ($responseBdVehiculos = $conn->mysqli->query($queryVehiculos)) {
        while ($dataVehiculos = $responseBdVehiculos->fetch_object()) {
            $vehiculos[] = $dataVehiculos;
        }
    }
    $conn->desconectar();
    return $vehiculos;
}

function getAvailableVehiculos($request)
{
    $conn = new bd();
    $conn->conectar();
    $vehiculos = [];

    foreach($request as $req){
        $empresaId = $req->empresaId;
        $fechaInicio = $req->fechaInicio;
        $fechaTermino = $req->fechaTermino;
    }

    $queryVehiculos = "SELECT v.id,v.patente FROM vehiculo v
                        LEFT JOIN proyecto_has_vehiculo phv on phv.vehiculo_id = v.id
                        LEFT  JOIN proyecto p on p.id = phv.proyecto_id
                        where p.id IS NULL 
                        or '".$fechaInicio."' < p.fecha_inicio and '".$fechaTermino."' < p.fecha_inicio 
                        or '".$fechaInicio."' > p.fecha_termino and '".$fechaTermino."' > p.fecha_termino
                        and p.empresa_id = $empresaId";

    if ($responseBdVehiculos = $conn->mysqli->query($queryVehiculos)) {
        while ($dataVehiculos = $responseBdVehiculos->fetch_object()) {
            $vehiculos[] = $dataVehiculos;
        }
    }
    $conn->desconectar();
    return $vehiculos;
}

function addVehicleToProject($request)
{
    $conn = new bd();
    $conn->conectar();
    $arrayResponse = [];
    $idProject = 0;
    
    foreach (array_slice($request, 0, 1) as $req) {
        $idProject = $req->idProject;
    }

    $queryIfAssigned = "SELECT * from proyecto_has_vehiculo phv where phv.proyecto_id =$idProject";

    if($conn->mysqli->query($queryIfAssigned)->num_rows>0){
        $qdelete = "DELETE FROM proyecto_has_vehiculo WHERE proyecto_id =$idProject";
        $conn->mysqli->query($qdelete);
    }

    foreach ($request as $req) {
        $idVehicle = $req->idVehicle;
        $trip_value = $req->trip_value;
        $trip_count = $req->trip_count;
        $query = "INSERT INTO proyecto_has_vehiculo
                (proyecto_id, vehiculo_id,price_per_trip,trip_count)
                VALUES($idProject, $idVehicle, $trip_value,$trip_count)";
        if ($conn->mysqli->query($query)) {
            array_push($arrayResponse, array("Asignado" => array("id" => $idVehicle)));
        } else {
            array_push($arrayResponse, array("NoAsignado" => array("id" => $idVehicle)));
        }
    }
    $conn->desconectar();
    return $arrayResponse;
}

function dropAssigmentVehicles($idProject){
    $conn = new bd();
    $conn->conectar();
    $queryIfAssigned = "SELECT * from proyecto_has_vehiculo phv where phv.proyecto_id =$idProject";

    if($conn->mysqli->query($queryIfAssigned)->num_rows>0){
        $qdelete = "DELETE FROM proyecto_has_vehiculo WHERE proyecto_id =$idProject";
        $conn->mysqli->query($qdelete);
    }

    return $conn->mysqli->affected_rows;
}

function getAssigned($empresaId)
{
    $conn = new bd();
    $conn->conectar();
    $vehiculos = [];
    $queryVehiculos = "SELECT v.id ,v.patente ,v.personal_id  FROM vehiculo v
                                INNER JOIN personal p on p.id = v.personal_id 
                                INNER JOIN empresa e on e.id = p.empresa_id 
                                WHERE e.id = $empresaId";

    if ($responseBdVehiculos = $conn->mysqli->query($queryVehiculos)) {
        while ($dataVehiculos = $responseBdVehiculos->fetch_object()) {
            $vehiculos[] = $dataVehiculos;
        }
    }
    $conn->desconectar();
    return $vehiculos;
}




function deleteVehicle($arrayIdVehicles)
{
    $conn = new bd();
    $conn->conectar();

    $today = date('Y-m-d');
    $arrayResponse = [];

    foreach ($arrayIdVehicles as $persona) {

        $queryDelete = 'update vehiculo set IsDelete = 1, deleteAt = "' . $today . '" where id = ' . $persona->id;

        if ($conn->mysqli->query($queryDelete)) {
            $arrayResponse = json_encode(array("status" => 1, "message" => "Se ha eliminado exitosamente "));
        } else {
            $arrayResponse = json_encode(array("status" => 0, "message" => "Error al eliminar"));
        }
    }

    $conn->desconectar();
    return $arrayResponse;
}

function addVehicle($vehicleData, $empresaId)
{
    $conn = new bd();
    $conn->conectar();
    // return json_encode($vehicleData);
    $returnErrArray = [];
    foreach ($vehicleData->arrayRequest as $value) {
        
        $patente = $value->patente;
        $nombre = $value->nombre;

        if($nombre !== ""){  
            
            $query = 'select p.id from personal p 
                    where CONCAT(LOWER(p.nombre)," ",LOWER(p.apellido))="'.trim(strtolower(($nombre))).'" LIMIT 1';

            $responseBd = $conn->mysqli->query($query);
            if ($responseBd->num_rows > 0) {
                $value = $responseBd->fetch_object();
                $idPersonal = $value->id;
                
            } else {
                $idPersonal = "null";
                // array_push($returnErrArray, array("nombre" => $nombre, "patente" => $patente));
            }

        }else{
            $idPersonal = "null";
        }
        $query = "INSERT INTO vehiculo
        (patente, IsDelete, empresa_id, persona_id)
        VALUES('".$patente."', 0, $empresaId, $idPersonal)";

        $conn->mysqli->query($query);
    }

    if (count($returnErrArray) > 0) {
        return json_encode(array("status" => 0, "array" => $returnErrArray));
    } else {
        return json_encode(array("status" => 1, "array" => $returnErrArray));
    }
}
?>