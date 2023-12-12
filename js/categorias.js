async function GetCategorias(){
    $.ajax({
        type: "POST",
        url: "ws/categoria_item/categoria.php",
        data: JSON.stringify({
            action: "getCategorias",
            empresaId:IDEMPRESA
        }),
        dataType: 'json',
        success: async function(data) {
            let select = $('#categoriaSelect')
            data.forEach(cat=>{
                let opt  = $(select).append(new Option(capitalizeFirstLetter(cat.nombre), cat.id))
            })
        },error:function(response){

            console.log(response.responseText);

        }
    })
}