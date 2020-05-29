$(document).ready(function () {

  /* ##DATA TABLES CONFIGURACIONES ##  */
  $(".sidebar-menu").tree();
  $("#registros").DataTable({
    language: {
      lengthMenu: "Muestra _MENU_ Registros",
      paginate: {
        next: "Siguiente",
        previous: "Anterior",
        last: "Ultimo",
        first: "Primero",
      },
      info: "Mostrando _START_ de _END_ de un total _TOTAL_ Registros",
      search: "Buscar Registro:   ",
      processing: "Procesando...",
      loadingRecords: "Cargando...",
      infoEmpty: "0 Registros ",
      infoFiltered: "(Filtrado de _MAX_ Registros Totales)",
      emptyTable: "No hay registros en la tabla",
      zeroRecords: "No se encontro ningun registro",
    },
    lengthMenu: [
      [5, 10, 15, 20, 25, -1],
      [5, 10, 15, 20, 25, "All"],
    ],

    // pagingType: "full_numbers",
  });

  /* ### SE DESAHABILITA BOTON DE EDITAR ADMIN HASTA QUE SE VALIDA QUE SEAN IGUALES LOS PASSWORDS #### */
  $("input#exampleInputPassword1").on("change", function(){
    if ($(this).val() != "") {
      $("#boton_habilitar").attr("disabled", true);
    }else{
      $("#boton_habilitar").attr("disabled", false);
    }
  });
 


  /* ##### VALIDAR QUE LOS DOS PASSWORD SEAN IGUALES #### */
  $("#repetir-password").on("input", function () {
    let password_original = $("#exampleInputPassword1").val();
    if ($(this).val() == password_original) {
      
        /*### SE AGREGAN CLASE EN EL DIV DEL PASSWORD PARA USUARIO COINCIDE PASS ##  */
      $("#resultado_password").text("Correcto");
      $("#resultado_password").parents(".form-group").addClass("has-success").removeClass("has-error");
      $("input#exampleInputPassword1")
        .parents(".form-group")
        .addClass("has-success").removeClass("has-error");

        /* si es correcto se habilita boton submit */
        $("#boton_habilitar").attr("disabled", false);
      
    } else {
        /* ### SE AGREGAN CLASE EN EL DIV DEL PASSWORD PARA USUARIO NO COINCIDE PASS ## */
      $("#resultado_password").text("No coinciden los passwords!");
      $("#resultado_password").parents(".form-group").addClass("has-error").removeClass("has-success");
      $("input#exampleInputPassword1")
        .parents(".form-group")
        .addClass("has-error").removeClass("has-success");
    }
  });


  /* ####################### PAGINA DE CREAR EVENTO // CATEGORIAS EVENTOS ####### */

  /* ## DATE PICKER FECHA DEL EVENTO ## */
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

   /* ## TIME PICKER HORA DEL EVENTO EN EVENTOS ## */
   //Timepicker para obtener la hora actual
    let hora = new Date().getHours();
    let min = new Date().getMinutes();
   $('.timepicker').timepicker({
    showInputs: false,
    defaultTime: hora + ":" + min,
  }) 


  /* ######### PLUGIN DE SELECT2 PARA CATEGORIAS EVENTOS ##### */
   //Initialize Select2 Elements
   //Select de Invitado Evento y Cateforia Evento
   $('#categoria_evento, #invitado_evento').select2()

  
   
   

});
/* ##### TERMINA EL DOCUMENT READY ###### */
