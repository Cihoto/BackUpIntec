<?php
$isDetails = true;
//Variables que manipulan condiciones if en Form proyecto
$detalle = true;
?>
<!DOCTYPE html>
<html lang="en">

<?php
require_once('./includes/head.php');
$active = 'dashboard';
?>

<body>
  <script src="./assets/js/initTheme.js"></script>
  <?php require_once('./includes/Constantes/empresaId.php') ?>
  
  <?php require_once('./includes/Constantes/rol.php') ?>
  <div id="app">

    <?php require_once('./includes/sidebar.php') ?>

    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-header">
        <h3>Dashboard</h3>
      </div>

      <div class="page-content">
        <!-- main section -->
        <!-- <section class="row"> -->
        <!-- info central grid -->
        <div class="col-12 justify-content-center">
          <!-- primer  -->
          <div class="row justify-content-center mb-5">

            <div class="col-md-5 col-12 mh-100 ">
              <div class="card">
                <div class="card-body p-4 mh-75">
                  <ul id="project-resume">
                    <li class="headerLi">
                      <div class="projectData">
                        <p class="projectName lipad">Nombre</p>
                        <p class="projectDate lipad">Fecha</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- calendario -->
            <div class="col-md-7 col-10">
              <div class="card">
                <div class="card-body px-4 py-4-5">

                  <div class="col-11">
                    <div id="calendar"></div>
                  </div>

                  <!-- <a href="#">
                    <div class="row">
                      <div class="col-12 d-flex justify-content-center align-items-center">
                        
                      </div>
                    </div>
                  </a> -->
                </div>
              </div>
            </div>
            <!-- fin calendario -->

          </div>


          <div class="row justify-content-around">
            <!-- eventos -->
            <div class="col-lg-3 col-md-4 col-sm-5 col-10 ">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <a href="proyectos.php">
                    <div class="row">
                      <!-- icono del cuadro info -->
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center">
                        <!-- color recuadro -->
                        <div class="stats-icon purple mb-2">
                          <!-- logo interno icono -->
                          <i class="iconly-boldCalendar"></i>
                        </div>
                      </div>
                      <!-- fin icono -->
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7  d-flex justify-content-center align-items-center">
                        <h5 class="text-muted font-semibold">
                          Proximos Eventos
                        </h5>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <!-- fin eventos -->

            <!-- inventario -->
            <div class="col-lg-3 col-md-4 col-sm-5 col-10 ">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <a href="inventario.php">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center">
                        <div class="stats-icon blue mb-2">
                          <i class="fa-solid fa-warehouse"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 d-flex justify-content-center align-items-center">
                        <h5 class="text-muted font-semibold">Inventario</h5>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <!-- fin inventario -->
          </div>


          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Urgencias</h4>
                </div>
                <div class="card-body">
                  tabla con info de los equipos con reparaciones pendientes
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-xl-4">
              <div class="card">
                <div class="card-header">
                  <h4>Profile Visit</h4>
                </div>
                <div class="card-body">
                  Info de los prox eventos
                </div>
              </div>
            </div>

            <div class="col-12 col-xl-8">
              <div class="card">
                <div class="card-header">
                  <h4>Algo que agregar</h4>
                </div>
                <div class="card-body">
                  body
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- <button id="changedateevent">CAMBIAR FECHA EVENTO</button> -->

        <!-- info in grid right -->
        <!-- <div class="col-12">
              <div class="card">
                <div class="card-body py-4 px-4">
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                      <img src="assets/images/faces/1.jpg" alt="Face 1" />
                    </div>
                    <div class="ms-3 name">
                      <h5 class="font-bold">John Duck</h5>
                      <h6 class="text-muted mb-0">@johnducky</h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4>Recent Messages</h4>
                </div>
                <div class="card-content pb-4">
                  <div class="recent-message d-flex px-4 py-3">
                    <div class="avatar avatar-lg">
                      <img src="assets/images/faces/4.jpg" />
                    </div>
                    <div class="name ms-4">
                      <h5 class="mb-1">Hank Schrader</h5>
                      <h6 class="text-muted mb-0">@johnducky</h6>
                    </div>
                  </div>
                  <div class="recent-message d-flex px-4 py-3">
                    <div class="avatar avatar-lg">
                      <img src="assets/images/faces/5.jpg" />
                    </div>
                    <div class="name ms-4">
                      <h5 class="mb-1">Dean Winchester</h5>
                      <h6 class="text-muted mb-0">@imdean</h6>
                    </div>
                  </div>
                  <div class="recent-message d-flex px-4 py-3">
                    <div class="avatar avatar-lg">
                      <img src="assets/images/faces/1.jpg" />
                    </div>
                    <div class="name ms-4">
                      <h5 class="mb-1">John Dodol</h5>
                      <h6 class="text-muted mb-0">@dodoljohn</h6>
                    </div>
                  </div>
                  <div class="px-4">
                    <button
                      class="btn btn-block btn-xl btn-outline-primary font-bold mt-3"
                    >
                      Start Conversation
                    </button>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4>Visitors Profile</h4>
                </div>
                <div class="card-body">
                  <div id="chart-visitors-profile"></div>
                </div>
              </div>
            </div> -->

        <!-- </section> -->
      </div>

      <?php include_once('./includes/Modal/detallesProyecto.php') ?>

      <?php require_once('./includes/footer.php') ?>

    </div>
  </div>

  <?php require_once('./includes/footerScriptsJs.php') ?>
  <?php require_once('./includes/Modal/detallesProyecto.php'); ?>
  <?php require_once('./includes/Modal/cliente.php'); ?>
  <?php require_once('./includes/Modal/direccion.php'); ?>

