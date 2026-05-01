<?php
function printNumbersWithParity() {
    $i = 0;
    do {
        if ($i == 0) {
            echo "<p>$i – это ноль.</p>";
        } elseif ($i % 2 == 0) {
            echo "<p>$i – чётное число.</p>";
        } else {
            echo "<p>$i – нечётное число.</p>";
        }
        $i++;
    } while ($i <= 10);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 1</title>
    <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
    <h1>Задание 1</h1>
    <p><?= printNumbersWithParity() ?></p>
    <a href="index.php">На главную</a>
</body>
</html>