<?php
require_once('../bd/bd.php');

$conn = new bd();
$conn->conectar();

$json = file_get_contents('php://input');
$data = json_decode($json);
$productoArr = $data->arrayRequest;
$today = date('Y-m-d');
$jsonErrMarca = [];
$jsonErrItemHasClass = [];
$err = false;
$resposePush = [];
set_time_limit(300); 
$empresaId = $data->empresaId;

foreach ($productoArr as $key => $value) {

    
    $err = false;
    $nombre = $value->nombre;
    $marca = $value->marca;
    $modelo = $value->modelo;
    $categoria = $value->categoria;
    $item = $value->item;
    $stock = $value->stock;
    $precioCompra = $value->precioCompra;
    $precioArriendo = $value->precioArriendo;
    $itemId = "";
    $catId = "";


    $queryIdMarca = $conn->mysqli->query("Select id  from marca where LOWER(marca) ='". strtolower($marca)."'");

   
    if ($queryIdMarca->num_rows === 0) {

        $queryInsertMarca = "INSERT INTO marca
        (marca, createAt,IsDelete)
        VALUES('$marca', '$today', 0)";
        $conn->mysqli->query($queryInsertMarca);
        $idMarca = $conn->mysqli->insert_id;
    } else {
        $dataBdResponse = $queryIdMarca->fetch_object();
        $idMarca = $dataBdResponse->id;
    }
        $queryItemHasId = $conn->mysqli->query("SELECT chi.id FROM categoria_has_item chi 
            INNER JOIN categoria c on c.id =chi.categoria_id 
            INNER JOIN item i on i.id = chi.item_id 
            where LOWER(c.nombre)='" . strtolower($categoria) . "' AND LOWER(i.item) ='" . strtolower($item) . "'");
            

        if ($queryItemHasId->num_rows === 0) {

            $query = "SELECT id FROM categoria c where LOWER(c.nombre) = '". strtolower($categoria)."'";
            if($responseCategoria = $conn->mysqli->query($query)){
                if($responseCategoria->num_rows > 0){
                    $insertedCategoria = $responseCategoria->fetch_object()->id;
                }else{
                    $queryCreateCategoria = "INSERT INTO categoria(nombre, createAt, IsDelete,empresa_id)VALUES('" . $categoria . "','" . $today . "', 0, $empresaId)";
                    $conn->mysqli->query($queryCreateCategoria);
                    $insertedCategoria =  $conn->mysqli->insert_id;
                }
            }
            $queryIfitem = "SELECT id FROM item i where LOWER(i.item) = '".strtolower($item)."'";

            if($responseItem = $conn->mysqli->query($queryIfitem)){
                if($responseItem->num_rows > 0){
                    $insertedItem = $responseItem->fetch_object()->id;
                }else{
                    $queryCreateItem = "INSERT INTO item(item, createAt, IsDelete, empresa_id)VALUES('" . $item . "','" . $today . "', 0, $empresaId)";
                    $conn->mysqli->query($queryCreateItem);
                    $insertedItem = $conn->mysqli->insert_id;
                }
            }
            //  echo "INSERT INTO categoria_has_item(categoria_id, item_id)VALUES($insertedCategoria, $insertedItem)";
            // return "INSERT INTO categoria_has_item(categoria_id, item_id)VALUES($insertedCategoria, $insertedItem)";
            $responseInsert = $conn->mysqli->query("INSERT INTO categoria_has_item(categoria_id, item_id)VALUES($insertedCategoria, $insertedItem)");
            echo $cathasitemId = $conn->mysqli->insert_id;
            $cathasitemId = $conn->mysqli->insert_id;
           
        } else {
            $dataBdResponse = $queryItemHasId->fetch_object();
            $cathasitemId = $dataBdResponse->id;
        }

        $queryProducto = "INSERT INTO producto
        (nombre, marca_id, categoria_has_item_id, codigo_barra, precio_compra, precio_arriendo, createAt, IsDelete, empresa_id)
        VALUES('" . $nombre . "'," . $idMarca . "," . $cathasitemId . ", '11011001'," . $precioCompra . "," . $precioArriendo . ", '" . $today . "', 0,$empresaId)";

        if ($conn->mysqli->query($queryProducto)) {
            $idProducto = $conn->mysqli->insert_id;

            $queryInventario = "INSERT INTO inventario
                                (producto_id, cantidad, createAt)
                                VALUES($idProducto, $stock , $today)";

            if ($conn->mysqli->query($queryInventario)) {
            }
        }
}

echo json_encode(array("status"=>200, "success"=>true));
