<?php
$type = (isset($_POST['type']) ? $_POST['type'] : '');
$path = (isset($_POST['path']) ? $_POST['path'] : '');
$name = (isset($_POST['name']) ? $_POST['name'] : '');
$dir = $path.''.$name;
switch ($type){
    case 'folder':
        if (!is_dir($dir)){
	        mkdir($dir, 0777, True);
            echo 'Папка '.$name.' создана';
        }
        else{
            echo 'Такая папка уже существует';
        }
        break;
    case 'file':
        if(!is_file($dir)){
            fopen($dir, 'x');
        }
        else{
            echo 'Такой файл уже существует';
        }
        break;
}

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