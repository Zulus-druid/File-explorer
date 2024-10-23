<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мои файлы</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css?t=<?=time();?>">
    <link rel="stylesheet" href="style.css?t=<?=time();?>">
    <link rel="icon" href="favicon.ico">
</head>
<body>

<header>
    <section>
        <div id="up">
            <button id="upload-btn"><i class="fa fa-upload" aria-hidden="true"></i></button>
            <button onclick="showWindow('fr_win');"><i class="fa fa-folder-o" aria-hidden="true"></i></button>
            <button onclick="showWindow('fl_win');"><i class="fa fa-file-o" aria-hidden="true"></i></button>
            <a href="#" onclick="reNew(); return false;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
        <div  id="down">
            <button><i class="fa fa-download" aria-hidden="true"></i></button>
            <button onclick="showPopUp('rename-pp')"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            <button><i class="fa fa-scissors" aria-hidden="true"></i></button>
            <button><i class="fa fa-files-o" aria-hidden="true"></i></button>
            <button onclick="delFile()"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            <a href="#" onclick="reNew(); return false;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
        <div id="paste">
            <button id=""><i class="fa fa-times" aria-hidden="true"></i></button>
            <button id=""><i class="fa fa-folder-o" aria-hidden="true"></i></button>
            <button id="paste-btn"><i class="fa fa-clipboard" aria-hidden="true"></i></button>
        </div>
    </section>
    <div id="back"><a href="#" id="back-link" onclick="back(); return false;"><i class="fa fa-reply" aria-hidden="true"></i></a></div>
</header>

<div class="file-result darkness" id="file-result">
    <div class="window">
    <div id="upload-result"></div>
    <div><a href="#" onclick="closeWindow('file-result'); return false;" class="close">Отмена</a></div>
    </div>
</div>
<div class="fr_win darkness">
    <div class="window">
    <div>Создать</div>
    <div><input type="text" id="addFolder" value="Папка"></div>
    <div><a href="#" onclick="closeWindow('folder'); return false;" class="close">Отмена</a><a href="#" onclick="addFile('folder'); return false;" class="close">OK</a></div>
    </div>
</div>
<div class="fl_win darkness">
    <div class="window">
    <div>Создать</div>
    <div><input type="text" id="addFile" value="Папка"></div>
    <div><a href="#" onclick="closeWindow('file'); return false;" class="close">Отмена</a><a href="#" onclick="addFile('file'); return false;" class="close">OK</a></div>
    </div>
</div>
<div class="rename-pp darkness">
    <div class="popup">
    <div>Переименовать</div>
    <div><input type="text" id="rename_inp" value=""></div>
    <div><a href="#" onclick="closePopUp('rename-pp'); return false;" class="close">Отмена</a><a href="#" onclick="reName(); return false;" class="close">OK</a></div>
    </div>
</div>

<main>
<section class="list">
    <div id="loading"><i class="fa fa-spinner fa-pulse"></i>  Загрузка...</div>
    <div id="demo"></div>
    <form id="list-form" method="POST" enctype="multipart/form-data">
        <ul id="folders" class="folders"></ul>
        <ul id="files" class="files"></ul>
    </form>
</section>
</main>

<form id="upload-form" method="POST" enctype="multipart/form-data">
    <input type="file"  id="file-inp" name="file[]" multiple hidden>
    <input type="text" id="dir" name="dir" value="" hidden>
</form>
<input type="text" id="r" value="" hidden>



<script src="jquery.min.js"></script>
<script src="jquery.form.min.js"></script>
<script src="script.js"></script>

</body>
</html>

<!--<div>
    <i class="fa fa-file-archive-o" aria-hidden="true"></i>
    <i class="fa fa-file-audio-o" aria-hidden="true"></i>
    <i class="fa fa-file-code-o" aria-hidden="true"></i>
    <i class="fa fa-file-image-o" aria-hidden="true"></i>
    <i class="fa fa-file-video-o" aria-hidden="true"></i>
    <i class="fa fa-cog" aria-hidden="true"></i>
    <i class="fa fa-file-text-o" aria-hidden="true"></i>
    <i class="fa fa-file-excel-o" aria-hidden="true"></i>
    <i class="fa fa-files-o" aria-hidden="true"></i>
</div>-->