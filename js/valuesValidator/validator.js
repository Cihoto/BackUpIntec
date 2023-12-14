function isNumeric(value){

    return $.isNumeric(value)

}

function isNull(value){

    if(value === "" || value === null || value === undefined ){
        return true
    }else{
        return false
    }
}



function minLength(value,min){

    let length = value.length

    if(length < min){
        return false
    }else{
        return true
    }
}

function maxLength(value,max){

    let length = value.length

    if(length > max){
        return false
    }else{
        return true
    }

}

function capitalizeFirstLetter(str) {

    const capitalized = str.charAt(0).toUpperCase() + str.slice(1);

    return capitalized;
}

function CLPFormatter(value){

    let CLPFormat = new Intl.NumberFormat('es-CL', {
        style: 'currency',
        currency: 'CLP',
    });
    return CLPFormat.format(value);
}

function ClpUnformatter(value){
    console.log("VALUE UNFORMATTER",value);
    let newValue = value
    .replaceAll("$", "")
    .replaceAll(".", "");

    return newValue;
}


function convertFormToJSON(form) {
    return form.reduce(function(json, {
        name,
        value
    }) {
        json[name] = value
        return json;
    }, {});
}



