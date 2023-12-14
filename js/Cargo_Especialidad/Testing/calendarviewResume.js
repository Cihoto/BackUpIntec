let listed;
let actualizarCliente ="";

//OPEN MODAL DIRECCION
$('#direccionInput').on('click', function() {
    $('#direccionModal').modal('show');
})

//OPEN MODAL CLIENTE
$('#inputNombreCliente').on('click', function() {
    $('#clienteModal').modal('show');
})
$(document).ready(function() {
    // VALIDAR FORM AGREGAR DIRECCION
    $('#direccionAddForm').validate({
      rules: {
        txtDir: {
          required: true
        },
        txtNumDir: {
          required: true
        },
        regionSelect: {
          required: true
        },
        comunaSelect: {
          required: true
        }
      },
      messages: {
        txtDir: {
          required: "Debe ingresar un valor"
        },
        txtNumDir: {
          required: "Debe ingresar un valor"
        },
        regionSelect: {
          required: "Debe ingresar un valor"
        },
        comunaSelect: {
          required: "Debe ingresar un valor"
        }
      },
      submitHandler: function() {
        
        event.preventDefault();
        // localStorage.clear();
        console.log("ENVIO DE INFORMACION DE PRODUCTO NUEVO UNITARIO");

        //CREAR LOCALE STORAGE TO DIRECCIONES
        $("#direccionModal ").modal('hide');
        //DATOS DE DIRECCION
        let dir = $('#txtDir').val();
        let numDir = $('#txtNumDir').val();
        let depto = $('#txtDepto').val();
        let region = $('#regionSelect').val();
        let comuna = $('#comunaSelect').val();
        let regionInput = $('#regionSelect option:selected').text();
        let comunaInput = $('#comunaSelect option:selected').text();
        let postal_code = $('#txtcodigo_postal').val();
        let idDireccion = $('#idDireccionModal').text();

        $('#direccionInput').val(`${dir} ${numDir} ${depto}, ${comunaInput}, ${regionInput}`);

        $('#lugarProjectResume').text(`${dir} ${numDir} ${depto}, ${comunaInput}, ${regionInput}`);

        SetProjectData($('#inputProjectName').val(), $('#fechaInicio').val(), $('#fechaTermino').val(), $('#inputNombreCliente').val(), $('#commentProjectArea').val() );

        if(localStorage.getItem("direccion") === null){
          localStorage.setItem("direccion", JSON.stringify([{dir,
                                                            numDir,
                                                            depto,
                                                            region,
                                                            comuna,
                                                            regionInput,
                                                            comunaInput,
                                                            postal_code,
                                                            idDireccion}]))
        }else{
          let allDirs = JSON.parse(localStorage.getItem("direccion"))
          allDirs.push({dir,numDir,depto,region,comuna,regionInput,comunaInput,postal_code,idDireccion});
          localStorage.setItem("direccion",JSON.stringify(allDirs));
        }

        console.log(JSON.parse(localStorage.getItem('direccion')))
        
      }
    })

    $('#projectForm').validate({
        rules: {
            txtProjectName: {
                required: true
            },
            dpInicio: {
                required: false
            },
            dpTermino: {
                required: false
            },
            txtDir: {},
            txtCliente: {}
        },
        messages: {
            txtProjectName: {
                required: "Ingrese un valor"
            },
            dpInicio: {
                required: "Ingrese un valor"
            },
            dpTermino: {
                required: "Ingrese un valor"
            },
            txtDir: {
                required: "Ingrese un valor"
            },
            txtCliente: {
                required: "Ingrese un valor"
            }
        },
        submitHandler: async function () {
            event.preventDefault();
            let form = $('#projectForm').serializeArray();

            let request = convertFormToJSON(form);

            request["idProject"] = $('#idProjectModalResume').text();

            updateProject().then(()=>{
                UpdateProjectData(request);
            });

        }
    })

    // Fill Clientes
    FillClientes(EMPRESA_ID);
    //FILL DIRECCIONES
    FillDirecciones();

    //FILL PRODUCTOS
    // FillProductos(EMPRESA_ID);

    // FILL PERSONAL
    FillPersonal(EMPRESA_ID);

    //FILLPROJECTS
    // FillCreated(EMPRESA_ID);

})

function convertFormToJSON(form) {
  return form.reduce(function (json, { name, value}){
      json[name] = value
      return json;
    }, {});
}

$('#created-tab').on('click',function(){
    FillCreated(EMPRESA_ID,1); 
})
$('#confirmed-tab').on('click',function(){
    FillCreated(EMPRESA_ID,2); 
})
$('#finished-tab').on('click',function(){
    FillCreated(EMPRESA_ID,3); 
})


