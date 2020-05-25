
<!--=====================================================================
                           CALENDARIO         
  =======================================================================-->
  <section class="seccion contenedor">
    <h2>INVITADOS</h2>

    <?php
    try {
        require_once('includes/funciones/db_conexion.php');
        $sql = 'SELECT * FROM `invitados`';
        $resultado = $conn->query($sql);
    } catch (\Exception $e) {  // ! En caso de error en DB se guarda en el catch y lanza el error
        echo $e->getMessage();
    }
    ?>
    
    <section class="contenedor seccion invitados">

        <div class="grid">
            <?php while ($invitados = $resultado->fetch_assoc()) { ?>
                <div class="invitado">
                    <a class="invitados-info" href="#invitado<?php echo $invitados['invitado_id']; ?>">
                        <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="Foto de Invitado">

                        <p class="nombre-invitado"><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ?></p>
                    </a>
                </div>
                <div style="display:none;">
                    <div class="invitados-info" id="invitado<?php echo $invitados['invitado_id'] ?>">
                        <h2><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ?></h2>
                        <img src="img/<?php echo $invitados['url_imagen'] ?>" alt="Foto de Invitado">
                        <p><?php echo $invitados['descripcion'] ?></p>
                    </div>

                </div>

            <?php } ?>

        </div>
        <?php $conn->close() ?>
    </section>



</section>