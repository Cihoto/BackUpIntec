<?php
if ($_POST) {

    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;

    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'GetUsuario':
            $email = $data->email;
            $result = GetUsuario($email);
            break;
        case 'GetAllUsuariosByEmpresa':
            $empresa_id = $data->empresa_id;
            $result = GetAllUsuariosByEmpresa($empresa_id);
            break;
        case 'GetUserByUserId':
            $user_id = $data->user_id;
            $result = GetUserByUserId($user_id);
            break;
        case 'GetUserRol':
            $user_id = $data->user_id;
            $result = GetUserRol($user_id);
            break;
        case 'AssignRoles':
            $user_id = $data->user_id;
            $arrayRoles = $data->arrayRoles;

            $result = AssignRoles($user_id,$arrayRoles);
            break;
        case 'LogUser':
            $request = $data->request;
            $result = LogUser($request);
            break;
        case 'CreateUser':
            $request = $data->request;
            $result = CreateUser($request);
            break;
        case 'DeleteUser':
            $user_id = $data->user_id;
            $result = DeleteUser($user_id);
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

    function GetUsuario($email){
        $conn =  new bd();
        $conn->conectar();
        // $query="SELECT per.email from persona per 
        // INNER JOIN personal p on p.persona_id = per.id 
        // INNER JOIN usuario u on u.id = p.usuario_id
        // where LOWER(per.email) = LOWER('$email')";
        $query = "SELECT * FROM usuario u WHERE LOWER(u.user) = LOWER('$email')";
        // return $query;

        if($conn->mysqli->query($query)->num_rows > 0){
            $conn->desconectar();
            return true;
        }else{
            $conn->desconectar();
            return false;
        }
    }

    function GetAllUsuariosByEmpresa($empresa_id){
        $conn =  new bd();
        $conn -> conectar();
        $usuarios = [];

        $queryGetAlUsers = "SELECT u.id as user_id, per.nombre , per.apellido,per.email,u.user as user_email FROM usuario u 
        INNER JOIN personal p on p.usuario_id = u.id 
        INNER JOIN persona per on per.id = p.persona_id
        WHERE u.empresa_id = $empresa_id  and u.is_deleted is null or u.is_deleted != 1";
        
        if($responseDb = $conn->mysqli->query($queryGetAlUsers)){
            if($responseDb->num_rows > 0){
                while($dataReponse = $responseDb->fetch_object()){
                    $usuarios [] = $dataReponse;
                }
                return array("success"=>true, "data"=>$usuarios , "message"=>"Se han encontrado ".count($usuarios)." usuarios");
            }else{
                return array("success"=>true, "data"=>$usuarios , "message"=>"No se han encontrado usuarios");
            }
        }else{
            return array("error", "message"=>"Ha ocurrido un error, intente nuevamente");
        }
    }

    function GetUserByUserId($user_id){
        $conn =  new bd();
        $conn->conectar();
    }


    function GetUserRol($user_id){
        $conn =  new bd();
        $conn->conectar();

        $roles = [];
        $userData = [];

        $query = "SELECT * FROM rol_has_usuario rhu 
        inner join rol r on r.id  = rhu.rol_id 
        where rhu.usuario_id  = $user_id";

        $querydatauser = "SELECT u.`user` , LENGTH(u.password) AS pass_length  FROM usuario u WHERE u.id =  $user_id";

        if($responseDbRoles = $conn->mysqli->query($query)){
            while($dataRoles = $responseDbRoles->fetch_object()){
                $roles [] = $dataRoles;
            }
            $responseDbData = $conn->mysqli->query($querydatauser);
            while($dataInfoUser = $responseDbData->fetch_object()){
                $userData [] = $dataInfoUser;
            }
            $conn->desconectar();
            return array("success"=>true,"data"=>$roles,"user_data"=>$userData);
        }else{
            $conn->desconectar();
            return array("error"=>true,"message"=>"No se ha podido completar la solicitud, por favor intente nuevamente");
        }
    }

    function AssignRoles($user_id,$arrayRoles){
        $conn =  new bd();
        $conn->conectar();
        $arrayLength = count($arrayRoles);
        $insertvalues = "";


        $conn->mysqli->query("DELETE FROM rol_has_usuario WHERE usuario_id = $user_id and rol_id > 2");

        if($arrayLength === 0){
            $conn->desconectar();
            return array("success"=>true,"message"=>"Roles asignados correctamente");
        }else{

            if($arrayLength > 1){
                foreach($arrayRoles as $key=>$rol_id){
                    if($key < $arrayLength){
                        if($key === $arrayLength -1){
                            $insertvalues .= "($rol_id->rol_id,$user_id)";
                        }else{
    
                            $insertvalues .= "($rol_id->rol_id,$user_id),";
                        }
                    }
                }
                $query= "INSERT INTO u136839350_intec.rol_has_usuario
                (rol_id, usuario_id)
                VALUES".$insertvalues;
            }else{
                $query= "INSERT INTO u136839350_intec.rol_has_usuario
                (rol_id, usuario_id)
                VALUES(".$arrayRoles[0]->rol_id.",".$user_id.")";
            }
            
            if($conn->mysqli->query($query)){
                $conn->desconectar();
                return array("success"=>true,"message"=>"Roles asignados correctamente");
            }else{
                $conn->desconectar();
                return array("error"=>true,"message"=>"No se ha podido completar el requerimiento, por favor intente nuevamente");
            }
        }
    }

    function LogUser($request){
        $conn =  new bd();
        $conn->conectar();
        
        $correo = $request->email;
        $pass = $request->pass;
        $roles = [];
        $rolesSession = [];

        $queryGetLogin = "SELECT * FROM usuario u WHERE LOWER(user) = LOWER('$correo') and LOWER(password)= LOWER('$pass')";
        // $queryGetLogin = "SELECT u.empresa_id,u.id  as usuario_id, per.email, u.password FROM usuario u 
        // INNER JOIN personal p on p.usuario_id = u.id 
        // INNER JOIN persona per on per.id = p.persona_id 
        // WHERE LOWER(per.email) = LOWER('$correo') and LOWER(u.password) = LOWER('$pass');";
        // return $queryGetLogin;
        if($responseBd = $conn->mysqli->query($queryGetLogin)){
            if($responseBd->num_rows > 0){

                while($dataReponseUser = $responseBd->fetch_object()){
                    $usuario_id = $dataReponseUser->id;
                    $empresa_id = $dataReponseUser->empresa_id;
                }
                $personalIds = [];

                $queryGetPersonalId = "SELECT per.id as 'persona_id', u.id as 'usuario_id',p.id as 'personal_id' FROM personal p 
                INNER JOIN usuario u on u.id = p.usuario_id 
                INNER JOIN persona per on per.id = p.persona_id 
                where u.id = $usuario_id;";
                
                session_start();
                if($responseBd = $conn->mysqli->query($queryGetPersonalId)){
                    while($row = $responseBd->fetch_object()){
                        $personalIds [] = $row; 
                    }
                    $_SESSION['personal_ids'] = $personalIds;
                }

                $queryGetRol = "SELECT r.id as rol_id, r.rol, u.id FROM usuario u  
                INNER JOIN rol_has_usuario rhu on rhu.usuario_id = u.id
                INNER JOIN rol r on r.id = rhu.rol_id 
                where u.id = $usuario_id";
                $queryGetRoles = "SELECT rhu.rol_id  FROM rol_has_usuario rhu where rhu.usuario_id = $usuario_id";

                $responseRol = $conn->mysqli->query($queryGetRoles);

                
                $_SESSION["empresa_id"] = $empresa_id;
                if($responseRol->num_rows > 0){

                 while($dataRoles = $responseRol->fetch_object() ){
                    $roles [] = $dataRoles;
                 }

                 for ($i=0; $i < count($roles); $i++) { 
                    array_push($rolesSession, $roles[$i]->rol_id);
                 }

                 $_SESSION["rol_id"] = $rolesSession;
                }else{
                    $_SESSION["rol_id"] = [];
                }
                $conn->desconectar();
                return array("success" => true,"message"=>"Excelente","ref"=>true);
            }else{
                $conn->desconectar();
                return array("success" => true,"message"=>"Credenciales Erroneas","ref"=>false);
            }
        }else{
            $conn->desconectar();
            return array("error" => true,"message"=>"Ha ocurrido un error, intente nuevamente");
        }
    }

    function CreateUser($request){
        $conn = new bd();
        $conn->conectar();
        $today = date('Y-m-d');
        $personal_id = $request->personal_id;
        $email = $request->email;
        $pass = $request->pass;
        $empresa_id = $request->empresa_id;

        $queryInsertUser ="INSERT INTO u136839350_intec.usuario
        (`user`, `password`, createAt, empresa_id)
        VALUES('$email', '$pass', '$today', $empresa_id)";

        if($conn->mysqli->query($queryInsertUser)){
            $user_id = $conn->mysqli->insert_id;
            $queryAssignUserToPersonal = "UPDATE personal SET usuario_id = $user_id WHERE id = $personal_id";
            $conn->mysqli->query($queryAssignUserToPersonal);
            $conn->desconectar();
            return array("success" => true,"message"=>"Usuario Creado Exsitosamente","user_id"=>$user_id);
        }else{
            $conn->desconectar();
            return array("error" => true,"message"=>"Ha ocurrido un error, intente nuevamente");
        }
    }

    function DeleteUser($user_id){

        $conn = new bd();
        $conn->conectar();

        $query = "UPDATE usuario SET is_deleted = 1 WHERE id = $user_id";

        if($conn->mysqli->query($query)){
            $conn->desconectar();
            return array("success" => true,"message"=>"Usuario eliminado exitosamente");
        }else{
            $conn->desconectar();
            return array("error" => true,"message"=>"Ha ocurrido un error por favor intente nuevamente");
        }

    }
?>