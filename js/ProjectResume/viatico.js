function AddViatico(){

    let newTr = `<tr>
                    <td class="tbodyHeader" contenteditable> <input type="text" class="inputViaticoName" placeholder=""/></td>
                    <td class="totalViatico" contenteditable><input class="totalViaticoInput" onblur="SetResumeViaticoValue(this.value)"/></td>
                    <td style="width:3%"onclick="RemoveViatico(this)" class="deleteRow"><i class="fa-solid fa-trash trashDelete"></i></td>
                </tr>`;
                
    $("#projectViatico tr:last").before(newTr);
}
function AddViaticoWithValues(valor, detalle){

    let newTr = `<tr>
                    <td class="tbodyHeader" contenteditable> <input type="text" class="inputViaticoName" placeholder="" value="${detalle}"/></td>
                    <td class="totalViatico" contenteditable><input class="totalViaticoInput" value="${valor}" onblur="SetResumeViaticoValue(this.value)"/></td>
                    <td style="width:3%"onclick="RemoveViatico(this)" class="deleteRow"><i class="fa-solid fa-trash trashDelete"></i></td>
                </tr>`;
    $("#projectViatico tr:last").before(newTr);
}


function SetResumeViaticoResumeValue(){
    let viaticoCost = $('.totalViaticoInput')
    let totalViatico = 0
    Array.from(viaticoCost).forEach(pCost => {
      totalViatico = totalViatico + parseInt(ClpUnformatter($(pCost).val()));
    });
    $('#totalSubResume').text(CLPFormatter(totalViatico));
    $('#totalCostProject').text(CLPFormatter(parseInt(ClpUnformatter(GetTotalCosts())) + totalViatico));
}


function tipoViatico(element){

    let select = $(element).closest('tr').find('.viaticoSelect')
    let value = $(select).val();
    let unitario = $(element).closest('tr').find('.inputViaticoCu').val();
    let total = $(element).closest('tr').find('.totalViatico').text();
    let totaltd = $(element).closest('tr').find('.totalViatico');
    let totalVehiculos;
    let totalPersonal;

    if(GetPersonalStorage() === false){
        totalPersonal = 0
    }else{
        totalPersonal = GetPersonalStorage().length;
    }

    if(GetVehicleStorage() === false){
        totalVehiculos = 0
    }else{
        totalVehiculos = GetVehicleStorage().length;
    }

    if(unitario === "" || !isNumeric(unitario)){
        unitario = 0;
    }

    totaltd.text("")
    if(value === "unico"){
        totaltd.text(CLPFormatter(unitario));
        SetResumeViaticoValue(ClpUnformatter(totaltd.text()))
    }
    if(value === "personal"){
        totaltd.text(CLPFormatter(totalPersonal*unitario));
        SetResumeViaticoValue(ClpUnformatter(totaltd.text()))
    }
    if(value === "vehiculos"){
        totaltd.text(CLPFormatter(totalVehiculos*unitario));
        SetResumeViaticoValue(ClpUnformatter(totaltd.text()))
    }
}

function SetResumeViaticoValue(value){

    let valor = value;
    if(valor === ""){
        valor = 0;
    }

    let previusValue;

    if($('#totalViaticoResume').text() === ""){
        previusValue = 0
    }else{
        previusValue = ClpUnformatter($('#totalViaticoResume').text());
    }

    if(isNumeric(valor)){

        let viaticoCost = $('.totalViaticoInput')
        let totalViatico = 0;
        
        Array.from(viaticoCost).forEach(pCost => {
            if($(pCost).val() !== ""){

                totalViatico = totalViatico + parseInt(ClpUnformatter($(pCost).val())) 

            }else{
                totalViatico = totalViatico + 0;
            }
        });
        $('#totalViaticoResume').text(CLPFormatter(totalViatico));
        $('#totalViaticosDes').text(CLPFormatter(totalViatico));
        AddTotal(totalViatico-previusValue);

    }else{
        Swal.fire({
            icon: 'error',
            title: 'Ups!',
            text: 'Debes ingresar un numero'
        })
    }
}


function RemoveViatico(el){

    let value = ClpUnformatter($(el).closest('tr').find('.totalViaticoInput').val());
    console.log("VALOR A RESTAR", value);
    let previusValue = ClpUnformatter($('#totalViaticoResume').text());

    if(value === ""){
        value = 0;
    }

    if(isNumeric(value)){
        AddTotal(-value)
        $('#totalViaticoResume').text(CLPFormatter(previusValue-value));
        $(el).closest("tr").remove();
        return true;
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Ups!',
            text: 'Debes ingresar un numero'
        })
        return false;
    }
}

