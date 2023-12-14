let PACKAGE_LIST = [];
let _selectedPackages = [];



let allMyProducts = [];
let allMyTakenPoducts = [];
let listProductArray = [];
let allAndselectedProductsList = [];
let selectedPackages = [];
let selectedProducts = [];
let resumeSelectedProducts = [];
let allMyCatAndSubCat = [];


async function FillStandardPackages() {
    const myPackages = await GetAllStandardPackages(EMPRESA_ID);
    if (myPackages.success) {
        const packages = myPackages.data;
        packages.forEach((package) => {
            let tr = `<tr package_id="${package.id}">
            <td>${package.nombre}</td>
            <td style="cursor:pointer;" class="addPackageToAssigments"><i  class="fa-solid fa-plus "></i></td>
            </tr>`;
            $('#standardPackagesList').append(tr);
        })
        PACKAGE_LIST = packages;
        console.log("PACKAGE_LIST", PACKAGE_LIST);
    }
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
        success: async function (data) {

        },
        error: function (response) { }
    })
}


function addPackageToPackageAssigment(){

    // remove GREEN BACKGORUND COLOR ON SELECTGED PACKAGES

    $('#standardPackagesList > tbody > tr').each((key,element)=>{

        $(element).removeClass('packageSelected')
    
    })




    $('.packageNameContainer').remove();
    _selectedPackages.forEach((selectedPackage) => {
        let toAppendPackage = `
        <div package_id=${selectedPackage.package_id} class="card col-lg-3 col-5 packageNameContainer ">
            <div class="d-flex justify-content-between" style="align-content:center">
                <p style="font-size:20px;">${selectedPackage.package_name}</p>
                <i style="color:red ;margin-top:10px; cursor:pointer" class="fa-solid fa-minus removePackageFromAssigment"></i>
            </div>
        </div>`;

        console.log($('#standardPackagesList > tbody > tr'));

        $('#standardPackagesList > tbody > tr').each((index,element)=>{
            if($(element).attr('package_id') === selectedPackage.package_id){
                $(element).addClass('packageSelected')
            }
        })
    })
}



