<?php
function getExt($filename){
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}
function fileImage($filename){
    $ext = getExt($filename);
    $image = match($ext){
        // Audio
        'mp3'=>'fa-file-audio-o',
        // Code
        'css','html','js','php','rst','sql','webmanifest','xml'=>'fa-file-code-o',
        // Image
        'gif','ico','jpg','jpeg','png'=>'fa-file-image-o',
        // Set
        'htaccess','ini'=>'fa-cog',
        // Text
        'log','txt'=>'fa-file-text-o',
        // Video
        'mp4'=>'fa-file-video-o',
        // Others
        'url'=>'fa-globe',
        default => 'fa-file-o',
    };
    return $image;
}

$dir = '../../';
$route = '';
if(!empty($_GET['r'])){
    $route = $_GET['r'].'/';
}
$path = $dir.''.$route;
$array = scandir($path);
foreach($array as $item){
    if($item == '.' || $item == '..') continue;
    if(is_dir($path.''.$item)){
        $folders[] = $item;
    }
    else{
        $files[] = $item;
    }
}

$folderArr = [];
if(!empty($folders)){
    foreach($folders as $folder){
        $folderArr[] = '{ "route": "'.$route.'", "folder": "'.$folder.'"}';
    }
}
$fileArr = [];
if(!empty($files)){
    foreach($files as $file){
        $fileArr[] = '{"img": "'.fileImage($file).'", "file": "'.$file.'"}';
    }
}

$jn_arr = ['folderArr' => $folderArr, 'fileArr' => $fileArr, 'path' => $path];
echo json_encode($jn_arr);
?>