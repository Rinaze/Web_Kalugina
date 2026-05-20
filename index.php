<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/menu.php';

try {
    $menu  = new Menu(getPDO());
    $items = $menu->fetchAll();        
    $tree  = $menu->buildTree($items); 
    $html  = $menu->render($tree);  
} catch (PDOException $e) {
    die('Ошибка БД: ' . htmlspecialchars($e->getMessage()));
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>List Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="item" id="item">
    <?= $html ?>
</div>
<script type="module" src="script.js"></script>
</body>
</html>