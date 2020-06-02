/* Mi script ajax */
$(document).ready(function () {
  /* ################ CREAR EVENTO ################## */
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
            html: `Se creo de manera correcta el evento: <br> <b>${resultado.nombre_evento} </b>`,
          });
        } else {
          Swal.fire({
            title: "Hubo un error al crear....",
            icon: "error",
            text:
              "Si continua con el problema Favor de contactar al Administrador del sistema",
          });
        }
      },
      /* ## TERMINA EL SUCCESS ## */
    });
    /* ## TERMINA EL EVENTO AJAX ## */
  });
  /* ## TERMINA LA FUNCION DEL CLICK SUBMIT ## */

  /* ################ ELIMINA EVENTO ################## */
  $(".borrar_registro").on("click", function (e) {
    e.preventDefault;
    let id = $(this).attr("data-id");
    let tipo = $(this).attr("data-tipo");
    let nombre_evento = $(this).attr("data-nombre");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "Eliminar Evento",
        html: `¿Estas seguro de eliminar el Evento: <b>${nombre_evento}<b> ?`,
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
                /* ## SE REMUEVE ELEMENTO TR DEL DOM ## */
                jQuery('[data-id="' + resultado.id_eliminado + '"]')
                  .parents("tr")
                  .remove();
                swalWithBootstrapButtons.fire(
                  "Eliminado!",
                  "El Evento se elimino de manera correcta",
                  "success"
                );
              } else {
                Swal.fire({
                  title: "Hubo un error....!",
                  text:
                    "No se elimino el evento, contactar a administrador o intentar de nuevo",
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
            "No se elimino ningun Evento",
            "error"
          );
        }
      });
  });

  /* ######### EDITAR EVENTO ############ */

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
        console.log(datos);

        /* ## INGRESO EXITOSO AL SISTEMA ## */

        if (resultado.respuesta == "exitoso") {
          Swal.fire({
            title: "Cambio Exitoso",
            icon: "success",
            html: `Se Actualizaron los datos Correctamente, <br> nombre: <b>${resultado.nombre}</b> <br> fecha: <b> ${resultado.fecha} </b> <br> hora: <b>${resultado.hora}</b>`,
            // showLoaderOnConfirm: true,
            // showCloseButton: true
          });
          setTimeout(() => {
            window.location.href = "lista-evento.php";
          }, 5000);
        } else {
          /* ## INGRESO EXITOSO AL SISTEMA ERRONEO ## */
          Swal.fire({
            title: "Hubo un error...",
            icon: "error",
            html:
              "Intente de nuevo si persiste el error, contactar al administrador del sistema",
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
