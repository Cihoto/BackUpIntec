async function GetMarca(){
    $.ajax({
        type: "POST",
        url: "ws/categoria_item/marca.php",
        data: JSON.stringify({
            action: "getMarca",
            empresaId:IDEMPRESA
        }),
        dataType: 'json',
        success: async function(data) {
            let select = $('#marcaSelect')
            data.forEach(cat=>{
                let opt  = $(select).append(new Option(capitalizeFirstLetter(cat.marca), cat.id))
            })

        },error:function(response){

            console.log(response.responseText);

        }
    })
}