async function addStandardPackage(package_id){

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

    if(_selectedPackages.length > 0){
        const packageExists = _selectedPackages.find((selectedPackage)=>{
            return selectedPackage.package_id === package_id
        });

        if(packageExists){
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
    const productsToAdd = productsOnPackage.products.map((productsOnPackage)=>{
        return{
            'id': productsOnPackage.product_id,
            'quantityToAdd' : productsOnPackage.quantity
        }
    })

    _selectedPackages.push({
        'package_id' : productsOnPackage.data[0].id,
        'package_name' : productsOnPackage.data[0].nombre,
        'package_products' :  productsOnPackage.products
    });

    const addProd = setSelectedProduct_AddNewProducts(productsToAdd);

    printAllProductsOnTable();
    setCategoriesAndSubCategories();
    printAllSelectedProducts();
    setIngresos();

    if (addProd) {
      Toastify({
        text: `Se ha agregado el paquete ${productsOnPackage.data[0].nombre}`,
        duration: 2000,
        close: true
      }).showToast();
    } else {
      console.log("ha ocurrido un error");
    }
}


async function addPackageToProjectAssigments(element){

    const package_id = $(element).closest('tr').attr('package_id');

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
    if(selectedPackages.length > 0 ){
        const packageIsSelected = selectedPackages.find((selected)=>{
            return selected.id === package_id
        })
        if(packageIsSelected){
            Swal.fire(
                'Lo sentimos!',
                'No se puede seleccionar mas de una vez el mismo paquete',
                'warning'
            )
            return
        }
    }

    //GET ALL PACKAGE DETAILS, NAME, ID FROM PACKAGE AND PRODUCTS THAT CONTAINS 
    const detailsPackage = await GetPackageDetails(package_id);
    console.log("detailsPackage",detailsPackage);
    if (!detailsPackage.success) {
        console.log("nada");
        return
    }

    // SET PACKAGE ID TO FIND IT ON GLOBAL VARIABLE PACKAGE_LIST
    // IF RETURN TRUE PUSH RESULT AND APPEND IT TO RESUME
    const detailPackageId = detailsPackage.data[0].id;
    const packageToAdd = PACKAGE_LIST.find((package)=>{
        if(package.id === detailPackageId){
            return package
        }
    })
    // PUSH FINDED PACKAGE TO GLOBAL LIST
    selectedPackages.push(packageToAdd);
    // ADD SELECTED PACKAGES TO RESUME
    addPackageToPackageAssigment();
    Toastify({
        text: `Se ha agregado el paquete ${packageToAdd.nombre}`,
        duration: 2000,
        close: true
    }).showToast();
    // FORMAT PRODUCTS TO STANDARD JSON AND APPEND ON RESUME
    // ALSO SET STOCK AND AVAILABILITY ON RESUME PRODUCT TABLE
    const productsToAdd = detailsPackage.products.map((packageProducts)=>{
        return {
            'product_id' : packageProducts.product_id,
            'quantityToAdd' : packageProducts.quantity
        }
    });

    // THIS FUNCTION MODIFY GLOBAL CONST listProductArray 
    substractStockFromProducts(productsToAdd);
    // THIS FUNCTION USE GLOBLA VARIABLE AND APPEND ARRAY ON TABLE PRODUCTS
    fillProductsTableAssigments();
    //FORMAT RESUME PRODUCT ARRAY
    SetSelectedProducts_Substract(productsToAdd);
    // APPEND ALL PRODUCTS TO RESUME AND RESUME PROJECT TABLE
    // AND APPEND PRODUCT ON RESUME PROJECT TABLE AT END OF ASSIGMENT OPTIONS
    printAllMySelectedProds();
    // printAllMySelectedProdsOnProjectResume();
}

function printAllMySelectedProds(){

    $('#productResume-tables h3').remove();
    $('#productResume-tables table').remove();
    $('#filterSelectedProducts option').remove();
    $('#filterSelectedProducts').append(`<option value="all">Todos</option>`);
    $('#projectResume-Products categorieSubTotal').remove();
    $('#projectResume-Products h3').remove();
    $('#projectResume-Products p').remove();
    $('#projectResume-Products input').remove();
    $('#projectResume-Products table').remove();
    $('#projectResumeFilter-products option').remove();
    $('#projectResumeFilter-products').append(`<option value="all">Todos</option>`);

    // THIS IS FOR TABLE PRODUCTS ON PRODUCT ASSIGMENTS (TEMPORARY VIEW PRE FRONT DESIGN)
    selectedProdsAndCategories.forEach((prodData)=>{
        $('#filterSelectedProducts').append(`<option value="${prodData.categoria}">${prodData.categoria}</option>`)
        const tableId = `table-${prodData.categoria}`
        const subCategorias = prodData.subcategorias
        $('#productResume-tables').append(
            `<h3>${prodData.categoria[0].toUpperCase() + prodData.categoria.substring(1)}</h3>
            <table id="${tableId}" class="table tableCatsAnsResume" style="margin-bottom:20px;">
                <thead>
                    <th>Nombre</th>
                    <th>Precio arriendo</th>
                    <th>Faltantes</th>
                    <th>Cantidad</th>
                    <th></th>
                </thead>
                <tbody>
                </tbody>
            </table>`
        );
        // console.table(subCategorias);
        subCategorias.forEach((subcat)=>{
            const productos = subcat.productos;
            $(`#${tableId}`).append(`<tr><td colspan="4" class="subcategorieName"><p ></p>${subcat.nombre}</td></tr>`);
            productos.forEach((prod)=>{
                $(`#${tableId}`).append(`<tr product_id="${prod.id}">
                    <td>${prod.nombre}</td>
                    <td>${prod.precio_arriendo}</td>
                    <td>${prod.faltantes}</td>
                    <td><input type="number" class="addProdInputResume" min="1" max="" value="${prod.quantityToAdd}"/></td>
                    <td style="color:red;cursor:pointer;"><i class="fa-solid fa-trash removePrd"></i></td>
                </tr>`)
            })
        })
    })

    // THIS IS FOR PROJECT RESUME  
    selectedProdsAndCategories.forEach((prodData)=>{
        $('#projectResumeFilter-products').append(`<option value="${prodData.categoria}">${prodData.categoria}</option>`)
        const tableId = `projectResumeProduct-${prodData.categoria}`
        const subCategorias = prodData.subcategorias
        $('#projectResume-Products').append(
            `<div class="row categorieSubTotal">
                <h3 class="col-lg-3 col-md-4 col-12">${prodData.categoria[0].toUpperCase() + prodData.categoria.substring(1)}</h3>
                <p class="col-lg-5  col-6" style="text-align:end;">Subtotal</p>
                <input type="text" categorie_name="${prodData.categoria}" class="col-lg-4 col-6 relativeCategorieValue" id="subtotalCategoria-${prodData.categoria}">
            </div>
            <table id="${tableId}" class="table tableCatsAnsResume" style="margin-bottom:20px;">
                <thead>
                    <th>Nombre</th>
                    <th>Precio arriendo</th>
                    <th>Faltantes</th>
                    <th>Cantidad</th>
                    <th></th>
                </thead>
                <tbody>
                </tbody>
            </table>`
        );
        // console.table(subCategorias);
        subCategorias.forEach((subcat)=>{
            const productos = subcat.productos;
            $(`#${tableId}`).append(`<tr><td colspan="4" class="subcategorieName"><p ></p>${subcat.nombre}</td></tr>`);
            productos.forEach((prod)=>{
                $(`#${tableId}`).append(`<tr product_id="${prod.id}">
                    <td>${prod.nombre}</td>
                    <td><input type="text" class="product-price" value="${CLPFormatter(parseInt(prod.precio_arriendo)) }"></td>
                    <td>${prod.faltantes}</td>
                    <td><input type="number" class="addProdInputResume" min="1" max="" value="${prod.quantityToAdd}"/></td>
                    <td style="color:red;cursor:pointer;"><i class="fa-solid fa-trash removePrd"></i></td>
                </tr>`)
            })
        })
    })

    setIngresos();
}
$(document).on('click','.removePrd',async function(){
    // FIND PRODUCT_ID ON TR ATTR 
    const product_id = $(this).closest('tr').attr('product_id');

    // CHECK IF PRODUCT_ID EXISTS ON SELECTED PRODS
    const idExists = _selectedProducts.find((selectedProduct)=>{
        if(selectedProduct.id === product_id){
            return true;
        }
    })
    if(!idExists){
        Swal.fire({
            'icon':'error',
            'title':'Ups!',
            'text':'Ha ocurrido un error',
            'showConfirmButton':false,
            'timer':2000
        })
        return;
    }
    
    const totalToRemove = _selectedProducts.find((product)=>{
        if(product.id === product_id){
            return product.quantityToAdd
        }
    });
    let totalOnPackages = 0; 
    let packageTakenProducts = _selectedPackages.map((selectedPackage)=>{
        const prodsPerPackage = selectedPackage.package_products.find((product)=>{
            return  product.product_id === product_id
        })
        if(prodsPerPackage){
            totalOnPackages += parseInt(prodsPerPackage.quantity);
            return {
                'package_name' : selectedPackage.package_name,
                'products' : prodsPerPackage 
            }
        }
    }).filter((value)=>{return value !== undefined})

    
    // console.log("packageTakenProducts",packageTakenProducts);
    // console.log("totalOnPackages",totalOnPackages);

    const totalToSubstract = parseInt(totalToRemove.quantityToAdd) - parseInt(totalOnPackages)   

    
    if(totalToSubstract === 0){
        let trs = '';
        packageTakenProducts.forEach((prod)=>{
            trs+=`<tr>
                <td>${prod.package_name}</td>
                <td>${prod.products.quantity}</td>
            </tr>`
        });

        Swal.fire({
            'icon':'warning',
            'title':'Ups!',
            'html':`<p>No se puede quitar el equipo ${totalToRemove.nombre} ya que todos los equipos seleccionados pertenecen a un paquete</p>
            <table class="table">
            <thead>
                <tr>
                    <th>Paquete</th>
                    <th>Cantidad</th>
                </tr>
            <thead>
            <tbody>
                ${trs}
            </tbody>
        </table>`
        })
        return
    }

    if(totalToSubstract > 0 && packageTakenProducts.length > 0){
        let trs = '';
        packageTakenProducts.forEach((prod)=>{
            trs+=`<tr>
                <td>${prod.package_name}</td>
                <td>${prod.products.quantity}</td>
            </tr>`
        });
        Swal.fire({
            'icon':'warning',
            'title':'Ups!',
            'html':`<p>Solo se pueden quitar ${totalToSubstract} ${totalToRemove.nombre} ya que los restantes pertenecen a los siguientes paquetes</p>
            <table class="table">
            <thead>
                <tr>
                    <th>Paquete</th>
                    <th>Cantidad</th>
                </tr>
            <thead>
            <tbody>
                ${trs}
            </tbody>
        </table>`,
        showCancelButton:true,
        cancelButtonText:'Cancelar'
        })
        .then((result)=>{
            if(result.isConfirmed){
                Swal.fire(
                    'Excelente!',
                    'Removido exitosamente',
                    'success'
                )
            }
            const productsToRemove = [{
                'id' : totalToRemove.id,
                'quantity' : totalToSubstract
            }]
        
            const removedProducts = setSelectedProduct_RemoveProducts(productsToRemove);
            printAllProductsOnTable();
            setCategoriesAndSubCategories();
            printAllSelectedProducts();
            setIngresos();
        })
        return;
    }

    const productsToRemove = [{
        'id' : totalToRemove.id,
        'quantity' : totalToRemove.quantityToAdd
    }]

    const removedProducts = setSelectedProduct_RemoveProducts(productsToRemove);
    printAllProductsOnTable();
    setCategoriesAndSubCategories();
    printAllSelectedProducts();
    setIngresos();
    
    
})
async function getAllProdsOnPackages(product_id){
    let packageContainsProduct = [];

    const detailsPackage = await Promise.all(
        selectedPackages.map(async (package)=>{
        return await GetPackageDetails(package.id);
    }))

    detailsPackage.forEach((package)=>{
        let products =  package.products;
        const prodExists = products.find((prod)=>{
            if(prod.product_id === product_id){
                return true;
            }
        })
        if(prodExists){
            packageContainsProduct.push({
                'package':package.data[0].nombre,
                'quantity':prodExists.quantity
            })
        }
    })

    return packageContainsProduct;
}

async function getAllSelectedProductsOnPackage(product_id){
    let totalPerProduct = 0;

    const selectedProd = selectedProducts.find((product)=>{
        if(product.id === product_id){
            return product
        }
    })

    const detailsPackage = await Promise.all(
        selectedPackages.map(async (package)=>{
        return await GetPackageDetails(package.id);
    }))

    console.log(detailsPackage);


    detailsPackage.forEach((package)=>{
        const prodsPerPackage = package.products;
        prodsPerPackage.forEach((prod)=>{
            if(prod.product_id === product_id){
                totalPerProduct = totalPerProduct + parseInt(prod.quantity);
            }
        })
    })

   return totalPerProduct
}

// function printAllMySelectedProdsOnProjectResume(){
//     $('#projectEquipos .productResumeItem').remove();
//     selectedProducts.forEach((product)=>{
//         let newTr = `
//         <tr class="productResumeItem">
//             <td class="idProductoResume" style="display:none">${product.id}</td>
//             <td class="tbodyHeader">${product.nombre}</td>
//             <td class="quantity">${product.quantityToAdd}</td>
//             <td class="perUnit">${product.precio_arriendo}</td>
//             <td class="valorProductoResume">${parseInt(product.precio_arriendo) * parseInt(product.quantityToAdd)}</td>
//         </tr>`;
//         $("#projectEquipos tr:last").before(newTr);
//     })
// }


function filterProductsResume(arrayToPrint){

    $('#productResume-tables h3').remove();
    $('#productResume-tables table').remove();
    arrayToPrint.forEach((prodData)=>{
        const tableId = `table-${prodData.categoria}`
        const subCategorias = prodData.subcategorias
        $('#productResume-tables').append(
            `<h3>${prodData.categoria[0].toUpperCase() + prodData.categoria.substring(1)}</h3>
            <table id="${tableId}" class="table tableCatsAnsResume" style="margin-bottom:20px;">
                <thead>
                    <th>Nombre</th>
                    <th>Precio arriendo</th>
                    <th>Faltantes</th>
                    <th>Cantidad</th>
                </thead>
                <tbody>
                </tbody>
            </table>`
        );
        // console.table(subCategorias);
        subCategorias.forEach((subcat)=>{
            const productos = subcat.productos;
            $(`#${tableId}`).append(`<tr><td colspan="4" class="subcategorieName"><p ></p>${subcat.nombre}</td></tr>`);
            productos.forEach((prod)=>{
                $(`#${tableId}`).append(`<tr product_id="${prod.id}">
                    <td>${prod.nombre}</td>
                    <td>${prod.precio_arriendo}</td>
                    <td>${prod.faltantes}</td>
                    <td><input type="number" class="addProdInputResume" min="1" max="" value="${prod.quantityToAdd}"/></td>
                </tr>`)
            })
        })
    })
}

let selectedProds = [];
function SetSelectedProducts_Substract(productsToAdd){

    // console.log("productsToAdd",productsToAdd);

    listProductArray.map((product)=>{

        const productExists = productsToAdd.find((addProd)=>{
            if(addProd.product_id === product.id){
                // console.log("addProd",addProd);
                return addProd
            }
        })

        if(productExists){
            // console.log("productExists",productExists);
            const exists = selectedProducts.find((selected)=>{
                if(selected.id === productExists.product_id){
                    selected.quantityToAdd = parseInt(selected.quantityToAdd) + parseInt(productExists.quantityToAdd)
                    selected.faltantes = product.faltantes;
                    return selected
                }
            })
            if(!exists){
                selectedProducts.push({
                    'id': product.id,
                    'nombre': product.nombre,
                    'precio_arriendo': product.precio_arriendo,
                    'quantityToAdd': productExists.quantityToAdd,
                    'categoria': product.categoria,
                    'item': product.item,
                    'faltantes' : product.faltantes
                })  
            }
        }
    })

    // console.log(selectedProducts);
    setMyCatsAndSubCats();
}

function SetSelectedProducts_Add(productsToAdd){
    listProductArray.map((product)=>{
        const productExists = productsToAdd.find((addProd)=>{
            if(addProd.product_id === product.id){
                return addProd
            }
        })

        if(productExists){
            const exists = selectedProducts.find((selected,index)=>{
                console.log("selected",selected);
                if(selected.id === productExists.product_id){
                    selected.quantityToAdd = parseInt(selected.quantityToAdd) - parseInt(productExists.quantityToAdd);
                    selected.faltantes = product.faltantes;
                    return selected;
                }
            })

            if(!exists){
                selectedProducts.push({
                    'id': product.id,
                    'nombre': product.nombre,
                    'precio_arriendo': product.precio_arriendo,
                    'quantityToAdd': productExists.quantityToAdd,
                    'faltantes' : product.faltantes
                })  
            }
            console.log("previo",selectedProducts);

            selectedProducts = selectedProducts.filter((selProd)=>{
                return selProd.quantityToAdd > 0
            })
        }
    })
    setMyCatsAndSubCats();
}

let selectedProdsAndCategories = [];



function setMyCatsAndSubCats(){
    selectedProdsAndCategories = [];
    console.log("0001---> ALL MY SELECTED PRODUCTS",selectedProducts);
    selectedProducts.forEach((selProd)=>{

        let testProds = [];

        selectedProdsAndCategories.forEach((prod)=>{
            prod.subcategorias.forEach((subcategoria)=>{
                subcategoria.productos.forEach((producto)=>{
                    if(producto.id === "194"){
                        testProds.push(producto);
                    }
                })
            })
        })

        console.log("RESULTADO DE LA BUSQUEDA DEL PRODUCTO", testProds);


        const catExists = selectedProdsAndCategories.find((prodAndCat)=>{
            if(selProd.categoria === prodAndCat.categoria){
                return prodAndCat;
            }
        });
        
        if(!catExists){
            selectedProdsAndCategories.push({
                "categoria":selProd.categoria,
                "subcategorias":[
                    {
                        "nombre":selProd.item,
                        "productos":[{
                            'id': selProd.id,
                            'nombre': selProd.nombre,
                            'precio_arriendo': selProd.precio_arriendo,
                            'quantityToAdd': selProd.quantityToAdd,
                            'categoria': selProd.categoria,
                            'item': selProd.item,
                            'faltantes' : selProd.faltantes
                        }]
                    }
                ]
            })
        }

        let catIndex;

        selectedProdsAndCategories.find((cat, index)=>{
            if(cat.categoria === selProd.categoria){
                catIndex = index;
            }
        });
        const subcategoriasToSearch = selectedProdsAndCategories[catIndex].subcategorias;

        const subCatExists = subcategoriasToSearch.find((subCat)=>{
            if(subCat.nombre === selProd.item){
                return subCat
            }
        });

        

        if(!subCatExists){

            console.log("SELPROD EN SUBCATEGORIA NO ENCONTRADA PARA PUSH",selProd);

            subcategoriasToSearch.push(
                {
                    "nombre":selProd.item,
                    "productos":[{
                        'id': selProd.id,
                        'nombre': selProd.nombre,
                        'precio_arriendo': selProd.precio_arriendo,
                        'quantityToAdd': selProd.quantityToAdd,
                        'categoria': selProd.categoria,
                        'item': selProd.item,
                        'faltantes' : selProd.faltantes
                    }]
                }
            )
        }


        // const subcategorias = selectedProdsAndCategories[catIndex].subcategorias;

        // let productoExists ;
        // let letSubCatIndex;
        // subcategorias.forEach((subcategoria,index)=>{
        //     letSubCatIndex = index
        //     subcategoria.productos.forEach((producto)=>{
        //         productoExists = producto.find((prod)=>{ 
        //             if(prod.id === selProd.id){
        //                 return false;
        //             }
        //         });   
        //     })
        // })

        // if(!productoExists){
        //     selectedProdsAndCategories[catIndex].subcategorias[letSubCat]
        // }

        const products = selectedProdsAndCategories[catIndex].subcategorias[0].productos;

        const prodExists = products.find((prod,index,array)=>{
            if(prod.id === selProd.id){
                prod.quantityToAdd = selProd.quantityToAdd;
                prod.faltantes = selProd.faltantes
                return true;
            }    
        });

        if(!prodExists){

            if(selProd.id === "194"){
                console.log("0001-->>ID 194 LOG ",selProd);
            }
            products.push({
                'id': selProd.id,
                'nombre': selProd.nombre,
                'precio_arriendo': selProd.precio_arriendo,
                'quantityToAdd': selProd.quantityToAdd,
                'categoria': selProd.categoria,
                'item': selProd.item,
                'faltantes' : selProd.faltantes
            })
        }


    })

    // console.log("all cats and subcats",selectedProdsAndCategories);

}



function substractStockFromProducts(productsToSubstract){

    // console.log("productsToSubstract",productsToSubstract);

    listProductArray = listProductArray.map((product)=>{
        let faltantes = product.faltantes;
        let disponibles = product.disponibles;
        const productExists = productsToSubstract.find((addProd)=>{
            if(addProd.product_id === product.id){
                return addProd
            }
        })
        if (productExists) {
          disponibles = parseInt(product.disponibles) - parseInt(productExists.quantityToAdd);
        }
        if (disponibles < 0) {
          faltantes = Math.abs(disponibles)
        }
        return {
          'id': product.id,
          'categoria': product.categoria,
          'item': product.item,
          'nombre': product.nombre,
          'precio_arriendo': product.precio_arriendo,
          'cantidad': product.cantidad,
          'disponibles': disponibles,
          'faltantes': faltantes
        }
    });
}

function AddStockFromProducts(productsToAdd){
    listProductArray = listProductArray.map((product)=>{
        let faltantes = product.faltantes;
        let disponibles = product.disponibles;
        const productExists = productsToAdd.find((addProd)=>{
            if(addProd.product_id === product.id){
                return addProd
            }
        })
        if (productExists) {
          disponibles = parseInt(product.disponibles) + parseInt(productExists.quantityToAdd);
        }
        if (disponibles < 0) {
          faltantes = Math.abs(disponibles)
        }else{
            faltantes = 0;
        }
        return {
          'id': product.id,
          'categoria': product.categoria,
          'item': product.item,
          'nombre': product.nombre,
          'precio_arriendo': product.precio_arriendo,
          'cantidad': product.cantidad,
          'disponibles': disponibles,
          'faltantes': faltantes
        }
    });
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
        success: async function (data) {
        },
        error: function (response) { }
    })
}



