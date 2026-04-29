<?php

$a = rand(0, 100);
$b = rand(0, 100);
function add($a, $b) {
    return $a + $b;
}

function subtract($a, $b) {
    return $a - $b;
}

function multiply($a, $b) {
    return $a * $b;
}

function divide($a, $b) {
    return $b != 0 ? $a / $b : "Ошибка: деление на 0";
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 3</title>
    <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
    <h1>Задание 3</h1>
    <p><?=$a ?> + <?=$b ?> = <?= add($a, $b) ?></p>
    <p><?=$a ?> - <?=$b ?> = <?= subtract($a, $b) ?></p>
    <p><?=$a ?> * <?=$b ?> = <?= multiply($a, $b) ?></p>
    <p><?=$a ?> / <?=$b ?> = <?= divide($a, $b) ?></p>
    <a href="index.php">На главную</a>
</body>
</html>