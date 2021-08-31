<?php

require 'paypal/autoload.php';

define('URL_SITIO','http://gdlwebcamp');

// iniciamos la configuración de Paypal

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        // aquí colocamos el clienteID y luego el secret
        'AUvHYh8i5hPpiW0DKZtth1OcSYFaX82qmg6PBMkNrKDhUAocmn1U3NN2W1szGI4kFcV-dfr-R2nQbxJN',
        'ELqPnTuGpTAGGr_gZq6jpRUGUGUes-aADtppYsiNYDSk72iCkFbxtwUASaw1p1V1Hjlo2RPRCr1dhLeM'  
    )

);

use Model\ActiveRecord;

ActiveRecord::setApiContext($apiContext);
