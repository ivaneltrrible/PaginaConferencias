<?php if (isset($_POST['submit'])) :
    date_default_timezone_set('America/Mexico_City');
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total = $_POST['total_pedido'];
    $fecha = date('Y-m-d H:i:s');
    $boletos = $_POST['boletos'];
    $camisas = $_POST['pedido_camisas'];
    $etiquetas = $_POST['pedido_etiquetas'];
    include_once 'includes/funciones/funciones.php';
    $pedidos = productos_json($boletos, $camisas, $etiquetas);
    if (isset($_POST['registro'])) {
        $eventos = $_POST['registro'];
    };
    $registro = eventos_json($eventos);
    require_once 'includes/funciones/db_conexion.php';
    try {
        $stmt = $conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
        $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedidos, $registro, $regalo, $total);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: validar_registro.php?exitoso=1');
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
?>
<?php endif; ?>
<?php include_once "includes/templates/header.php"; ?>
<section class="seccion contenedor">
    <h2>Validar Datos</h2>
    <?php if (isset($_GET['existoso'])) :
        if ($_GET['existoso'] == "1") :
            echo "Resgristro Exitoso";
        endif;

    endif;  ?>


</section>
<?php require_once "includes/templates/footer.php"; ?>