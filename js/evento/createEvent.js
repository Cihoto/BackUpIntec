let event_data = {
  address_id: "",
  client_id: "",
  event_id: ""

}

let requestProject = {
  'nombre_proyecto': "",
  'lugar_id': "",
  'fecha_inicio': "",
  'fecha_termino': "",
  'cliente_id': "",
  'comentarios': "",
  'empresa_id': "",
  'owner': "",
  'status_id': ""
}



// $('#createProject').on('click', function (){
//   const NOMBRE_EVENTO = $('#inputProjectName').val();
//   if (NOMBRE_EVENTO) {
//     $('#eventNameMessage').show();
//     return
//   }
// })

$('#inputProjectName').on('click', function () {
  $('#eventNameMessage').css('visibility', 'hidden');
})

async function SaveOrUpdateEvent() {

  // SET event_data.event_id = projectDates.project_id

  if (projectDates.project_id !== "") {
    event_data.event_id = projectDates.project_id;
  }

  requestProject = {
    'nombre_proyecto': $('#inputProjectName').val(),
    'lugar_id': "",
    'fecha_inicio': $('#fechaInicio').val(),
    'fecha_termino': $('#fechaTermino').val(),
    'cliente_id': $('#clienteSelect').val(),
    'comentarios': $('#commentProjectArea').val(),
    'empresa_id': EMPRESA_ID,
    'owner': $('#ownerSelect').val(),
    'status_id': $('#status-button').attr('status_id'),
    'event_type_id': $('#event_type').val()
  }

  console.log("requestProject", requestProject);

  if (requestProject.nombre_proyecto === "") {
    $('#inputProjectName').focus();
    $('#eventNameMessage').css('visibility', 'visible');
    return
  }

  // create or update project

  console.log("projectDates", projectDates);

  if (projectDates.project_id === "") {
    const RESPONSE_CREATE_EVENT = await createNewEvent(requestProject);

    if (RESPONSE_CREATE_EVENT.id_project) {
      event_data.event_id = RESPONSE_CREATE_EVENT.id_project;
      projectDates.project_id = RESPONSE_CREATE_EVENT.id_project;
    }
  } else {
    const RESPONSE_UPDATE_EVENT = await updateEvent(requestProject, event_data.event_id, EMPRESA_ID);
  }

  // CREATE AND ASSIGN EVENT ADDRESS 
  if ($('#dirInput').val() !== "") {
    const REQUEST_ASSIGN_ADDRESS = {
      'address_id': $('#dirInput').val(),
      'empresa_id': EMPRESA_ID,
      'event_id': event_data.event_id
    }

    insertAddressAndAssignToProject($('#dirInput').val(), EMPRESA_ID, event_data.event_id);
  } else {
    removeAddressFromEvent(event_data.event_id, EMPRESA_ID);
  }

  // CREATE OR REMOVE EVENT SCHEDULES
  if (_all_my_selected_schedules.length > 0) {
    insertAndAssignSchedulesToEvent(event_data.event_id, EMPRESA_ID, _all_my_selected_schedules)
  } else {
    removeAllSchedulesFromEvent(event_data.event_id, EMPRESA_ID)
  }

  //CREATE AND ASSIGN DOCUMENTS TO EVENT
  await saveSelectedFilesInServer();
  assignFilesToEvent(_allmyUploadedFiles, event_data.event_id, EMPRESA_ID, PERSONAL_IDS);


  // SAVE ALL SELECTED PRODUCTS
  let arrayProducts = []
  _selectedProducts.forEach((product) => {
    arrayProducts.push({
      'idProject': event_data.event_id,
      'idProduct': product.id,
      'price': product.precio_arriendo,
      'quantity': product.quantityToAdd
    })
  });
  assignProduct(arrayProducts);

  // SAVE ALL SELECTED PACKAGES
  if (_selectedPackages.length > 0) {
    const arrayPackage = _selectedPackages.map((package) => {
      return {
        "proyecto_id": event_data.event_id,
        "package_id": package.package_id
      }
    });
    const packagesAssigment = await assignStandardPackageToProject(arrayPackage);
    console.log("packagesAssigment",packagesAssigment);
  }
  
  // SAVE ALL SELECTED VEHICLES
  const requestPersonal = allSelectedPersonal.map((personal) => {
    return {
      'idProject': event_data.event_id,
      'idPersonal': personal.id,
      'cost': personal.neto,
      'worked_hours': personal.horasTrabajadas
    };
  });
  assignPersonal(requestPersonal);


  // SAVE ALL SELECTED VEHICLES
  const requestVehicle = selectedVehicles
    .map(vehicle => {
      return {
        'idProject': event_data.event_id,
        'idVehicle': vehicle.id,
        'trip_value': vehicle.tripValue,
        'trip_count': vehicle.cantidadViajes
      };
    })

  assignvehicleToProject(requestVehicle)
}

