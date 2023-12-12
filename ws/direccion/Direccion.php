<?php

if ($_POST){
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    // Realiza la acción correspondiente según el valor de 'action'
    switch($action) {
        case 'addDireccion':
            $request = $data->request;
            $result = addDireccion($request);
            break;
        case 'getDireccion':
            $request = $data->request;
            $result = getDireccion($request);
            break;
        case 'getDireccionesByEmpresa':
            $request = $data->request;
            $result = getDireccionesByEmpresa($request);
            break;
        case 'insertNewAddress':
            $request = $data->request;
            $result = insertNewAddress($request);
            break;
        case 'addAndAssignToProject':
            $address = $data->address;
            $empresa_id = $data->empresa_id;
            $event_id = $data->event_id;
            $result = addAndAssignToProject($address,$empresa_id,$event_id);
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

    function addDireccion($request){
        $conn= new bd();
        $conn ->conectar();
        $direccion = "";
        $numero = "";
        //$extra = "";
        $dpto = "";
        $postal_code = "";
        $comuna_id = "";
        foreach($request as $req){
            $direccion= $req->direccion;
            $numero = $req->numero;
            // $extra = $req->extra;
            $dpto = $req->depto;
            $postal_code = $req->codigo_postal;
            $comuna_id = $req->comuna;
        }
        $query = "INSERT INTO direccion
        (direccion, numero,  dpto, postal_code, comuna_id, empresa_id)
        VALUES('".$direccion."', '".$numero."','".$dpto."', '".$postal_code."', $comuna_id, 1)";

        if($responseBd = $conn->mysqli->query($query)){
            $insert_id = $conn->mysqli->insert_id;
            $conn->desconectar();
            return json_encode(array("id_direccion"=> $insert_id)) ;
        }else{
            $conn->desconectar();
            return false;
        }
    }

    function insertNewAddress($request){
        $conn= new bd();
        $conn ->conectar();

        $queryInsertAddress = "INSERT INTO direccion
        (direccion, empresa_id)
        VALUES('$request->direccion',$request->empresa_id)";

        if($conn->mysqli->query($queryInsertAddress)){
            $address_id = $conn->mysqli->insert_id;
            return array("success"=>true,"message"=>"Dirección creada exitosamente","address_id"=>$address_id);
        }else{
            return array("error"=>true,"message"=>"No se ha podido crear la dirección");
        }
    } 
    
    function addAndAssignToProject($address,$empresa_id,$event_id){
        $conn= new bd();
        $conn ->conectar();

        $queryInsertAddress = "INSERT INTO direccion
        (direccion, empresa_id)
        VALUES('$address',$empresa_id)";

        if($conn->mysqli->query($queryInsertAddress)){
            $address_id = $conn->mysqli->insert_id;
            $queryAssign = "UPDATE proyecto
            SET address_id = $address_id 
            WHERE id = $event_id AND empresa_id=$empresa_id;";

            if($conn->mysqli->query($queryAssign)){
                return json_encode(array("success"=>true,"message"=>"Se ha la dirección asignado al evento"));
            }else{
                return json_encode(array("error"=>true,"message"=>"No se ha podido asignar la dirección"));
            }

        }else{
            return json_encode(array("error"=>true,"message"=>"No se ha podido crear la dirección"));
        }
    }


    function getDireccion($request){

        $conn= new bd();
        $conn ->conectar();
        $direccionId = $request;

        $query = "SELECT * FROM direccion d where d.id = $direccionId";

        if($responseBd = $conn->mysqli->query($query)){
            
            while($dataResponse = $responseBd->fetch_object()){
                $direcciones[] = $dataResponse; 
            }
        }else{
            $conn->desconectar();
            return false;
        }
        return json_encode(array("direcciones"=>$direcciones));
    }
    function getDireccionesByEmpresa($request){

        $conn= new bd();
        $conn ->conectar();
        $direccionId = "";
        $direcciones = [];

        $query = "SELECT * FROM direccion d";

        if($responseBd = $conn->mysqli->query($query)){
            
            while($dataResponse = $responseBd->fetch_object()){
                $direcciones[] = $dataResponse; 
            }
        }else{
            $conn->desconectar();
            return false;
        }
        return json_encode(array("direcciones"=>$direcciones)); 
    }
?>
