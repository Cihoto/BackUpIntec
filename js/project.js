function FillCreated(empresaId, status) {
    let table;
    if (status === 1) {
        table = $('#createdProjects').hide();
    }
    if (status === 2) {
        table = $('#confirmedProjects').hide();
    }
    if (status === 3) {
        table = $('#finishedProjects').hide();
    }
    $('.lds-facebook').show();

    $.ajax({
        type: "POST",
        url: "ws/proyecto/proyecto.php",
        dataType: 'json',
        data: JSON.stringify({
            "action": "getMyProjects",
            request: {
                "empresaId": empresaId,
                "status": status
            }
        }),
        success: function (response) {

            let tbody = table.find('tbody');
            tbody.empty();

            response.forEach(p => {
                let fechaRealizacion = "";
                if (p.fecha_inicio === null) {
                    p.fecha_inicio = "";
                }
                if (p.fecha_termino === null) {
                    p.fecha_termino = "";
                }
                if (p.fecha_inicio === "") {
                    fechaRealizacion = `/ ${p.fecha_termino}`;
                }
                if (p.fecha_termino === "") {
                    fechaRealizacion = `${p.fecha_inicio} /`;
                }
                if (p.fecha_inicio !== "" && p.fecha_termino !== "") {
                    fechaRealizacion = `${p.fecha_inicio} 
                                         <br>/ ${p.fecha_termino}`
                }
                if (p.fecha_inicio === "" && p.fecha_termino === "") {
                    fechaRealizacion = ""
                }

                if (p.nombreCliente === null) {
                    p.nombreCliente = "";
                }

                if (p.direccion === null) {
                    p.direccion = ""
                }

                let tr = `<tr class="getProjectDetails">;
                            <td class="idProject" align=center>${p.id}</td>
                            <td align=center>${p.nombre_proyecto}</td>
                            <td align=center>${p.nombreCliente}</td> 
                            <td align=center>${p.direccion}</td> 
                            <td align=center>${fechaRealizacion}</td>
                            <td data-tooltip="Detalles" align=center><i style="cursor:pointer;" class="fa-solid fa-eye openDetalleModal"></i></td>
                        </tr>`;
                tbody.append(tr);
            });
            $('.lds-facebook').hide();
            if (!$.fn.DataTable.isDataTable('#createdProjects')) {
                $('#createdProjects').DataTable({
                    fixedHeader: true
                })
            }
            if (!$.fn.DataTable.isDataTable('#confirmedProjects')) {
                $('#confirmedProjects').DataTable({
                    fixedHeader: true
                })
            }
            if (!$.fn.DataTable.isDataTable('#finishedProjects')) {
                $('#finishedProjects').DataTable({
                    fixedHeader: true
                })
            }
            table.fadeIn(1000)
        }
    })
}

function FillProjectList(empresaId, status) {
    let table = $('#projectList').hide();
    if ($.fn.DataTable.isDataTable('#projectList')) {
        $('#projectList').DataTable().destroy();
    }

    $('#chargeListProjects').show();

    $.ajax({
        type: "POST",
        url: "ws/proyecto/proyecto.php",
        dataType: 'json',
        data: JSON.stringify({
            "action": "getMyProjects",
            request: {
                "empresaId": empresaId,
                "status": status
            }
        }),
        success: function (response) {

            let tbody = table.find('tbody');
            tbody.empty();

            response.forEach(p => {
                let fechaRealizacion = "";
                if (p.fecha_inicio === null) {
                    p.fecha_inicio = "";
                }
                if (p.fecha_termino === null) {
                    p.fecha_termino = "";
                }

                if (p.fecha_inicio === "") {
                    fechaRealizacion = `/ ${p.fecha_termino}`;
                }
                if (p.fecha_termino === "") {
                    fechaRealizacion = `${p.fecha_inicio} /`;
                }
                if (p.fecha_inicio !== "" && p.fecha_termino !== "") {
                    fechaRealizacion = `${p.fecha_inicio} 
                                         <br>/ ${p.fecha_termino}`
                }
                if (p.fecha_inicio === "" && p.fecha_termino === "") {
                    fechaRealizacion = ""
                }

                if (p.nombreCliente === null) {
                    p.nombreCliente = "";
                }

                if (p.direccion === null) {
                    p.direccion = ""
                }

                let tr = `<tr class="getProjectDetails">;
                            <td class="idProject" align=center>${p.id}</td>
                            <td align=center>${p.nombre_proyecto}</td>
                            <td align=center>${p.nombreCliente}</td> 
                            <td align=center>${p.direccion}</td> 
                            <td align=center>${fechaRealizacion}</td>
                            <td data-tooltip="Detalles" align=center><i style="cursor:pointer;" class="fa-solid fa-eye openDetalleModal"></i></td>
                        </tr>`;
                tbody.append(tr);
            });

            $('#chargeListProjects').hide();

            if (!$.fn.DataTable.isDataTable('#projectList')) {
                $('#projectList').DataTable({
                    fixedHeader: true
                })
            }
            table.fadeIn(1000)
        }
    })
}

