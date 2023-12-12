function clearText(element){

    let value  = $(element).closest("tr").find('input[type=number]').val();
    

    if(isNumeric(value)){

        AddTotal(-value)
        $(element).closest("tr").remove();
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
function deleteResumedata(element){

    let value  = $(element).closest("tr").find('input[type=number]').val();
    let previusValue = ClpUnformatter($('#totalSubResume').text());

    if(value === ""){
        value = 0;
    }

    if(isNumeric(value)){
        AddTotal(-value)
        $('#totalSubResume').text(CLPFormatter(previusValue-value));
        $('#totalSubarriendosDes').text(CLPFormatter(previusValue-value))
        CalcularUtilidad();
        $(element).closest("tr").remove();
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



