let _allMyProviders = [];
let _subRentsToAssign = []

async function getAllMyProviders(empresa_id) {
    return $.ajax({
        type: "POST",
        url: 'ws/Arriendos/arriendos.php',
        data: JSON.stringify({
            action: 'getAllMyProviders',
            empresa_id: empresa_id
        }),
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                _allMyProviders = data.providers;
                printAllMyProviders();
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    })
}

async function setAllMyProviders(empresa_id) {
    return $.ajax({
        type: "POST",
        url: 'ws/Arriendos/arriendos.php',
        data: JSON.stringify({
            action: 'getAllMyProviders',
            empresa_id: empresa_id
        }),
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                _allMyProviders = data.providers;
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    })
}


function printAllMyProviders() {
    $('#mySelect2').select2('destroy');
    $('.allProvidersSelect').each((key, element) => {
        $(element).append(new Option("", ""))
        console.log("element", $(element));
        if ($(element).val() === "") {
            _allMyProviders.forEach((provider) => {
                $(element).append(new Option(`${provider.nombre} ${provider.apellido}`, provider.id))
            })
        }
    })
    $('.allProvidersSelect').select2();
}

function AddSubArriendo() {

    let newTr = `<tr>
                    <td class="tbodyHeader" contenteditable> <input type="text" class="inputSubName" placeholder=""/></td>
                    <td><input type="text" class="inputSubDetalle" placeholder=""/></td>
                    <td><input onblur="SetResumeSubValue(this)" type="number" class="inputSubValue" placeholder=""/></td>
                    <td onclick="deleteResumedata(this)" class="deleteRow"><i class="fa-solid fa-trash trashDelete"></i></td>
                </tr>`;

    $("#projectSubArriendos tr:last").before(newTr);
}

function AddSubArriendoWithValues(detalle, valor) {

    let newTr = `<tr>
        <td class="tbodyHeader" contenteditable> <input type="text" class="inputSubName" placeholder=""/></td>
        <td><input type="text" class="inputSubDetalle" placeholder="" value="${detalle}"/></td>
        <td><input onblur="SetResumeSubValue(this)" type="number" class="inputSubValue" placeholder="" value="${valor}"/></td>
        <td onclick="deleteResumedata(this)" class="deleteRow"><i class="fa-solid fa-trash trashDelete"></i></td>
    </tr>`;
    $("#projectSubArriendos tr:last").before(newTr);

}

function addSubRentToResumeTable(nombre, detalle, valor, id) {

    let newTr = `<tr id="${id}">
        <td class="tbodyHeader"><input type="text" class="inputSubName" placeholder="" value="${nombre}"/></td>
        <td><input type="text" class="inputSubDetalle" placeholder="" value="${detalle}"/></td>
        <td><input onblur="SetResumeSubValue(this)" type="number" class="inputSubValue" placeholder="" value="${valor}"/></td>
        <td onclick="deleteResumedata(this)" class="deleteRow"><i class="fa-solid fa-trash trashDelete"></i></td>
    </tr>`;
    $("#projectSubArriendos tr:last").before(newTr);
    SetResumeArriendosResumeValue(valor);
}

function SetResumeArriendosResumeValue(valuetoAdd) {
    let arriendoCost = $('.inputSubValue')
    let totalArriendo = 0;
    Array.from(arriendoCost).forEach(pCost => {
        totalArriendo = totalArriendo + parseInt(ClpUnformatter($(pCost).val()));
    });
    $('#totalSubResume').text(CLPFormatter(totalArriendo));
    AddTotal(valuetoAdd);
    CalcularUtilidad();
}

function SetResumeSubValue(el) {

    let valor = $(el).val();
    if (valor === "") {
        valor = 0;
        $(el).val(0);
    }

    let previusValue;
    if ($('#totalSubResume').text() === "") {
        previusValue = 0
    } else {
        previusValue = ClpUnformatter($('#totalSubResume').text());
    }

    if (isNumeric(valor)) {
        let personalCost = $('.inputSubValue')
        let totalSub = 0
        Array.from(personalCost).forEach(pCost => {

            totalSub = totalSub + parseInt(ClpUnformatter($(pCost).val()))
        });
        $('#totalSubResume').text(CLPFormatter(totalSub))
        $('#totalSubarriendosDes').text(CLPFormatter(totalSub));

        // console.log(totalSub-previusValue);
        AddTotal(totalSub - previusValue);

    } else {
        // Swal.fire({
        //     icon: 'error',
        //     title: 'Ups!',
        //     text: 'Debes ingresar un numero'
        // })
    }
}
function SetResumeSubValueDirectValue() {

    let previusValue;
    if ($('#totalSubResume').text() === "") {
        previusValue = 0
    } else {
        previusValue = ClpUnformatter($('#totalSubResume').text());
    }


    let personalCost = $('.inputSubValue')
    let totalSub = 0
    Array.from(personalCost).forEach(pCost => {
        totalSub = totalSub + parseInt(ClpUnformatter($(pCost).val()))
    });
    $('#totalSubResume').text(CLPFormatter(totalSub))
    $('#totalSubarriendosDes').text(CLPFormatter(totalSub));
    // console.log(totalSub-previusValue);
    AddTotal(totalSub - previusValue);


}

