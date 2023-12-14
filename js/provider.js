async function addNewProvider(request, empresa_id){
    return $.ajax({
        type: "POST",
        url: 'ws/Proveedor/proveedor.php',
        data: JSON.stringify({
            action: 'addNewProvider',
            empresa_id: empresa_id,
            request:request
        }),
        dataType: 'json',
        success: function (data) {
            // if (data.success) {
            //     _allMyProviders = data.providers;
            //     printAllMyProviders();
            // }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    })
}