function GetAllProjects(empresaId) {
    let table = $('#projectList').hide();
    if ($.fn.DataTable.isDataTable('#projectList')) {
        $('#projectList').DataTable().destroy();
    }

    $('#chargeListProjects').show();

    $.ajax({
        type: "POST",
        url: "ws/proyecto/proyecto.php",
        dataType: 'json',
        data: JSON.stringify({
            "action": "GetAllProjects",
            "empresaId": empresaId
            
        }),
        success: function (response) {

            if(response.status === "success" &&  response.data.length > 0){
                Swal.fire({
                    title: '',
                    text: response.message,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer:1500,
                    position: 'bottom-end'
                })
                let tbody = table.find('tbody');
                tbody.empty();
    
                response.data.forEach(p => {
                    let fechaRealizacion = "";
                    if (p.fecha_inicio === null) {
                        p.fecha_inicio = "";
                    }
                    if (p.fecha_termino === null) {
                        p.fecha_termino = "";
                    }
    
                    if (p.fecha_inicio === "") {
                        fechaRealizacion = `/ ${p.fecha_termino}`;
                    }
                    if (p.fecha_termino === "") {
                        fechaRealizacion = `${p.fecha_inicio} /`;
                    }
                    if (p.fecha_inicio !== "" && p.fecha_termino !== "") {
                        fechaRealizacion = `${p.fecha_inicio} 
                                             <br>/ ${p.fecha_termino}`
                    }
                    if (p.fecha_inicio === "" && p.fecha_termino === "") {
                        fechaRealizacion = ""
                    }
    
                    if (p.nombreCliente === null) {
                        p.nombreCliente = "";
                    }
    
                    if (p.direccion === null) {
                        p.direccion = ""
                    }
    
                    let tr = `<tr class="getProjectDetails">;
                                <td class="idProject" align=center>${p.id}</td>
                                <td align=center>${p.nombre_proyecto}</td>
                                <td align=center>${p.nombreCliente}</td> 
                                <td align=center>${p.direccion}</td> 
                                <td align=center>${fechaRealizacion}</td>
                                <td data-tooltip="Detalles" align=center><i style="cursor:pointer;" class="fa-solid fa-eye openDetalleModal"></i></td>
                            </tr>`;
                    tbody.append(tr);
                });
            }

            if(response.status === "success" && response.data.length === 0){
                Swal.fire({
                    title: 'Ups',
                    text: response.message,
                    icon: 'info',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer:2000,
                    position: 'bottom-end'
                })
            }
            if(response.status === "error"){
                Swal.fire({
                    title: 'Ups',
                    text: response.message,
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer:2000,
                    position: 'bottom-end'
                })
            }

            $('#chargeListProjects').hide();

            if (!$.fn.DataTable.isDataTable('#projectList')) {
                $('#projectList').DataTable({
                    fixedHeader: true
                })
            }
            table.fadeIn(1000)
        }
    })
}



async function GetCalendarProjects(empresaId,status) {

    return $.ajax({
      type: "POST",
      url: "ws/proyecto/proyecto.php",
      dataType: 'json',
      data: JSON.stringify({
        "action": "GetCalendarProjects",
        empresaId: empresaId,
        status : status
      }),
      success: function(response) {
        console.log(response);
        // console.log("PROYECTOS A AAGREGAR A CALENDAR",response);

      }
    })
  }


async function GetEventsByClient(cliente_id){
    return $.ajax({
        type: "POST",
        url: "ws/proyecto/proyecto.php",
        dataType: 'json',
        data: JSON.stringify({
        "action": "GetEventsByClient",
        "cliente_id": cliente_id
        }),
        success: function(response){

        },error: function(error){

        }
    })
}


