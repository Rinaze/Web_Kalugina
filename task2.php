<?php
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Касимов', 'Скопин', 'Сасово', 'Ряжск']
];

function buildRegionsList($regions) {
    $output = '';
    foreach ($regions as $region => $cities) {
        $output .= "<strong>$region:</strong><br>";
        $output .= implode(', ', $cities) . ".<br><br>";
    }
    return $output;
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
    <?= buildRegionsList($regions) ?>
    <a href="index.php">На главную</a>
</body>
</html>