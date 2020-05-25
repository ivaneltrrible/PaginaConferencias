$(document).ready(function () {
    /* ################ LOGUEO ADMIN ################## */
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
        if (resultado.respuesta == "exitoso") {
          Swal.fire({
            title: "Login Correcto",
            icon: "success",
            text: "Bienvenid@ " + resultado.nombre_admin,
          });
          setTimeout(() => {
            window.location.href = "area-admin.php";
          }, 3000);
        } else {
          /* ## INGRESO EXITOSO AL SISTEMA ERRONEO ## */
          Swal.fire({
            title: "Login Erroneo",
            icon: "error",
            text: "Usuario o Password incorrectos",
          });
        }
      },
      /* ## TERMINA EL SUCCESS ## */
    });
    /* ## TERMINA EL EVENTO AJAX ## */
  });
  /* ## TERMINA LA FUNCION DEL CLICK SUBMIT ## */
});