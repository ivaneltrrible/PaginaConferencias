<?php
//PARA QUE NO REENVIEN EL PRODUCTO CON SOLO ACTUALIZAR LA PAGINA 

//Utilizar clases de un archivo con el nombre de namespace

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

if (!isset($_POST['submit'])) {
    exit("<a href=reservaciones.php> Hubo un Error!.. Regresar a reservar </a>");
}

require 'includes/paypalConfig.php';

if (isset($_POST['submit'])) :
    date_default_timezone_set('America/Mexico_City');
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total = $_POST['total_pedido'];
    $fecha = date('Y-m-d H:i:s');
    $boletos = $_POST['boletos'];
    $numero_boletos = $boletos;  // variable para no utilizar $boletos y asi no confundir o cambiar datos

    $pedido_extra = $_POST['pedido_extra'];  // variable para reutilizar etiquetas y camisas juntas 
    $camisas = $_POST['pedido_extra']["camisas"]["cantidad"];
    $precioCamisas = $_POST['pedido_extra']["camisas"]["precio"];

    $etiquetas = $_POST['pedido_extra']["etiquetas"]["cantidad"];
    $precioEtiquetas = $_POST['pedido_extra']["etiquetas"]["precio"];

    include_once 'includes/funciones/funciones.php';
    $pedidos = productos_json($boletos, $camisas, $etiquetas);

    if (isset($_POST['registro'])) {
        $eventos = $_POST['registro'];
    };
    $registro = eventos_json($eventos);


    echo '<pre>' ;
     var_dump($pedido_extra) ;
    echo '</pre>' ;
    
try {
    require_once 'includes/funciones/db_conexion.php';
    $stmt = $conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
    $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedidos, $registro, $regalo, $total);
    $stmt->execute();
    $stmt->close();
    $conn->close();
   // header('Location: validar_registro.php?exitoso=1');
} catch (\Exception $e) {
    echo $e->getMessage();
}
endif;




//SE CREA INSTANCIA DE PAYMETHOD metodo de pago
$compra = new Payer();
$compra->setPaymentMethod('paypal');

$articulo = new Item();
$articulo->setName($producto)
            //TIPO DE MONEDA
            ->setCurrency('MXN')
            //CANTIDAD DE PRODUCTOS PUEDE LLEVAR UNA VARIABLE
            ->setQuantity(1)
            //PRECIO DE PRODUCTO O ITEM
            ->setPrice($precio);


//SE CREA UN FOREACH PARA RECORRER CADA PRODUCTO QUE SELECCIONE CREARLO Y DE ESTA MANERA NO CREAR PRODUCTO POR PRODUCTO DEPENDIENDO LOS BOLETOS SELECCIONADOS
$i = 0;
foreach ($numero_boletos as $key => $value) {
    if ( (int) $value["cantidad"] > 0) {

        //SE CREA UNA INSTANCIA DEL OBEJTO ITEM que practicamente contiene descripcion,nombre, etc
        ${"articulo".$i} = new Item();
        //NOMBRE DE PRODUCTO
        ${"articulo".$i}->setName('Pase ' . $key)
            //TIPO DE MONEDA
            ->setCurrency('MXN')
            //CANTIDAD DE PRODUCTOS PUEDE LLEVAR UNA VARIABLE
            ->setQuantity( (int) $value['cantidad'])
            //PRECIO DE PRODUCTO O ITEM
            ->setPrice( (int) $value['precio']);
        $i++;
       
    }
}

//RECORRER TODAS LAS ETIQUETAS O CAMISAS SELECCIONADAS PARA CREAR ITEM DE CADA UNA SI ES QUE HAY
foreach ($pedido_extra as $key => $value) {
    if ( (int) $value["cantidad"] > 0) {   
 
       if ($key == 'camisas') {
           $precio = (float) $value['precio'] * .93;
           
       } else{
           $precio = (int) $value['precio'];
       }
        //SE CREA UNA INSTANCIA DEL OBEJTO ITEM que practicamente contiene descripcion,nombre, etc
        ${"articulo".$i} = new Item();
        //NOMBRE DE PRODUCTO
        ${"articulo".$i}->setName('Extra: ' . $key)
            //TIPO DE MONEDA
            ->setCurrency('MXN')
            //CANTIDAD DE PRODUCTOS PUEDE LLEVAR UNA VARIABLE
            ->setQuantity( (int) $value['cantidad'])
            //PRECIO DE PRODUCTO O ITEM
            ->setPrice($precio);
           
        $i++;
      
       
    }
}


/*
//Segundo Articulo ejemplo
$articulo_ropa = new Item();
$articulo_ropa->setName('jeans')->setCurrency('MXN')->setPrice($precio_ropa)->setQuantity(1);


////// LISTA DE ARTICULOS SE AGREGAN TODOS LOS ARTICULOS DE ITEM COMO SI FUERA UN CARRITO //
$listaArticulos = new ItemList();
$listaArticulos->setItems(array($articulo, $articulo_ropa));


////// SE CREA LOS DETALLES COMO EL PRECIO Y EL COSTO DEL ENVIO //
$detalles = new Details();
$detalles->setShipping($envio)
->setSubtotal($precio + $precio_ropa);

////// MONTO A PAGAR ////
$cantidad = new Amount();
$cantidad->setCurrency('MXN')
->setTotal($total)
->setDetails($detalles);



////// TRANSACCIONES REALIZADAS COMPRAS O VENTAS POR EJEMPLO ////
$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
->setInvoiceNumber(uniqid())
->setDescription('Paga ')
->setItemList($listaArticulos);


////// REDIRECCIONAR URLS DESPUES DEL APROVADO EL PAGO O QUE FALLA EL PAGO HACIA QUE PAGINA REDIRECCIONAR////
$redireccionar = new RedirectUrls();
//URL_SITIO esta declarada en config.php como constante para saber el sitio web a redireccionar
$redireccionar->setReturnUrl(URL_SITIO . "pago_finalizado.php?exito=true&precio={$total}")
->setCancelUrl(URL_SITIO . "pago_finalizado.php?exito=false");



//////// PAGO REAL PAYMENT ////////////
$pago = new Payment();
$pago->setIntent("sale")
->setPayer($compra)
->setTransactions(array($transaccion))
->setRedirectUrls($redireccionar);



try {
$pago->create($apiContenxt);
} catch (\PayPal\Exception\PayPalConnectionException $pce) {
echo '
<pre>' ;
          print_r(json_decode($pce->getData())) ;
          exit;
         echo '</pre>' ;
}

$aprobado = $pago->getApprovalLink();
header("Location: {$aprobado}"); */
