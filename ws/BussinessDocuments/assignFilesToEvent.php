<?php

if ($_POST) {
    require_once('../bd/bd.php');
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $event_id = $data->event_id;
    $empresa_id = $data->empresa_id;
    $files = $data->files;
    $usuario_id = $data->personal_id[0]->usuario_id;

    $conn = new bd();
    $conn->conectar();

    $insertvalues = "";
    $today = date('Y-m-d');
    $inserted_ids = [];

    $not_pending_files = [];

    // FOLDER CREATION
    $absolutePath = getcwd();
    $target_folder_path = $absolutePath."\documents\buss$empresa_id\Ev$event_id";
    $target_document_path = $absolutePath."\documents\buss$empresa_id\documents";

    if(!is_dir($target_folder_path)){
        mkdir($target_folder_path);
    }
    //MOVE TO NEW FOLDER 
    foreach($files as $key=>$file_data){
        $scandir = scandir($target_document_path);
        // echo print_r($scandir);
        // echo "jjgg </br>";
        // echo $file_data->name;
        $file_exists = array_search("bsd".$file_data->name, $scandir);
        // echo $file_exists;
        if($file_exists !== false){
            $scandir = scandir($target_folder_path);
            $fileIsInserted = array_search("bsd".$file_data->name, $scandir);
            if($fileIsInserted !== false){

            }else{
                rename($target_document_path."\bsd$file_data->name",$target_folder_path."\bsd$file_data->name");
                array_push($not_pending_files,$file_data);

                $queryInsertFiles = "INSERT INTO u136839350_intec.file
                (`name`, `size`, `type`, uploader_user_id, upload_date,empresa_id)
                VALUES ('$file_data->name', $file_data->size ,'$file_data->type', $usuario_id, '$today',$empresa_id)";
                if($conn->mysqli->query($queryInsertFiles)){
                    $insert_id = $conn->mysqli->insert_id;
                    array_push($inserted_ids,$insert_id);
                }
            }
        }
    }

    $arrayLength = count($inserted_ids);
    if($arrayLength > 0){
        foreach($inserted_ids as $key=>$inserted_id){
            if($key < $arrayLength){
                if($key === $arrayLength -1){
                    $insertvalues .= "($event_id, $inserted_id)";
                }else{
                    $insertvalues .= "($event_id, $inserted_id),";
                }
            }
        }
        $queryAssignFileToEvent = "INSERT INTO u136839350_intec.proyecto_has_files
        (event_id, file_id)
        VALUES $insertvalues;";
        $conn->mysqli->query($queryAssignFileToEvent);
    }


    // echo json_encode($not_pending_files);
}
?>