function addProductToResumeAssigment(){

    $('.detailsProduct-box').remove()
    $('#projectEquipos .productResumeItem').remove()

    selectedProducts.forEach((product)=>{
        $('#tbodyReceive').append(`
        <div class="detailsProduct-box">
                <div class="checkitem">
                    <input type="checkbox">
                    <span class="verticalLine"></span>
                </div>
                <div class="itemProperties">
                    <p class="itemId" style="display:none">${product.id}</p>
                <div class="itemName"> 
                    <p>${product.nombre}</p>
                    <hr/>
                </div>
                <div class="itemName"> 
                    <p>Faltantes</p>
                    <p>${product.faltantes}</p>
                    <hr/>
                </div>
                <div class="itemPrice">
                    <p class="getPrice" style="display:none">${product.id}</p>
                    <p  style="font-size: 15px; font-weight: 700;">Precio arriendo: ${product.precio_arriendo}</p>
                    <hr/>
                </div>
                <div class="itemDetails">
                    <div class="detailQuantity">
                        <p>Cantidad</p>
                        <input type="number" class="addProdInputResume" min="1" max="" value="${product.quantityToAdd}"/>
                    </div>
                    <div class="containerRemoveLogo">
                        <p style="visibility: hidden;">CANT</p>
                        <i class="fa-solid fa-trash logoRemove" style="color:red;font-size: 30px;"></i>
                    </div>
                </div>
            </div>
        </div>`);
        let newTr = `
        <tr class="productResumeItem">
            <td class="idProductoResume" style="display:none">${product.id}</td>
            <td class="tbodyHeader">${product.nombre}</td>
            <td class="quantity">${product.quantityToAdd}</td>
            <td class="perUnit">${product.precio_arriendo}</td>
            <td class="valorProductoResume">${parseInt(product.precio_arriendo) * parseInt(product.quantityToAdd)}</td>
        </tr>`;
        $("#projectEquipos tr:last").before(newTr);
    })
}


