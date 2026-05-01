<?php
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Касимов', 'Скопин', 'Сасово', 'Ряжск']
];

function renderCitiesStartingWithK($regions) { 
    $output = '';
    foreach ($regions as $region => $cities) {
        $filtered = array_filter($cities, function($city) {
            return mb_substr($city, 0, 1) === 'К';
        });
        if (!empty($filtered)) {
            $output .= "<strong>$region:</strong><br>";
            $output .= implode(', ', $filtered) . ".<br><br>";
        }
    }
    return $output;
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
    <?= renderCitiesStartingWithK($regions) ?>
    <a href="index.php">На главную</a>
</body>
</html>