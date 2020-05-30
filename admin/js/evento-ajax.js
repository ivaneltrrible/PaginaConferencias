/* Mi script ajax */
$(document).ready(function () {
  /* ################ CREAR ADMIN ################## */
  $("#crear-evento").on("submit", function (e) {
    e.preventDefault();
    let categoria_evento = $("#categoria_evento").val();
    let invitado_evento = $("#invitado_evento").val();
    if (categoria_evento == 0 || invitado_evento == 0) {
      Swal.fire({
        title: "Faltan datos..",
        icon: "warning",
        text: "Selecciona un evento y una categoria",
      });
      return false;
    }

    var datos = $(this).serializeArray();

    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: datos,
      dataType: "json",
      success: function (data) {
        document.querySelector("#crear-evento").reset();
        var resultado = data;
        console.log(resultado);

        if (resultado.respuesta == "exito") {
          Swal.fire({
            title: "Evento Creado",
            icon: "success",
            html: `Se creo de manera correcta el evento: <br> <b>${resultado.nombre_evento} </b>`
          });
         
        } else {
          Swal.fire({
            title: "Hubo un error al crear....",
            icon: "error",
            text:
              "Si continua con el problema Favor de contactar al Administrador del sistema",
          });
        }

        
      }
      /* ## TERMINA EL SUCCESS ## */
    });
    /* ## TERMINA EL EVENTO AJAX ## */
  });
  /* ## TERMINA LA FUNCION DEL CLICK SUBMIT ## */

  /* ################ ELIMINA ADMIN ################## */
  $(".borrar_registro").on("click", function (e) {
    e.preventDefault;
    let id = $(this).attr("data-id");
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
        title: "Eliminar Administrador",
        text: "¿Estas seguro de eliminar este administrador?",
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
              id: id,
              registro: "eliminar",
            },
            dataType: "json",
            success: function (response) {
              let resultado = response;
              if (resultado.respuesta == "exitoso") {
                swalWithBootstrapButtons.fire(
                  "Eliminado!",
                  "El administrador se elimino de manera correcta",
                  "success"
                );
                /* ## SE REMUEVE ELEMENTO TR DEL DOM ## */
                jQuery('[data-id="' + resultado.id_eliminado + '"]')
                  .parents("tr")
                  .remove();
              } else {
                Swal.fire({
                  title: "Hubo un error....!",
                  text:
                    "No se elimino usuario, contactar a administrador o intentar de nuevo",
                  icon: "error",
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

  /* ######### EDITAR ADMIN ############ */

  $("#editar-evento").on("submit", function (e) {
    e.preventDefault();

    var datos = $(this).serializeArray();

    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: datos,
      dataType: "json",
      success: function (data) {
        var resultado = data;

        /* ## VER QUE MANDA EL SERVIDOR ## */
        // console.log(resultado);

        /* ## INGRESO EXITOSO AL SISTEMA ## */

        if (resultado.respuesta == "exitoso") {
          Swal.fire({
            title: "Cambio Exitoso",
            icon: "success",
            text: "Se Actualizaron los datos Correctamente " + resultado.nombre,
            // showLoaderOnConfirm: true,
            // showCloseButton: true
          });
          setTimeout(() => {
            window.location.href = "lista-admins.php";
          }, 3000);
        } else {
          /* ## INGRESO EXITOSO AL SISTEMA ERRONEO ## */
          Swal.fire({
            title: "Usuario no disponible",
            icon: "error",
            html: `El usuario :  <b>${resultado.usuario}</b>  no esta disponible intente con otro, si persiste el problema contactar al administrador `,
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