async function GetAlArriendosByEmpresa(empresa_id) {
    return $.ajax({
        type: "POST",
        url: 'ws/Arriendos/arriendos.php',
        data: JSON.stringify({
            action: 'GetArriendos',
            empresa_id: empresa_id
        }),
        dataType: 'json',
        success: function (data) {
        },
        error: function (response) {
            console.log(response.responseText);
        }
    })
}

async function GetRentById(arriendo_id) {
    return $.ajax({
        type: "POST",
        url: 'ws/Arriendos/arriendos.php',
        data: JSON.stringify({
            'action': 'GetArriendoById',
            'arriendo_id': arriendo_id
        }),
        dataType: 'json',
        success: function (data) {
        },
        error: function (response) {
            console.log(response.responseText);
        }
    })
}
async function FillRent() {

    let ul = $('#rentsUl');
    console.log(ul);
    const rentArray = await GetAlArriendosByEmpresa(EMPRESA_ID);
    console.log("ARRAY RENTAS", rentArray.data);
    rentArray.data.forEach((arr) => {
        console.log(arr.id);
        let li = `<li class="rentObj" onclick="AddArriendoToTable(this)" id="${arr.id}"><p>${arr.item} | ${arr.nombre} ${arr.apellido} ${arr.rut}</p></li>`;
        $(ul).append(li);
    });
}


function GetArriendos() {

    $('.arriendosSelect').addClass('active');
    $('#rentsUl').addClass('active');
    let liRent = $('#rentsUl').find('.rentObj');
    if (liRent.length > 0) {
        $(liRent).each((key, element) => {
            element.remove();
        })
        FillRent();
    } else {
        FillRent();
    }
}


$('#closeDiv').on('click', function () {
    $('.arriendosSelect').removeClass('active')
    $('#rentsUl').removeClass('active')
});

function OpenArriendoModal() {
    $('#arriendosModal').modal('show');
}

async function AddArriendoToTable(element) {

    const id = $(element).attr('id');
    const { value: valorTotal } = await Swal.fire({
        title: 'Ingrese el total bruto de este arriendo',
        input: 'text',
        inputLabel: 'Valor Bruto',
        inputPlaceholder: ''
    })
    if (valorTotal) {
        const responseArriendo = await GetRentById(id);
        const arrayArriendo = responseArriendo.data;
        console.table(arrayArriendo[0].nombre)
        addSubRentToResumeTable(arrayArriendo[0].nombre, `${arrayArriendo[0].nombre} ${arrayArriendo[0].apellido} - ${arrayArriendo[0].rut}`, valorTotal, id)
        Swal.fire(
            {
                'icon': 'success',
                'text': 'Agregado exitosamente',
                'timer': 800
            });
        return valorTotal;
    } else {
        return
    }
}

