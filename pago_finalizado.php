<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/5.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
  </head>
  <body>
      <div class="formulario">
            <h2>Pagos con Paypal</h2>
              <?php 
                //$resultado =  estas dos manera para convertir el valor a boolean
                $resultado = filter_var($_GET['exito'], FILTER_VALIDATE_BOOLEAN );
               if(isset($_GET['paymentId'])){ $paymentID = $_GET['paymentId'];}
            //    echo '<pre>' ;
            //     var_dump($resultado) ;
            //    echo '</pre>' ;
                if($resultado == true){
                    echo "El pago se realizo correctamente tu ID es <b> {$paymentID} </b> " ; 
                }else {
                    echo "<p class=prueba> El Proceso del Pago no fue terminado </p>";
                }
              ?>
        </div>
  </body>
  
  
</html>