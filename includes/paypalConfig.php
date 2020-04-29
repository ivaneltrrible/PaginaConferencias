<?php
require 'paypal/autoload.php';

//VARIABLE SUPER GLOBAL para utilizar al redireccionar el pago
define('URL_SITIO', 'http://localhost/proyectosUdemy/PaginaConferencias/');

//INSTALAR SDK DE PAYPAL de usuario bussiness
$apiContenxt = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'Adf1vNNS2iH0W7vio2deQ0Cd3r4tYxwfHHKWq8GBU8i8L0uaV5toJNBVDwNXPJOjxiTeKem_IO2LmQkW', //ClienteID
        'EBGU7N4MuRguTGPyF2ptA-EYPewq-1qikzOCYTFz56qU4AB4eFKw-hj60X2rJ3JGWCrZVajLrR5Hk_ZB'  //Secret
    )
);
