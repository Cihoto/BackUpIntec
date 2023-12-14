async function getAllProjectData(event_id, empresa_id) {
    console.log("ESTO ES TODO LO QUE TENGO PARA MOSTRAR DE UIIN EVNETO CREADO");

    const projectRequest = {
        'idProject': event_id,
        'empresa_id': empresa_id,
        'asignados': true
    }
    const responseGetData = await $.ajax({
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
            console.log("event_Data", response);
        }
    });

    if (responseGetData.fatalError) {
        window.location.href = "/index.php"
    }

    console.log("response get data", responseGetData);


    responseGetData.dataProject.forEach(data => {
        let nombre_cliente;
        console.table("response.asignados.cliente", data);

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
        if (data.direccion === "" || data.direccion === undefined || data.direccion === null) {
            data.direccion = "";
        }

        $('#inputProjectName').val(data.nombre_proyecto);

        $('#direccionInput').val('')
        $('#event_type').val(data.event_type_id);

        $('#dirInput').val(data.direccion);
        $('#dirInput').blur();

        $('#inputNombreCliente').val(data.nombre_cliente)
        $('#commentProjectArea').val(data.comentarios);
        $('#estadoProyecto').text(data.estado);
    });

    if (responseGetData.asignados.cliente.length > 0) {

        responseGetData.asignados.cliente.forEach(cliente => {
            $('#inputTelefono').val(cliente.telefono);
            $('#inputNombreCliente').val(`${cliente.nombre} ${cliente.apellido} | ${cliente.razon_social} | ${cliente.rut_df}`);
            nombre_cliente = `${cliente.nombre} ${cliente.apellido} | ${cliente.razon_social} | ${cliente.rut_df}`;
        });
    }

    if (responseGetData.asignados.productos.length > 0) {
        responseGetData.asignados.productos.forEach(producto => {
            const productsToAdd = [{
                'id': producto.id,
                'quantityToAdd': producto.cantidad
            }];
            setSelectedProduct_AddNewProducts(productsToAdd);
            printAllProductsOnTable();
            setCategoriesAndSubCategories();
            printAllSelectedProducts();
            setIngresos();
        });
    }

    if (responseGetData.asignados.assignedPackages.length > 0) {
        
        responseGetData.asignados.assignedPackages.forEach(async (package) => {
            const productsOnPackage = await GetPackageDetails(package.paquete_id);
            const productsToAdd = productsOnPackage.products.map((productsOnPackage)=>{
                return{
                    'id': productsOnPackage.product_id,
                    'quantityToAdd' : productsOnPackage.quantity
                }
            });

            _selectedPackages.push({
                'package_id' : productsOnPackage.data[0].id,
                'package_name' : productsOnPackage.data[0].nombre,
                'package_products' :  productsOnPackage.products
            });
            
            if($(`#standardPackagesList tr[package_id = ${package.paquete_id}]`).length > 0)
            {
                $(`#standardPackagesList tr[package_id = ${package.paquete_id}]`).addClass("packageSelected");
            }
            
        });
    }

    if (responseGetData.asignados.personal.length > 0) {
        responseGetData.asignados.personal.forEach(personal => {
            AddSelectedPersonal(personal.id);
        });
        printAllSelectedPersonal();
    } else { }

    if (responseGetData.asignados.vehiculos.length > 0) {
        responseGetData.asignados.vehiculos.forEach(vehiculo => {
            addVehicle(vehiculo.vehiculo_id)
        });
    } else { }

    responseGetData.dataProject.forEach(data => {
        if (data.fecha_inicio === "" || data.fecha_inicio === undefined || data.fecha_inicio === null) {
            data.fecha_inicio = "";
        }
        if (data.fecha_termino === "" || data.fecha_termino === undefined || data.fecha_termino === null) {
            data.fecha_termino = "";
        }
        $('#fechaInicio').val(data.fecha_inicio)
        $('#fechaTermino').val(data.fecha_termino)
        $('#fechaInicio').change();
        $('#fechaTermino').change();
    });
}