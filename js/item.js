async function GetItems(){
    $.ajax({
        type: "POST",
        url: "ws/categoria_item/item.php",
        data: JSON.stringify({
            action: "getItems",
            empresaId:IDEMPRESA
        }),
        dataType: 'json',
        success: async function(data) {
            let select = $('#itemSelect')
            data.forEach(cat=>{
                let opt  = $(select).append(new Option(capitalizeFirstLetter(cat.item), cat.id))
            })

        },error:function(response){

            console.log(response.responseText);

        }
    })
}