<?php
$translitMap = [
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
    'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm',
    'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
    'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
    'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
];

$string = "Привет, мир.";

function transliterate($str, $map) {
    $result = '';
    $len = mb_strlen($str, 'UTF-8');
    for ($i = 0; $i < $len; $i++) {
        $char = mb_substr($str, $i, 1, 'UTF-8');
        $lower = mb_strtolower($char, 'UTF-8');
        if (isset($map[$lower])) {
            $trans = $map[$lower];
            if ($char !== $lower) { // была заглавная
                $trans = mb_convert_case($trans, MB_CASE_TITLE, 'UTF-8');
            }
            $result .= $trans;
        } else {
            $result .= $char;
        }
    }
    return $result;
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
    <p>Исходная строка: <?= $string ?></p>
    <p>Транслитерация: <?= transliterate($string, $translitMap) ?></p>
    <a href="index.php">На главную</a>
</body>
</html>