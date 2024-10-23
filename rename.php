<?php
$oldName = !empty($_POST['old']) ? $_POST['old'] : '';
$newName = !empty($_POST['new']) ? $_POST['new'] : '';
echo $oldName.'-'.$newName;
rename($oldName, $newName);
?>