<?php
function getExt($filename){
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}
function fileImage($filename){
    $ext = getExt($filename);
    $ext_arr = array(
        // Audio
        'mp3'=>'fa-file-audio-o',
        // Image
        'gif'=>'fa-file-image-o','ico'=>'fa-file-image-o','jpg'=>'fa-file-image-o','jpeg'=>'fa-file-image-o','png'=>'fa-file-image-o',
        // Video
        'mp4'=>'fa-file-video-o',

        'css'=>'fa-file-code-o', 'url'=>'fa-globe', 'htaccess'=>'fa-cog', 'html'=>'fa-file-code-o',  'ini'=>'fa-cog',   'js'=>'fa-file-code-o', 'log'=>'fa-file-text-o',  'php'=>'fa-file-code-o',  'rst'=>'fa-file-code-o', 'sql'=>'fa-file-code-o', 'txt'=>'fa-file-text-o', 'webmanifest'=>'fa-file-code-o', 'xml'=>'fa-file-code-o'
    );
    if(array_key_exists($ext, $ext_arr)){
        $image = $ext_arr[$ext];
    }
    else{
        $image = 'fa-file-o';
    }
    return $image;
}

$r = '';
$dir_r = '';
$dir = '../';
if(!empty($_GET['r'])){
    $r = $_GET['r'];$dir_r = $r.'/';$dir .= $dir_r;
}
$array = scandir($dir);
foreach($array as $item){
    if($item == '.' || $item == '..') continue;
    if(is_dir($dir.''.$item)){
        $folders[] = $item;
    }
    else{
        $files[] = $item;
    }
}/*
$back = explode('/', $r);
$count = count($back);
unset($back[$count - 1]);
unset($back[$count - 2]);
$back = implode('/', $back);
if(!empty($back)){$back = '?r='.$back;}*/

//print_r($files);
$fr_a = array();
if(!empty($folders)){
    foreach($folders as $folder){
        $fr_a[] = '{ "dir_r": "'.$dir_r.'", "folder": "'.$folder.'"}';
    }
}
$fl_a = array();
if(!empty($files)){
    foreach($files as $file){
        $fl_a[] = '{"img": "'.fileImage($file).'", "file": "'.$file.'"}';
    }
}
$jn_arr = array('fr_a' => $fr_a, 'fl_a' => $fl_a, 'dir' => $dir, 'r' => $r);
echo json_encode($jn_arr);
//echo 'loh';
//require_once('list.html')
?>