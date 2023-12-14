$('#addNewFreeLance').validate({
    rules: {
        especialidadSelect:{
            required:true
        },
        nombreInput:{
            required:true
        },
        rutInput:{
            required:true
        },
        correoInput:{
            required:true
        },
        telefonoInput:{
            required:true
        }
    },
    messages: {
        especialidadSelect:{
            required:"Ingrese un valor"
        },
        nombreInput:{
            required:"Ingrese un valor"
        },
        rutInput:{
            required:"Ingrese un valor"
        },
        correoInput:{
            required:"Ingrese un valor"
        },
        telefonoInput:{
            required:"Ingrese un valor"
        }
      
    },
    submitHandler: async function() {
      event.preventDefault();

      const requestFreeLance = [{
        'nombre' : $('#nombreInput').val(),
        'rut' : $('#rutInput').val(),
        'correo' : $('#correoInput').val(),
        'telefono' : $('#telefonoInput').val(),
        'especialidad' : $('#especialidadSelect').val()
      }]

      const newFreeLance = await insertPersonal(requestFreeLance,EMPRESA_ID);

    if(newFreeLance.success){

        const personal = newFreeLance.personalInserted;

        Swal.fire({
            'icon' : 'success',
            'title' : 'Excelente',
            'text' : `${personal.nombre} ha sido creado y asignado a tu proyecto`,
            'showConfirmButton' : false,
            'timer' : 2000
        });

        allPersonal.push({
            'cargo': personal.cargo,
            'cargo_id':personal.cargo_id,
            'contrato': personal.contrato,
            'especialidad': personal.especialidad,
            'id': personal.id,
            'rut':personal.rut,
            'neto': personal.neto,
            'nombre':  personal.nombre,
            'isPicked':false,
            'isSelected':true,
            'horasTrabajadas':0
        });

        allSelectedPersonal.push({
            'cargo': personal.cargo,
            'cargo_id':personal.cargo_id,
            'contrato': personal.contrato,
            'especialidad': personal.especialidad,
            'id': personal.id,
            'rut':personal.rut,
            'neto': personal.neto,
            'nombre':  personal.nombre,
            'isPicked':false,
            'isSelected':true,
            'horasTrabajadas':0
        });
        printAllSelectedPersonal();
      }
    }
  })