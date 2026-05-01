<?php
function rotateLog() {
    $logFile = 'log.txt';
    if (file_exists($logFile)) {
        $lines = file($logFile, FILE_IGNORE_NEW_LINES);
        if (count($lines) >= 10) {
            $maxNum = 0;
            foreach (glob('log*.txt') as $file) {
                if (preg_match('/log(\d+)\.txt/', $file, $matches)) {
                    $num = (int)$matches[1];
                    if ($num > $maxNum) $maxNum = $num;
                }
            }
            $newName = 'log' . ($maxNum + 1) . '.txt';
            rename($logFile, $newName);
        }
    }
    $time = date('Y-m-d H:i:s');
    file_put_contents($logFile, $time . PHP_EOL, FILE_APPEND | LOCK_EX);
}
rotateLog();

$bigDir = 'uploads/big/';      
$thumbDir = 'uploads/thumbs/'; 
$maxWidthBig = 1200;          
$thumbWidth = 200;            
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 5 * 1024 * 1024; 

if (!is_dir($bigDir)) mkdir($bigDir, 0777, true);
if (!is_dir($thumbDir)) mkdir($thumbDir, 0777, true);

function buildGallery($thumbDir, $bigDir) {
    $images = glob($thumbDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    if (empty($images)) {
        return '<p>Фотографий пока нет.</p>';
    }
    $html = '<div class="gallery">';
    foreach ($images as $thumbPath) {
        $filename = basename($thumbPath);
        $bigPath = $bigDir . $filename;
        $bigUrl = file_exists($bigPath) ? $bigPath : $thumbPath;
        $html .= '<a href="' . htmlspecialchars($bigUrl) . '" target="_blank">';
        $html .= '<img src="' . htmlspecialchars($thumbPath) . '" width="200" alt="' . htmlspecialchars($filename) . '">';
        $html .= '</a>';
    }
    $html .= '</div>';
    return $html;
}

$uploadMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $uploadMessage = 'Ошибка загрузки файла.';
    } elseif ($file['size'] > $maxFileSize) {
        $uploadMessage = 'Файл слишком большой. Максимум 5 МБ.';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, $allowedTypes)) {
            $uploadMessage = 'Разрешены только JPG, PNG, GIF.';
        } else {
            $ext = '';
            switch ($mime) {
                case 'image/jpeg': $ext = '.jpg'; break;
                case 'image/png':  $ext = '.png'; break;
                case 'image/gif':  $ext = '.gif'; break;
            }
            $newName = uniqid() . $ext;
            $bigPath = $bigDir . $newName;
            $thumbPath = $thumbDir . $newName;

            list($width, $height) = getimagesize($file['tmp_name']);
            $src = null;
            if ($mime === 'image/jpeg') $src = imagecreatefromjpeg($file['tmp_name']);
            elseif ($mime === 'image/png') $src = imagecreatefrompng($file['tmp_name']);
            elseif ($mime === 'image/gif') $src = imagecreatefromgif($file['tmp_name']);

            if (!$src) {
                $uploadMessage = 'Не удалось создать изображение.';
            } else {
                if ($width > $maxWidthBig) {
                    $newHeight = floor($height * ($maxWidthBig / $width));
                    $resized = imagecreatetruecolor($maxWidthBig, $newHeight);
                    imagecopyresampled($resized, $src, 0, 0, 0, 0, $maxWidthBig, $newHeight, $width, $height);
                    imagedestroy($src);
                    $src = $resized;
                    $width = $maxWidthBig;
                    $height = $newHeight;
                }
                if ($mime === 'image/jpeg') imagejpeg($src, $bigPath, 85);
                elseif ($mime === 'image/png') imagepng($src, $bigPath, 9);
                elseif ($mime === 'image/gif') imagegif($src, $bigPath);
                
                $thumbHeight = floor($height * ($thumbWidth / $width));
                $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
                imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                if ($mime === 'image/jpeg') imagejpeg($thumb, $thumbPath, 80);
                elseif ($mime === 'image/png') imagepng($thumb, $thumbPath, 9);
                elseif ($mime === 'image/gif') imagegif($thumb, $thumbPath);
                
                imagedestroy($src);
                imagedestroy($thumb);
                $uploadMessage = 'Файл успешно загружен!';
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Фотогалерея</title>
    <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
    <h1>Фотогалерея</h1>
    
    <?php if ($uploadMessage): ?>
        <div class="message"><?= htmlspecialchars($uploadMessage) ?></div>
    <?php endif; ?>
    
    <?= buildGallery($thumbDir, $bigDir) ?>
    
    <div class="upload-form">
        <h3>Загрузить новое изображение</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/jpeg,image/png,image/gif" required>
            <button type="submit">Загрузить</button>
        </form>
        <p><small>Допустимые форматы: JPG, PNG, GIF. Размер до 5 МБ.</small></p>
    </div>
    
    <p><a href="index.php">Обновить страницу</a></p>
</body>
</html>