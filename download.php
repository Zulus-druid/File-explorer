
function download(){
// Имя скачиваемого файла
$file = "files/public/download.rar";

// Контент-тип означающий скачивание
header("Content-Type: application/octet-stream");

// Размер в байтах
header("Accept-Ranges: bytes");

// Размер файла
header("Content-Length: ".filesize($file));

// Расположение скачиваемого файла
<?php
header("Content-Disposition: attachment; filename=".$file);  

// Прочитать файл
readfile($file);



ob_end_clean();
 
$file = __DIR__ . '/file.avi';
 
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($file));
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
 
readfile($file);
exit();
}
?>