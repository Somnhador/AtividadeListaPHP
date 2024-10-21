<?php
$array = [];
$enviar = $_POST['enviar'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($i = 1; $i <= 10; $i++) {
        $array["nomeAluno$i"] = $_POST["nomeAluno$i"] ?? '';
        $array["nota$i"] = $_POST["nota$i"] ?? '';
    }
}

function mediaClasse($nomeAluno)
{
    $somar = 0;
    $i = 0;
    foreach ($nomeAluno as $nota) {
        $somar += $nota;
        $i++;
    }
    return $i > 0 ? $somar / $i : 0;
}

function alunoMaiorNota($nomesAlunos, $notas)
{
    $maiorNota = -1;
    $alunoMaiorNota = '';

    foreach ($notas as $i => $nota) {
        if ($nota > $maiorNota) {
            $maiorNota = $nota;
            $alunoMaiorNota = $nomesAlunos[$i];
        }
    }

    return ['nomeMaior' => $alunoMaiorNota, 'notaMaior' => $maiorNota];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 2</title>
</head>

<body>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <label for="nomeAluno">Nome do Aluno <?= $i ?></label>
            <input type="text" name="nomeAluno<?= $i ?>" value="<?= htmlspecialchars($array["nomeAluno$i"] ?? ''); ?>">
            <label for="nota">Nota <?= $i ?></label>
            <input type="floatval" name="nota<?= $i ?>" value="<?= htmlspecialchars($array["nota$i"] ?? ''); ?>">
            <br><br>
        <?php endfor; ?>

        <button type="submit" name="enviar" style="width: 100px; height: 40px;">ENVIAR</button>
        <br><br>
    </form>

    <?php
    if (isset($enviar)) {
        $nomesAlunos = [];
        $notas = [];
        $maiorNota = max($nomesAlunos, $notas);

        echo "<table border='1'>";
        echo "<tr><th>Nome</th><th>Nota</th></tr>";
        for ($i = 1; $i <= 10; $i++) {
            if (!empty($array["nomeAluno$i"]) && !empty($array["nota$i"])) {
                $nomesAlunos[] = $array["nomeAluno$i"];
                $notas[] = floatval($array["nota$i"]);
                echo "<tr>";
                echo "<td>" . htmlspecialchars($array["nomeAluno$i"]) . "</td>";
                echo "<td>" . htmlspecialchars($array["nota$i"]) . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "<p>Média da Classe: " . mediaClasse($notas) . "</p>";
        echo "<p>Aluno com a maior nota da sala: " . implode("<br>Nota: " ,alunoMaiorNota($nomesAlunos, $notas)) . "</p>";
    }
    ?>
</body>

</html>