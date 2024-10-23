

// == Upload
$(function(){
    $("#upload-btn").on("click", function(){
        $('#file-inp').click();
    });
});

$('#file-inp').change(function(){
    //$("#loading").show();
	$('#upload-form').ajaxSubmit({
		type: 'POST',
		url: 'upload.php',
		target: '#upload-result',
		success: function(){
			$('#upload-form')[0].reset(); // После загрузки файла очистим форму.
            //$("#loading").hide();
            $("#file-result").show();
		}
	});
});


// == View
function checkOrNo(){
    checks=document.getElementsByClassName('checkbox');
    var i = 0;
    for (let check of checks){
        if (check.checked) {
            i++;
        }
    }
    if(i == 1){
        document.getElementById('up').style.display = 'none';
        document.getElementById('down').style.display = 'block';
    }
    if(i == 0){
        document.getElementById('down').style.display = 'none';
        document.getElementById('up').style.display = 'block';
    }
    //document.getElementById('none').style.display = 'none';
    //document.getElementById('block').style.display = 'block';
}
function isCheck(){
    let check = document.querySelectorAll('input[type="checkbox"]');
    for(var i = 0; i < check.length; i++){
        check[i].onchange=checkOrNo;
    }
}

function showCatalog(dir){
    if (dir == null) {dir = '';}
    let r = 'list.php?r='+dir;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', r);
    xhr.onreadystatechange = function(){
        if (xhr.readyState !== 4 || xhr.status !== 200){
            return;
        }
        const resp = xhr.response;
        //alert(resp);
        //document.getElementById('list').innerHTML = resp;
        let jn = JSON.parse(resp);
        var str = '';
        if(jn['fr_a'] !== ''){
            jn['fr_a'].forEach(function(item, index, array){
                item = JSON.parse(item);
	            str += `<li><label><input type="checkbox" class="fr_checkbox checkbox" name="fld-check[]" value="`+item['folder']+`" ><span></span></label><a href="#" onclick="aClick('`+item['dir_r']+item['folder']+`'); return false;"><i class="fa fa-folder" aria-hidden="true"></i> `+item['folder']+`</a></li>`;
            });
        }
        document.getElementById('folders').innerHTML = str;
        str = '';
        if(jn['fl_a'] !== ''){
            jn['fl_a'].forEach(function(item, index, array){
                item = JSON.parse(item);
	            str += `<li><label><input type="checkbox" class="fl_checkbox checkbox" name="fl-check[]" value="`+item['file']+`"><span></span></label><i class="fa `+item['img']+`" aria-hidden="true"></i> `+item['file']+`</li>`;
            });
        }
        document.getElementById('files').innerHTML = str;
        str = '';
        //document.getElementById('demo').innerHTML = jn['rt'];
        var input = document.querySelector('#dir');
        input.value = jn['dir'];
        //var input = document.querySelector('#r');
        //input.value = jn['r'];
        isCheck();
        checkOrNo();
        
    }
    xhr.send();
}
showCatalog();

function reNew(){
    var str = '';
    document.getElementById('upload-result').innerHTML = str;
    let input = document.getElementById('r').value; // Извлекаем элемент input
    showCatalog(input);
}
function aClick(r){
    if(r == null){r = '';}
    if(r != ''){
        document.getElementById('back').style.display = 'block';
    }
    let input = document.querySelector('#r');
    input.value = r
    showCatalog(r);
}
function back(){
    let str = document.getElementById('r').value;
    let arr = str.split('/');
    arr.pop();
    str = arr.join('/');
    let input = document.querySelector('#r');
    input.value = str;
    if(str == ''){
        document.getElementById('back').style.display = 'none';
    }
    showCatalog(str);
}
function delFile(){
    let folders=document.getElementsByClassName('fr_checkbox');
    let files=document.getElementsByClassName('fl_checkbox');
    let path = document.querySelector('#dir').value;
    var fr_arr = [];
    var i = 0;
    for (let folder of folders){
        if (folder.checked){
            fr_arr[i] = path+folder.value;
            i++;
        }
    }
    var fl_arr = [];
    var i = 0;
    for (let file of files){
        if (file.checked){
            fl_arr[i] = path+file.value;
            i++;
        }
    }

    $.ajax({
	url: 'delete.php',         /* Куда пойдет запрос */
	method: 'post',             /* Метод передачи (post или get) */
	dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
	/*data: {text: arr},*/
    data:{'fr':fr_arr,'fl':fl_arr},/* Параметры передаваемые в запросе. */
	success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
		alert(data);            /* В переменной data содержится ответ от index.php. */
        reNew();
	}
});
}

function showWindow(name){
    if(name == 'fr_win'){
        document.querySelector('.fr_win').style.display = 'block';
        var input = document.querySelector('#addFolder');
        input.value = 'Папка';
    }
    if(name == 'fl_win'){
        document.querySelector('.fl_win').style.display = 'block';
        var input = document.querySelector('#addFile');
        input.value = 'Файл';
    }
}
function closeWindow(name){
    var win_name = [];
    win_name['file-result'] = '.file-result';
    win_name['folder'] = '.fr_win';
    win_name['file'] = '.fl_win';
    document.querySelector(win_name[name]).style.display = 'none';
    reNew();
}

function addFile(type){
    closeWindow(type);
    var add_type = [];
    add_type['folder'] = 'addFolder';
    add_type['file'] = 'addFile';
    let path = document.querySelector('#dir').value;
    let name = document.getElementById(add_type[type]).value;
    $.ajax({
	url: 'add.php',         /* Куда пойдет запрос */
	method: 'post',             /* Метод передачи (post или get) */
	dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
    data:{'type':type,'path':path,'name':name},/* Параметры передаваемые в запросе. */
	success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
		alert(data);            /* В переменной data содержится ответ от index.php. */
        reNew();
	}
    });
}

/*-----------------------*/
function preReName(){
    let folders=document.getElementsByClassName('fr_checkbox');
    let files=document.getElementsByClassName('fl_checkbox');
    let i = 0;
    for (let folder of folders){
        if (folder.checked){
            i++;
            if(i == 1){
                old_name = folder.value;
            }
        }
    }
    for (let file of files){
        if (file.checked){
            i++;
            if(i == 1){
                old_name = file.value;
            }
        }
    }
    if(i == 1){
        let input = document.querySelector('#rename_inp');
        input.value = old_name;
    }
}
function showPopUp(name){
    name = '.'+name;
    document.querySelector(name).style.display = 'block';
    preReName();
}
function closePopUp(name){
    name = '.'+name;
    document.querySelector(name).style.display = 'none';
}
function reName(){
    closePopUp('rename-pp');
    let path = document.querySelector('#dir').value;
    let folders=document.getElementsByClassName('fr_checkbox');
    let files=document.getElementsByClassName('fl_checkbox');
    let i = 0;
    for (let folder of folders){
        if (folder.checked){
            i++;
            if(i == 1){
                old_name = path+folder.value;
            }
        }
    }
    for (let file of files){
        if (file.checked){
            i++;
            if(i == 1){
                old_name = path+file.value;
            }
        }
    }
    if(i == 1){
        let rename = document.getElementById('rename_inp').value;
        let new_name = path+rename;
        $.ajax({
	        url: 'rename.php',         /* Куда пойдет запрос */
	        method: 'post',             /* Метод передачи (post или get) */
	        dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data:{'old':old_name,'new':new_name},/* Параметры передаваемые в запросе. */
	        success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
		        alert(data);            /* В переменной data содержится ответ от index.php. */
                reNew();
	        }
        });
    }
    else{
        alert('Выбрано больше одного файла')
    }
}