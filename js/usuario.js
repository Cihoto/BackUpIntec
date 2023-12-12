async function GetAllUsuariosByEmpresa(empresa_id){
    return $.ajax({
        type: "POST",
        url: "ws/Usuario/usuario.php",
        dataType: 'json',
        data: JSON.stringify({
          "action": "GetAllUsuariosByEmpresa",
          "empresa_id": empresa_id
        }),
        success: function(response){
            console.log(response.data);
            const userList = $('#userList');
            if(response.success && response.data.length > 0){
                response.data.forEach(user=>{
                    $(userList).append(
                    `<li user_id="${user.user_id}" class="user-element">
                        <h5>Correo</h5>
                        <p>${user.user_email}</p>
                        <h5>Nombre</h5>
                        <p class="userName">${user.nombre} ${user.apellido}</p>
                    </li>`)
                })
                console.log("SE LLENARON TODOS LOS LI");
            }
        }
    })
}

async function DeleteUser(user_id){
    return $.ajax({
        type: "POST",
        url: "ws/Usuario/usuario.php",
        dataType: 'json',
        data: JSON.stringify({
            "action": "DeleteUser",
            "user_id": user_id
        }),
        success: function(response) {
            console.log(response);
        }
    })
}

async function GetUserByUserId(empre){
    $.ajax({
        type: "POST",
        url: "ws/Usuario/usuario.php",
        dataType: 'json',
        data: JSON.stringify({
          "action": "GetUserByUserId",
          "empresa_id": empresa_id
        }),
        success: function(response){
            console.log(response.data);
            const userList = $('#userList');
            if(response.success && response.data.length > 0){
                response.data.forEach(user=>{
                    $(userList).append(
                    `<li user_id="${user.user_id}" class="user-element">
                        <h5>Correo</h5>
                        <p>${user.email}</p>
                        <h5>Nombre</h5>
                        <p class="userName">${user.nombre} ${user.apellido}</p>
                    </li>`)
                
                })
            }
        }
    })
}


async function GetUserRol(user_id) {
    return $.ajax({
        type: "POST",
        url: "ws/Usuario/usuario.php",
        dataType: 'json',
        data: JSON.stringify({
            "action": "GetUserRol",
            "user_id": user_id
        }),
        success: function(response) {
            console.log(response);
        }
    })
}

async function GetEmailusuario(email){
    return $.ajax({
        type: "POST",
        url: "ws/Usuario/usuario.php",
        dataType: 'json',
        data: JSON.stringify({
          "action": "GetUsuario",
          "email": email
        }),
        success: function(response){
            console.log(`EXISTE ${response}`);
        }
    })
}

async function CreateUser(request){
    return $.ajax({
        type: "POST",
        url: "ws/Usuario/usuario.php",
        dataType: 'json',
        data: JSON.stringify({
          "action": "CreateUser",
          "request": request
        }),
        success: function(response){
            console.log(response);
        }
    })
}