<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

include_once "includes/templates/header.php";

require 'includes/paypalConfig.php';



?>
<section class="seccion contenedor">
  <h2>Validar Pago</h2>
  <?php
  if (isset($_GET['paymentId'])) {
    $paymentID = $_GET['paymentId'];
  }
  $id_pago = $_GET['id_pago'];
  $pagado = 1;


  //REST API
  //Comentario: TODO ESTO SIRVE PARA SABER DESDE PAYPAY CON REST API SI EL PAGO FUE APROVADO /////////
  //No se instancia se accede de manera estatica a el metodo ya que solo se pasan parametros
  $pago = Payment::get($paymentID, $apiContenxt);
  $execution = new PaymentExecution();
  //LE PASAMOS EL ID DE LA TRANSACCION DEPAYPAL para saber si fue aprovado
  $execution->setPayerId($_GET['PayerID']);
  //se ejecuta en el servidor de paypal
  $resultado = $pago->execute($execution, $apiContenxt);
 
  //VALIDACION DIRECTA DE PAYPAL PARA VALIR PAGO COMPLETADO
  $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;
  // echo '<pre>' ;
  //  var_dump($respuesta) ;
  // echo '</pre>' ;

  if ($respuesta == 'completed') {
    echo "<div class='correcto resultado' >";
    echo "El pago se realizo correctamente tu ID es: <br> <b> {$paymentID} </b> ";
    echo "</div>";
    require_once('includes/funciones/db_conexion.php');
    $stmt = $conn->prepare("UPDATE registrados SET pagado = ? WHERE id_registrado = ?");
    $stmt->bind_param("ii", $pagado, $id_pago);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  } else {
    echo "<p class='error resultado'> El Proceso del Pago no fue terminado </p>";
  }
  ?>

</section>
<?php require_once "includes/templates/footer.php"; ?>