$('#getAvailableVehicles').on('click',function(){

    let navItem = $(this).find('.projectAssigmentTab')
    if($(navItem).hasClass('active')){
        $(navItem).removeClass('active')
        $('#vehicle').removeClass('active show').addClass('fade');
    }else{

        CloseAllTabsOnProjectsAssigments();
        $(navItem).addClass('active');
        $('#vehicle').removeClass('fade').addClass('active show');
        $('#DragVehiculos').show();
        $('#fechaInicio').val();
        $('#fechaTermino').val();
        let fechaInicio = $('#fechaInicio').val();
        let fechaTermino = $('#fechaTermino').val();
        DropVehiculos();
        if(fechaInicio === "" || fechaTermino === ""){
            Swal.fire({
                title: '',
                text: "Debes seleccionar el rango de fechas en las que se realizará este proyecto para poder ver los vehículos disponibles, ¿Deseas continuar y ver todos tus vehículos?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ver todos los vehículos',
                cancelButtonText: 'Seleccionaré un rango de fechas'
                }).then((result) => {
                if (result.isConfirmed) {
                    FillVehiculos(EMPRESA_ID);
                }else{
                }
            })
        }
        if(fechaInicio !== "" && fechaTermino !== ""){
            GetAvailableVehicles(EMPRESA_ID,fechaInicio,fechaTermino);    
        }
    }
})

$('#products-tab').on('click',function(){

})


function DropAllSelectedProducts(){
    $('.detailsProduct-box').each((key,element)=>{
        $(element).remove();
    })
}

function DropVehiculos(){
    $('#sortable1 li').each((key,element)=>{
        $(element).remove()
    })
}

function DropDragPersonal(){
    $('#sortablePersonal2 li').each((key,element)=>{
        $(element).remove()
    })
}

$('#tableResumeView').on('click',function(){
    let navItem = $(this).find('.projectAssigmentTab')
    if($(navItem).hasClass('active')){
        $(navItem).removeClass('active')
        $('#resumen').removeClass('active show').addClass('fade');
    }else{
        CloseAllTabsOnProjectsAssigments();
        $(navItem).addClass('active')
        $('#resumen').removeClass('fade').addClass('active show');
        GetResumeProjectList();
    }
    
})

function GetResumeProjectList(){

    // $('#resumen').show();
    let idProyecto = $('#idProjectModalResume').text();
    let dataProject = GetProjectData();
    let personalProject = GetPersonalStorage();
    let productosProject = GetProductsStorage();
    let vehiculosProject = GetVehicleStorage();
    let arriendosProject = GetArriendosProject();
    let viaticoProject = GetProjectViaticos();
    let totalIngresos = GetTotalProject();
    let direccion = localStorage.getItem('direccion');

    console.log("DATOS DEL PROYECTO",dataProject);

    if(listed !== idProyecto){
        ClearTables();
    }

    if(listed !== idProyecto){
        listed = idProyecto;
        if(dataProject !== false){
            
            $('#projectNameResume').text(`${dataProject.nombre_proyecto}`);
            $('#fechaProjectResume').text(`${dataProject.fecha_inicio} ${dataProject.fecha_termino}`);
            $('#clienteProjectResume').text(`${dataProject.nombre_cliente}`);
            $('#lugarProjectResume').text("");
            $('#comentariosProjectResume').text(dataProject.comentarios);
            
        }

        if(personalProject !== false){
            AppendPersonalTableResumeArray(personalProject);
        }
    
        if(productosProject !== false){
            AppendProductosTableResumeArray(productosProject);
        }
    
        if(vehiculosProject !== false){
            AppendVehiculoTableResumeArray(vehiculosProject);
        }

        if(viaticoProject !== false){
            viaticoProject.forEach(element =>{
                AddViaticoWithValues(element.valor, element.detalle);
            });
            SetResumeViaticoResumeValue();
        }

        if(arriendosProject !== false){
            arriendosProject.forEach(element => {
                AddSubArriendoWithValues(element.detalle,element.valor);
            });
            SetResumeArriendosResumeValue();
        }

        if(totalIngresos !== false){
            totalIngresos.forEach(element => {
                console.log("TOTAL INGRESOS PARA TEXT",element.valor);
                $('#totalIngresos').text(element.valor);
            });
            CalcularUtilidad();
        }

    }
}


