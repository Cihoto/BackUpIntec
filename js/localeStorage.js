
function TotalCosts(valor){

    valor = parseInt(valor);

    if(localStorage.getItem('totalCosts') === null){

        if(valor < 0){
            localStorage.setItem('totalCosts',[0]);

        }else{
            localStorage.setItem('totalCosts',[parseInt(valor)]);
        }


    }else{
        let localStorageCost = localStorage.getItem('totalCosts');

        let totalCost =parseInt(localStorageCost) + parseInt(valor) ;

        localStorage.setItem('totalCosts',totalCost);
    }
}





function GetTotalCosts(){
    return localStorage.getItem('totalCosts');
}


function AddTotal(value){

    if(isNumeric(value)){
        TotalCosts(value);
        SetTotalCost();
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Ups!',
            text: 'Debes ingresar un numero'
        })
    }
}

// LOCAL STORAGE MANAGEMENT FOR PERSONAL

function PersonalLocalStorage(idPersonal, nombrePersonal, valor,tipoContrato){

    if(localStorage.getItem("personal") === null){

        localStorage.setItem("personal", JSON.stringify([{idPersonal, nombrePersonal, valor,tipoContrato}]))

    }else{

        let allDirs = JSON.parse(localStorage.getItem("personal"))
        allDirs.push({idPersonal, nombrePersonal, valor,tipoContrato});
        localStorage.setItem("personal",JSON.stringify(allDirs));
    }

}

function GetPersonalStorage(){
    if(localStorage.getItem('personal') === null){
        return false;
    }
    return JSON.parse(localStorage.getItem('personal'));

}

function removeProductStorage(idPersonalDelete){
    console.log("ARRAY DE PERSONAL ENTRANTES",GetPersonalStorage());
    let personal = GetPersonalStorage()
    let indexToDelete;

    personal.forEach((v,index) => {

        if(v.idPersonal === idPersonalDelete){

            indexToDelete = index;
            personal.splice(indexToDelete,1);
            AddTotal(parseInt(-v.valor))
            localStorage.setItem('personal',JSON.stringify(personal))

        }
    });
}


// LOCALE STORAGE MANAGEMENT FOR PRODUCTOS

function ProductsStorage(productId, productName, productPrice,quantityToAdd,totalPrice){
    if(localStorage.getItem("productos") === null){
        localStorage.setItem("productos", JSON.stringify([{productId, productName, productPrice,quantityToAdd,totalPrice}]))
    }else{
        let allDirs = JSON.parse(localStorage.getItem("productos"))
        allDirs.push({productId, productName, productPrice,quantityToAdd,totalPrice});
        localStorage.setItem("productos",JSON.stringify(allDirs));
    }
}


function GetProductsStorage(){

    if(localStorage.getItem("productos") === null){
        return false;
    }

    return JSON.parse(localStorage.getItem('productos'));
}


function removeProductoStorage(idProduct){

    console.log("ARRAY DE VEHICULOS ENTRANTES",GetProductsStorage());

    let productos = GetProductsStorage()
    let indexToDelete;
    let productRPrice;

    productos.forEach((v,index) => {

        if(v.productId === idProduct){
            indexToDelete = index;
            AddTotal(-(v.productPrice * v.quantityToAdd))
            productos.splice(indexToDelete,1);
            localStorage.setItem('productos',JSON.stringify(productos))
        }
    });
}




//LOCALE STORAGE MANAGEMENT FOR VEHICULOS

function VehicleStorage(idVehiculo, patente, valor){
try{
    if(localStorage.getItem("vehiculos") === null){
        localStorage.setItem("vehiculos", JSON.stringify([{idVehiculo, patente, valor}]))
      }else{
        let allDirs = JSON.parse(localStorage.getItem("vehiculos"))
        allDirs.push({idVehiculo, patente, valor});
        localStorage.setItem("vehiculos",JSON.stringify(allDirs));
    }
}catch(e){
    console.log(e);
}
    
}


function GetVehicleStorage(){

    if(localStorage.getItem("vehiculos") === null){
        return false;
    }

    return JSON.parse(localStorage.getItem('vehiculos'));
}

