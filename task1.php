<?php
$a = 5;  
$b = -3; 

if ($a >= 0 && $b >= 0) {
    $result = $a - $b;
    $message = "Оба положительные (разность): $a - $b = $result";
} elseif ($a < 0 && $b < 0) {
    $result = $a * $b;
    $message = "Оба отрицательные (произведение): $a * $b = $result";
} else {
    $result = $a + $b;
    $message = "Разные знаки (сумма): $a + $b = $result";
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
    <p><strong>a = <?= $a ?>, b = <?= $b ?></strong></p>
    <p><?= $message ?></p>
    <a href="index.php">На главную</a>
</body>
</html>