<?php
session_start();
if ($_POST) {
    $empresaId = 1;
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;

    

    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'sortProducts':
            // Recibe el parámetro requestJson
            $requestJson = $data->requestJson;
            
            // Llama a la función sortProducts y devuelve el resultado
            $sortedProducts = sortProducts($requestJson);
            echo json_encode($sortedProducts);
            break;
        
        case 'getProductos':
            // Recibe el parámetro empresaId
            $empresaId = $data->empresaId;
            
            // Llama a la función getProductos y devuelve el resultado
            $productos = getProductos($empresaId);
            echo json_encode($productos);
            break;
        
        case 'GetProductDataById':
            // Recibe el parámetro empresaId
            $product_id = $data->product_id;
            
            // Llama a la función getProductos y devuelve el resultado
            $productos = GetProductDataById($product_id);
            echo json_encode($productos);
            break;
        
        case 'addProd':
            // Recibe el parámetro jsonCreateProd
            $jsonCreateProd = $data->request;
            
            // Llama a la función addProd y devuelve el resultado
            $addProdResponse = addProd($jsonCreateProd);
            echo $addProdResponse;
            break;
        case 'dropAssigmentProduct':
            // Recibe el parámetro jsonCreateProd
            $idProject = $data->idProject;
            // Llama a la función addProd y devuelve el resultado
            $droppedIds = dropAssigmentProduct($idProject);
            echo $droppedIds;
            break;
        case 'GetAvailableProducts':
            $empresaId = $data->empresaId;
            // Llama a la función GetAvailableProducts y devuelve el resultado
            $products = json_encode(GetAvailableProducts($empresaId));
            echo $products;
            break;
        case 'assignProductToProject':
            // Recibe el parámetro jsonCreateProd
            $request = $data->request;
            
            // Llama a la función addProd y devuelve el resultado
            $assignProductResponse = assignProductToProject($request);
            echo json_encode($assignProductResponse);
            break;
        case 'GetUnavailableProductsByDate':
            // Recibe el parámetro jsonCreateProd
            $request = $data->request;
            $empresa_id = $data->empresa_id;
            // Llama a la función addProd y devuelve el resultado
            $response = GetUnavailableProductsByDate($request,$empresa_id);
            echo json_encode($response);
            break;
        case 'AssignOthersToProject':
            // Recibe el parámetro jsonCreateProd
            $request = $data->request;
            $project_id = $data->project_id;
            // Llama a la función addProd y devuelve el resultado
            $response = AssignOthersToProject($request,$project_id);
            echo json_encode($response);
            break;
        case 'GetAllProductsByBussiness':
            // Recibe el parámetro jsonCreateProd
            $empresa_id = $data->empresa_id;
            // Llama a la función addProd y devuelve el resultado
            $response = GetAllProductsByBussiness($empresa_id);
            echo json_encode($response);
            break;
        case 'assignProductJSONToProject':
            // Recibe el parámetro jsonCreateProd
            $empresa_id = $data->empresa_id;
            $event_id = $data->event_id;
            $json = $data->json;
            // Llama a la función addProd y devuelve el resultado
            $response = assignProductJSONToProject($json,$empresa_id,$event_id);
            echo json_encode($response);
            break;
        default:
            echo 'Invalid action.';
            break;
    }
} else {
    require_once('./ws/bd/bd.php');
}

    function sortProducts($requestJson){
        $conn = new bd();
        $conn ->conectar();
        $data = $requestJson;
        $item = $data->item;
        $categoria = $data->categoria;
        $tipo = $data->tipo;
        $queryProd = "";
        $productos = [];

        if($tipo === "categoria"){
            $queryProd = "SELECT i.item as Item ,c.nombre as categoria, p.nombre as nombre, p.precio_arriendo as arriendo, p.precio_compra as compra ,
                          m.marca as marca, inv.cantidad
                            from producto p 
                            INNER JOIN inventario inv on inv.producto_id  = p.id
                            INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
                            INNER JOIN categoria c on c.id = chi.categoria_id 
                            INNER JOIN marca m on m.id = p.marca_id 
                            INNER JOIN item i on i.id  = chi.item_id 
                            WHERE LOWER(c.nombre) = '".strtolower($categoria)."' and p.empresa_id = 1
                            GROUP BY p.nombre";
        }
    
        if($tipo === "item"){
            $queryProd ="SELECT i.item as Item ,c.nombre as categoria, p.nombre as nombre, p.precio_arriendo as arriendo, p.precio_compra as compra, 
                        m.marca as marca, inv.cantidad
                        from producto p 
                        INNER JOIN inventario inv on inv.producto_id  = p.id
                        INNER JOIN categoria_has_item chi on chi.id =p.categoria_has_item_id 
                        INNER JOIN categoria c on c.id = chi.categoria_id 
                        INNER JOIN marca m on m.id = p.marca_id 
                        INNER JOIN item i on i.id  = chi.item_id 
                        WHERE LOWER(i.item) = '".strtolower($item)."' and LOWER(c.nombre)= '".strtolower($categoria)."' and p.empresa_id = 1
                        GROUP BY p.nombre";
        }
    
        $responseBdProd = $conn->mysqli->query($queryProd);
        while($dataItems =$responseBdProd->fetch_object()){
            $productos [] = $dataItems;
        }

        $conn->desconectar();
        if(count($productos)===0){
            return $productos;
        }
        return $productos;
    }


    function getProductos($empresaId){
        $conn = new bd();
        $conn->conectar();

        $productos = [];
        $queryProductos = "SELECT p.id, p.nombre, c.nombre as categoria, i.item, p.precio_arriendo, inv.cantidad FROM producto p 
        INNER JOIN empresa e on e.id = p.empresa_id 
        INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
        INNER JOIN categoria c on c.id = chi.categoria_id 
        INNER JOIN item i on i.id  = chi.item_id 
        INNER JOIN inventario inv on inv.producto_id  = p.id 
        WHERE e.id = $empresaId";

        if($responseProductos = $conn->mysqli->query($queryProductos)){
            while($dataProductos = $responseProductos->fetch_object()){
                $productos[] = $dataProductos;
            }
        }
        $conn->desconectar();
        return $productos;
    }

    function GetProductDataById($product_id){
        $conn =  new bd();
        $conn->conectar();

        $queryGetProduct = "SELECT * FROM productos ";

    }


    function GetAvailableProducts(){
        $conn = new bd();
        $conn->conectar();
        $products = [];


        $queryGetAvailable = "SELECT  p.id, 
                                p.nombre, 
                                cat.nombre as categoria,
                                it.item,
                                p.precio_arriendo,
                                i.cantidad as stock,
                                php.cantidad as assigned,
                                pro.fecha_inicio,
                                pro.fecha_termino,
                                phe.estado_id  as estado
                                FROM proyecto_has_producto php 
                                RIGHT JOIN proyecto_has_estado phe on phe.proyecto_id = php.proyecto_id 
                                RIGHT JOIN producto p on p.id = php.producto_id
                                INNER JOIN inventario i on i.producto_id  = p.id
                                INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
                                INNER JOIN categoria cat on cat.id = chi.categoria_id
                                INNER JOIN item it on it.id = chi.item_id 
                                LEFT join proyecto pro on pro.id = php.proyecto_id
                                WHERE p.empresa_id = 1";

        $responseDB = $conn->mysqli->query($queryGetAvailable);
        while($dataResponseBd = $responseDB->fetch_object()){
            $products[] = $dataResponseBd;
        }
        $conn->desconectar();
        return $products;

    }

    function assignProductToProject($request){
        $conn = new bd();
        $conn->conectar();
        $arrayResponse = [];

        foreach (array_slice($request, 0, 1) as $req) {
            if(isset($req->idProject)){
                $idProject = $req->idProject;
                $queryIfAssigned = "SELECT * FROM proyecto_has_producto php WHERE php.proyecto_id = $idProject";
                if($conn->mysqli->query($queryIfAssigned)->num_rows>0){
                    $qdelete = "DELETE FROM proyecto_has_producto WHERE proyecto_id =$idProject";
                    $conn->mysqli->query($qdelete);
                }
            }
        }
        
        foreach ($request as $req) {
            
            $idProject = $req->idProject;
            $idProduct = $req->idProduct;
            $price = $req->price;
            $quantity = $req->quantity;

            $query = "INSERT INTO proyecto_has_producto
                    (proyecto_id, producto_id, cantidad, arriendo)
                    VALUES($idProject, $idProduct, $quantity, $price);";
    
            if ($conn->mysqli->query($query)){
                array_push($arrayResponse, array("Asignado" => array("id" => $idProduct,"descontados"=>$quantity)));
            } else {
                array_push($arrayResponse, array("NoAsignado" => array("id" => $idProduct)));
            }
        }
    
        $conn->desconectar();
        return $arrayResponse;
        // return $query;
    }

    function dropAssigmentProduct($idProject){
        $conn = new bd();
        $conn->conectar();

        $queryIfAssigned = "SELECT * FROM proyecto_has_producto php WHERE php.proyecto_id = $idProject";

        if($conn->mysqli->query($queryIfAssigned)->num_rows>0){

            $qdelete = "DELETE FROM proyecto_has_producto WHERE proyecto_id =$idProject";
            $conn->mysqli->query($qdelete);

        }
        $conn->desconectar();
        return true;
        
    }



    function addProd($jsonCreateProd){
        $conn = new bd();
        $conn ->conectar();

        return $jsonCreateProd;

        $data = json_decode($jsonCreateProd);
        $productoArr = $data;
        $today = date('Y-m-d');
        $jsonErrMarca = [];
        $jsonErrItemHasClass = [];
        $err = false ; 

        foreach ($jsonCreateProd as $key => $value){

            $err = false ; 
            $nombre = $value->nombre;
            $marca = $value->marca;
            $modelo = $value->modelo;
            $categoria = $value->categoria;
            $item = $value->item;
            $stock = $value->stock;
            $precioCompra = $value->precioCompra;
            $precioArriendo = $value->precioArriendo;

            $queryIdMarca =$conn->mysqli->query("Select m.id  from marca m where LOWER(m.marca) ='".strtolower($marca)."'");
        
            if($queryIdMarca->num_rows === 0){
                array_push($jsonErrMarca,array(
                    "nombre"=>$nombre,
                    "marca"=>$marca,
                    "modelo"=>$modelo,
                    "categoria"=>$categoria,
                    "item"=>$item,
                    "stock"=>$stock,
                    "precioCompra"=>$precioCompra,
                    "precioArriendo"=>$precioArriendo));
                $err = true;
            }else{
                $dataBdResponse = $queryIdMarca->fetch_object();
                $idMarca = $dataBdResponse->id;
            }

            if(!$err){

                $queryItemHasId = $conn->mysqli->query("SELECT chi.id FROM categoria_has_item chi 
                INNER JOIN categoria c on c.id =chi.categoria_id 
                INNER JOIN item i on i.id = chi.item_id 
                where LOWER(c.nombre)='".strtolower($categoria) ."' AND LOWER(i.item) ='". strtolower($item) ."'");

                if($queryItemHasId->num_rows === 0){

                    $queryCreateItem = "INSERT INTO item(item, createAt, IsDelete)VALUES('".$item."','".$today."',0)";
                    $queryCreateCategoria = "INSERT INTO categoria(nombre, createAt, IsDelete)VALUES('".$categoria."','".$today."',0)";

                    $conn->mysqli->query($queryCreateItem);
                    $insertedItem = $conn->mysqli->insert_id;
                    $conn->mysqli->query($queryCreateCategoria);
                    $insertedCategoria =  $conn->mysqli->insert_id;
                    $conn->mysqli->query("INSERT INTO categoria_has_item(categoria_id, item_id)VALUES($insertedCategoria, $insertedItem)");
                    array_push($jsonErrItemHasClass,array(
                        "nombre"=>$nombre,
                        "marca"=>$marca,
                        "modelo"=>$modelo,
                        "categoria"=>$categoria,
                        "item"=>$item,
                        "stock"=>$stock,
                        "precioCompra"=>$precioCompra,
                        "precioArriendo"=>$precioArriendo));
                    $err = true;
                }else{
                    $dataBdResponse = $queryItemHasId->fetch_object();
                    $cathasitemId = $dataBdResponse->id;
                }
                
                if(!$err){

                    $queryProducto = "INSERT INTO producto
                    (nombre, marca_id, categoria_has_item_id, codigo_barra, precio_compra, precio_arriendo, createAt, IsDelete, empresa_id)
                    VALUES('".$nombre."',".$idMarca.",".$cathasitemId.", '11011001',".$precioCompra.",".$precioArriendo.", '".$today."', 0,1)";
                    
                    
                    
                    if($conn->mysqli->query($queryProducto)){

                        $idProducto = $conn->mysqli->insert_id;

                        $queryInventario = "INSERT INTO inventario
                                        (producto_id, cantidad, createAt)
                                        VALUES($idProducto, $stock , $today)";
                                        
                        if($conn->mysqli->query($queryInventario)){

                        }
                    }
                }
            }
        }

        return json_encode(array("total"=>count($jsonCreateProd),"errMarca"=>$jsonErrMarca,"errHasItem"=>$jsonErrItemHasClass));
    }

    function GetUnavailableProductsByDate($request,$empresa_id){
        $conn = new bd();
        $conn->conectar();

        $fecha_inicio = $request->data->fecha_inicio;
        $fecha_termino = $request->data->fecha_termino;

        $unavailableProducts = [];
        // $queryGetUnavailables ="SELECT php.*, phe.estado_id,p.fecha_inicio,p.fecha_termino  FROM proyecto_has_producto php 
        // INNER JOIN proyecto p ON p.id = php.proyecto_id
        // INNER JOIN proyecto_has_estado phe on phe.proyecto_id = p.id 
        // WHERE phe.estado_id = 2
        // AND p.fecha_inicio >= '$fecha_inicio' and p.fecha_termino <= '$fecha_termino'
        // AND p.empresa_id = $empresa_id";
        $queryGetUnavailables ="SELECT php.*, phe.estado_id,p.fecha_inicio,p.fecha_termino  FROM proyecto_has_producto php 
        INNER JOIN proyecto p ON p.id = php.proyecto_id
        INNER JOIN proyecto_has_estado phe on phe.proyecto_id = p.id 
        WHERE phe.estado_id = 2
        AND p.fecha_inicio >= '$fecha_inicio' AND p.fecha_inicio <= '$fecha_termino'
        OR p.fecha_termino >= '$fecha_inicio' AND p.fecha_termino <= '$fecha_termino'
        AND p.empresa_id = 1;";

        // return $queryGetUnavailables;

        if($responseDb = $conn->mysqli->query($queryGetUnavailables)){

            while($dataDb = $responseDb->fetch_object()){
                $unavailableProducts [] = $dataDb;
            }
            $conn->desconectar();
            return array("success"=>true,"data"=>$unavailableProducts);

        }else{

            $conn->desconectar();
            return array("error"=>true,"data"=>$unavailableProducts);
        }

    }


    function GetAllProductsByBussiness($empresa_id){
        $conn= new bd();
        $conn->conectar();
        $products = [];

        $query = "SELECT p.*, inv.cantidad,c.nombre as categoria, i.item  FROM producto p
        INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
        INNER JOIN categoria c on c.id = chi.categoria_id 
        INNER JOIN item i on i.id = chi.item_id
        INNER JOIN inventario inv on inv.producto_id = p.id 
        where p.empresa_id  = $empresa_id";

        if($responseDb = $conn->mysqli->query($query)){

            while($dataDb = $responseDb->fetch_object()){
                $products [] = $dataDb;
            }
            $conn->desconectar();
            return array("success"=>true,"data"=>$products);
        }else{
            $conn->desconectar();
            return array("error"=>true,"data"=>$products);
        }
    }


    function AssignOthersToProject($request,$project_id){
        $conn = new bd();
        $conn->conectar();
        $counter = 0;
    
        $arrayLength = count($request);
        $insertvalues = "";
    
        if($arrayLength > 0){
            foreach($request as $key=>$other_prod){
                if($key < $arrayLength){
                    if($key === $arrayLength -1){
                        $insertvalues .= "('$other_prod->detalle', $other_prod->cantidad, $other_prod->total,$project_id)";
                    }else{
                        $insertvalues .= "('$other_prod->detalle', $other_prod->cantidad, $other_prod->total,$project_id),";
                    }
                }
            }
            $query= "INSERT INTO u136839350_intec.proyecto_has_otros_productos
            (detalle, cantidad, valor,project_id)
            VALUES".$insertvalues;
            if($conn->mysqli->query($query)){
                $conn->desconectar();
                return array("success"=>true,"message"=>"Se han agregado otros productos al proyecto");
            }else{
                $conn->desconectar();
                return array("error"=>true,"message"=>"No se han podido agregar todos los otros productos al proyecto");
            }
        }

    }

    function assignProductJSONToProject($json,$empresa_id,$event_id){
        $conn = new bd();
        $conn->conectar();
        

        $queryInsert = "";

        if($conn->mysqli->query($queryInsert)){
            return array("success"=>true,"message"=>"JSON Object has been assigned successfuly");
        }else{
            return array("error"=>true,"message"=>"JSON Object hasn't been assigned");
        }
    }
?>