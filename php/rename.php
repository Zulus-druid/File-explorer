<?php
$oldName = !empty($_POST['old']) ? $_POST['old'] : '';
$newName = !empty($_POST['new']) ? $_POST['new'] : '';

if(file_exists($oldName)){
    if(!file_exists($newName)){
        if(rename($oldName, $newName)){
            echo 'Переименование выполнено!';
        }
        else{
            echo 'Ошибка: Переименование не выполнено!';
        }
    }
    else{
        echo 'Ошибка: Такой файл или папка уже существует!';
    }
}
else{
    echo 'Ошибка: Файл или папка не существует!';
}
?>