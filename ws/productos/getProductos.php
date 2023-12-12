<?php 
    require_once('../bd/bd.php');
    
    $conn = new bd();
    $conn ->conectar();

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $item = $data->item;
    $categoria = $data->categoria;
    $tipo = $data->tipo;
    $today = date('Y-m-d');
    $jsonErrMarca = [];
    $jsonErrItemHasClass = [];
    $err = false ; 
    $queryProd = "";

    if($tipo === "categoria"){
        $queryProd = "SELECT i.item as Item ,c.nombre as categoria, p.nombre as nombre, p.precio_arriendo as arriendo, p.precio_compra as compra ,
                      mo.modelo as modelo ,m.marca as marca 
        from producto p 
        INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
        INNER JOIN categoria c on c.id = chi.categoria_id 
        INNER JOIN marca m on m.id = p.marca_id 
        INNER JOIN modelo mo on mo.marca_id = m.id
        INNER JOIN item i on i.id  = chi.item_id 
        WHERE LOWER(c.nombre) = '".strtolower($categoria)."' and p.empresa_id = 1
        GROUP BY p.nombre";
    }

    if($tipo === "item"){
        $queryProd ="SELECT i.item as Item ,c.nombre as categoria, p.nombre as nombre, p.precio_arriendo as arriendo, p.precio_compra as compra, 
                     mo.modelo as modelo ,m.marca as marca 
        from producto p 
        INNER JOIN categoria_has_item chi on chi.id =p.categoria_has_item_id 
        INNER JOIN categoria c on c.id = chi.categoria_id 
        INNER JOIN marca m on m.id = p.marca_id 
        INNER JOIN modelo mo on mo.marca_id = m.id
        INNER JOIN item i on i.id  = chi.item_id 
        WHERE LOWER(i.item) = '".strtolower($item)."' and LOWER(c.nombre)= '".strtolower($categoria)."' and p.empresa_id = 1
        GROUP BY p.nombre";
    }

    // echo $queryProd;
    $responseBdProd = $conn->mysqli->query($queryProd);
    while($dataItems =$responseBdProd->fetch_object()){
        $productos [] = $dataItems;
    }

    echo json_encode($productos);
?>