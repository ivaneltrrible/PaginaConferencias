$(function () {

        //CREAR INVITADO CON ARCHIVO 
    $("#crear-invitado-archivo").on('submit', function (e){


      e.preventDefault();
  
      var datos = new FormData(this);
  
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: datos,
        dataType: "json",
        contentType: false,
        cache: false,
        async: true,
        processData: false, 
        success: function (data) {
         
          var resultado = data;
          // console.log(resultado);
          
          if (resultado.respuesta == "exito") {
            Swal.fire({
              title: "Invitado Creado",
              icon: "success",
              html: `Se creo el invitado <b> ${resultado.nombre} </b> correctamente`,
            });
            setTimeout(() => {
                window.location.href = 'lista-invitados.php';
            }, 5000);
          } else {
            Swal.fire({
              title: "Hubo un error al crear....",
              icon: "error",
              text:
                "Si continua con el problema Favor de contactar al Administrador del sistema",
            });
          }
          /* ## TERMINA EL ELSEIF DE VALIDAR USUARIO ## */
        },
        /* ## TERMINA EL SUCCESS ## */
      });
      /* ## TERMINA EL EVENTO AJAX ## */
    });
    /* ## TERMINA LA FUNCION DEL CLICK SUBMIT ## */
  
    /* ################ ELIMINA ADMIN ################## */
    $(".borrar_registro").on("click", function (e) {
      e.preventDefault();
      let id_registro = $(this).attr("data-id");
      let tipo = $(this).attr("data-tipo");
  
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });
  
      swalWithBootstrapButtons
        .fire({
          title: "Eliminar Invitado",
          text: "¿Estas seguro de eliminar este Invitado?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Eliminar",
          cancelButtonText: "No, cancelar",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.value) {
            /* ### SI DA CLICK A CONFIRMAR DE BORRAR ### */
  
            /* ##PETICION POR AJAX A BASE DE DATOS ## */
            $.ajax({
              type: "post",
              url: `modelo-${tipo}.php`,
              data: {
                id_registro: id_registro,
                registro: "eliminar",
              },
              dataType: "json",
              success: function (response) {
                let resultado = response;
                console.log(resultado);
                
                if (resultado.respuesta == "exitoso") {
                  swalWithBootstrapButtons.fire(
                    "Eliminado!",
                    "El Invitado se elimino de manera correcta",
                    "success"
                  );
                      /* ## SE REMUEVE ELEMENTO TR DEL DOM ## */
                  jQuery('[data-id="' + resultado.id_eliminado + '"]')
                    .parents("tr")
                    .remove();
                }else{
                  Swal.fire({
                    title: 'Hubo un error....!',
                    text: 'No se elimino Invitado, contactar a administrador o intentar de nuevo',
                    icon: 'error'
                  });
                }
              },
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              "Cancelado",
              "No se elimino ningun Administrador",
              "error"
            );
          }
        });
    });
  
  
    /* ######### EDITAR INVITADO  ############ */
  
    $("#actualizar-invitado-archivo").on("submit", function (e) {
      e.preventDefault();
  
      var datos = new FormData(this);

  
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: datos,
        dataType: "json",
        contentType: false,
        cache: false,
        async: true,
        processData: false,
        success: function (data) {
          var resultado = data;
  
          /* ## VER QUE MANDA EL SERVIDOR ## */
          // console.log(resultado);
  
          /* ## INGRESO EXITOSO AL SISTEMA ## */
  
          if (resultado.respuesta == "exitoso") {
            Swal.fire({
              title: "Cambio Exitoso",
              icon: "success",
              text: "Se Actualizaron los datos Correctamente de " + resultado.nombre,
              // showLoaderOnConfirm: true,
              // showCloseButton: true
            });
            setTimeout(() => {
              window.location.href = "lista-invitados.php";
            }, 3000);
          } else {
            /* ## INGRESO EXITOSO AL SISTEMA ERRONEO ## */
            Swal.fire({
              title: "Usuario no disponible",
              icon: "error",
              text: "Hubo un error vuelva a intentar o contacte al administrador del sistema"
            });
          }
        },
        /* ## TERMINA EL SUCCESS ## */
      });
      /* ## TERMINA EL EVENTO AJAX ## */
    });
    /* ## TERMINA LA FUNCION DEL CLICK SUBMIT ## */
  
  
  
  
});
/* ## TERMINA DOCUMENTO ## */