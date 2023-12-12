$('#addProviderToSubRents').validate({
    rules: {
        providerNameInput:{
            required:true
        },
        providerLastNameInput:{
            required:true
        },
        providerRutInput:{
            required:false
        },
        correoInput:{
            required:true
        },
        telefonoInput:{
            required:true
        },
        razonSocialInput:{
            required:false
        },
        nombreFantasiaInput:{
            required:false
        },
        rutEmpresaInput:{
            required:false
        },
        direccionEmpresaInput:{
            required:false
        },
        correoEmpresaInput:{
            required:false
        }
    },
    messages: {

        providerNameInput:{
            required:"Ingrese un valor"
        },
        providerLastNameInput:{
            required:"Ingrese un valor"
        },
        correoInput:{
            required:"Ingrese un valor"
        },
        telefonoInput:{
            required:"Ingrese un valor"
        },
    },
    submitHandler: async function() {
      event.preventDefault();

        const requestProvider = {
            'nombre' : $('#providerNameInput').val(),
            'apellido' : $('#providerLastNameInput').val(),
            'rut' : $('#providerRutInput').val(),
            'correo' : $('#providerCorreoInput').val(),
            'telefono' : $('#providerTelefonoInput').val(),
            'razon_social' : $('#razonSocialInput').val(),
            'nombre_fantasia' : $('#nombreFantasiaInput').val(),
            'rutEmpresa' : $('#rutEmpresaInput').val(),
            'direccionEmpresa' : $('#direccionEmpresaInput').val(),
            'correoEmpresa' : $('#correoEmpresaInput').val()

        };

        console.log("requestProvider",requestProvider)

        const providerInserted = await addNewProvider(requestProvider,EMPRESA_ID);

        console.log("providerInserted",providerInserted);

        if(providerInserted.success === true){
            Swal.fire({
                title: 'Excelente!',
                text: providerInserted.message,
                icon: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                timer:2000
            });
        }

        printNewRow_subRent();
    }
  })