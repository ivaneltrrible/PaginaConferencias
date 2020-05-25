<?php include_once 'includes/templates/header.php'; ?>


<section class="seccion contenedor">
  <h2>La mejor conferencia de Diseño Web en español</h2>
  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ad accusamus ratione earum corrupti incidunt
    mollitia architecto repellendus id nobis iusto libero placeat voluptatem corporis unde sit at, explicabo illo
    voluptatibus dolor, totam tempora dignissimos! Id dicta nostrum, aut quidem, voluptatem totam fuga quisquam quam
    in quasi rem non sit.</p>
</section>

<!-- =====================================================================
                      Conferencias y video
  =======================================================================-->

<section class="programa">
  <div class="contenedor-video">
    <video autoplay loop poster="./img/bg-talleres.jpg">
      <source src="video/video.mp4" type="video/mp4">
      <source src="video/video.webm" type="video/webm">
      <source src="video/video.ogv" type="video/ogv">
    </video>
  </div>
  <!--Termina contenedor-video-->



  <!-- ==================================== -->
  <!-- COMIENZA TODOS LOS TALLERES PAGINA INDEX-->
  <!-- ==================================== -->

  <div class="contenido-programa">
    <div class="contenedor">
      <div class="programa-evento">
        <h2>Programa del Evento</h2>
        <?php
        try {
          require_once 'includes/funciones/db_conexion.php';
          $sql = 'SELECT * FROM `categoria_evento`';
          $resultado = $conn->query($sql);
        } catch (\Exception $e) {
          echo $e->getMessage();
        }
        ?>
        <nav class="menu-programa">
          <?php while ($cat = $resultado->fetch_assoc()) { ?>
            <a href="#<?php echo mb_strtolower($cat['cat_evento']); ?>"><i class="fa <?php echo $cat['icono']; ?>"></i><?php echo $cat['cat_evento'] ?></a>
          <?php } ?>
        </nav>



        <?php // ESTA PARTE ES EL MULTI QUERY PARA REALIZAER LA CONSULTA A TODOS LOS TALLERES //
        try {
          require_once('includes/funciones/db_conexion.php');
          $sql = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";

          $sql .= "FROM eventos ";

          $sql .= "INNER JOIN categoria_evento ";

          $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";

          $sql .= "INNER JOIN invitados ";

          $sql .= "ON eventos.id_invitado_key=invitados.invitado_id ";

          $sql .= "AND eventos.id_cat_evento=1 ";

          $sql .= "ORDER BY evento_id LIMIT 2; ";

          $sql .= "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";

          $sql .= "FROM eventos ";

          $sql .= "INNER JOIN categoria_evento ";

          $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";

          $sql .= "INNER JOIN invitados ";

          $sql .= "ON eventos.id_invitado_key=invitados.invitado_id ";

          $sql .= "AND eventos.id_cat_evento=2 ";

          $sql .= "ORDER BY evento_id LIMIT 2; ";

          $sql .= "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";

          $sql .= "FROM eventos ";

          $sql .= "INNER JOIN categoria_evento ";

          $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";

          $sql .= "INNER JOIN invitados ";

          $sql .= "ON eventos.id_invitado_key=invitados.invitado_id ";

          $sql .= "AND eventos.id_cat_evento=3 ";

          $sql .= "ORDER BY evento_id LIMIT 2; ";
          //no se necesita porque sera multi query $resultado = $conn->query($sql);
        } catch (\Exception $e) {  // ! En caso de error en DB se guarda en el catch y lanza el error
          echo $e->getMessage();
        }
        ?>

        <?php if (!$conn->multi_query($sql)) {
          echo "Falló la multiconsulta: (" . $conn->errno . ") " . $conn->error;
        }
        ?>
        <?php
        do {
          //traes toda la consulta realizada con store_result (puse el parametro 3 para que no falle)
          $resultado = $conn->store_result(3);
          //Conviertes el resultado en un formato de array asociativo para leer los datos mejor
          $row = $resultado->fetch_all(MYSQLI_ASSOC);   ?>
          <?php $i = 0; ?>
          <?php foreach ($row as $evento) : ?>
            <?php if ($i % 2 == 0) { //para que se abra el div 
            ?>
              <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
              <?php } ?>
              <div class="detalle-evento">
                <h3><?php echo $evento['nombre_evento'] ?></h3>
                <p><i class="far fa-clock"></i><?php echo strftime('%H:%M %p', strtotime($evento['hora_evento'])); ?> hrs</p>
                <p><i class="far fa-calendar-alt"></i><?php echo strftime('%A, %d de %B  del %Y', strtotime($evento['fecha_evento'])); ?></p>
                <p><i class="far fa-user"></i><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></p>
              </div>
              <!--Termina Detalle del evento -->
              <?php if ($i % 2 == 1) : //se cierra el div 
              ?>
                <a href="calendario.php" class="boton float-right">Ver Todo</a>
              </div>
            <?php endif; ?>
            <!--Termina nombre del evento -->
            <?php $i++; ?>
          <?php endforeach; ?>
          <?php $resultado->free(); ?>
        <?php } while ($conn->more_results() && $conn->next_result()); ?>



        <!-- ==================================== -->
        <!-- TERMINA TALLERES -->
        <!-- ==================================== -->




        <!-- ==================================== -->
        <!-- TERMINA CONFERENCIAS -->
        <!-- ==================================== -->



        <!-- ==================================== -->
        <!-- TERMINA SEMINARIOS -->
        <!-- ==================================== -->

        <!--Termina info-curso-->
      </div>
      <!--Termina programa evento-->
    </div>
    <!--Termina Contenedor-->
  </div>
  <!--Termina contenido-programa-->
