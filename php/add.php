<?php
$type = (isset($_POST['type']) ? $_POST['type'] : '');
$route = (isset($_POST['route']) ? $_POST['route'] : '');
$name = (isset($_POST['name']) ? $_POST['name'] : '');
$path = $route.''.$name;

switch ($type){
    case 'folder':
        if(!is_dir($path)){
            if(mkdir($path, 0777, True)){
                echo 'Папка &laquo;'.$name.'&raquo; создана!';
            }
            else{
                echo 'Ошибка: Создать папку не удалось!';
            }
        }
        else{
            echo 'Такая папка уже существует!';
        }
        break;
    case 'file':
        if(!is_file($path)){
            if(fopen($path, 'x')){
                echo 'файл &laquo;'.$name.'&raquo; создан!';
            }
            else{
                echo 'Ошибка: Создать файл не удалось!';
            }
        }
        else{
            echo 'Такой файл уже существует!';
        }
        break;
}
?>