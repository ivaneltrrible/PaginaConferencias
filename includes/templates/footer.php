<!-- =====================================================================
                     fOOTER DE LA PAGINA PRINCIPAL
  =======================================================================-->
<footer class="site-footer">
  <div class="contenido-footer">
    <h4>Sobre <span>GdlWebCamp</span> </h4>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae recusandae quod natus sit eaque autem optio
      tempore non inventore a dolor cumque ipsum iste atque, aut maiores necessitatibus sequi illo est fugit quos
      harum? Eligendi praesentium, doloribus officia id voluptates assumenda ratione, nihil libero, asperiores
      quisquam ab dolores aspernatur consequatur.</p>
  </div>
  <!--Termina contenido-footer-->
  <div class="contenido-footer">
    <h4>ultimos <span>Tweets</span> </h4>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae recusandae quod natus sit eaque autem optio
      tempore non inventore a dolor cumque ipsum iste atque, aut maiores necessitatibus sequi illo est fugit quos
      harum? Eligendi praesentium, doloribus officia id voluptates assumenda ratione, nihil libero, asperiores
      quisquam ab dolores aspernatur consequatur.</p>
  </div>
  <!--Termina contenido-footer-->
  <div class="contenido-footer">
    <h4>Redes <span>sociales</span> </h4>
    <nav class="redes-sociales">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-pinterest-p"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </nav>
  </div>
  <!--Termina contenido-footer-->
</footer>
<div class="contenido-footer2">
  <p class="copyright">Todos los derechos reservados por &copy; lucio</p>
</div>
<!-- =====================================================================
                     Parte de Codigo del HTML5 Boilerplate
  =======================================================================-->
<script src="js/vendor/modernizr-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')
</script>
<script src="js/plugins.js"></script>
<script src="js/vendor/jquery.animateNumber.js"></script>
<script src="js/vendor/jquery.lettering.js"></script>
<?php
$archivo = basename($_SERVER['PHP_SELF'], ".php");
if ($archivo == 'invitados' || $archivo == 'index') {
  echo '<script src="js/vendor/jquery.colorbox.js"></script>';
} elseif ($archivo == 'conferencia') {
  echo '<script src="js/vendor/lightbox.js"></script>';
}
?>


<script src="js/vendor/jquery.countdown.js"></script>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/cotizador.js"></script>
<script src="js/main.js"></script>


<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga = function() {
    ga.q.push(arguments)
  };
  ga.q = [];
  ga.l = +new Date;
  ga('create', 'UA-XXXXX-Y', 'auto');
  ga('set', 'transport', 'beacon');
  ga('send', 'pageview')
</script>
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"df0bf872b2f7d445bc8b5d149","lid":"4898ee43ab","uniqueMethods":true}) })</script>
<!-- <script src="https://www.google-analytics.com/analytics.js" async></script> -->
</body>

</html>