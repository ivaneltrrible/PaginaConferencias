$(document).ready(function () {
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
});
