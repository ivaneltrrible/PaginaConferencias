<?php include_once 'includes/templates/header.php'; ?>
<!-- =====================================================================
                     SECCION DE REGISTRO
  =======================================================================-->
<section class="seccion contenedor">
    <h2>Registro</h2>
    <form class="registro" id="registro" action="pagar.php" method="post">
        <div id="datos_usuarios" class="caja registro clearfix">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" >
            </div>
            <div class="campo">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" id="apellido" placeholder="Tu Apellido" >
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Tu Email" >
            </div>
            <div id="error"></div>
        </div>


        <div id="paquetes" class="paquetes">
            <h3>Elige el Numero de Boletos</h3>
            <div class="contenedor contenido-precios">
                <div class="oferta clearfix">
                    <p class="promo-oferta">Pase por Dia (Viernes)</p>
                    <p class="precio-oferta">$30</p>
                    <p><i class="fas fa-check"></i>Bocadilllos Gratis</p>
                    <p><i class="fas fa-check"></i>Todas las conferencias</p>
                    <p><i class="fas fa-check"></i>Todos los talleres</p>
                    <div class="order">
                        <label for="paseDia">Boletos Deseados</label>
                        <input type="number" name="boletos[un_dia][cantidad]" id="paseDia" placeholder="0" min="0" size="3">
                        <input type="hidden" name="boletos[un_dia][precio]" value="30">
                    </div>

                </div>
                <div class="oferta">
                    <p class="promo-oferta">Todos los dias</p>
                    <p class="precio-oferta">$50</p>
                    <p><i class="fas fa-check"></i>Bocadilllos Gratis</p>
                    <p><i class="fas fa-check"></i>Todas las conferencias</p>
                    <p><i class="fas fa-check"></i>Todos los talleres</p>
                    <div class="order">
                        <label for="paseDiario">Boletos Deseados</label>
                        <input type="number" name="boletos[completo][cantidad]" id="paseDiario" placeholder="0" min="0" size="3">
                        <input type="hidden" name="boletos[completo][precio]" value="50">
                    </div>
                </div>
                <div class="oferta">
                    <p class="promo-oferta">pase 2 dias (Viernes y Sabado)</p>
                    <p class="precio-oferta">$45</p>
                    <p><i class="fas fa-check"></i>Bocadilllos Gratis</p>
                    <p><i class="fas fa-check"></i>Todas las conferencias</p>
                    <p><i class="fas fa-check"></i>Todos los talleres</p>
                    <div class="order">
                        <label for="paseDosDias">Boletos Deseados</label>
                        <input type="number" name="boletos[2dias][cantidad]" id="paseDosDias" placeholder="0" min="0" size="3">
                        <input type="hidden" name="boletos[2dias][precio]" value="45">
                    </div>
                </div>
            </div>
        </div>

        <div id="eventos" class="eventos clearfix">
            <h3>Elige tus talleres</h3>
            <div class="caja">
                <div id="viernes" class="contenido-dia clearfix">
                    <h4>Viernes</h4>
                    <div>
                        <p>Talleres:</p>
                        <label><input type="checkbox" name="registro[]" id="taller_01" value="taller_01"><time>10:00</time> Responsive Web Design</label>
                        <label><input type="checkbox" name="registro[]" id="taller_02" value="taller_02"><time>12:00</time> Flexbox</label>
                        <label><input type="checkbox" name="registro[]" id="taller_03" value="taller_03"><time>14:00</time> HTML5 y CSS3</label>
                        <label><input type="checkbox" name="registro[]" id="taller_04" value="taller_04"><time>17:00</time> Drupal</label>
                        <label><input type="checkbox" name="registro[]" id="taller_05" value="taller_05"><time>19:00</time> WordPress</label>
                    </div>
                    <div>
                        <p>Conferencias:</p>
                        <label><input type="checkbox" name="registro[]" id="conf_01" value="conf_01"><time>10:00</time> Como ser Freelancer</label>
                        <label><input type="checkbox" name="registro[]" id="conf_02" value="conf_02"><time>17:00</time> Tecnologías del Futuro</label>
                        <label><input type="checkbox" name="registro[]" id="conf_03" value="conf_03"><time>19:00</time> Seguridad en la Web</label>
                    </div>
                    <div>
                        <p>Seminarios:</p>
                        <label><input type="checkbox" name="registro[]" id="sem_01" value="sem_01"><time>10:00</time> Diseño UI y UX para móviles</label>
                    </div>
                </div>
                <!--#viernes-->
                <div id="sabado" class="contenido-dia clearfix">
                    <h4>Sábado</h4>
                    <div>
                        <p>Talleres:</p>
                        <label><input type="checkbox" name="registro[]" id="taller_06" value="taller_06"><time>10:00</time> AngularJS</label>
                        <label><input type="checkbox" name="registro[]" id="taller_07" value="taller_07"><time>12:00</time> PHP y MySQL</label>
                        <label><input type="checkbox" name="registro[]" id="taller_08" value="taller_08"><time>14:00</time> JavaScript Avanzado</label>
                        <label><input type="checkbox" name="registro[]" id="taller_09" value="taller_09"><time>17:00</time> SEO en Google</label>
                        <label><input type="checkbox" name="registro[]" id="taller_10" value="taller_10"><time>19:00</time> De Photoshop a HTML5 y CSS3</label>
                        <label><input type="checkbox" name="registro[]" id="taller_11" value="taller_11"><time>21:00</time> PHP Medio y Avanzado</label>
                    </div>
                    <div>
                        <p>Conferencias:</p>
                        <label><input type="checkbox" name="registro[]" id="conf_04" value="conf_04"><time>10:00</time> Como crear una tienda online que venda millones
                            en pocos días</label>
                        <label><input type="checkbox" name="registro[]" id="conf_05" value="conf_05"><time>17:00</time> Los mejores lugares para encontrar
                            trabajo</label>
                        <label><input type="checkbox" name="registro[]" id="conf_06" value="conf_06"><time>19:00</time> Pasos para crear un negocio rentable</label>
                    </div>
                    <div>
                        <p>Seminarios:</p>
                        <label><input type="checkbox" name="registro[]" id="sem_02" value="sem_02"><time>10:00</time> Aprende a Programar en una mañana</label>
                        <label><input type="checkbox" name="registro[]" id="sem_03" value="sem_03"><time>17:00</time> Diseño UI y UX para móviles</label>
                    </div>
                </div>
                <!--#sabado-->
                <div id="domingo" class="contenido-dia clearfix">
                    <h4>Domingo</h4>
                    <div>
                        <p>Talleres:</p>
                        <label><input type="checkbox" name="registro[]" id="taller_12" value="taller_12"><time>10:00</time> Laravel</label>
                        <label><input type="checkbox" name="registro[]" id="taller_13" value="taller_13"><time>12:00</time> Crea tu propia API</label>
                        <label><input type="checkbox" name="registro[]" id="taller_14" value="taller_14"><time>14:00</time> JavaScript y jQuery</label>
                        <label><input type="checkbox" name="registro[]" id="taller_15" value="taller_15"><time>17:00</time> Creando Plantillas para WordPress</label>
                        <label><input type="checkbox" name="registro[]" id="taller_16" value="taller_16"><time>19:00</time> Tiendas Virtuales en Magento</label>
                    </div>
                    <div>
                        <p>Conferencias:</p>
                        <label><input type="checkbox" name="registro[]" id="conf_07" value="conf_07"><time>10:00</time> Como hacer Marketing en línea</label>
                        <label><input type="checkbox" name="registro[]" id="conf_08" value="conf_08"><time>17:00</time> ¿Con que lenguaje debo empezar?</label>
                        <label><input type="checkbox" name="registro[]" id="conf_09" value="conf_09"><time>19:00</time> Frameworks y librerias Open Source</label>
                    </div>
                    <div>
                        <p>Seminarios:</p>
                        <label><input type="checkbox" name="registro[]" id="sem_04" value="sem_04"><time>14:00</time> Creando una App en Android en una tarde</label>
                        <label><input type="checkbox" name="registro[]" id="sem_05" value="sem_05"><time>17:00</time> Creando una App en iOS en una tarde</label>
                    </div>
                </div>
                <!--#domingo-->
            </div>
            <!--.caja-->
        </div>
        <!--#eventos-->

        <div id="resumen" class="resumen">
            <h3>Pagos y Extras</h3>
            <div class="caja clearfix">
                <div class="extras">
                    <div class="orden">
                        <label for="camisa_evento">Camisa del Evento $10 <small>(promocion 7% dto.)</small></label>
                        <input type="number" name="pedido_extra[camisas][cantidad]" id="camisa_evento" min="0" placeholder="0" max="3">
                        <input type="hidden" name="pedido_extra[camisas][precio]" value="10">
                    </div>
                    <div class="orden">
                        <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript,
                                Chrome)</small></label>
                        <input type="number" name="pedido_extra[etiquetas][cantidad]" id="etiquetas" min="0" placeholder="0" max="3">
                        <input type="hidden" name="pedido_extra[etiquetas][precio]" value="2">
                    </div>
                    <div class="orden">
                        <label for="regalo">Seleccione un regalo</label>
                        <select name="regalo" id="regalo" required>
                            <option value="">-- Seleccione un regalo --</option>
                            <option value="2">Etiquetas</option>
                            <option value="1">Pulseras</option>
                            <option value="3">Plumas</option>
                        </select>
                    </div>
                    <input type="button" class="boton" id="calcular" value="Calcular">
                </div>
                <!--Termina Extras-->
                <div class="total">
                    <p>Resumen:</p>
                    <div id="lista-productos">

                    </div>
                    <p>Total:</p>
                    <div id="suma-total">

                    </div>
                    <!-- Campo Oculto para Cantidad Total -->
                    <input type="hidden" name="total_pedido" id="total_pedido">
                    <input type="submit" class="boton" value="Pagar" name="submit" id="btnRegistro">
                </div>
                <!--Total-->

            </div>
            <!--Termina Caja -->
        </div>
        <!--Termina resumen-->



    </form>

</section>
<?php include_once 'includes/templates/footer.php'; ?>