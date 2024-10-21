<?php
$array = [];
$enviar = $_POST['enviar'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($i = 1; $i <= 10; $i++) {
        $array["numero$i"] = $_POST["numero$i"] ?? '';
    }
}

function numerosArmazenados($numeros)
{
    $arrayN = [
        'negativos' => 0,
        'positivos' => 0,
        'pares' => 0,
        'impares' => 0
    ];

    foreach ($numeros as $numero) {
        if ($numero < 0) {
            $arrayN['negativos']++;
        } elseif ($numero > 0) {
            $arrayN['positivos']++;
        }

        if ($numero % 2 == 0) {
            $arrayN['pares']++;
        } else {
            $arrayN['impares']++;
        }
    }

    return $arrayN;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 3</title>
</head>

<body>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <label for="numero">Número <?= $i ?></label>
            <input type="number" name="numero<?= $i ?>" value="<?= htmlspecialchars($array["numero$i"] ?? ''); ?>">
            <br><br>
        <?php endfor; ?>

        <button type="submit" name="enviar" style="width: 100px; height: 40px;">ENVIAR</button>
        <br>
    </form>

    <?php
    if (isset($enviar)) {
        $numeros = [];

        echo "<table border='1'>";
        echo "<tr><th>Números Armazenados</th></tr>";
        for ($i = 1; $i <= 10; $i++) {
            if (!empty($array["numero$i"])) {
                $numeros[] = floatval($array["numero$i"]);
                echo "<tr>";
                echo "<td>" . htmlspecialchars($array["numero$i"]) . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        $arrayN = numerosArmazenados($numeros);
        echo "<p>Números Negativos: " . $arrayN['negativos'] . "</p>";
        echo "<p>Números Positivos: " . $arrayN['positivos'] . "</p>";
        echo "<p>Números Pares: " . $arrayN['pares'] . "</p>";
        echo "<p>Números Ímpares: " . $arrayN['impares'] . "</p>";
    }
    ?>
</body>

</html>