</section>
<!-- =====================================================================
                      Seccion de invitados
  =======================================================================-->
<?php require_once 'includes/templates/invitados.php'; ?>
<!-- =====================================================================
                      Imagen de fondo Contador de tiempo
  =======================================================================-->
<section class="hero-cantidad parallax">

  <div class="contenido-tiempo">

    <div>
      <p class="numero"></p>
      <p class="texto-tiempo">Invitados</p>
    </div>
    <div>
      <p class="numero"></p>
      <p class="texto-tiempo">talleres</p>
    </div>
    <div>
      <p class="numero"></p>
      <p class="texto-tiempo">dias</p>
    </div>
    <div>
      <p class="numero"></p>
      <p class="texto-tiempo">conferencias</p>
    </div>

  </div>
  <!--Termina Contenido.tiempo-->

</section>
<!-- =====================================================================
                      Tablas de Precios
  =======================================================================-->

<section class="seccion precios">
  <h2>Precios</h2>
  <div class="contenedor contenido-precios">
    <div class="oferta">
      <p class="promo-oferta">Pase por Dia</p>
      <p class="precio-oferta">$30</p>
      <p><i class="fas fa-check"></i>Bocadilllos Gratis</p>
      <p><i class="fas fa-check"></i>Todas las conferencias</p>
      <p><i class="fas fa-check"></i>Todos los talleres</p>
      <a href="#" class="boton-secundario">Comprar</a>
    </div>
    <div class="oferta">
      <p class="promo-oferta">Todos los dias</p>
      <p class="precio-oferta">$50</p>
      <p><i class="fas fa-check"></i>Bocadilllos Gratis</p>
      <p><i class="fas fa-check"></i>Todas las conferencias</p>
      <p><i class="fas fa-check"></i>Todos los talleres</p>
      <a href="#" class="boton-tercero">Comprar</a>
    </div>
    <div class="oferta">
      <p class="promo-oferta">pase por 2 dias</p>
      <p class="precio-oferta">$45</p>
      <p><i class="fas fa-check"></i>Bocadilllos Gratis</p>
      <p><i class="fas fa-check"></i>Todas las conferencias</p>
      <p><i class="fas fa-check"></i>Todos los talleres</p>
      <a href="#" class="boton-secundario">Comprar</a>
    </div>
  </div>
  <!--Termina contenido-precios-->
</section>
<!-- =====================================================================
                      Mapa Google Maps api
  =======================================================================-->
<div class="map" id="map"></div>
<!-- =====================================================================
                      Testimoniales
  =======================================================================-->
<section class="testimoniales">
  <h2>Testimoniales</h2>
  <div class="contenedor">
    <div class="contenido-testimoniales">
      <div class="testimonial">
        <p class="comillas">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia sequi sit corrupti
          tempore debitis nulla
          quo doloremque modi expedita obcaecati velit cum porro, nobis distincti.</p>
        <div class="icono-imagen">
          <img src="img/testimonial.jpg" alt="Imagen de diseñador">
          <div class="datos-testimoniales">
            <p>Oswaldo Aponte Escobedo</p>
            <p><cite> Diseñador en </cite>@Prisma</p>
          </div>
        </div>
        <!--Icono-imagen-->
      </div>
      <!--Testimonial-->
      <div class="testimonial">
        <p class="comillas">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia sequi sit corrupti
          tempore debitis nulla
          quo doloremque modi expedita obcaecati velit cum porro, nobis distinctio.</p>
        <div class="icono-imagen">
          <img src="img/testimonial.jpg" alt="Imagen de diseñador">
          <div class="datos-testimoniales">
            <p>Oswaldo Aponte Escobedo</p>
            <p><cite>Diseñador en</cite> @Prisma</p>
          </div>
        </div>
        <!--Icono-imagen-->
      </div>
      <!--Testimonial-->

      <div class="testimonial">
        <p class="comillas">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia sequi sit corrupti
          tempore debitis nulla
          quo doloremque modi expedita obcaecati velit cum porro, nobis distinctioa.</p>
        <div class="icono-imagen">
          <img src="img/testimonial.jpg" alt="Imagen de diseñador">
          <div class="datos-testimoniales">
            <p>Oswaldo Aponte Escobedo</p>
            <p><cite> Diseñador en </cite>@Prisma </p>
          </div>
        </div>
        <!--Icono-imagen-->
      </div>
      <!--Testimonial-->

    </div>
    <!--Contenido-Testimoniales-->
  </div>
  <!--Contenedor-->
</section>
<!-- =====================================================================
                      Registro al newsletter
  =======================================================================-->
<section class="hero-newsletter newsletter">
  <div class="contenido-newsletter">
    <p>Registrate al newsletter</p>
    <h3 class="nombre-sitio">GdlWebCamp</h3>
    <a href="#">Registro</a>
  </div>
</section>

<!-- =====================================================================
                     Contador del Footer sin fondo
  =======================================================================-->
<section class="contador-footer contenedor">
  <h2>Faltan</h2>


  <div class="contenido-contador2">

    <div class="datos-contador">
      <p id="dias" class="numero"></p>
      <p class="texto-contador">Dias</p>
    </div>
    <div class="datos-contador">
      <p id="horas" class="numero"></p>
      <p class="texto-contador">Horas</p>
    </div>
    <div class="datos-contador">
      <p id="minutos" class="numero"></p>
      <p class="texto-contador">minutos</p>
    </div>
    <div class="datos-contador">
      <p id="segundos" class="numero"></p>
      <p class="texto-contador">segundos</p>
    </div>

  </div>
  <!--Termina Contenido.tiempo-->


</section>
<?php include_once 'includes/templates/footer.php'; ?>