<?php

$a = rand(1, 10);

function power($val, $pow) {
    if ($pow == 0) return 1;
    if ($pow < 0) return 1 / power($val, -$pow);
    return $val * power($val, $pow - 1);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 6</title>
    <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
    <h1>Задание 6</h1>
    <p><?=$a ?> в степени 4 = <?= power($a, 5) ?></p>
    <p><?=$a ?> в степени -2 = <?= power($a, -2) ?></p>
    <p><?=$a ?> в степени 0 = <?= power($a, 0) ?></p>
    <a href="index.php">На главную</a>
</body>
</html>