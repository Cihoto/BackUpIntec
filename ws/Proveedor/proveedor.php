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
            case 'addNewProvider':
                $empresa_id = $data->empresa_id;
                $request = $data->request;
                $providerResponse = addNewProvider($request,$empresa_id);
                echo json_encode($providerResponse);
                break;
            default:
                echo 'Invalid action.';
                break;
        }

    }else{
        require_once('./ws/bd/bd.php');
    }


    function addNewProvider($request,$empresa_id){
    
        $conn = new bd();
        $conn->conectar();



        $persona_id = 0;
        $datosFacturacion_id = 0; 
        $proveedor_id = 0;

        $nombre= $request->nombre;
        $apellido= $request->apellido;
        $rut= $request->rut;
        $correo= $request->correo;
        $telefono= $request->telefono;
        $razon_social= $request->razon_social;
        $nombre_fantasia= $request->nombre_fantasia;
        $rutEmpresa= $request->rutEmpresa;
        $direccionEmpresa= $request->direccionEmpresa;
        $correoEmpresa= $request->correoEmpresa;


        $queryInsertPersona = "INSERT INTO u136839350_intec.persona
        (nombre, apellido, rut, email, telefono)
        VALUES('$nombre', '$apellido', '$rut', '$correo', '$telefono');";

        if($conn->mysqli->query($queryInsertPersona)){
            $persona_id = $conn->mysqli->insert_id;
        }else{
            return array("success"=>false);
        }

        $queryInsertDatosFacturacion = "INSERT INTO u136839350_intec.datos_facturacion
        (razon_social, nombre_fantasia, rut, direccion, correo)
        VALUES('$razon_social', '$nombre_fantasia', '$rutEmpresa', '$direccionEmpresa', '$correoEmpresa');";

        if($conn->mysqli->query($queryInsertDatosFacturacion)){
            $datosFacturacion_id = $conn->mysqli->insert_id;
        }else{
            $querydelete = "DELETE FROM u136839350_intec.persona WHERE id = $persona_id;";
            $conn->mysqli->query($querydelete);
            return array("success"=>false);
        }


        $queryInsertProvider = "INSERT INTO u136839350_intec.proveedor
        (persona_id_contacto, empresa_id, datos_facturacion_id) VALUES
        ($persona_id, $empresa_id, $datosFacturacion_id);";

        if($conn->mysqli->query($queryInsertProvider)){
            $proveedor_id = $conn->mysqli->insert_id;
            return array("success"=>true, "message"=>"Proveedor agregado exitosamente");
        }else{
            $querydelete = "DELETE FROM u136839350_intec.persona WHERE id = $persona_id;";
            $conn->mysqli->query($querydelete);
            $querydelete = "DELETE FROM u136839350_intec.datos_facturacion WHERE id = $datosFacturacion_id;";
            $conn->mysqli->query($querydelete);
            return array("success"=>false);
        }
    }
?>