async function printNewRow_subRent(){
    await  setAllMyProviders(EMPRESA_ID);
    $('#subarriendosTable tbody tr').remove();
    $('#mySelect2').select2('destroy');
    console.log("SET ALL MY PROVIDERS", _allMyProviders);


    _subRentsToAssign.forEach((subRent) => {
        let options = "";
        _allMyProviders.forEach((provider) => {

            if (provider.id === subRent.proveedor_id) {

                options += `<option selected value="${provider.id}">${provider.nombre} ${provider.apellido}</option>`
            } else {
                options += `<option value="${provider.id}">${provider.nombre} ${provider.apellido}</option>`

            }
        })

        console.log("options", options);

        let tr = `<tr class="isCompletedSubArriendo">
            <td>
                <input class="form-control rentDetail" type="text" name="" value="${subRent.detalle}" id="">
            </td>
            <td>
                <select class="form-select allProvidersSelect" name="" >
                ${options}
                </select>
            </td>
            <td >
                <input class="form-control subArriendoValue" type="text" name="" id="" value="${CLPFormatter(subRent.valor)}">
            </td>
            <td class="removeSubArriendo">
                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M2 4H3.33333H14" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.33334 4.00065V2.66732C5.33334 2.3137 5.47381 1.97456 5.72386 1.72451C5.97391 1.47446 6.31305 1.33398 6.66667 1.33398H9.33334C9.68696 1.33398 10.0261 1.47446 10.2761 1.72451C10.5262 1.97456 10.6667 2.3137 10.6667 2.66732V4.00065M12.6667 4.00065V13.334C12.6667 13.6876 12.5262 14.0267 12.2761 14.2768C12.0261 14.5268 11.687 14.6673 11.3333 14.6673H4.66667C4.31305 14.6673 3.97391 14.5268 3.72386 14.2768C3.47381 14.0267 3.33334 13.6876 3.33334 13.334V4.00065H12.6667Z" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.33334 7.33398V11.334" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.66666 7.33398V11.334" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>             
            </td>
        </tr>`
        $('#subarriendosTable tbody').append(tr);
    })
    let newOpt =`<option value=""></option>`;
    _allMyProviders.forEach((provider) => {
        newOpt += `<option value="${provider.id}">${provider.nombre} ${provider.apellido}</option>`
    })

    let tr = `<tr class="notCompletedSubArriendo">
        <td>
            <input class="form-control rentDetail" type="text" name="" id="">
        </td>
        <td>
            <select class="form-select allProvidersSelect" name="" >
                ${newOpt}
            </select>
        </td>
        <td >
            <input class="form-control subArriendoValue" type="text" name="" id="">
        </td>
        <td class="removeSubArriendo">
            <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M2 4H3.33333H14" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5.33334 4.00065V2.66732C5.33334 2.3137 5.47381 1.97456 5.72386 1.72451C5.97391 1.47446 6.31305 1.33398 6.66667 1.33398H9.33334C9.68696 1.33398 10.0261 1.47446 10.2761 1.72451C10.5262 1.97456 10.6667 2.3137 10.6667 2.66732V4.00065M12.6667 4.00065V13.334C12.6667 13.6876 12.5262 14.0267 12.2761 14.2768C12.0261 14.5268 11.687 14.6673 11.3333 14.6673H4.66667C4.31305 14.6673 3.97391 14.5268 3.72386 14.2768C3.47381 14.0267 3.33334 13.6876 3.33334 13.334V4.00065H12.6667Z" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.33334 7.33398V11.334" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.66666 7.33398V11.334" stroke="#069B99" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>             
        </td>
    </tr>`;

    $("#subarriendosTable tbody").append(tr);

    $('.allProvidersSelect').select2();
    // printAllMyProviders();

    tippy('.notCompletedSubArriendo', {
        content: '<strong>Debes completar todos los campos para poder agregar</strong>'
    });
}

$('#AddNewProvider').on('click',function(){
    $('#newProvider-Modal').modal('show');
})

$('#triggerNewProvider').on('click',function(){
    $('#createNewProvider').trigger('click');
});

$('#addNewRowSubArriendos').on('click', function () {
    printNewRow_subRent();
})

let lastSubArriendoValue = [];
$(document).on('click', '.subArriendoValue', function () {
    lastVehicleValue = ClpUnformatter($(this).val());

    $(this).val("");
    console.log("lastVehicleValue", lastVehicleValue);
});
$(document).on('blur', '.subArriendoValue', function () {
    const valorSubArriendo = $(this).val();

    if (valorSubArriendo === "" || valorSubArriendo === null || valorSubArriendo === undefined) {
        $(this).val(CLPFormatter(lastVehicleValue));
        return;
    }

    if (!isNumeric(valorSubArriendo)) {
        $(this).val(CLPFormatter(lastVehicleValue));
        return;
    }

    $(this).val(CLPFormatter(valorSubArriendo));

    setSubarriendoIfReady();


});

$(document).on('change', '.allProvidersSelect', function () {
    setSubarriendoIfReady()
})

$(document).on('change', '.rentDetail', function () {
    setSubarriendoIfReady()
})

function setSubarriendoIfReady() {
    // console.log("$(element).closest('tr').find('.rentDetail').val()",$(element).closest('tr').find('.rentDetail').val())    
    // console.log("$(element).closest('tr').find('.allProvidersSelect').val()",$(element).closest('tr').find('.allProvidersSelect').val())    
    // console.log("$(element).closest('tr').find('.subArriendoValue').val()",$(element).closest('tr').find('.subArriendoValue').val())


    _subRentsToAssign = [];
    $('#subarriendosTable tbody tr').each((key, element) => {
        console.log("ELEMENT", element);
        if ($(element).find('.rentDetail').val() &&
            $(element).find('.allProvidersSelect').val() &&
            $(element).find('.subArriendoValue').val()) {
            $(element).removeClass('notCompletedSubArriendo');
            $(element).addClass('isCompletedSubArriendo');
            _subRentsToAssign.push({
                'detalle': $(element).find('.rentDetail').val(),
                'proveedor_id': $(element).find('.allProvidersSelect').val(),
                'valor': parseInt(ClpUnformatter($(element).find('.subArriendoValue').val()))
            })
        } else {
            $(element).addClass('notCompletedSubArriendo');
        }
    });

    console.log("_subRentsToAssign", _subRentsToAssign);
    setEgresos();
}

$(document).on('click', '.removeSubArriendo', function () {
    $(this).closest('tr').remove();
    setSubarriendoIfReady();
})