$(document).on('click', '.addPackageToAssigments', async function() {
    const package_id = $(this).closest('tr').attr('package_id');

    addPackageToEvent(package_id);
    // await addStandardPackage(package_id);
    // addPackageToPackageAssigment();
    // addPackageToProjectAssigments($(this))
});

async function addPackageToEvent(package_id){
    await addStandardPackage(package_id);
    addPackageToPackageAssigment();
}



$(document).on('click', '.removePackageFromAssigment', async function () {
    const package_id = $(this).closest('.packageNameContainer').attr('package_id');
    // console.log(package_id);
  
    const packageExists = _selectedPackages.find((selectedPackage) => {
      return selectedPackage.package_id === package_id
    })
  
    if (!packageExists) {
      Swal.fire(
        'Ups!',
        'Ha ocurrido un error, por favor intenta nuevamente',
        'error'
      );
      return
    }

    //GET ALL PACKAGE DETAILS, NAME, ID FROM PACKAGE AND PRODUCTS THAT CONTAINS 
    const detailsPackage = await GetPackageDetails(package_id);

    console.log("detailsPackage", detailsPackage);
    console.log("packageExists.package_products", packageExists.package_products);
    console.log("packageExists.1203987x1-92x483jyu109js3812y", packageExists);

    if (!detailsPackage.success){
      console.log("nada");
    }

    const productsToRemove = packageExists.package_products.map((removeProds)=>{
        return {
            'id' : removeProds.product_id,
            'quantity' : removeProds.quantity
        }
    });


    const removedProducts = setSelectedProduct_RemoveProducts(productsToRemove);
    printAllProductsOnTable();
    setCategoriesAndSubCategories();
    addPackageToPackageAssigment();
    printAllSelectedProducts();
    setIngresos();
    const packageToDelete = _selectedPackages.find((selectedPackage)=>{
        return selectedPackage.package_id === package_id
    })
    //SPLICE PACKAGE FROM _SELECTED PACKAGES AND PRINT SELECTED PACKAGES ON RESUME 
    _selectedPackages.splice(_selectedPackages.indexOf(packageToDelete),1)

    addPackageToPackageAssigment();
    

    if(removedProducts){
      Toastify({
        text: `Paquete ${packageExists.package_name} removido exitosamente`,
        duration: 2000,
        close: true
      }).showToast();
    } else {
      console.log("ha ocurrido un error");
    }
})