$('#clienteSelect').on('change',function(){

    $('#clientDataBtn').text("Guardar");
    const SelectValue = $(this).val();
    if(SelectValue === "" || SelectValue === "new"){
        ResetClienteForm();
        $('#idClienteModalResume').text("");
    }
})


$('#clienteForm input').on('change',function(){

    let actualizarCliente = $('#clienteSelect').val();
    if(actualizarCliente !== "new" || actualizarCliente !== ""){
        SetUpdateCliente(true);
    }else{
        SetUpdateCliente(false);
    }

    if(GetUpdateCliente() === true && $('#clientDataBtn').text() !== "Actualizar datos del cliente"){
        SetUpdateCliente(false);
        Swal.fire({
                title: 'Crear nuevo cliente?',
                text: "Estás cambiando los datos del cliente,deseas crear un nuevo cliente o actualizar los datos del actual? ",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Quiero crear un nuevo cliente',
                cancelButtonText: 'Quiero actualizar este cliente!'
            }).then((result) => {
            if (result.isConfirmed){
                $('#idClienteModalResume').text("");
            } else {
                $('#clientDataBtn').text("Actualizar datos del cliente");
            }
        })
    }
});

$('#clientDataBtn').on('click',function(){
    if($("#clienteForm").valid()){
        let idCliente = $('#clienteSelect').val();
        let nombreCliente = $('#inputNombreClienteForm').val();
        let apellidos = $('#inputApellidos').val();
        let rutCliente = $('#inputRutCliente').val();
        let correo = $('#inputCorreo').val();
        let telefono = $('#inputTelefono').val();
        let rut = $('#inputRut').val();
        let razonSocial = $('#inputRazonSocial').val();
        let nombreFantasia = $('#inputNombreFantasia').val();
        let direccionDatosFacturacion = $('#inputDireccionDatosFacturacion').val();
        let correoDatosFacturacion = $('#inputCorreoDatosFacturacion').val();

        if($('#clientDataBtn').text()==="Actualizar datos del cliente"){
            let updateClienteRequest = {
                idCliente:idCliente,
                nombreCliente:nombreCliente,
                apellidos:apellidos,
                rutCliente:rutCliente,
                correo:correo,
                telefono:telefono,
                rut:rut,
                razonSocial:razonSocial,
                nombreFantasia:nombreFantasia,
                direccionDatosFacturacion:direccionDatosFacturacion,
                correoDatosFacturacion:correoDatosFacturacion
            };
            UpdateCliente(updateClienteRequest);

        }else{
        }
    }
})

//VALIDAR DATOS DE CLIENTE
$('#clienteForm').validate({
      rules: {
        txtNombreCliente:{
          required:true
        },
        txtApellidos:{
          required:true
        },
        txtRut:{
          required:true
        },
        txtCorreo:{
          required:true
        },
        txtTelefono:{
          required:true
        },
        txtRut:{
          required:true
        },
        txtRazonSocial:{
          required:true
        },
        txtNombreFantasia:{
          required:true
        },
        txtDireccionDatosFacturacion:{
          required:true
        },
        txtCorreoDatosFacturacion:{
          required:true
        }
      },
      messages: {
        txtNombreCliente:{
          required : "Ingrese un valor"
        },
        txtApellidos:{
          required : "Ingrese un valor"
        },
        txtRut:{
          required : "Ingrese un valor"
        },
        txtCorreo:{
          required : "Ingrese un valor"
        },
        txtTelefono:{
          required : "Ingrese un valor"
        },
        txtRut:{
          required : "Ingrese un valor"
        },
        txtRazonSocial:{
          required : "Ingrese un valor"
        },
        txtNombreFantasia:{
          required : "Ingrese un valor"
        },
        txtDireccionDatosFacturacion:{
          required : "Ingrese un valor"
        },
        txtCorreoDatosFacturacion:{
          required : "Ingrese un valor"
        }
      },
      submitHandler: function() {
        event.preventDefault();
        //DATOS DE CLIENTE
        let nombreCliente = $('#inputNombreClienteForm').val();
        let apellidos = $('#inputApellidos').val();
        let rutCliente = $('#inputRutCliente').val();
        let correo = $('#inputCorreo').val();
        let telefono = $('#inputTelefono').val();
        let rut = $('#inputRut').val();
        let razonSocial = $('#inputRazonSocial').val();
        let nombreFantasia = $('#inputNombreFantasia').val();
        let direccionDatosFacturacion = $('#inputDireccionDatosFacturacion').val();
        let correoDatosFacturacion = $('#inputCorreoDatosFacturacion').val();
        $('#inputNombreCliente').val(`${nombreFantasia} | ${rut}`);
        $('#clienteProjectResume').text(`${nombreFantasia} | ${rut}`);

        SetProjectData($('#inputProjectName').val(), $('#fechaInicio').val(), $('#fechaTermino').val(), $('#inputNombreCliente').val(), $('#commentProjectArea').val());

        $("#clienteModal ").modal('hide');
      }
    })

