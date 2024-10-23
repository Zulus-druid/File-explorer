<?php
function removeDirectory($dir){
    $objs = scandir($dir.'/');
    if (!empty($objs)){
       foreach($objs as $obj){
         if(is_dir($dir.'/'.$obj)){
           removeDirectory($dir.'/'.$obj);
         }
         else{
           unlink($dir.'/'.$obj);
         }
       }
    }
    rmdir($dir);
}

if (!empty($_POST['fr'])){
    $folders = $_POST['fr'];
    foreach($folders as $folder){
        removeDirectory($folder);
    }
}
if (!empty($_POST['fl'])){
    $files = $_POST['fl'];
    foreach($files as $file){
        unlink($file);
    }
}
echo 'Удалено';
?>