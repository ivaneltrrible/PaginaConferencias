<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>GdlWebCamp</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta http-equiv="Content-type" content="text/html; charset=utf-8" /> -->

  <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <!-- Fontawesome -->

  <link href="https://fonts.googleapis.com/css?family=Krub:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
  <?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    if ($pagina == 'invitados' || $pagina == 'index') {
      echo ' <link rel="stylesheet" href="css/colorbox.css">';
    }elseif($pagina == 'conferencia'){
      echo '<link rel="stylesheet" href="css/lightbox.css">';
    }
  ?>
  
 
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">

  <meta name="theme-color" content="#fafafa">
</head>

<!-- Se agrega la clase del nombre del archivo para saber en que pagina se encuentra -->
<body class="<?php echo $pagina ?>">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- =====================================================================
                      Inicio de Pagina
  =======================================================================-->
  <!-- =====================================================================
                      Header
  =======================================================================-->

  <header class="site-header">
    <div class="hero">
      <div class="contenido-header">
        <nav class="redes-sociales">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-pinterest-p"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </nav>
        <div class="contenedor-informacion">
          <div class="informacion-evento">
            <p class="fecha"><i class="far fa-calendar-alt"></i>10-12- Dic</p>
            <p class="ciudad"><i class="fas fa-map-marker-alt"></i>Guadalajara, Jalisco</p>
          </div>
          <div class="informacion-sitio">
            <h1 class="nombre-sitio">GdlWebCamp</h1>
            <p class="slogan">La mejor conferencia de <span>Diseño WEB</span></p>
          </div>
        </div>
        <!-- Termina contenedor-informacion -->
      </div>
      <!--Termina contenido header-->
    </div>
    <!--Finaliza Hero-->
  </header>
  <!-- =====================================================================
                      Barra de Navegacion Principal
  =======================================================================-->
  <div class="barra">
    <div class="contenedor-barra">
      <div class="logo-movil">
        <div class="logo">
          <a href="index.php">
            <img src="img/logo.svg" alt="Imagen de Logo no se ve">
          </a>
        </div>
        <div class="menu-movil">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <nav class="navegacion-principal">
        <a href="conferencia.php">Conferencia</a>
        <a href="calendario.php">Calendario</a>
        <a href="invitados.php">Invitados</a>
        <a href="reservaciones.php">Reservaciones</a>
      </nav>
    </div>
    <!--Termina Contenedor-->
  </div>
  <!--Termina Barra-->