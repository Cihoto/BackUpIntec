<?php
if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $action = $data->action;

    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'getRegiones':
            $regiones = getRegiones();
            echo json_encode($regiones);
            break;

        default:
            echo 'Invalid action.';
            break;
    }
} else {
    require_once('./ws/bd/bd.php');
}

    function getRegiones(){
        $conn = new bd();
        $conn->conectar();
        $regiones = [];
        $queryRegiones = 'SELECT id, region FROM region';
        if($responseRegion = $conn->mysqli->query($queryRegiones)){
            while($dataRegiones = $responseRegion->fetch_object()){
                $regiones[] = $dataRegiones;
            }
        }
        $conn->desconectar();
        return $regiones;
    }

//   require_once('./ws/bd/bd.php');

//     function getRegiones(){
//         $conn = new bd();
//         $conn->conectar();

//         $regiones = [];
//         $queryRegiones = 'Select id, region from region';
//         if($responseRegion = $conn->mysqli->query($queryRegiones)){
//             while($dataRegiones = $responseRegion->fetch_object()){
//                 $regiones[] = $dataRegiones;
//             }
//         }
//         return $regiones;
//     }
?>