<?php
if ($_POST) {

    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;

    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'CreatePackage':
            $request = $data->request;
            $empresaId = $data->empresaId;
            $nombre = $data->packageName;
            $result = CreatePackage($request,$empresaId,$nombre);
            break;
        case 'GetAllStandardPackages':
            $empresa_id = $data->empresa_id;
            $result = GetAllStandardPackages($empresa_id);
            break;
        case 'GetPackageDetails':
            $package_id = $data->package_id;
            $result = GetPackageDetails($package_id);
            break;
        case 'editPackage':
            $package_id = $data->package_id;
            $data = $data->data;
            $result = editPackage($package_id,$data);
            break;
        case 'deletePackage':
            $package_id = $data->package_id;
            $empresa_id = $data->empresa_id;
            $result = deletePackage($package_id,$empresa_id);
            break;
        case 'assignStandardPackageToProject':
            $request = $data->request;
            $result = assignStandardPackageToProject($request);
            break;
        case 'GetProductsByPackage':
            $package_id = $data->package_id;
            $result = GetProductsByPackage($package_id);
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



    function CreatePackage($request,$empresa_id,$nombre){

        $conn = new bd();
        $conn->conectar();

        $query = "INSERT INTO standard_package
        (empresa_id, nombre)
        VALUES($empresa_id, '$nombre');";

        if($conn->mysqli->query($query)){
            $insert_id = $conn->mysqli->insert_id;


            foreach($request->arrayPackages as $key=>$element){
                $queryInsert="INSERT INTO u136839350_intec.packages_has_products
                (product_id, package_id, quantity)
                VALUES($element->id, $insert_id,$element->cantidad)";
                $conn->mysqli->query($queryInsert);
            }
            $conn->desconectar();
            return true;
        }else{
            $conn->desconectar();
            return false;
        }


    }

    function GetAllStandardPackages($empresa_id){
        $conn = new bd();
        $conn->conectar();
        $packages = [];

        $query = "SELECT * FROM standard_package sp 
        WHERE sp.empresa_id = $empresa_id and is_deleted is null;";


        if($responseDb = $conn->mysqli->query($query)){
            while($dataPackages = $responseDb->fetch_object()){
                $packages [] =  $dataPackages;
            }
            $conn->desconectar();
            return array("success"=>true,"data"=>$packages);
        }else{
            $conn->desconectar();
            return array("false"=>true,"data"=>$packages);
        }

    }


    function GetPackageDetails($package_id){
        $conn = new bd();
        $conn->conectar();
        $products = [];
        $data = [];

        $queryName = "SELECT * FROM standard_package where id = $package_id";
        $queryProducts = "SELECT * FROM packages_has_products php where 
        php.package_id = $package_id";

        if($responseDb = $conn->mysqli->query($queryProducts)){
            while($databd = $responseDb->fetch_object()){
                $products [] = $databd;
            }
        }

        if($responseDbdata = $conn->mysqli->query($queryName)){
            while($databdData = $responseDbdata->fetch_object()){
                $data [] = $databdData;
            }
        }
        $conn->desconectar();
        return array("success"=>true, "data"=> $data, "products"=>$products);

    }
    function editPackage($package_id,$data){
        $conn = new bd();
        $conn->conectar();

        $counterErr = 0 ;

        $queryDeletePackageHasProduct = "DELETE FROM packages_has_products 
        WHERE package_id= $package_id";


        if(!$conn->mysqli->query($queryDeletePackageHasProduct)){
            $conn->desconectar();
            return array("error"=>true, "message"=>"no se ha podido completar la actualización del paquete");
        }

        foreach ($data as $key => $product) {
            $queryInsertNewPackages ="INSERT INTO u136839350_intec.packages_has_products
            (product_id, package_id, quantity)
            VALUES($product->id, $package_id,$product->cantidad)";

            if($conn->mysqli->query($queryInsertNewPackages)){
                
            }else{
                $counterErr ++;
            }
        }
        $conn->desconectar();
        return array("success"=>true, "message"=>"Paquete actualizado exitosamente", "total"=>count($data), "withErrors"=>$counterErr);


       
    }

    function deletePackage($package_id,$empresa_id){
        $conn = new bd();
        $conn->conectar();

        $querySoftDeletePackage = "UPDATE standard_package SET is_deleted = 1 WHERE id =$package_id AND empresa_id = $empresa_id ";

        if($conn->mysqli->query($querySoftDeletePackage)){
            $conn->desconectar();
            return array("success"=>true, "message"=>"Paquete eliminado exitosamente");
        }else{
            $conn->desconectar();
            return array("error"=>true, "message"=>"No se ha podido finalizar la acción");
        }
    }


    function assignStandardPackageToProject($request){
        $conn = new bd();
        $conn->conectar();
        
        $arrayLenght = count($request);

        $inserts = "";

        foreach ($request as $key => $value) {

            if($key === $arrayLenght - 1){
                $inserts = $inserts."($value->proyecto_id,$value->package_id)";
            }else{
                $inserts = $inserts."($value->proyecto_id,$value->package_id),";
            }
        }

        $query = "INSERT INTO proyecto_has_paquete
        (proyecto_id, paquete_id)
        VALUES $inserts;";

        if($conn->mysqli->query($query)){
            return array('success'=>true);
        }else{
            return array('false'=>true);
        }
    
    }

    function GetProductsByPackage($package_id){
        $conn =  new bd();
        $conn->conectar();



        $query = '';


    }
?>