<?php
function master($valor,$valor2) {
    $url = 'https://v6.exchangerate-api.com/v6/617ee60d7da82906cd586141/latest/USD';
    $json_data = file_get_contents($url);
    
    if ($json_data !== false) {
        $data = json_decode($json_data, true);
        
        if ($data !== null) {
            $base_code = $data['base_code'];
            $conversion_rates = $data['conversion_rates'];
            if (isset($conversion_rates[$valor])) {
                $usd_to_eur = $conversion_rates[$valor];
                $valor_total =$usd_to_eur*$valor2;
                echo "$valor2 $base_code equivale a $valor_total $valor";
                return  $valor_total;
            } else {
                echo "La moneda '$valor' no se encuentra en las tasas de conversión.";
            }
        } else {
            echo "Error al decodificar el JSON.";
        }
    } else {
        echo "Error al obtener datos de la API.";
    }
}
function email($valorparaenviar,$monedas,$montos){
        $para = 'ray.dev.ganemo@gmail.com';
        $asunto = 'Tipos de cambio';
        $mensaje= "Tipo de cambio de $monedas a $montos USD es $valorparaenviar";
        $headers = 'de: tu@email.com' . "\r\n" .
            'para: tu@email.com' . "\r\n" ;
        ini_set('SMTP', 'smtp.gmail.com'); // aqui tambien se puede usar el servidor de mailtrap que seria sandbox.smtp.mailtrap.io
        ini_set('smtp_port', 587); // el puerto para mailtrap prueba seria 2525
        ini_set('sendmail_from', 'marceloibarra968@gmail.com'); 
        stream_context_set_option(
            stream_context_create(),
            'ssl',
            'crypto_method',
            STREAM_CRYPTO_METHOD_TLS_CLIENT
        );
        $username = 'correousuario'; // esto tambien se te brinda en la paltaforma
        $password = 'contraseña';


        $mail_success = mail($para, $asunto,  $mensaje, $headers);

        if ($mail_success) {
            echo "Correo enviado con éxito.";
        } else {
            echo "Error al enviar el correo.";
        }
}


if (isset($_GET['action']) && $_GET['action'] == 'llamarFuncion') {
    if (isset($_GET['moneda']) && isset($_GET['monto']) && $_GET['monto']!=null) {
        $moneda = $_GET['moneda'];
        $monto = $_GET['monto'];
        master($moneda,$monto);
        //$valorenviar = master($moneda,$monto);
        //email($valorenviar,$moneda,$monto);
    } else {
        echo "Faltan parámetros (moneda y/o monto).";
    }
}
?>
