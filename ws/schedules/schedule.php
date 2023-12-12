<?php
if ($_POST){
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    // Realiza la acción correspondiente según el valor de 'action'
    switch($action) {
        case 'insertAndAssignSchedulesToEvent':
            $event_id = $data->event_id;
            $empresa_id = $data->empresa_id;
            $schedules = $data->schedules;
            $result = insertAndAssignSchedulesToEvent($event_id,$empresa_id,$schedules);
            break;
        case 'removeAllSchedulesFromEvent':
            $event_id=$data->event_id;
            $empresa_id=$data->empresa_id;
            $result = removeAllSchedulesFromEvent($event_id,$empresa_id);
            break;
        default:
            $result = false;
            break;
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    require_once('./ws/bd/bd.php');
}

function insertAndAssignSchedulesToEvent($event_id,$empresa_id,$schedules){


    $conn = new bd();
    $conn->conectar();

    $arrayLength = count($schedules);
    $insertvalues = "";

    $deleteAllSchedulesFromEvent= removeAllSchedulesFromEvent($event_id,$empresa_id);

    
    if(!isset($deleteAllSchedulesFromEvent['success'])){
        return $deleteAllSchedulesFromEvent;
    }

    if($arrayLength > 0){
        foreach($schedules as $key=>$schedule_data){
            if($key < $arrayLength){
                if($key === $arrayLength -1){
                    $insertvalues .= "($event_id, '$schedule_data->schedule_detail', '$schedule_data->schedule_hour')";
                }else{
                    $insertvalues .= "($event_id, '$schedule_data->schedule_detail', '$schedule_data->schedule_hour'),";
                }
            }
        }
    }

    $queryInsertSchedulesToProject = "INSERT INTO event_has_schedules
    (event_id, schedule_detail, schedule_hour)
    VALUES $insertvalues";

    if($conn->mysqli->query($queryInsertSchedulesToProject)){
        return array("success"=>true,"message"=>"Schedules has been assgined to event successfully");
    }else{
        return array("error"=>true,"message"=>"Something happend, schedules hasn't been assigned to event, please try again");
    }
}   


function removeAllSchedulesFromEvent($event_id,$empresa_id){
    $conn = new bd();
    $conn->conectar();

    $queryGetMyEvent = "SELECT p.id FROM proyecto p 
    where p.id = $event_id and p.empresa_id = $empresa_id";

    // return $queryGetMyEvent;

    if(!$conn->mysqli->query($queryGetMyEvent)){
        return array("error"=>true,"message"=>"Access Denied, event not found");
    }

    $queryDeleteSchedules = "DELETE FROM u136839350_intec.event_has_schedules
    WHERE event_id = $event_id; ";

    if($conn->mysqli->query($queryDeleteSchedules)){
        return array("success"=>true,"message"=>"Schedules has been removed from event successfully");
    }else{
        return array("error"=>true,"message"=>"Schedules hasn't been removed from event, try again");
    }
}
?>