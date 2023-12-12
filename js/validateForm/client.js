const EMPRESA_ID = document.getElementById('empresaId').textContent;

$('#clienteForm').validate({
    rules: {
      txtNombreCliente: {
        required: true
      },
      txtApellidos: {
        required: true
      },
      txtRut: {
        required: true
      },
      txtCorreo: {
        required: true
      },
      txtTelefono: {
        required: true
      },
      txtRut: {
        required: true
      },
      txtRazonSocial: {
        required: true
      },
      txtNombreFantasia: {
        required: true
      },
      txtDireccionDatosFacturacion: {
        required: true
      },
      txtCorreoDatosFacturacion: {
        required: true
      }
    },
    messages: {
      txtNombreCliente: {
        required: "Ingrese un valor"
      },
      txtApellidos: {
        required: "Ingrese un valor"
      },
      txtRut: {
        required: "Ingrese un valor"
      },
      txtCorreo: {
        required: "Ingrese un valor"
      },
      txtTelefono: {
        required: "Ingrese un valor"
      },
      txtRut: {
        required: "Ingrese un valor"
      },
      txtRazonSocial: {
        required: "Ingrese un valor"
      },
      txtNombreFantasia: {
        required: "Ingrese un valor"
      },
      txtDireccionDatosFacturacion: {
        required: "Ingrese un valor"
      },
      txtCorreoDatosFacturacion: {
        required: "Ingrese un valor"
      }
    },
    submitHandler: function() {
      event.preventDefault();
      //DATOS DE CLIENTE
      const nombreCliente = $('#inputNombreClienteForm').val();
      const apellidos = $('#inputApellidos').val();
      const rutCliente = $('#inputRutCliente').val();
      const correo = $('#inputCorreo').val();
      const telefono = $('#inputTelefono').val();
      const rut = $('#inputRut').val();
      const razonSocial = $('#inputRazonSocial').val();
      const nombreFantasia = $('#inputNombreFantasia').val();
      const direccionDatosFacturacion = $('#inputDireccionDatosFacturacion').val();
      const correoDatosFacturacion = $('#inputCorreoDatosFacturacion').val();

      const idClienteReq = "";

      const requestCliente = {
        empresaId: EMPRESA_ID,
        nombreCliente: nombreCliente,
        apellidos: apellidos,
        rutCliente: rutCliente,
        correoCliente: correo,
        telefono: telefono,
        rut: rut,
        razonSocial: razonSocial,
        nombreFantasia: nombreFantasia,
        direccionDatosFacturacion: direccionDatosFacturacion,
        correoDatosFacturacion: correoDatosFacturacion
      }

      $.ajax({
        type: "POST",
        url: "ws/cliente/cliente.php",
        dataType: 'json',
        data: JSON.stringify({
          "tipo": "AddClientForm",
          request: requestCliente,
          empresa_id:EMPRESA_ID
        }),
        success: function(response) {
            console.log(response);
        }
      }).then(()=>{
        FillClientesTable()
      })

      $("#clienteModal ").modal('hide');
    }
  })