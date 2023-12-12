let _projectsToList = [];

async function getEvents(empresa_id){
    $.ajax({
        type: "POST",
        url: "ws/proyecto/proyecto.php",
        dataType: 'json',
        data: JSON.stringify({
            "action": "getAllMyProjects_list_toExecute",
            "empresa_id": empresa_id,
            "status": 1
        }),
        success: function (response) {
            _projectsToList = response;

            // console.log(_projectsToList)
            printAllProjects();
        }
    })
}



async function printAllProjects(){

    // $('#allProjectTable-list tbody tr').remove();
    _projectsToList.forEach((evento)=>{


        let color = "";
        if(evento.estado === "creado"){

        }
        if(evento.estado === "confirmado"){
            color = "#27AE60"
        }
        if(evento.estado === "finalizado"){
            color = "#7F45E3"
        }


        if(evento.nombreCliente === null){
            evento.nombreCliente = ""
        }
        // let estadoStyle = '<p style =""></p>'

    //     let trs = `<tr project_id=${evento.id}>
    //     <td><p> ${evento.nombre_proyecto}</p></td>
    //     <td><p class="p-estado" style="border-radius:10px; background-color:${color};">${evento.estado}</p></td>
    //     <td><p>${evento.fecha_inicio}</p></td>
    //     <td><p >${evento.nombreCliente}</p></td>
    //     <td>Tipo de evento</td>
    //     <td>Precio venta</td>
    //     <td>Owner</td>
    //   </tr>`



      let tr = `<tr evento_id="${evento.id}" class="eventListRow">
        <td style="width: 17.8226514%;">
            <p class="event-name"> ${evento.nombre_proyecto} </p>
            <button class="commentContainer">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M15.75 8.62502C15.7526 9.61492 15.5213 10.5914 15.075 11.475C14.5458 12.5338 13.7323 13.4244 12.7256 14.047C11.7189 14.6696 10.5587 14.9996 9.375 15C8.3851 15.0026 7.40859 14.7713 6.525 14.325L2.25 15.75L3.675 11.475C3.2287 10.5914 2.99742 9.61492 3 8.62502C3.00046 7.44134 3.33046 6.28116 3.95304 5.27443C4.57562 4.26771 5.46619 3.4542 6.525 2.92502C7.40859 2.47872 8.3851 2.24744 9.375 2.25002H9.75C11.3133 2.33627 12.7898 2.99609 13.8969 4.10317C15.0039 5.21024 15.6638 6.68676 15.75 8.25002V8.62502Z" stroke="#069B99" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

        </td>
        <td style="width: 6.67251975%;padding: 10px 16px 10px 8px;"><p class="event-status ${evento.estado}">${ evento.estado[0].toUpperCase()}${evento.estado.slice(1)}</p></td>
        <td style="width: 12.642669%;"> <p>${evento.fecha_inicio}</p></td>
        <td style="width: 13.5355575%;"><p class="event-client-name">${evento.nombreCliente}</p></td>
        <td style="width: 10.5355575%;"><p>Tipo de evento</p></td>
        <td style="width: 10.5355575%;"><p>Precio venta</p></td>
        <td style="width: 10.5355575%;"><p>Owner</p></td>
        <td style="width: 14.15%;">
            <button class="buttonEventList">
                <img src="./assets/svg/ArchiveActive.svg" alt="">
            </button>
            <button class="buttonEventList">
                <img src="./assets/svg/PersonalNoActive.svg" alt="">
            </button>
            <button class="buttonEventList">
                <img src="./assets/svg/VehicleActive.svg" alt="">
            </button>
        </td>
    </tr>`

      $('#allProjectTable-list tbody').append(tr);
    })
}