function removeVehicleStorage(idVehiculoDelete,patente){
    console.log("ARRAY DE VEHICULOS ENTRANTES",GetVehicleStorage());
    let vehiculos = GetVehicleStorage()
    let indexToDelete;

    vehiculos.forEach((v,index) => {

        if(v.idVehiculo === idVehiculoDelete || v.patente === patente){

            indexToDelete = index;
            vehiculos.splice(indexToDelete,1);
            localStorage.setItem('vehiculos',JSON.stringify(vehiculos))

        }
    });
}


// SET LOCALE STORAGE UPDATE CLIENTE


function SetUpdateCliente(boolUpdate){
    localStorage.setItem("updateCliente", boolUpdate)
}


function GetUpdateCliente(){

    if(localStorage.getItem("updateCliente") === null){
        return false;
    }
    return JSON.parse(localStorage.getItem('updateCliente'));

}


function SetProjectData(nombre_proyecto,fecha_inicio,fecha_termino,nombre_cliente,comentarios){
    localStorage.setItem("projectData", JSON.stringify({nombre_proyecto,fecha_inicio,fecha_termino,nombre_cliente,comentarios}))

    // if(localStorage.getItem("projectData") === null){
    //   }else{
    //     let allDirs = JSON.parse(localStorage.getItem("projectData"))
    //     console.log(allDirs);
    //     allDirs.push({nombre_proyecto,fecha_inicio,fecha_termino,nombre_cliente,comentarios});
    //     localStorage.setItem("projectData",JSON.stringify(allDirs));
    // }

}


// LOCALE STORAGE MANAGEMENT FOR PROJECT DATA

function GetProjectData(){

    if(localStorage.getItem("projectData") === null){
        return false;
    }

    return JSON.parse(localStorage.getItem('projectData'));
}

// LOCAL VIATICOS MANAGEMENT
function SetViatico(idProject, valor,detalle){
    if(localStorage.getItem("viaticoData") === null){
        localStorage.setItem("viaticoData", JSON.stringify([{idProject, valor,detalle}]))
      }else{
        let allDirs = JSON.parse(localStorage.getItem("viaticoData"))
        allDirs.push({idProject, valor,detalle});
        localStorage.setItem("viaticoData",JSON.stringify(allDirs));
    }
}

// LOCALE STORAGE MANAGEMENT FOR PROJECT DATA
function GetProjectViaticos(){
    if(localStorage.getItem("viaticoData") === null){
        return false;
    }
    return JSON.parse(localStorage.getItem('viaticoData'));
}



// LOCAL VIATICOS MANAGEMENT
function SetTotalProject(idProject, valor,detalle){
    localStorage.setItem("totalProjectIngresos", JSON.stringify([{idProject, valor,detalle}]))
    
}

// LOCALE STORAGE MANAGEMENT FOR PROJECT DATA
function GetTotalProject(){
    if(localStorage.getItem("totalProjectIngresos") === null){
        return false;
    }
    return JSON.parse(localStorage.getItem('totalProjectIngresos'));
}


// LOCAL ARRIENDOS  MANAGEMENT
function SetArriendosProject(idProject, valor,detalle){
    if(localStorage.getItem("arriendosData") === null){
        localStorage.setItem("arriendosData", JSON.stringify([{idProject, valor,detalle}]))
      }else{
        let allDirs = JSON.parse(localStorage.getItem("arriendosData"))
        allDirs.push({idProject, valor,detalle});
        localStorage.setItem("arriendosData",JSON.stringify(allDirs));
    }
}

// LOCALE STORAGE MANAGEMENT FOR PROJECT DATA
function GetArriendosProject(){
    if(localStorage.getItem("arriendosData") === null){
        return false;
    }
    return JSON.parse(localStorage.getItem('arriendosData'));
}



// LOCAL RENTS  MANAGEMENT
function SetRents(rent_id,nombre, valor,detalle){
    if(localStorage.getItem("rentsData") === null){
        localStorage.setItem("rentsData", JSON.stringify([{rent_id,nombre, valor,detalle}]))
      }else{
        let allDirs = JSON.parse(localStorage.getItem("rentsData"))
        allDirs.push({rent_id,nombre, valor,detalle});
        localStorage.setItem("rentsData",JSON.stringify(allDirs));
    }
}
// LOCALE STORAGE MANAGEMENT FOR RENTS
function GetRents(){
    if(localStorage.getItem("rentsData") === null){
        return false;
    }
    return JSON.parse(localStorage.getItem('rentsData'));
}


