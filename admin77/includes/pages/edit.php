<?php
//Редактирование страницы
function Edit_Page($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `pages` WHERE id=$id"));



    echo '
    <article class="module width_full">
    <header><h3>Редактирование страницы</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">

    <p class="return" style="float:left"><a href="index.php?page=show_pages">Вернуться к страницам</a></p><br clear="all"/>



        Вывод страницы:<br/>
        <label><input type="radio" name="include_file"';if($result["include_file"]==0)echo' checked '; echo'value="0">Вывод из базы</label>
        <label><input type="radio" name="include_file"';if($result["include_file"]==1)echo' checked '; echo'value="1">Подключение файла</label>
        <label><input type="radio" name="include_file"';if($result["include_file"]==2)echo' checked '; echo' value="2">Полностью файл</label><br/><br/>

        Заголовок:<br/>
        <input type="text" name="title" value="' . $result["title"] . '"/><br />
        URL <small>(указать в php файле url=")</small>:<br/>
        <input type="text" name="url" value="' . $result["url"] . '"/><br />
		Краткое описание:<br/>
        <input type="text" name="meta_d" value="' . $result["meta_d"] . '"/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value="' . $result["meta_k"] . '"/><br />
        H1:<br/>
        <input type="text" name="h1" value="' . $result["h1"] . '"/><br />
        Текст:<br/>
        <textarea class="tinymce" name="text">' . $result["text"] . '</textarea><br />
        
		
		
		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/><input type="file" name="image"/><br/>';
			if ($result["background"]) {
			echo '<img width="100" class="delete_img" type="page" src="../' . $result["background"] . '" alt="' . $result["background"] . '"/><br/>'; }
			echo'</div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color" value="' . $result["background_color"] . '"/></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text" value="' . $result["background_text"] . '"/></div>				
		</div>
		
		
		
		
        <input type="hidden" name="id" value="' . $result["id"] . '"/>
        <input type="submit" name="edit_page" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Редактирование
if(isset($_POST["edit_page"]))
{
    $url = $_POST["url"];
    $title = mysql_real_escape_string($_POST["title"]);
    $meta_d = mysql_real_escape_string($_POST["meta_d"]);
    $meta_k = mysql_real_escape_string($_POST["meta_k"]);
    $text = mysql_real_escape_string($_POST["text"]);
    $include_file = mysql_real_escape_string($_POST["include_file"]);
    $h1 = mysql_real_escape_string($_POST["h1"]);
    $background_color = mysql_real_escape_string($_POST["background_color"]);
    $background_text = mysql_real_escape_string($_POST["background_text"]);
    $id = $_POST["id"];
    if (!$url)
    {
        $url = translateURL($title);
    }

    $url = checkurl($url,"pages");

$PAGE = mysql_fetch_array(mysql_query("SELECT * FROM `pages` WHERE `id`='$id'"));


    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$PAGE["background"]);
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image']['tmp_name']);
        $image->save("../files/pages/big" . $photo_img);

        $thumb = "files/pages/big" .$photo_img;
    }else{
        $thumb  = $PAGE["background"];
    }





    mysql_query("UPDATE pages SET `url`='$url',`title`='$title', `meta_d`='$meta_d', `meta_k`='$meta_k', `text`='$text', `include_file`='$include_file', `h1`='$h1', `background`='$thumb', `background_color`='$background_color', `background_text`='$background_text' WHERE id=$id");;

    $_SESSION["message"] = "Страница изменена";
    echo '<script>window.location="index.php?page=edit_page&id='.$id.'";</script>';
    exit();
}