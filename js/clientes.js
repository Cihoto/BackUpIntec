let _selectedClient = [];

function FillClientes(empresaId){

$.ajax({
  type: "POST",
  url: "ws/cliente/cliente.php",
  dataType: 'json',
  data: JSON.stringify({
    "tipo": "getClientesByEmpresa",
    request: empresaId
  }),
  success: function(response) {

    console.log("response", response);
  //   $('#clienteSelect').append(new Option("", ""));
    response.forEach(response => {
      let opt  = $('#clienteSelect').append(new Option(response.nombre_cliente, response.id))
      opt.addClass()
    })
  }
})

}

$('#clienteSelect').on('change',function(){

let idCliente = this.value;
console.log(idCliente);
$.ajax({
    type: "POST",
    url: "ws/cliente/cliente.php",
    dataType: 'json',
    data: JSON.stringify({
      "tipo": "getClienteById",
      request: idCliente
    }),
    success: function(response) {

      // console.log(response);
      // console.log(response.cliente);

      setSelectedClient(response.cliente);

      console.log(_selectedClient);

      response.cliente.forEach(cli => {
        $('#idClienteModalResume').text(cli.id);
        document.getElementById('inputNombreClienteForm').value = cli.nombre;
        document.getElementById('inputApellidos').value = cli.apellido;
        document.getElementById('inputRutCliente').value = cli.rut;
        document.getElementById('inputCorreo').value = cli.email;
        document.getElementById('inputTelefono').value = cli.telefono;
        document.getElementById('inputRut').value = cli.df_rut;
        document.getElementById('inputRazonSocial').value = cli.razon_social;
        document.getElementById('inputNombreFantasia').value = cli.nombre_fantasia;
        document.getElementById('inputDireccionDatosFacturacion').value = cli.direccion;
        document.getElementById('inputCorreoDatosFacturacion').value = cli.correo;
      })


    }
  })
})

function setSelectedClient(selectedClient){
  _selectedClient = [];

  _selectedClient = selectedClient;
}

function CleanCliente(){
    document.getElementById("clienteForm").reset();
}


function UpdateCliente(request){
  $.ajax({
    type: "POST",
    url: 'ws/cliente/cliente.php',
    data: JSON.stringify({
        "request": {
            request
        },
        "tipo": "UpdateCliente"
    }),
    dataType: 'json',
    success: function(response) {
      $('#clientDataBtn').text("Guardar");
      // console.log(response);
    },error:function(response){
      // console.log(response)
    }})
}

function GetClientData(empresa_id){

  return $.ajax({
    type: "POST",
    url: 'ws/cliente/cliente.php',
    data: JSON.stringify({
        "tipo": "getClientData",
        'empresa_id': empresa_id
    }),
    dataType: 'json',
    success: function(response) {
      console.log(response);

      if(response.success){
        console.log(response.data);

      }
      if(response.error){
        console.log(response.error);

      }
    },error:function(response){

  }})
}

async function FillCientesDisplay(){
  const dataClientes = await GetClientData(EMPRESA_ID);
  console.log(dataClientes);
  if(!dataClientes.success){
    return
  }

  if(dataClientes.data.length > 0 ){
    const container = $('#clients-container')

    dataClientes.data.forEach(cliente => {
      
      let boxCliente = `<div class="client-box">

          <h4>${cliente.nombre_fantasia}</h4>
          <hr>
          <div class="client-box-body">
            <p>${cliente.nombre} ${cliente.apellido}</p>
            <p>${cliente.rut_df}</p>
            <p>${cliente.direccion}</p>
            <p>${cliente.telefono}</p>
            <p>${cliente.email}</p>
          </div>
        </div>`;
    
        container.append(boxCliente);
    });

  }
}
async function FillClientesTable(){

  const dataClientes = await GetClientData(EMPRESA_ID);
  console.log(dataClientes);
  if(!dataClientes.success){
    return
  }

  if(dataClientes.data.length > 0 ){
    const tableClientes = $('#clientesTable > tbody');

    if ($.fn.DataTable.isDataTable( '#clientesTable' )){
      $('#clientesTable').DataTable().destroy();
    }
    tableClientes.empty();
    dataClientes.data.forEach(cliente => {
      let trClientes = 
        `<tr cliente_id="${cliente.cliente_id}"><td>${cliente.nombre_fantasia}</td>
        <td>${cliente.nombre} ${cliente.apellido}</td>
        <td>${cliente.rut_df}</td>
        <td>${cliente.direccion}</td>
        <td>${cliente.telefono}</td>
        <td>${cliente.email}</td>
        <td class="viewClientData"><i class="fa-solid fa-info"></i></td></tr>`;
      tableClientes.append(trClientes);
    });
  }
  if ( ! $.fn.DataTable.isDataTable( '#clientesTable' ) ) {
    $('#clientesTable').dataTable({
      scrollY: 400,
      ordering: true,
      fixedHeader : true
    });
  }
}

function getClientInformation(cliente_id){
  return $.ajax({
    type: "POST",
    url: 'ws/cliente/cliente.php',
    data: JSON.stringify({
        "tipo": "getClientInformation",
        'cliente_id': cliente_id
    }),
    dataType: 'json',
    success: function(response) {

    },error:function(error){

  }})
}



function ResetClienteForm(){
  $("#clienteSelect").val("");
  $("#inputNombreClienteForm").val("");
  $("#inputApellidos").val("");
  $("#inputRutCliente").val("");
  $("#inputCorreo").val("");
  $("#inputTelefono").val("");
  $("#inputRut").val("");
  $("#inputRazonSocial").val("");
  $("#inputNombreFantasia").val("");
  $("#inputDireccionDatosFacturacion").val("");
  $("#inputCorreoDatosFacturacion").val("");
}