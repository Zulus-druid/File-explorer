<?php
function removeDirectory($dir, $i){
    $dir_ = $dir.'/';
    $objs = scandir($dir_);
    if(!empty($objs)){
        foreach($objs as $obj){
            if($obj == '.' || $obj == '..') continue;
            if(is_dir($dir_.''.$obj)){
                $i = removeDirectory($dir_.''.$obj, $i);
            }
            else{
               if(!unlink($dir_.''.$obj)){
                   $i++;
               }
            }
        }
    }
    if(!rmdir($dir)){
        $i++;
    }
    return $i;
}

$i = 0;
if(!empty($_POST['folder'])){
    $folders = $_POST['folder'];
    foreach($folders as $folder){
        if(is_dir($folder.'/')){
            $i = removeDirectory($folder, $i);
        }
        else{
            $i++;
        }
    }
}
if(!empty($_POST['file'])){
    $files = $_POST['file'];
    foreach($files as $file){
        if(is_file($file)){
            if(!unlink($file)){
                $i++;
            }
        }
        else{
            $i++;
        }
    }
}

if($i == 0){
    echo 'Удалено!';
}
else{
    echo 'Ошибка!';
}
?>