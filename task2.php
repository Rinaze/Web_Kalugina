<?php
$a = rand(0, 15);
$output = "";
switch ($a) {
        case 0:  $output .= "0 "; 
        case 1:  $output .= "1 ";
        case 2:  $output .= "2 ";
        case 3:  $output .= "3 ";
        case 4:  $output .= "4 ";
        case 5:  $output .= "5 ";
        case 6:  $output .= "6 ";
        case 7:  $output .= "7 ";
        case 8:  $output .= "8 ";
        case 9:  $output .= "9 ";
        case 10: $output .= "10 ";
        case 11: $output .= "11 ";
        case 12: $output .= "12 ";
        case 13: $output .= "13 ";
        case 14: $output .= "14 ";
        case 15: $output .= "15";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 2</title>
    <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
    <h1>Задание 2</h1>
    <p><strong>a = <?= $a ?></strong></p>
    <p>Числа от <?= $a ?> до 15: <strong><?= $output ?></strong></p>
    <a href="index.php">На главную</a>
</body>
</html>