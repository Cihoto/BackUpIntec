let ingresos = 0 ;
let egresos = 0;
let totalPerItem = {
    'personal' : [

    ],
    'equipos':[

    ],
    'vehiculos':[

    ],
    'otros':[

    ]
}

let _totalEgresos = 0;
let _totalIngresos = 0;



function setUtilidad(){

    console.log(allSelectedPersonal);
    
    let total_contratados = 0;

    const allHiredPersonal =  allSelectedPersonal.filter((personal)=>{
        return personal.contrato !== "Freelance";
    })  

    allHiredPersonal.forEach((hired)=>{
        total_contratados +=  parseInt(hired.neto);
    })

    let utilidad = _totalIngresos - _totalEgresos;

    let margen_operacional = utilidad + total_contratados

    $('#utilidadEvento').text(CLPFormatter(utilidad))
    $('#margfenOperacional').text(CLPFormatter(margen_operacional))

}


function setEgresos(){

    totalPerItem.personal = [];
    let allSelectedPersonalCost = 0;
    // EVALUATE GLOBAL VARIABLES ON PERSONAL, VEHICLES AND PRODUCTS 
    // CHANGE #totalCostProject TEXT()   

    if(allSelectedPersonal.length === 0){
        allSelectedPersonalCost = 0;
    }else{
        allSelectedPersonal.forEach((personal)=>{
            allSelectedPersonalCost += parseInt(personal.neto);
        });
    }

    const personalTypeContract = allSelectedPersonal.map((personal)=>{
        return {
            'contract': personal.contrato,
            'value':parseInt(personal.neto) 
        }
    });
    
    personalTypeContract.forEach((contractValue)=>{
        let contract = contractValue.contract;
        let value = contractValue.value;
        // SEARCH IF TOTALPERITEM HAS CONTRACT TYPE PUSHED
        // IF NOT PUSHED PUSH IF EWXISTS ADD VALUE TO OBJECT
        const personalContract = totalPerItem.personal.find((personal)=>{ 
            if(personal.contract === contract){
                return personal;
            }
        });
        if(!personalContract){
            totalPerItem.personal.push(contractValue); 
        }else{
            totalPerItem.personal.forEach((personal)=>{
                if(personal.contract === contract){
                    personal.value = parseInt(personal.value) + parseInt(value);
                }
            })
        }
    })

    // console.log("totalPerItem",totalPerItem)
    $('#totalCostProject').text(CLPFormatter(allSelectedPersonalCost));
    let totalpersonal = 0;
    $('#total-personalResume tbody tr').remove();
    totalPerItem.personal.forEach((personal)=>{

      totalpersonal += parseInt(personal.value);  
      let tr = `<tr>
        <td class="col-4"></td>
        <td>${personal.contract}</td>
        <td>${CLPFormatter(parseInt(personal.value))}</td>
      </tr>`;
      $('#total-personalResume tbody').append(tr);
    })

    // Calculate all VehicleCosts
    // totalVehiculosPropios
    // totalVehiculosExternos

    let totalExternos = 0;
    let totalPropios = 0;
    
    selectedVehicles.forEach((selected)=>{
        if(selected.ownCar === "1"){
            totalPropios += (parseInt(selected.tripValue) * parseInt(selected.cantidadViajes))
        }

        if(selected.ownCar === "0"){
            totalExternos += (parseInt(selected.tripValue) * parseInt(selected.cantidadViajes))
        }
    })


    $('#totalVehiculosPropios').text(CLPFormatter(totalPropios))
    $('#totalVehiculosExternos').text(CLPFormatter(totalExternos))

    let subArriendototal = 0;
    _subRentsToAssign.forEach((subRent)=>{
        subArriendototal += subRent.valor;
    });



    let totalCosts = totalpersonal + totalExternos + totalPropios + subArriendototal;

    _totalEgresos = totalCosts;

    // SET AND WRITE TOTAL   
    $('#totalCost-project').text(CLPFormatter(parseInt(totalCosts)));
    // SET AND WRITE TOTAL 

    $('#totalSubArriendos').text(CLPFormatter(subArriendototal));

    setUtilidad()
}

