<?php
 require_once('../bd/bd.php');
 
 $json = file_get_contents('php://input');
 $data = json_decode($json);

 $request = $data->request;
 $tipo = $data->tipo;

 if($tipo === "add"){
     echo addProject($request);
 }

 function addProject($request){

     $conn = new bd();
     $conn ->conectar();
     $today = date('Y-m-d');
    //  return json_encode($request);

     foreach($request as $req){

        $nombre_proyecto = $req->nombre_proyecto;
        $lugar_id = $req->lugar_id;
        $fecha_inicio = $req->fecha_inicio;
        $fecha_termino = $req->fecha_termino;
        $cliente_id = $req->cliente_id;
        $comentarios = $req->comentarios;
        // $empresa_id = $req->empresa_id;
     }

     $query = "INSERT INTO intec.proyecto
     (nombre_proyecto, lugar_id, fecha_inicio, fecha_termino, createAt, IsDelete , cliente_id, empresa_id,comentarios)
     VALUES('".$nombre_proyecto."', $lugar_id, '".$fecha_inicio."', '".$fecha_termino."', '".$today."', 0, $cliente_id, 1,'".$comentarios."')";

    if($conn->mysqli->query($query)){
        $id_project = $conn->mysqli->insert_id;
        return json_encode(array("id_project"=>$id_project));
    }else{
        return false;
    }
 }
?>