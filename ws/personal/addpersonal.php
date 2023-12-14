<?php
    require_once('../bd/bd.php');
    
    $conn = new bd();
    $conn ->conectar();

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $personalArr = $data->request;
    // return json_encode($personalArr);
     $today = date('Y-m-d');

    // foreach ($personalArr as $key => $value){

    //     $nombre = $value ->nombre;
    //     $apellido = $value ->apellido;
    //     $rut = $value ->rut;
    //     $telefono = $value->telefono;
    //     $correo = $value->correo;
    //     $cargo = $value ->cargo;
    //     $especialidad = $value ->especialidad;
    //     $contrato = $value ->contrato;
    //     $neto = 15000;
    //     // $neto = $value->neto;
    //     $idPersona = 0;
        
    //     $queryPersona = "INSERT INTO intec.persona
    //                     (nombre, apellido, rut, email, telefono)
    //                     VALUES('".$nombre." ', '".$apellido."', '".$rut."', '".$correo."', '$telefono')";

    //     $resposenBdPersona = $conn->mysqli->query($queryPersona);
    //     $idPersona = $conn->mysqli->insert_id;

    //     $queryCargo = $conn->mysqli->query('select id from cargo where cargo = "'.$cargo.'"'); 
    //     $value = $queryCargo->fetch_object();
    //     $idCargo = $value->id;

    //     $especialidadq = $conn->mysqli->query('select id from especialidad where especialidad ="' .$especialidad.'"'); 
    //     $value = $especialidadq->fetch_object();
    //     $idEspecialidad = $value->id;

    //     $contratoq = $conn->mysqli->query('select id from tipo_contrato where contrato = "'.$contrato.'"'); 
    //     $value = $contratoq->fetch_object();
    //     $idContrato = $value->id;
        
    //     $query = "INSERT INTO intec.personal
    //             (persona_id, cargo_id, especialidad_id, tipo_contrato_id, createAt, IsDelete, empresa_id,neto)
    //             VALUES(".$idPersona.",".$idCargo.",".$idEspecialidad.",".$idContrato.",'".$today."', 0, 1, $neto)";
       
    //     // if($conn->mysqli->query($query)){
    //     //     return array("Success"=>"123321");
    //     // }else{

    //     // }

    // }
    // return $query;
?>