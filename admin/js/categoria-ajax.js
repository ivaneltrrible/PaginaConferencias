/* Mi script ajax */
$(document).ready(function () {
    /* ################ CREAR ADMIN ################## */
    $("#crear-categoria").on("submit", function (e) {
      e.preventDefault();
  
      var datos = $(this).serializeArray();
  
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: datos,
        dataType: "json",
        success: function (data) {
          $("#crear-categoria").trigger("reset");
          var resultado = data;
          console.log(resultado);
          
          if (resultado.respuesta == "exito") {
            Swal.fire({
              title: "Categoria Creada",
              icon: "success",
              html: `Se creo la categoria <b>${resultado.nombre}</b> correctamente`,
            });
            setTimeout(() => {
                window.location.href = 'lista-categorias.php';
            }, 3000);
          } else if (resultado.respuesta == "Error") {
            Swal.fire({
              title: "Hubo un error al crear....",
              icon: "error",
              text:
                "Si continua con el problema Favor de contactar al Administrador del sistema",
            });
          } else if (resultado.respuesta == "error") {
            /* ############### SI EXISTE EL USUARIO QUE ESTA INGRESANDO ########### */
            //   let nombreUsuario = resultado.usuario; OPCION A INGRESAR USUARIO
            Swal.fire({
              title: "hubo un error",
              icon: "info",
              html:
                `El nombre  <b> ${resultado.nombre}</b> ya existe en la base de datos`,
              imageUrl: "./img/usuarioTriste.png",
              imageWidth: 300,
              imageHeight: 150,
              imageAlt: "Custom image",
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
      // e.preventDefault();
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
          title: "Eliminar Categoria",
          text: "¿Estas seguro de eliminar esta Categoria?",
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
                console.log(resultado);
                
                if (resultado.respuesta == "exitoso") {
                  swalWithBootstrapButtons.fire(
                    "Eliminado!",
                    "La categoria se elimino de manera correcta",
                    "success"
                  );
                      /* ## SE REMUEVE ELEMENTO TR DEL DOM ## */
                  $('[data-id="' + resultado.id_eliminado + '"]')
                    .parents("tr")
                    .remove();
                }else{
                  Swal.fire({
                    title: 'Hubo un error....!',
                    text: 'No se elimino, contactar a administrador o intentar de nuevo',
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
  
  
    /* ######### EDITAR Categoria ############ */
  
    $("#editar-categoria").on("submit", function (e) {
      e.preventDefault();
  
      var datos = $(this).serializeArray();
  
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: datos,
        dataType: "json",
        success: function (data) {
          var resultado = data;
          console.log(resultado);
          
  
          /* ## VER QUE MANDA EL SERVIDOR ## */
          // console.log(resultado);
  
          /* ## INGRESO EXITOSO AL SISTEMA ## */
  
          if (resultado.respuesta == "exitoso") {
            Swal.fire({
              title: "Se actualizaron los datos",
              icon: "success",
              html: `Nombre Categoria: <b> ${resultado.nombre} </b> <br> Icono: <b>${resultado.icono}</b> `,
              // showLoaderOnConfirm: true,
              // showCloseButton: true
            });
            setTimeout(() => {
              window.location.href = "lista-categorias.php";
            }, 3000);
          } else {
            /* ## INGRESO EXITOSO AL SISTEMA ERRONEO ## */
            Swal.fire({
              title: "Hubo un error...",
              icon: "error",
              html: `No se actualizaron los datos, intentar de nuevo o contactar al administrador `,
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
  