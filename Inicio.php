<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagina Cambios</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<section>
 <div id="Cambio">
    <h1>Cambio de moneda</h1>
    <img src="iconom.png" id="imagen">
    <label for="monto">Ingrese la moneda de cambio abreviada tal </br>como se muestra en la tabla :</label>
    <input id="moneda" />
    </br>
    <label for="monto">Ingrese el monto a convertir de dolares: </label>
    <input type="number" id="monto" />
    <hr>
    <button type="button" id="btnllamarfuncion">Pulsa</button>
    </br>
    <span id="resultado"></span>

    </br>
 </div>
</section>
<section>
 <div>

    <table>

        <thead>
            <tr>
                <label id="titulotabla">Tabla de Cambios</label>
                <th>Moneda</th>
                <th>Tasa de Cambio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $url = 'https://v6.exchangerate-api.com/v6/617ee60d7da82906cd586141/latest/USD';
            $json_data = file_get_contents($url);
            if ($json_data !== false) {
                $data = json_decode($json_data, true);
                if ($data !== null) {
                    $base_code = $data['base_code'];
                    $conversion_rates = $data['conversion_rates'];
                    foreach ($conversion_rates as $codigo_moneda => $tasa_conversion) {
                        echo '<tr>';
                        echo "<td>$codigo_moneda</td>";
                        echo "<td>1 $base_code equivale a $tasa_conversion $codigo_moneda</td>";
                        echo '</tr>';
                    }
                } else {
                    echo "Error al decodificar el JSON";
                }
            } else {
                echo "Error al obtener datos de la API";
            }
            ?>
        </tbody>
    </table>
 </div>
</section>
</body>
<script src="llamado.js"></script>

</html>