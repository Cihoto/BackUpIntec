<!DOCTYPE html>
<html lang="en">
<?php
require_once('./includes/head.php');
$active = 'eventos';
?>

<body>
    <?php include_once('./includes/Constantes/empresaId.php') ?>
    <?php include_once('./includes/Constantes/rol.php') ?>
    <script src="./assets/js/initTheme.js"></script>
    <div id="app">
        <?php require_once('./includes/sidebar.php') ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-header" style="margin-bottom: 30px;">
                <div style="display:flex; align-items: center;justify-content: space-between; ">
                    <h3 style="margin-right: 50px">Paquetes de recursos</h3>
                    <!-- <a href="./ExcelFiles/Clientes.xlsx" download="Carga Masiva Clientes">
                        <div class="card">
                            <i style="font-size: 30px; color:#1D6F42; text-align: center;" class="fa-solid fa-download"></i>
                            <p style="font-size: 20px;">Descargar Formato Excel</p>
                        </div>
                    </a> -->
                </div>
            </div>
            <div class="page-content">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation" id="createdPackages">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mis Paquetes</a>
                    </li>

                    <li class="nav-item" role="presentation" id="showEventsRecord">
                        <a class="nav-link" id="EventRecord-tab" data-bs-toggle="tab" href="#EventRecord" role="tab" aria-controls="EventRecord" aria-selected="false">Crear Nuevo Paquete</a>
                    </li>

                    <li class="nav-item" role="presentation" id="showEditPackage">
                        <a class="nav-link" id="PackageEdit-tab" data-bs-toggle="tab" href="#PackageEdit" role="tab" aria-controls="PackageEdit" aria-selected="false">Editar Paquete Existente</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p>No tienes paquetes creados, para ser listados, por favor crea uno antes de continuar</p>
                        <table id="packagePreView" class="table">
                            <thead>
                                <th>Nombre</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="EventRecord" role="tabpanel" aria-labelledby="EventRecord-tab">

                        <br>
                        <label for="packageName">Nombre</label>
                        <input type="text" name="packageName" id="packageName">

                        <br>


                        <p>Asigna todos los elementos que necesites</p>

                        <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-sunday-list" data-bs-toggle="list" href="#list-sunday" role="tab">Productos</a>
                        </div>
                        <div class="tab-content text-justify">
                            <div class="tab-pane fade show active" id="list-sunday" role="tabpanel" aria-labelledby="list-sunday-list">
                                <table id="productsTable">
                                    <thead>
                                        <th>Categoría</th>
                                        <th>Sub Categoría</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="cursor: pointer;" class="addToPackage"><i class="fa-solid fa-plus"></i></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="list-monday" role="tabpanel" aria-labelledby="list-monday-list">

                            </div>
                            <div class="tab-pane fade" id="list-tuesday" role="tabpanel" aria-labelledby="list-tuesday-list">

                            </div>
                        </div>
                        <section class="row justify-content-center">
                            <div class="card col-lg-12 col-10">
                                <div class="card-content">
                                    <div class="card-body">
                                        <table id="packageResume" class="table">
                                            <thead>
                                                <th>Categoría</th>
                                                <th>Sub Categoría</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <footer class="row justify-content-end">
                            <button class="btn btn-success col-4" id="createNewPackage">Crear Paquete</button>
                        </footer>
                    </div>
                    <div class="tab-pane fade" id="PackageEdit" role="tabpanel" aria-labelledby="PackageEdit-tab">

                        <h3>Nombre del paquete</h3>
                        <input type="text" id="packageNameEdit">

                        <table class="table" id="productsPackageModal">
                            <thead>
                                <th>Categoría</th>
                                <th>Sub Categoría</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <section class="row justify-content-center">
                            <div class="card col-lg-12 col-10">
                                <div class="card-content">
                                    <div class="card-body">
                                        <table id="packageResumeView" class="table">
                                            <thead>
                                                <th>Categoría</th>
                                                <th>Sub Categoría</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <footer class="row justify-content-end">
                            <button class="btn btn-success col-4" id="EditPackage">Editar Paquete</button>
                        </footer>
                    </div>
                </div>

            </div>
        </div>
        <?php require_once('./includes/footer.php') ?>
    </div>


    <?php require_once('./includes/footerScriptsJs.php') ?>
    <!-- Validador intec -->
    <script src="./js/valuesValidator/validator.js"></script>

    <!-- JS FUNCTIONS -->
    <script src="/js/productos.js"></script>

    <script>
        const EMPRESA_ID = <?php echo $empresaId; ?>;


        let arrayPackage = [];
        let productsArrayNonEditableObj = [];
        let arrayCreatedPackages = [];
        let openEdit = false;
        let editPackageId = '';

        // const EMPRESA_ID = $('#empresaId').text();
        $(document).ready(async function() {
            arrayPackage = [];
            // GET ALL PRODUCTS BY BUSSINESS AND SEND JSON TO FUNCTION, FILL TABLE AND CONVERT IT TO DATATABLE
            // THIS LIST IS MADE FOR CONSTRUCT A NEW EVENT STANDARD PACKAGE
            productsArrayNonEditableObj = await GetAllProductsByBussiness(EMPRESA_ID);
            FillPackageProductsTable(productsArrayNonEditableObj);
            fillPackagesByBussiness();
            
        })

        async function fillPackagesByBussiness(){
            $('#packagePreView > tbody tr').remove();

            const myStandardPackages = await GetAllStandardPackages(EMPRESA_ID);

            if (myStandardPackages.success) {
                myStandardPackages.data.forEach((package) => {
                    let tr = `<tr package_id="${package.id}">
                    <td>${package.nombre}</td>
                    <td><i class="fa-solid fa-eye viewPackageContent"></i></td>
                    <td style="color:red"><i class="fa-solid fa-delete-left deletePackage"></i></td>
                    </tr>`;
                    $('#packagePreView > tbody').append(tr)
                });

                arrayCreatedPackages = myStandardPackages.data;
            }
        }


        // DELETE PACKAGE ON FONT AWEOME ICON CLICK EVENT
        $(document).on('click','.deletePackage',function(){

            const package_id = $(this).closest('tr').attr('package_id');
            
    
    
            Swal.fire({
                title: 'Quieres eliminar este paquete de recursos?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `Cancelar`,
                showCancelButton:false,
                'icon':'error'
            }).then(async (result) => {
                if (result.isConfirmed){
                    const responseDelete = await deletePackage(package_id,EMPRESA_ID);

                    if(responseDelete.success){
                        $(this).closest('tr').remove();
                        Swal.fire('Eliminado exitosamente', '', 'success',2000)
                    }
                } else if (result.isDenied){

                }
            })
        })
       


        

        function deletePackage(package_id,empresa_id){
            return $.ajax({
                type: "POST",
                url: "ws/standard_package/standard_package.php",
                data: JSON.stringify({
                    action: "deletePackage",
                    package_id: package_id,
                    empresa_id :empresa_id
                }),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                },
                error: function(response) {}
            })
        }


        /* FILL PRODUCTS BY GIVES JSON ARRAY AND TRANSFORM TRABLE TO DATATABLE TO SORT IT AND ADD SELECTED PRODUCT TO STANDARD
         PROJECT PACKAGE*/
        function FillPackageProductsTable(products) {
            // console.log(products);
            products.forEach(product => {
                let td = `<tr product_id="${product.id}">
                    <td>${product.categoria}</td>
                    <td>${product.item}</td>
                    <td>${product.nombre}</td>
                    <td>${product.cantidad}</td>
                    <td style="cursor: pointer;" class="addToPackage"><i class="fa-solid fa-plus addNewProdToPackage"></i></td>
                </tr>`
                $('#productsTable').append(td);
            })

            $('#productsTable').DataTable();
        }

        function FillPackageProductsTableModal(products) {
            // console.log(products);

            // console.log($.fn.DataTable.isDataTable( '#productsPackageModal' ));

            if($.fn.DataTable.isDataTable( '#productsPackageModal' )){
                $('#productsPackageModal').DataTable().destroy();
                $('#productsPackageModal > tbody tr').remove();
            }

            products.forEach(product => {
                let td = `<tr product_id="${product.id}" class="packageDetails">
                    <td>${product.categoria}</td>
                    <td>${product.item}</td>
                    <td>${product.nombre}</td>
                    <td>${product.cantidad}</td>
                    <td style="cursor: pointer;" class="addToPackage"><i class="fa-solid fa-plus addNewProdToPackage"></i></td>
                </tr>`
                $('#productsPackageModal').append(td);
            })

            $('#productsPackageModal').DataTable();
        }


        $(document).on('click', '.viewPackageContent', async function(){
            openEdit = true;
            arrayPackage=[];

            $('#home-tab').removeClass('active');
            $('#home').removeClass('show active');
            $('#PackageEdit-tab').addClass('active');
            $('#PackageEdit').addClass('show active');

            editPackageId = $(this).closest('tr').attr('package_id');

            const productos = await GetAllProductsByBussiness(EMPRESA_ID);
            FillPackageProductsTableModal(productos);

            const packageDetails = await GetPackageDetails(editPackageId);

            console.log(packageDetails);

            $('#packageNameEdit').val(packageDetails.data[0].nombre)

            $('#packageResumeView > tbody tr').remove();

            packageDetails.products.forEach((package) => {
                arrayPackage.push({
                    "id": package.product_id,
                    "cantidad": package.quantity
                });
            });
            arrayPackage.forEach((resumeProd) =>{
                productsArrayNonEditableObj.forEach((noEditableProd) => {
                    if (parseInt(noEditableProd.id) === parseInt(resumeProd.id)) {
                        let tr = `<tr product_id="${noEditableProd.id}">
                            <td>${noEditableProd.categoria}</td>
                            <td>${noEditableProd.item}</td>
                            <td>${noEditableProd.nombre}</td>
                            <td>${resumeProd.cantidad}</td>
                            <td style="color:red"><i class="fa-solid fa-minus deleteFromPackage"></i></td>
                        </tr>`
                        $('#packageResumeView').append(tr);
                    }
                })
            })
        })


        // CAPTURE CLICK ON EDIT BUTTON
        $('#EditPackage').on('click',async function(){
            if($('#packageNameEdit').val() === ""){
                Swal.fire({
                    title:'Ups!',
                    text:'Debes ingresar un nombre para el paquete',
                    icon:'warning',
                    showConfirmButton:false,
                    timer:2000
                })
                return
            }
            if(arrayPackage.length === 0){
                Swal.fire({
                    title:'Ups!',
                    text:'Debes ingresar equipos al paquete para poder actualizarlo',
                    icon:'warning',
                    showConfirmButton:false,
                    timer:2000
                })
                return
            }

            const responseUpdate = await editPackage(editPackageId,arrayPackage);
            console.log(responseUpdate);

            if(responseUpdate.error){
                Swal.fire({
                    title:'Excelente!',
                    text: responseUpdate.message,
                    icon:'error',
                    showConfirmButton:false,
                    timer:2000
                })
            }
            if(responseUpdate.success){

                $('#home-tab').addClass('active');
                $('#home').addClass('show active');
                $('#PackageEdit-tab').removeClass('active');
                $('#PackageEdit').removeClass('show active');
                arrayPackages = [];

                Swal.fire({
                    title:'Ups!',
                    text: responseUpdate.message,
                    icon:'success',
                    showConfirmButton:false,
                    timer:2000
                })

            }
        })

        function editPackage(package_idUpdate,arrayPackageUpdate){
            return $.ajax({
                type: "POST",
                url: "ws/standard_package/standard_package.php",
                data: JSON.stringify({
                    'action': "editPackage",
                    'package_id': package_idUpdate,
                    'data':arrayPackageUpdate
                }),
                dataType: 'json',
                success: async function(data){

                },
                error: function(response){}
            })
        }

        // EDIT PACKAGE BIUTTON ONLY IF VARIABLE OPENIEDT IS TRUE
        $('#PackageEdit-tab').on('click', async function() {
            if (!openEdit){
                Swal.fire({
                    title:'Lo sentimos',
                    text:'Debes seleccionar un paquete para poder acceder a esta sección',
                    icon:'warning',
                    showConfirmButton:false,
                    timer:2000
                })
                .then(()=>{
                    $(this).removeClass('active');
                    $('#PackageEdit').removeClass('show active');
                    $('#home-tab').addClass('active');
                    $('#home').addClass('show active');
                   
                    console.log("lkajsdlkajsd");
                })
            }
        })

        


        // CAPTURE CLICK EVENT ON ADD ELEMENT IN ALL PRODUCTS TABLE AND SEND DATA TO 
        // addProductToPackage FUNCTION, SEND CLOSEST TR TO ADD ELEMENT
        $(document).on('click', '.addNewProdToPackage', async function() {


            // let arrayPackage = [];
            // let productsArrayNonEditableObj = [];
            // let arrayCreatedPackages = [];

            const id = $(this).closest('tr').attr('product_id');

            console.log(id);

            const idExist = idExistsOnArray(id);

            if (!idExist) {
                Swal.fire({
                        icon: 'error',
                        title: '...',
                        text: 'Intenta nuevamente'
                    })
                    .then(() => {
                        return
                    })
                return
            }

            const {
                value: quantityToAdd
            } = await Swal.fire({
                customClass: {
                    container: 'my-swal-zindexed'
                },
                input: 'number',
                inputLabel: 'Cantidad a asignar',
                inputPlaceholder: '',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            });

            if (quantityToAdd === "") {
                return;
            }

            const enoughstock = checkStockOnArray(quantityToAdd, id);

            if (!enoughstock) {
                Swal.fire({
                        icon: 'error',
                        title: 'Ups!',
                        text: 'No posees la cantidad suficiente de este equipo'
                    })
                    .then(() => {
                        return
                    })
                return
            }

            const element = $(this).closest('tr');

            // esta clase solo est[a presente en la tabla de productos del modal de detalles de paquete
            // no asi en la crecion de paquetes
            // la funcion solo hace append en una tabla distinta, por el resto son iguales

            if ($(this).closest('tr').hasClass('packageDetails')) {
                console.log("ENVIANDO A FUNCIKONA PPEND MODAL");
                addProductToPackageInModalResume($(element), quantityToAdd);

            } else {
                addProductToPackage($(element), quantityToAdd);
            }
        })


        function idExistsOnArray(id) {

            const idExists = productsArrayNonEditableObj.find((product) => {
                if (product.id === id) {
                    return true;
                }
            });

            if (idExists) {
                return true
            }

            return false;
        }

        function checkStockOnArray(quantityToAdd, id) {

            const response = productsArrayNonEditableObj.find((product) => {
                if (product.id === id) {
                    if (parseInt(product.cantidad) >= quantityToAdd) {
                        return true
                    }
                }
            });
            if (response) {
                return true
            }
            return false;
        }


        function addProductToPackage(element, quantityToAdd) {

            const product_id = $(element).attr("product_id");
            const existsOnResume = checkProductIdOnResume(product_id);

            if (existsOnResume) {

                const newQuantity = arrayPackage.find((resume) => {
                    if (resume.id === product_id) {
                        resume.cantidad = parseInt(resume.cantidad) + parseInt(quantityToAdd);
                        return true;
                    }
                })

                if (newQuantity) {
                    const producto = productsArrayNonEditableObj.find((product) => {
                        if (product.id === newQuantity.id) {

                            // console.log(parseInt(newQuantity.cantidad));
                            // console.log(parseInt(product.cantidad));

                            if (parseInt(newQuantity.cantidad) <= parseInt(product.cantidad)) {
                                return true
                            } else {

                                const checkStock = arrayPackage.find((resume) => {
                                    if (resume.id === newQuantity.id) {
                                        resume.cantidad = parseInt(resume.cantidad) - parseInt(quantityToAdd);
                                        return true
                                    }
                                })

                                if (checkStock) {
                                    console.log(checkStock);
                                }
                            }
                        }
                    })

                    if (producto) {

                        $('#packageResume > tbody tr').remove();

                        arrayPackage.forEach((resumeProd) => {

                            productsArrayNonEditableObj.forEach((noEditableProd) => {
                                if (parseInt(noEditableProd.id) === parseInt(resumeProd.id)) {

                                    let tr = `<tr product_id="${noEditableProd.id}">
                                        <td>${noEditableProd.categoria}</td>
                                        <td>${noEditableProd.item}</td>
                                        <td>${noEditableProd.nombre}</td>
                                        <td>${resumeProd.cantidad}</td>
                                        <td style="color:red"><i class="fa-solid fa-minus deleteFromPackage"></i></td>
                                    </tr>`
                                    $('#packageResume').append(tr);
                                }
                            })
                        })

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No puedes asignar mas productos de los que posees',
                            text: 'No hemos podido encontrar el producto seleccionado, por favor intente nuevamente',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        text: 'No hemos podido encontrar el producto seleccionado, por favor intente nuevamente',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            } else {

                // SEARCH PRODUCT DATA ON NOEDITABLEPRODUCTLIST AND
                // APPEND DATA ON RESUME PACKAGE TABLE ON PAGE BOTTOM
                const productToAdd = productsArrayNonEditableObj.find((product) => {
                    if (product.id === product_id) {
                        return product;
                    }
                });

                let tr = `<tr product_id="${productToAdd.id}">
                    <td>${productToAdd.categoria}</td>
                    <td>${productToAdd.item}</td>
                    <td>${productToAdd.nombre}</td>
                    <td>${quantityToAdd}</td>
                    <td style="color:red"><i class="fa-solid fa-minus deleteFromPackage"></i></td>
                </tr>`

                $('#packageResume').append(tr);


                arrayPackage.push({
                    "id": productToAdd.id,
                    "cantidad": quantityToAdd
                });
            }
        }



        function addProductToPackageInModalResume(element, quantityToAdd) {

            console.log("ADDING TO VIEWEDIRT ON RESUME");

            const product_id = $(element).attr("product_id");
            const existsOnResume = checkProductIdOnResume(product_id);

            if (existsOnResume) {

                const newQuantity = arrayPackage.find((resume) => {
                    if (resume.id === product_id) {
                        resume.cantidad = parseInt(resume.cantidad) + parseInt(quantityToAdd);
                        return true;
                    }
                })

                if (newQuantity) {
                    const producto = productsArrayNonEditableObj.find((product) => {
                        if (product.id === newQuantity.id) {

                            // console.log(parseInt(newQuantity.cantidad));
                            // console.log(parseInt(product.cantidad));

                            if (parseInt(newQuantity.cantidad) <= parseInt(product.cantidad)) {
                                return true
                            } else {

                                const checkStock = arrayPackage.find((resume) => {
                                    if (resume.id === newQuantity.id) {
                                        resume.cantidad = parseInt(resume.cantidad) - parseInt(quantityToAdd);
                                        return true
                                    }
                                })

                                if (checkStock) {
                                    console.log(checkStock);
                                }
                            }
                        }
                    })

                    if (producto) {

                        $('#packageResume > tbody tr').remove();



                        arrayPackage.forEach((resumeProd) => {

                            productsArrayNonEditableObj.forEach((noEditableProd) => {
                                if (parseInt(noEditableProd.id) === parseInt(resumeProd.id)) {

                                    let tr = `<tr product_id="${noEditableProd.id}">
                                        <td>${noEditableProd.categoria}</td>
                                        <td>${noEditableProd.item}</td>
                                        <td>${noEditableProd.nombre}</td>
                                        <td>${resumeProd.cantidad}</td>
                                        <td style="color:red"><i class="fa-solid fa-minus deleteFromPackage"></i></td>
                                    </tr>`
                                    $('#packageResumeView').append(tr);
                                }
                            })
                        })

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No puedes asignar mas productos de los que posees',
                            text: 'No hemos podido encontrar el producto seleccionado, por favor intente nuevamente',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        text: 'No hemos podido encontrar el producto seleccionado, por favor intente nuevamente',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            } else {

                // SEARCH PRODUCT DATA ON NOEDITABLEPRODUCTLIST AND
                // APPEND DATA ON RESUME PACKAGE TABLE ON PAGE BOTTOM
                const productToAdd = productsArrayNonEditableObj.find((product) => {
                    if (product.id === product_id) {
                        return product;
                    }
                });

                let tr = `<tr product_id="${productToAdd.id}">
                    <td>${productToAdd.categoria}</td>
                    <td>${productToAdd.item}</td>
                    <td>${productToAdd.nombre}</td>
                    <td>${quantityToAdd}</td>
                    <td style="color:red"><i class="fa-solid fa-minus deleteFromPackage"></i></td>
                </tr>`

                $('#packageResumeView').append(tr);


                arrayPackage.push({
                    "id": productToAdd.id,
                    "cantidad": quantityToAdd
                });
            }
        }

        function checkProductIdOnResume(product_id) {

            const arrayResume = arrayPackage.find((product) => {
                if (product.id === product_id) {
                    return true
                }
            })

            if (arrayResume) {
                return true;
            }

            return false;
        }

        // remove button

        $(document).on('click', '.deleteFromPackage', function() {

            const product_id = $(this).closest('tr').attr('product_id');

            const idExists = idExistsOnArray(product_id);
            console.log(idExists);

            if (idExists) {
                let indexToDelete = "";

                arrayPackage.find((prodResume, index, array) => {
                    if (prodResume.id === product_id) {
                        // array.splice(index,1)
                        indexToDelete = index;
                    }
                });

                arrayPackage.splice(indexToDelete, 1);

                $(this).closest('tr').remove();
                console.log("POST ARRAY RESUME", arrayPackage);
            }


        })

        // Create NEW PACKAGE 
        $('#createNewPackage').on('click', async function() {
            if (arrayPackage.length === 0) {
                console.log("EL ARREGLOE STA VACIO");
                return
            }

            if ($('#packageName').val() === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debes ingresar un nombre para este paquete',
                    text: 'Intente nuevamente',
                    showConfirmButton: false,
                    timer: 5000
                })
                return
            }
            const packageName = $('#packageName').val();
            const responsePackageCreation = await CreatePackage(EMPRESA_ID, packageName, arrayPackage);

            if (responsePackageCreation) {
                arrayPackage = [];

                fillPackagesByBussiness();

                $('#home-tab').addClass('active');
                $('#home').addClass('show active');
                $('#EventRecord-tab').removeClass('active');
                $('#EventRecord').removeClass('show active');

                Swal.fire({
                    icon: 'success',
                    title: 'Excelente',
                    text: 'Paquete creado exitosamente!',
                    showConfirmButton: false,
                    timer: 5000
                })
            }
        })

        async function CreatePackage(empresa_id, packageName, request) {
            return $.ajax({
                type: "POST",
                url: "ws/standard_package/standard_package.php",
                data: JSON.stringify({
                    action: "CreatePackage",
                    empresaId: empresa_id,
                    packageName: packageName,
                    request: {
                        arrayPackages: request
                    }
                }),
                dataType: 'json',
                success: async function(data) {
                    console.log(data);
                },
                error: function(response) {}
            })
        }
        async function GetAllStandardPackages(empresa_id) {
            return $.ajax({
                type: "POST",
                url: "ws/standard_package/standard_package.php",
                data: JSON.stringify({
                    action: "GetAllStandardPackages",
                    empresa_id: empresa_id
                }),
                dataType: 'json',
                success: async function(data) {

                },
                error: function(response) {}
            })
        }

        async function GetPackageDetails(package_id) {
            return $.ajax({
                type: "POST",
                url: "ws/standard_package/standard_package.php",
                data: JSON.stringify({
                    action: "GetPackageDetails",
                    package_id: package_id
                }),
                dataType: 'json',
                success: async function(data) {

                },
                error: function(response) {}
            })
        }
    </script>

</body>

</html>