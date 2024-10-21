<?php
$array = [];
$enviar = $_POST['enviar'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($i = 1; $i <= 5; $i++) {
        $array["n$i"] = $_POST["n$i"] ?? '';
        $array["p$i"] = $_POST["p$i"] ?? '';
    }
}

function prodsAbaixo50($produto) {
    $i = 0;
    foreach ($produto as $preco) {
        if ($preco < 50) {
            $i++;
        }
    }
    return $i;
}

function prodsEntre50e100($produto, $produtos) {
    $prodsEntre50e100 = [];
    foreach ($produto as $i => $preco) {
        if ($preco >= 50 && $preco <= 100) {
            $prodsEntre50e100[] = $produtos[$i];
        }
    }
    return $prodsEntre50e100;
}

function mediaAcima100($produto) {
    $somar = 0;
    $i = 0;
    foreach ($produto as $preco) {
        if ($preco > 100) {
            $somar += $preco;
            $i++;
        }
    }
    return $i > 0 ? $somar / $i : 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 1</title>
</head>

<body>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label for="produto">Produto <?= $i ?></label>
            <input type="text" name="n<?= $i ?>" value="<?= htmlspecialchars($array["n$i"] ?? ''); ?>">
            <label for="preco">Preço <?= $i ?></label>
            <input type="floatval" name="p<?= $i ?>" value="<?= htmlspecialchars($array["p$i"] ?? ''); ?>">
            <br><br>
        <?php endfor; ?>

        <button type="submit" name="enviar" style="width: 100px; height: 60px;">ENVIAR</button>
        <br><br>
    </form>

    <?php
    if (isset($enviar)) {
        $produtos = [];
        $precos = [];

        echo "<table border='1'>";
        echo "<tr><th>Produto</th><th>Preço</th></tr>";
        for ($i = 1; $i <= 5; $i++) {
            if (!empty($array["n$i"]) && !empty($array["p$i"])) {
                $produtos[] = $array["n$i"];
                $precos[] = floatval($array["p$i"]);
                echo "<tr>";
                echo "<td>" . htmlspecialchars($array["n$i"]) . "</td>";
                echo "<td>" . htmlspecialchars($array["p$i"]) . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";

        echo "<p>Quantidade de produtos abaixo de R$50: " . prodsAbaixo50($precos) . "</p>";
        echo "<p>Produtos entre R$50 e R$100: " . implode(", ", prodsEntre50E100($precos, $produtos)) . "</p>";
        echo "<p>Média dos preços acima de R$100: R$" . mediaAcima100($precos) . "</p>";
    }
    ?>
</body>

</html>