$('#updateProject').on('click', function() {
    $('#hiddenAddProject').trigger('click');
})
$(document).on('click', '.logoRemove', function() {
      let productId = $(this).closest('.detailsProduct-box').find('.itemId').text()
    
      $(this).closest('.detailsProduct-box').remove()
      $('#resumeBody').find(`.idProd${productId}`).remove();
    })

$('#verarray').on('click',function(){
    
})

$('#getAvailableProducts').on('click',function(){


    let navItem = $(this).find('.projectAssigmentTab')
    if($(navItem).hasClass('active')){
        $(navItem).removeClass('active')
        $('#products').removeClass('active show').addClass('fade');
    }else{
        
        CloseAllTabsOnProjectsAssigments();
        $(navItem).addClass('active')
        $('#products').removeClass('fade').addClass('active show');
    
        if($('#fechaInicio').val() === "" || $('#fechaTermino').val() === ""){
    
            Swal.fire({
                title: '',
                text: "Debes seleccionar el rango de fechas en las que se realizara este proyecto para poder ver los productos disponibles,Deseas continuar y ver todos tus productos sin asignar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ver todos los productos',
                cancelButtonText: 'Seleccionaré un rango de fechas'
                }).then((result) => {
                if (result.isConfirmed) {
                    FillProductosAvailable(EMPRESA_ID,"all","","");
                }
            })
        }
    
        if($('#fechaInicio').val() !== "" && $('#fechaTermino').val() !== ""){
            FillProductosAvailable(EMPRESA_ID,"available",$('#fechaInicio').val(),$('#fechaTermino').val());
        }
    
    
    }

})

$('#getAvailablePersonal').on('click',function(){

    let navItem = $(this).find('.projectAssigmentTab')
    if($(navItem).hasClass('active')){
        $(navItem).removeClass('active')
        $('#personal').removeClass('active show').addClass('fade');
    }else{
        
        CloseAllTabsOnProjectsAssigments();
        $(navItem).addClass('active')
        $('#personal').removeClass('fade').addClass('active show');
    
        if($('#fechaInicio').val() === "" || $('#fechaTermino').val() === ""){
    
            Swal.fire({
                title: '',
                text: "Debes seleccionar el rango de fechas en las que se realizara este proyecto para poder ver los tecnicos disponibles,Deseas continuar y ver todos tus productos sin asignar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ver todos los productos',
                cancelButtonText: 'Seleccionaré un rango de fechas'
                }).then((result) => {
                if (result.isConfirmed){

                }
            })
        }
    }
})

$('#changeStatusButton').on('click',function(){
    let idProject = $('#idProjectModalResume').text();
    $.ajax({
    type: "POST",
    url: 'ws/proyecto/proyecto.php',
    data: JSON.stringify({
      idProject: idProject,
      action: "UpdateProjectDataStatus"
    }),
    dataType: 'json',
    success: function (data) {
    },
    error: function (response) {

    }
  })
  updateProject();

})

$('#inputProjectName').on('change',function(){
    $('#projectNameResume').text($('#inputProjectName').val)

})
$('#fechaInicio').on('change',function(){
    $('#fechaProjectResume').text( `${$('#fechaInicio').val()}  / ${$('#fechaTermino').val() }`);
})

$('#fechaTermino').on('change',function(){
    $('#fechaProjectResume').text( `${$('#fechaInicio').val()}  / ${$('#fechaTermino').val() }`);
})

$('#direccionInput').on('change',function(){
    $('#lugarProjectResume').text();
})

$('#inputNombreCliente').on('change',function(){
    $('#inputNombreCliente').text($('#inputNombreCliente').val())
})

$('#commentProjectArea').on('change',function(){

    $('#comentariosProjectResume').text($('#commentProjectArea').val());
})


$(document).on('click', '.getProjectDetails', function(){
    // console.log("THIS DE VIEW RESUME",$(this));
     ViewResume($(this))
});


function ViewResume(element){

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

let projectId = element.closest('tr').find('.idProject').text();

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
  success: function (response) {
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

    } else {
    }


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
  error: function (err) { }
})
}


// $('.getProjectDetails').on('click',function(){
//     console.log("THIS DE VIEW RESUME",this);
//     // ViewResume($(this));
// })

