

$(function () {
  //======================================================================
  // Plugin Modificador Texto Lettering H1
  //======================================================================
  $(".nombre-sitio").lettering();

  //======================================================================
  //? == Resaltar en que archivo se encuentra el usuario ACTIVO en el menu
  //======================================================================
  $(
    'body.conferencia .navegacion-principal a:contains("Conferencia")'
  ).addClass("activoPagina");
  $('body.calendario .navegacion-principal a:contains("Calendario")').addClass(
    "activoPagina"
  );
  $('body.invitados .navegacion-principal a:contains("Invitados")').addClass(
    "activoPagina"
  );
  $(
    'body.reservaciones .navegacion-principal a:contains("Reservaciones")'
  ).addClass("activoPagina");

  //======================================================================
  // MENU FIJO (ESTATICO)
  //======================================================================
  //Importante linea
  let windowHeight = $(window).height();
  let alturaBarra = $(".barra").innerHeight();
  console.log(alturaBarra);
  // console.log(windowHeight);
  $(window).scroll(function () {
    let scroll = $(window).scrollTop();
    // console.log(scroll);

    if (scroll > windowHeight) {
      $(".barra").addClass("fixed");
      $("body").css({
        "margin-top": alturaBarra + "px",
      });

      // console.log('ya pasaste la altura')
    } else {
      $(".barra").removeClass("fixed");
      // console.log('todavia no pasas altura')
      $("body").css({
        "margin-top": "0px",
      });
    }
  });
  //?======================================================================
  //? Menu Responsive (HAMBUERGUESA)
  //?================================================
  $(".menu-movil").on("click", function () {
    $("nav.navegacion-principal").slideToggle();
  });

  //PROGRAMAS DE EVENTOS FUNCIONES Y CODIGO  (conferencias, talleres etc)
  $("div.ocultar").hide();
  $("div#seminario").show();
  $(".menu-programa a:first").addClass("activo");

  $(".menu-programa a").click(function () {
    $(".menu-programa a").removeClass("activo");
    $(this).addClass("activo");
    $("div.ocultar").hide();
    let enlaceSeleccionado = $(this).attr("href");
    $(enlaceSeleccionado).fadeIn(1000);

    //    $('.menu-programa nav a').removeClass('activo');
    return false;
  });

  //?======================================================================
  //? CONTADOR DE NUMEROS PLUGIN JQUERY ANIMATE NUMBER
  //?======================================================================

  $(".contenido-tiempo").mouseenter(function () {
    $(".contenido-tiempo div:nth-child(1) p:first").animateNumber(
      {
        number: 6,
      },
      1200
    );
    $(".contenido-tiempo div:nth-child(2) p:first").animateNumber(
      {
        number: 15,
      },
      1200
    );
    $(".contenido-tiempo div:nth-child(3) p:first").animateNumber(
      {
        number: 3,
      },
      2000
    );
    $(".contenido-tiempo div:nth-child(4) p:first").animateNumber(
      {
        number: 9,
      },
      1500
    );
  });
  //?======================================================================
  // ?COUNTDOWN CONTADOR QUE VA DISMINUYENDO // CONTADOR DE FOOTER SIN FONDO(HTML)
  //?======================================================================

  $(".contenido-contador2").countdown("2020/01/13 09:00:00", function (event) {
    $("#dias").html(event.strftime("%D"));
    $("#horas").html(event.strftime("%H"));
    $("#minutos").html(event.strftime("%M"));
    $("#segundos").html(event.strftime("%S"));
  });
  //?======================================================================
  // ? CODIGO DE PLUGIN COLORBOX
  //?======================================================================

  $(".invitados-info").colorbox({ inline: true, width: "50%" });

  //TODO:   Codigo de la API Leaflet MAPS ===========================================
  // Se puso el codigo del mapa aqui porque ocacionaba errores al no encontrar el Contenedor MAP
  let mapa = $("#map");
  if (mapa) {
    var map = L.map("map").setView([20.675559, -103.365983], 20);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    L.marker([20.675559, -103.365983])
      .addTo(map)
      .bindPopup("Tu estas aqui.<br> Lucioboss.")
      .openPopup()
      .bindTooltip("Visitanos")
      .openTooltip();
  }
});


  //?======================================================================
  // ? CODIGO DE PLUGIN SWEETALERT
  //?======================================================================
  correcto = document.querySelector(".correcto");
  if (correcto) {
    console.log("funciona");
    Swal.fire({
      icon: "success",
      title: "Pagado",
      text: "El Pago si hizo de manera exitosa",
    });
  }