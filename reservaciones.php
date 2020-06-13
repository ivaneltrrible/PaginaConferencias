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
                <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre">
            </div>
            <div class="campo">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" id="apellido" placeholder="Tu Apellido">
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Tu Email">
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
                <?php
                try {
                    include_once 'includes/funciones/db_conexion.php';
                    $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
                    $sql .= " FROM eventos ";
                    $sql .= " INNER JOIN categoria_evento ";
                    $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                    $sql .= " INNER JOIN invitados ";
                    $sql .= " ON eventos.id_invitado_key = invitados.invitado_id ";
                    $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento ";
                    // echo $sql;
                    $resultado = $conn->query($sql);
                } catch (\Exception $e) {
                    echo 'Error!' . $e->getMessage();
                }
                //SE CREA ARREGLO PARA QUE GUARDE CADA DIA QUE HAGA UNA ITERACION
                $eventos_semana = array();

                while ($evento = $resultado->fetch_assoc()) {
                    //Se formatea fecha para que se extraiga la info de dia de la semana en palabra (VIERNES etc)
                    $fecha = $evento['fecha_evento'];
                    $dia_semana = strftime("%A", strtotime($fecha));

                    //Variable de categoria del evento
                    $categoria = $evento['cat_evento'];

                    //Se crea arreglo con los datos extraidos de la BD 
                    $dia = array(
                        'nombre' => $evento['nombre_evento'],
                        'hora' => $evento['hora_evento'],
                        'id' => $evento['evento_id'],
                        'nombre_invitado' => $evento['nombre_invitado'],
                        'apellido_invitado' => $evento['apellido_invitado']
                    );

                    //en cada iteracion se agrega elemento al arreglo fuera del while($eventos_semana) que se hace multidimensional
                    $eventos_semana[$dia_semana]['eventos'][$categoria][] = $dia;
                }
                // echo '<pre>';
                // var_dump($eventos_semana);
                // echo '</pre>';
                ?>
                <?php foreach ($eventos_semana as $dia => $eventos) {  ?>

                    <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix">
                        <h4><?php echo $dia; ?></h4>

                        <?php foreach ($eventos['eventos'] as $tipo => $evento_dia) : ?>
                            <div>
                                <p><?php echo $tipo ?>:</p>

                                <?php foreach ($evento_dia as $evento) { ?>
                                   
                                    <label>
                                        <input type="checkbox" name="registro[]" id="<?php echo $evento['id'] ;?>" value="<?php echo $evento['id'] ;?>">
                                        <time><?php echo $evento['hora'] ;?></time> <?php echo $evento['nombre'] ;?>
                                        <br>
                                        <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['nombre_invitado'] ?></span>
                                    </label>

                                <?php  } ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
                <?php } ?>
                <!--#viernes-->

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