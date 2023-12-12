async function addLugar(lugarRequest) {
  return $.ajax({
    type: "POST",
    url: 'ws/lugar/lugar.php',
    data: JSON.stringify({
      request: lugarRequest,
      action: "addLugar"
    }),
    dataType: 'json',
    success: function (data) {
      let id_lugar = data.id_lugar;
      console.log("LUGAR", data);
    },
    error: function (response) {
      console.log(response);
    }
  })
}

async function addDir(dirRequest) {
  return $.ajax({
    type: "POST",
    url: 'ws/direccion/direccion.php',
    data: JSON.stringify({
      request: dirRequest,
      action: "addDireccion"
    }),
    dataType: 'json',
    success: function (data) {

      id_direccion = data.id_direccion;
      console.log("DIRECCION", data);

    },
    error: function (response) {

    }
  })
}
async function addCliente(clienteRequest) {
  return $.ajax({
    type: "POST",
    url: 'ws/cliente/cliente.php',
    data: JSON.stringify({
      request: {
        clienteRequest
      },
      tipo: "addCliente"
    }),
    dataType: 'json',
    success: function (data) {
      idCliente = data.idCliente
      console.log("CLIENTE", data);
    },
    error: function (response) {
      console.log(response.responseText);
    }
  })
}

async function createProject(requestProject) {
  return $.ajax({
    type: "POST",
    url: 'ws/proyecto/proyecto.php',
    data: JSON.stringify({
      request: {
        requestProject
      },
      action: "addProject"
    }),
    dataType: 'json',
    success: function (data) {
      console.log("RESPONSE PROYECTO", data);
    },
    error: function (response) {
      console.log(response.responseText);
    }
  })
}


async function assignStandardPackageToProject(request){
  return $.ajax({
    type: "POST",
    url: 'ws/standard_package/standard_package.php',
    data: JSON.stringify({
      'request': request,
      'action': "assignStandardPackageToProject"
    }),
    dataType: 'json',
    success: function (data){
      
    },
    error: function (response){
      console.log(response.responseText);
    }
  })
}

async function assignvehicleToProject(requestasssign) {
  return $.ajax({
    type: "POST",
    url: 'ws/vehiculo/Vehiculo.php',
    data: JSON.stringify({
      request: requestasssign,
      action: "addVehicleToProject"
    }),
    dataType: 'json',
    success: function (data) {

      console.log("RESPONSE AGIGNACION VEHICULO", data);

    },
    error: function (response) {
      console.log(response.responseText);
    }
  })
}

async function assignPersonal(requestasssign) {
  try {
    return $.ajax({
      type: "POST",
      url: 'ws/personal/Personal.php',
      data: JSON.stringify({
        request: requestasssign,
        action: "addPersonalToProject"
      }),
      dataType: 'json',
      success: function (data) {

        console.log("RESPONSE AGIGNACION PERSONAL", data);

      },
      error: function (response) {
        console.log(response.responseText);
      }
    })
  } catch (e) {
    console.log(e);
  }
}


async function assignProduct(requestAssignFunction) {
  try {
    return $.ajax({
      type: "POST",
      url: 'ws/productos/Producto.php',
      data: JSON.stringify({
        request: requestAssignFunction,
        action: "assignProductToProject"
      }),
      dataType: 'json',
      success: function (data) {

        console.log("RESPONSE AGIGNACION PRODUCTOS", data);

      },
      error: function (response) {
        console.log(response.responseText);
      }
    })
  } catch (e) {
    console.log(e);
  }
}

function AddDivProduct(productName, productPrice, productId, quantity) {
  
  if(!AddStockToProduct(productId, quantity)){
    $('#tbodyReceive').append(`<div class="detailsProduct-box">
    <div class="checkitem">
      <input type="checkbox">
      <span class="verticalLine"></span>
    </div>
    <div class="itemProperties">
      <p class="itemId" style="display:none">${productId}</p>
      <div class="itemName"> 
        <p>${productName}</p>
        <hr/>
      </div>
      <div class="itemPrice">
        <p class="getPrice" style="display:none">${productPrice}</p>
        <p  style="font-size: 15px; font-weight: 700;">Precio arriendo: ${productPrice}</p>
        <hr/>
      </div>
      <div class="itemDetails">
          <div class="detailQuantity">
            <p>Cantidad</p>
            <input type="number" class="addProdInput" min="1" max="" value="${quantity}"/>
          </div>
          <div class="containerRemoveLogo">
            <p style="visibility: hidden;">CANT</p>
            <i class="fa-solid fa-trash logoRemove" style="color:red;font-size: 30px;"></i>
          </div>
      </div>
    </div>
  </div>`);
  }
}

function AddStockToProduct(productId, quantity){

  let finded = false;
  let arrayProducts = $('.detailsProduct-box');
  if (arrayProducts.length > 0) {

    $(arrayProducts).each((key, element) => {
      if ($(element).find('.itemId').text() === productId){
        let oldQuantity = $(element).find('.addProdInput').val();
        let newQuantity = parseInt(quantity) + parseInt(oldQuantity);
        $(element).find('.addProdInput').val(newQuantity);
        finded = true;
      }
    })

  } else {
    return false;
  }
  return finded;
}

function FillPresonalDragAndDrop(empresaId) {
  $.ajax({
    Type: 'POST',
    url: '/ws/personal/Personal.php',
    data: JSON.stringify({ action: 'getPersonal', empresaId: empresaId }),
    dataType: 'json',
    success: function (response) {
      console.log(response)
    }
  })
}


function AssignRents(arrayRents){
  return $.ajax({
    type: "POST",
    url: 'ws/Arriendos/arriendos.php',
    data: JSON.stringify({
      action: 'AssignRentToProject',
      request: arrayRents
    }),
    dataType: 'json',
    success: function(data) {
      // console.log("ARRIENDOS", data);
    },
    error: function(response) {
      // console.log(response.responseText);
    }
  })
}

async function assignOtherProdsToProject(request,project_id){

  return $.ajax({
    type: "POST",
    url: 'ws/productos/Producto.php',
    data: JSON.stringify({
      'action' : 'AssignOthersToProject',
      'request' : request,
      'project_id' : project_id
    }),
    dataType: 'json',
    success: function(data) {
      // console.log("ARRIENDOS", data);
    },
    error: function(response) {
      // console.log(response.responseText);
    }
  })

}