function setIngresos(){
    // CHECK IF totalPerItem.equipos has elements
    
    if(totalPerItem.equipos.length > 0){
        console.log("ESTO ES LO QUE ESTARE PONIENDO EN VETAN SUB TOTAL", totalPerItem.equipos);

        totalPerItem.equipos = totalPerItem.equipos.map((categoria)=>{
            // console.log("categoria",categoria)
            const categoriaExists = _selectedProducts.find((selected)=>{
                // console.log("selected",selected);
                return selected.categoria === categoria.categorie
            })
            console.log("categoriaExists",categoriaExists);
            
            if(categoriaExists){
                return categoria
            }
        }).filter((item)=>{return item !== undefined})

        
        console.log("TOTALPERITEM.EQUIPOS FILTERED",totalPerItem.equipos);
        totalPerItem.equipos.forEach((totalPerItem)=>{
            if(totalPerItem.isEdited === false){
                totalPerItem.value = 0;
            }
        })
    }

    // _selectedProducts.forEach((selected)=>{
    //     const totalCatExists = totalPerItem.equipos.find((item)=>{
    //         console.log("item",item)
    //         console.log("CATEGORIA",item.categorie);
    //         console.log("item",item)
    //         if(item.categorie === selected.categorie){
    //         }
    //     })
    // })

    // FILL TOTALPERITEM ARRAY ON EQUIPOS TOTAL
    const productTotal = _selectedProducts.map((product)=>{
        return {
            'categorie':product.categoria,
            'value':parseInt(product.precio_arriendo) * parseInt(product.quantityToAdd)
        }
    })
    
    productTotal.forEach((selectedProd)=>{
        const catOnTotal = totalPerItem.equipos.find((equipo)=>{
            if(equipo.categorie === selectedProd.categorie){
                return true;
            } 
        });
        if(!catOnTotal){
            console.log("NO ESXISTE LA CATEGORIA", selectedProd.categorie);
            totalPerItem.equipos.push({
                'categorie':selectedProd.categorie,
                'value':parseInt(selectedProd.value),
                'isEdited':false
            })
        }else{
            const categorieOnTotalPerItem = totalPerItem.equipos.find((item)=>{
                return item.categorie === selectedProd.categorie
            })
            if(categorieOnTotalPerItem){
                if(categorieOnTotalPerItem.isEdited === false){
                    categorieOnTotalPerItem.value += selectedProd.value;
                }
            }
        }
    })

    setUtilidad()
    printAllResumeIncome()
}

function printAllResumeIncome(){

    console.log("ESTO ES LO  QUE SSE VA A IMPRIMIIR", totalPerItem.equipos)
    $('#total-productResume > tbody tr').remove();
    $('#total-othersResume > tbody tr').remove();
    let totalEquipos = 0;
    let totalOthers = 0;
    totalPerItem.equipos.forEach((equipos)=>{
        totalEquipos +=  parseInt(equipos.value);
        let tr = `<tr>
            <td class="col-4"></td>    
            <td>${equipos.categorie[0].toUpperCase() + equipos.categorie.slice(1)}</td>    
            <td>${CLPFormatter(equipos.value)}</td>   
        <tr/>`;
        $(`#subtotalCategoria-${equipos.categorie}`).val(CLPFormatter(parseInt(equipos.value)));
        $('#total-productResume > tbody').append(tr)
    });

    _selectedOthersProducts.forEach((other)=>{
        totalOthers += parseInt(other.total);

    });
    let total = totalEquipos + totalOthers;
    $('#totalPrice-equipos').text(CLPFormatter(parseInt(total)));
    let iva = parseInt(total) * 0.19;
    let totalPlusIva = total + iva;
    _totalIngresos = total;

    $('#totalOthers').text(CLPFormatter(totalOthers))
    $('#netoVenta').text(CLPFormatter(total))
    $('#ivaVenta').text(CLPFormatter(iva))
    $('#totalVenta').text(CLPFormatter(totalPlusIva))
}

function SetTotalCost(){
    $('#totalCostProject').text(CLPFormatter(parseInt(GetTotalCosts())));
}

function CalcUtilidad(){
    $('#totalResumeProductos').text(CLPFormatter(totalPersonal))
    $('#totalResumePersonal').text(CLPFormatter(totalPersonal))
}


























