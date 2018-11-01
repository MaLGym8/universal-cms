<?php 
include("../../../config.php");
$array	= $_POST['position'];

if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE images_content SET sort = " . $count . " WHERE id = " . $idval;
		mysql_query($query) or die('Ошибка');
		$count ++;	
	}
	echo 'Информация сохранена!';
}
?>