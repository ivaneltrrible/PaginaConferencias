/* Mi script ajax */
$(document).ready(function () {




  $("#crear-admin").on("submit", function (e) {
    e.preventDefault();

    var datos = $(this).serializeArray();

    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: datos,
      dataType: "json",
      success: function (data) {
        document.querySelector("#crear-admin").reset();
        var resultado = data;
        if (resultado.respuesta == "exito") {
          Swal.fire({
            title: "Usuario Creado",
            icon: "success",
            text: "Se creo el Administrador Correctamente",
          });
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
            title: "El nombre de usuario ya existe",
            icon: "info",
            text:
              "Intente de nuevo con otro usuario, Si continua con el problema Favor de contactar al Administrador del sistema",
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

  $("#login-admin").on("submit", function (e) {
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
        if(resultado.respuesta == 'exitoso'){
            Swal.fire({
                title: "Login Correcto",
                icon: "success",
                text: "Bienvenid@ "+ resultado.nombre_admin
              });
              setTimeout(() => {
                  window.location.href = "area-admin.php";
              }, 3000);
        }else{
        /* ## INGRESO EXITOSO AL SISTEMA ERRONEO ## */
            Swal.fire({
                title: "Login Erroneo",
                icon: "error",
                text: "Usuario o Password incorrectos"
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