function CalcularUtilidad(){

    
if($('#totalIngresos').text() === ""){

}else{
    $('#totalIngresos').text(CLPFormatter(parseInt($('#totalIngresos').text())));
}

let personalCost = $('.valorPersonalResume')
let totalPersonalContratado = 0
let totalPersonalBHE = 0;
let totalPersonal = 0;

Array.from(personalCost).forEach(pCost => {

    let tipoContrato = $(pCost).closest('tr').find('.tipoContratoProjectResume').text();
    console.log($(pCost).text());
    let valor = $(pCost).text()
    valor = ClpUnformatter(valor);
    console.log(`TIPO CONTRATO ${tipoContrato}`);
    if(tipoContrato === "BHE"){

        totalPersonalBHE = totalPersonalBHE + parseInt(valor);

    }else{
        console.log(parseInt(valor));
        totalPersonalContratado = totalPersonalContratado + parseInt(valor);
    }
});

console.log(`TOTAL DE PERSONAL CONTRATADO ${totalPersonalContratado}`);

let totalIngresos = parseInt(ClpUnformatter($('#totalIngresos').text()));
let totalSubarriendos = $('#totalSubResume').text(); 
// let totalPersonal = $('#totalResumePersonal').text();
let totalViaticos = $('#totalViaticoResume').text();
// let totalPersonalBHE = $('#totalPersonalBHEDes').text();


let unftotalSubarriendos;
let unftotalPersonal;
let unftotalViaticos;

if(totalSubarriendos === ""){
    totalSubarriendos = CLPFormatter(0);
    unftotalSubarriendos = 0;
}else{
    unftotalSubarriendos = ClpUnformatter(totalSubarriendos);
}

if(totalPersonal === ""){
    totalPersonal = CLPFormatter(0);
    unftotalPersonal = 0;
}else{
    unftotalPersonal = totalPersonal;
}

if(totalPersonalBHE === ""){
    totalPersonalBHE = CLPFormatter(0);
    unftotalPersonalBHE = 0;
}else{
    unftotalPersonalBHE = totalPersonalBHE;
}

if(totalViaticos === ""){
    totalViaticos = CLPFormatter(0);
    unftotalViaticos = 0;
}else{
    unftotalViaticos = ClpUnformatter(totalViaticos);
}

$('#totalSubarriendosDes').text(totalSubarriendos);

let ingresOP = totalIngresos - parseInt(unftotalSubarriendos);
$('#ingresoOPDes').text(CLPFormatter(ingresOP))

$('#totalPersonalDes').text(CLPFormatter(totalPersonalContratado));
$('#totalPersonalBHEDes').text(CLPFormatter(totalPersonalBHE));

$('#totalViaticosDes').text(totalViaticos);

let f29 = ((ingresOP*19)/100) + (unftotalPersonalBHE*13.5)/100
$('#totalf29Des').text(CLPFormatter(f29));

let gastosOP = parseInt(unftotalPersonal) + parseInt(unftotalViaticos) + parseInt(totalPersonalBHE);
$('#totalGastosOPDes').text(CLPFormatter(gastosOP));

let utilidadOP = totalIngresos - gastosOP - parseInt(unftotalSubarriendos);
$('#totalUtilidadOPDes').text(CLPFormatter(utilidadOP));

let porcentajeGastos = ((gastosOP*100) / (ingresOP)).toFixed(3);
$('#totalporGastosOPDes').text(`${porcentajeGastos}%`)

let totalsueldos =  parseInt(unftotalPersonal) + parseInt(totalPersonalBHE)
let porcentajesinsueldos = `${(((gastosOP - totalsueldos) * 100) / ingresOP).toFixed(3)}%`;
$('#totalGastosOPSNDes').text(porcentajesinsueldos);

let totalOPSN = (utilidadOP + parseInt(unftotalPersonal));
$('#totalUtililidadOPSNDes').text(CLPFormatter(totalOPSN));

}


function ClearTables(){

    $('#fechaProjectResume').text("");
    $('#clienteProjectResume').text("");
    $('#clienteProjectResume').text("");
    $('#lugarProjectResume').text("");
    $('#comentariosProjectResume').text("");
    $('#totalResumePersonal').text("");
    $('#totalResumeProductos').text("");
    $('#totalResumeViatico').text("");
    $('#totalViaticoResume').text("");
    $('#totalSubResume').text("");
    $('#totalCostProject').text("");
    $('#totalIngresos').text("");
    $('#totalSubarriendosDes').text("");
    $('#ingresoOPDes').text("");
    $('#totalPersonalDes').text("");
    $('#totalViaticosDes').text("");
    $('#totalf29Des').text("");
    $('#totalGastosOPDes').text("");
    $('#totalUtilidadOPDes').text("");

    $('#projectPersonal').find('.tbodyHeader').closest('tr').each((key,element)=>{
        $(element).remove();
    })
    $('#projectEquipos').find('.tbodyHeader').closest('tr').each((key,element)=>{
        $(element).remove();
    })
    $('#vehiculosProject').find('.tbodyHeader').closest('tr').each((key,element)=>{
        $(element).remove();
    })
    $('#projectViatico').find('.tbodyHeader').closest('tr').each((key,element)=>{
        $(element).remove();
    })
    $('#projectSubArriendos').find('.tbodyHeader').closest('tr').each((key,element)=>{
        $(element).remove();
    })
}

function UnformatToClp(element){

    let valorUNCLP = ClpUnformatter($(element).text())
    $(element).text(valorUNCLP);
    
}