function createNewEvent(requestProject) {
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
      console.log("RESPONSE CREATE PROYECTO", data);

    },
    error: function (response) {
      console.log(response.responseText);
    }
  })
}

function updateEvent(requestProject, event_id, empresa_id) {

  return $.ajax({
    type: "POST",
    url: 'ws/proyecto/proyecto.php',
    data: JSON.stringify({
      action: "updateProject",
      'empresa_id': empresa_id,
      'request': requestProject,
      'event_id': event_id,
    }),
    dataType: 'json',
    success: function (response) {
      console.log("RESPONSE UPDATE PROYECTO", response);
    },
    error: function (error) {
      console.log(error.responseText);
    }
  })

}


// SECTION ADDRESS CREATION AND ASSIGMENTS
async function insertAddressAndAssignToProject(address, empresa_id, event_id) {
  $.ajax({
    type: "POST",
    url: 'ws/direccion/Direccion.php',
    data: JSON.stringify({
      'action': 'addAndAssignToProject',
      'address': address,
      'empresa_id': empresa_id,
      'event_id': event_id
    }),
    dataType: 'json',
    success: function (response) {
      console.log(response)
    },
    error: function (response) {
      console.log(response.responseText);
    }
  });
}

async function removeAddressFromEvent(event_id, empresa_id) {
  $.ajax({
    type: "POST",
    url: 'ws/proyecto/proyecto.php',
    data: JSON.stringify({
      'action': 'removeAddressFromEvent',
      'event_id': event_id,
      'empresa_id': empresa_id
    }),
    dataType: 'json',
    success: function (response) {
      console.log(response)
    },
    error: function (response) {
      console.log(response.responseText);
    }
  });
}

// SECTION SCHEDULES, CREATE, ASSIGN OR REMOVE FROM EVENT

async function insertAndAssignSchedulesToEvent(event_id, empresa_id, schedules) {
  $.ajax({
    type: "POST",
    url: 'ws/schedules/schedule.php',
    data: JSON.stringify({
      'action': 'insertAndAssignSchedulesToEvent',
      'event_id': event_id,
      'empresa_id': empresa_id,
      'schedules': schedules
    }),
    dataType: 'json',
    success: function (response) {
      console.log(response)
    },
    error: function (response) {
      console.log(response.responseText);
    }
  });
}

async function removeAllSchedulesFromEvent(event_id, empresa_id) {
  $.ajax({
    type: "POST",
    url: 'ws/schedules/schedule.php',
    data: JSON.stringify({
      'action': 'removeAllSchedulesFromEvent',
      'event_id': event_id,
      'empresa_id': empresa_id
    }),
    dataType: 'json',
    success: function (response) {
      console.log(response)
    },
    error: function (response) {
      console.log(response.responseText);
    }
  });
}

// SECTION FILES CONTROLLER
async function assignFilesToEvent(_allmyUploadedFiles, event_id, empresa_id, personal_id) {
  $.ajax({
    type: "POST",
    url: 'ws/BussinessDocuments/assignFilesToEvent.php',
    data: JSON.stringify({
      'event_id': event_id,
      'empresa_id': empresa_id,
      'files': _allmyUploadedFiles,
      'personal_id': personal_id
    }),
    dataType: 'json',
    success: function (response) {
      console.log(response)
    },
    error: function (response) {
      console.log(response.responseText);
    }
  });
}

async function addAssignedPackagesToEvent() {

  // const package_id = $(element).closest('tr').attr('package_id');

  // console.log(PACKAGE_LIST);



  const idExists = PACKAGE_LIST.find((package) => {
    return parseInt(package.id) === parseInt(package_id)
  });

  if (!idExists) {
    Swal.fire(
      'Lo sentimos!',
      'Algo ha ido mal, intenta nuevamente',
      'error'
    )
  }

  if (_selectedPackages.length > 0) {
    const packageExists = _selectedPackages.find((selectedPackage) => {
      return selectedPackage.package_id === package_id
    });

    if (packageExists) {
      Swal.fire(
        'Lo sentimos!',
        'No se puede seleccionar mas de una vez el mismo paquete',
        'warning'
      )
      return;
    }
  }

  // GET ALL PACKAGE PRODUCTS
  const productsOnPackage = await GetPackageDetails(package_id);
  const productsToAdd = productsOnPackage.products.map((productsOnPackage) => {
    return {
      'id': productsOnPackage.product_id,
      'quantityToAdd': productsOnPackage.quantity
    }
  })

  _selectedPackages.push({
    'package_id': productsOnPackage.data[0].id,
    'package_name': productsOnPackage.data[0].nombre,
    'package_products': productsOnPackage.products
  });

  const addProd = setSelectedProduct_AddNewProducts(productsToAdd);

  printAllProductsOnTable();
  setCategoriesAndSubCategories();
  printAllSelectedProducts();
  setIngresos();
}


