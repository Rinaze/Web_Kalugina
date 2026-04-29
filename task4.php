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

function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case '+':
            return add($arg1, $arg2);
        case '-':
            return subtract($arg1, $arg2);
        case '*':
            return multiply($arg1, $arg2);
        case '/':
            return divide($arg1, $arg2);
        default:
            return "Неизвестная операция";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 4</title>
    <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
    <h1>Задание 4</h1>
    <p><?=$a ?> + <?=$b ?> = <?= mathOperation($a, $b, '+') ?></p>
    <p><?=$a ?> - <?=$b ?> = <?= mathOperation($a, $b, '-') ?></p>
    <p><?=$a ?> * <?=$b ?> = <?= mathOperation($a, $b, '*') ?></p>
    <p><?=$a ?> / <?=$b ?> = <?= mathOperation($a, $b, '/') ?></p>
    <a href="index.php">На главную</a>
</body>
</html>