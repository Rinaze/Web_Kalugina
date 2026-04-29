<?php

  $title = "Практика 16";
  $head = "Практика 16 :)";
  $year = date("Y");

  function getTimeWithWords() {
      $hours = (int)date('G');     
      $minutes = (int)date('i');     

      # Определение часа
      if ($hours % 10 == 1 && $hours % 100 != 11) {
          $hoursWord = "час";
      } elseif (in_array($hours % 10, [2, 3, 4]) && !in_array($hours % 100, [12, 13, 14])) {
          $hoursWord = "часа";
      } else {
          $hoursWord = "часов";
      }

      # Определение минут
      if ($minutes % 10 == 1 && $minutes % 100 != 11) {
          $minutesWord = "минута";
      } elseif (in_array($minutes % 10, [2, 3, 4]) && !in_array($minutes % 100, [12, 13, 14])) {
          $minutesWord = "минуты";
      } else {
          $minutesWord = "минут";
      }

      return "$hours $hoursWord $minutes $minutesWord";
  }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?= $title; ?></title>
  <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
  <header>
    <h1><?= $head; ?></h1>
    <p>Это страница сделана Калугиной Ариной в <?= $year; ?> году.</p>
    <p>В данный момент <?= getTimeWithWords(); ?></p>
  </header>
</body>
</html>