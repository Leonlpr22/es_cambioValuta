<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato del Cambio</title>
    <style>
        body { 
            font-family: Arial, sans-serif; background-color: #f0f8ff; padding-top: 50px; text-align: center; 
        }
        .box { 
            background-color: #fff; padding: 20px; margin: auto; width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }
        img { 
            width: 50px; height: 30px; 
        }
        .result { 
            margin: 10px 0; 
        }
    </style>
</head>
<body>
<?php
    $cambio = [
        "dollaro" => 1.08,
        "yen" => 130.20,
        "franco" => 1.04,
        "sterlina" => 0.85
    ];

    if (isset($_GET['importo'])) {
        $importo = floatval($_GET['importo']);
    } else {
        $importo = 0;
    }

    if (isset($_GET['valuta'])) {
        $valuta = $_GET['valuta'];
    } else {
        $valuta = "dollaro";
    }

    $data = date("d-m-Y");
    $giornoSettimana = date("N");
    $commissionePercentuale = ($giornoSettimana <= 5) ? 2.5 : 5;
    $commissione = $importo * $commissionePercentuale / 100;
    $importoNetto = $importo - $commissione;
    $importoConvertito = $importoNetto * $cambio[$valuta];

    $giorni = ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"];
    $giornoItaliano = $giorni[date("w")];

    $bandiere = [
        "italia" => "https://www.worldometers.info/img/flags/it-flag.gif",
        "dollaro" => "https://www.worldometers.info/img/flags/us-flag.gif",
        "yen" => "https://www.worldometers.info/img/flags/ja-flag.gif",
        "franco" => "https://www.worldometers.info/img/flags/sz-flag.gif",
        "sterlina" => "https://www.worldometers.info/img/flags/uk-flag.gif"
    ];

    echo "<h1>Risultato del Cambio</h1>";
    echo "<div class='box'>";
    echo "<p class='result'>Data: $data</p>";
    echo "<p class='result'>Giorno: $giornoItaliano</p>";
    echo "<p class='result'>Importo in Euro: €$importo <img src='{$bandiere['italia']}' alt='Bandiera Italia'></p>";
    echo "<p class='result'>Importo nella valuta di arrivo (senza commissioni): " . number_format($importo * $cambio[$valuta], 2) . " <img src='{$bandiere[$valuta]}' alt='Bandiera Valuta'></p>";
    echo "<p class='result'>Commissioni: €" . number_format($commissione, 2) . " (" . ($commissionePercentuale == 5 ? "commissione maggiorata" : "commissione normale") . ")</p>";
    echo "<p class='result'>Importo finale nella valuta di arrivo: " . number_format($importoConvertito, 2) . "</p>";
    echo "<a href='valuta.html'>Torna indietro</a>";
    echo "</div>";
?>
</body>
</html>