</body>

<script src="/js/Funciones/UpdateProject.js"></script>
<script src="/js/clientes.js"></script>
<script src="/js/direccion.js"></script>
<script src="/js/personal.js"></script>
<script src="/js/vehiculos.js"></script>
<script src="/js/productos.js"></script>
<script src="/js/project.js"></script>
<script src="/js/Funciones/NewProject.js"></script>
<script src="/js/localeStorage.js"></script>
<script src="/js/valuesValidator/validator.js"></script>
<script src="/js/ClearData/clearFunctions.js"></script>
<script src="/js/ProjectResume/viatico.js"></script>
<script src="/js/ProjectResume/subArriendo.js"></script>
<script src="/js/ProjectResume/projectResume.js"></script>
<script src="/js/Funciones/assigments.js"></script>
<script src="/js/Cargo_Especialidad/Testing/calendarviewResume.js"></script>
<script src="/js/calendar.js"></script>

<script>
  const EMPRESA_ID = $('#empresaId').text();
  let calendar;
  var calendarEl = document.getElementById('calendar');

  async function GetCalendarProjects(empresaId) {
    return $.ajax({
      type: "POST",
      url: "ws/proyecto/proyecto.php",
      dataType: 'json',
      data: JSON.stringify({
        "action": "GetAllMyProjects",
        empresaId: empresaId
      }),
      success: function(response) {
        // console.log("PROYECTOS A AAGREGAR A CALENDAR",response);

      }
    })
  }

  $('#changedateevent').on('click', function() {
    // console.log(calendar.getEvent());

    let calendarData = calendar.getEvents();
    console.log(calendarData);
    let specificEvent = calendar.getEventById(75);
  })

  async function fillListProjects() {
    let eventos = await GetCalendarProjects(EMPRESA_ID);
    let ul = $('#project-resume');

    console.log("eventos", eventos);

    eventos.forEach((element) => {
      let li = `<li class="headerLi">
                  <div class="projectData">
                    <p class="projectName lipad">${element.nombre_proyecto}</p>
                    <p class="projectDate lipad">${element.fecha_inicio} / ${element.fecha_termino}</p>
                  </div>
                </li>`
      ul.append(li);
    })
  }

  document.addEventListener('DOMContentLoaded', async function() {

    fillListProjects();


    FillCalendar(0);

    // const events = await (GetCalendarProjects(EMPRESA_ID));
    // let calendarEventObj = [];

    // console.log(events);

    // events.forEach(element => {

    //   console.log(element.id);
    //   let color = "white";
    //   let textColor = "black";
    //   if (element.estado === 'creado') {
    //     color = "yellow";
    //     let textColor = "black";

    //   }
    //   if (element.estado === 'confirmado') {
    //     color = "green";
    //     let textColor = "white";

    //   }
    //   if (element.estado === 'finalizado') {
    //     color = "blue";
    //     let textColor = "white";

    //   }

    //   calendarEventObj.push({
    //     id: element.id,
    //     title: element.nombre_proyecto,
    //     start: element.fecha_inicio,
    //     end: element.fecha_termino,
    //     color: color,
    //     textColor: textColor
    //   })

    // });

   
    // calendar = new FullCalendar.Calendar(calendarEl, {
    //   eventClick: function(info) {

    //     // ViewResume(projectId)

    //     console.log(`ID ${info.event.id}`);
    //     ViewResume(info.event.id);
    //     // alert('Event: ' + info.event.title);
    //     // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    //     // alert('View: ' + info.view.type);
    //     // change the border color just for fun
    //     // info.el.style.borderColor = 'red';
    //   },
    //   events: calendarEventObj
    // })
    // calendar.render();

  });


  function ViewResume(projectId) {

    // $('#resumen').show();
    ResetClienteForm();
    localStorage.clear();

    // LIMPIAR TODOS LOS li PERSONAL ASSIGNED
    DropDragPersonal();

    // CLOSE ALL NAV-LINKS IN PORJECT ASSIGMENTS
    CloseAllTabsOnProjectsAssigments();

    // CLEAR PRODUCTS ASSIGMENTS
    DropAllSelectedProducts();

    // console.log("LOCAL STORAGE POST CLEAN FUNCTION",GetPersonalStorage());

    $('#idProjectModalResume').text("");
    $('#idClienteModalResume').text("");
    $('#idLugarModalResume').text("");

    // let projectId = element.closest('tr').find('.idProject').text();

    $('#idProjectModalResume').text(projectId);

    $('#proyectosModal').modal('show');

    let projectRequest = {
      idProject: projectId,
      asignados: true
    }

    $.ajax({
      type: "POST",
      url: 'ws/proyecto/proyecto.php',
      data: JSON.stringify({
        request: {
          projectRequest
        },
        action: "getProjectResume"
      }),
      dataType: 'json',
      success: function(response) {
        // console.table(response.asignados.vehiculos);
        // console.table(response.asignados.personal);
        // console.table(response.asignados.cliente);
        // console.table(response.asignados.productos);
        // console.table(response.asignados.viaticos);
        // console.table(response.asignados.arriendos);
        // console.table(response.asignados.totalIngresos);
        console.table(response.dataProject);

        response.dataProject.forEach(data => {

          let nombre_cliente;

          // console.table("response.asignados.cliente",response.asignados.cliente);
          if (response.asignados.cliente.length > 0) {

            response.asignados.cliente.forEach(cliente => {
              $('#inputTelefono').val(cliente.telefono);
              $('#inputNombreCliente').val(`${cliente.nombre} ${cliente.apellido} | ${cliente.razon_social} | ${cliente.rut_df}`);
              nombre_cliente = `${cliente.nombre} ${cliente.apellido} | ${cliente.razon_social} | ${cliente.rut_df}`;
            });
          }
          if (data.nombre_proyecto === "" || data.nombre_proyecto === undefined || data.nombre_proyecto === null) {
            data.nombre_proyecto = "";
          }
          if (data.fecha_inicio === "" || data.fecha_inicio === undefined || data.fecha_inicio === null) {
            data.fecha_inicio = "";
          }
          if (data.fecha_termino === "" || data.fecha_termino === undefined || data.fecha_termino === null) {
            data.fecha_termino = "";
          }
          // console.log("NOMBRE CLIENTE",nombre_cliente);
          if (nombre_cliente === "" || nombre_cliente === undefined || nombre_cliente === null) {
            nombre_cliente = "";
          }
          if (data.comentarios === "" || data.comentarios === undefined || data.comentarios === null) {
            comentarios = "";
          }

          console.log("NOMBRE PROYECTO", data.nombre_proyecto);
          $('#inputProjectName').val(data.nombre_proyecto);
          $('#fechaInicio').val(data.fecha_inicio)
          $('#fechaTermino').val(data.fecha_termino)
          $('#direccionInput').val('')

          if (data.lugarId === null) {

            $('#direccionInput').val("")

          } else {

            $('#direccionInput').val(data.direccion + ' ' + data.numero + ' ' + data.dpto + ', ' + data.comuna + ', ' + data.region)
          }

          $('#inputNombreCliente').val(data.nombre_cliente)
          $('#commentProjectArea').val(data.comentarios);
          $('#estadoProyecto').text(data.estado);
          if (data.estado === "1") {
            $('#changeStatusButton').text("Confirmar Evento")
          }
          if (data.estado === "2") {
            $('#changeStatusButton').text("Finalizar Evento")
          }
          if (data.estado === "3") {
            $('#changeStatusButton').css('display', 'none');
          }
          SetProjectData(data.nombre_proyecto, data.fecha_inicio, data.fecha_termino, nombre_cliente, data.comentarios);
        });

        if (response.asignados.vehiculos.length > 0) {
          // console.log('ARRAY DE VEHICLOS',response.asignados.vehiculos)
          response.asignados.vehiculos.forEach(asignado => {
            $('#sortable2').append(`<li style="display:flex; justify-content:space-between;" class="${asignado.id}">
                                            ${asignado.patente}
                                            <div class="personalPricing" style="display:flex;align-content: center;">
                                                <input type="number" name="price" value="" class="vehiclePrice" placeholder="Costo"/>
                                                <i onclick="AddVehiculo(this)"class="fa-solid fa-plus addPersonal"></i>
                                            </div>
                                        </li>`)
            VehicleStorage(asignado.id, asignado.patente, asignado.costo);
            // console.log("SI SE ASIGNA EL LOCALSTORAGE DE VEHICULOS");
          });

        } else {
          // VehicleStorage("","","");
          document.getElementById('car').style.display = "block"
        }

        if (response.asignados.productos.length > 0) {
          response.asignados.productos.forEach(asignado => {
            AddDivProduct(asignado.nombre, asignado.precio_arriendo, asignado.id, asignado.cantidad);
            let totalPrice = parseInt(asignado.precio_arriendo) * parseInt(asignado.cantidad)
            ProductsStorage(asignado.id, asignado.nombre, asignado.precio_arriendo, asignado.cantidad, totalPrice);
          });

        } else {
          // ProductsStorage({id:"", nombre:"", precio_arriendo:"", cantidad:"",totalPrice:""});
        }

        if (response.asignados.cliente.length > 0) {
          response.asignados.cliente.forEach(cliente => {
            $('#clienteSelect').val(cliente.id);
            $('#idClienteModalResume').text(cliente.id);
            $('#inputNombreClienteForm').val(cliente.nombre);
            $('#inputApellidos').val(cliente.apellido);
            $('#inputRutCliente').val(cliente.rut);
            $('#inputCorreo').val(cliente.correo);
            $('#inputTelefono').val(cliente.telefono);
            $('#inputRut').val(cliente.rut_df);
            $('#inputRazonSocial').val(cliente.razon_social);
            $('#inputNombreFantasia').val(cliente.nombre_fantasia);
            $('#inputDireccionDatosFacturacion').val(cliente.direccion);
            $('#inputCorreoDatosFacturacion').val(cliente.correo);
            $('#inputNombreCliente').val(`${cliente.nombre} ${cliente.apellido} | ${cliente.razon_social} | ${cliente.rut_df}`);
          });
        } else {
          document.getElementById('person').style.display = "none";
        }

        if (response.asignados.personal.length > 0) {
          response.asignados.personal.forEach(asignado => {
            $('#sortablePersonal2').append(`<li style="display:flex; justify-content:space-between;" class="${asignado.id}">
                                          ${asignado.nombre} | ${asignado.cargo} ${asignado.especialidad} 
                                          <div class="personalPricing" style="display:flex;align-content: center;">
                                              <input type="number" name="price" value="${asignado.costo}" class="personalPrice" placeholder="Costo"/>
                                              <i onclick="AddPersonal(this)" style="display:none" class="fa-solid fa-plus addPersonal"></i>
                                              <i onclick="removePersonal(this)" class="fa-solid fa-minus" style="color: #b92413;"></i>
                                          </div>
                                      </li>`);

            PersonalLocalStorage(asignado.id, `${asignado.nombre} | ${asignado.cargo} ${asignado.especialidad}`, asignado.costo, asignado.contrato);
          });

        } else {}


        if (response.asignados.arriendos.length > 0) {
          response.asignados.arriendos.forEach(asignado => {

            SetArriendosProject(asignado.id_proyecto, parseInt(asignado.valor), asignado.detalle_arriendo)
          });

        } else {

        }
        if (response.asignados.viaticos.length > 0) {
          response.asignados.viaticos.forEach(asignado => {
            SetViatico(asignado.proyecto_id, asignado.valor, asignado.detalle);
          });
        } else {

        }

        if (response.asignados.totalIngresos.length > 0) {
          response.asignados.totalIngresos.forEach(asignado => {
            console.log("TOTAL INGRESOS", asignado);

            SetTotalProject(asignado.id_proyecto, asignado.total, "");

          });
        } else {
          SetTotalProject("", 0, "");
        }
        // GetResumeProjectList();
      },
      error: function(err) {}
    })
  }


  $('#clienteSelect').on('change', function() {

    $('#clientDataBtn').text("Guardar");
    const SelectValue = $(this).val();

    if (SelectValue === "" || SelectValue === "new") {

      ResetClienteForm();

      $('#idClienteModalResume').text("");
    }
  })


  function DropAllSelectedProducts() {
    $('.detailsProduct-box').each((key, element) => {
      $(element).remove();
    })
  }

  function DropVehiculos() {
    $('#sortable1 li').each((key, element) => {
      $(element).remove()
    })
  }

  function DropDragPersonal() {
    $('#sortablePersonal2 li').each((key, element) => {
      $(element).remove()
    })
  }
</script>

</html>