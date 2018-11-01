<?php
//Добавление страницы
function Add_Sale()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление акции</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
        Вывод страницы:<br/>
        <label><input type="radio" name="include_file" value="0" checked>Вывод из базы</label>
        <label><input type="radio" name="include_file" value="1">Подключение файла</label>
        <label><input type="radio" name="include_file" value="2">Полностью файл</label><br/><br/>
        
	    Название:<br/>
        <input type="text" name="name" value=""/><br />
        URL <small>(указать в php файле url=")</small>:<br/>
        <input type="text" name="url" value=""/><br />
		  Заголовок:<br/>
        <input type="text" name="title" value=""/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d" value=""/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value=""/><br />
        H1:<br/>
        <input type="text" name="h1" value=""/><br />
		
		Доп. текст:<br/>
        <input type="text" name="dop_text" value=""/><br />
		
        Текст:<br/>
        <textarea class="tinymce" name="text"></textarea><br />';
		
		$last = mysql_fetch_array(mysql_query("SELECT * FROM `sales` ORDER by position DESC LIMIT 1"));
    	$last = $last["position"]+1;
		
		echo 'Позиция: <input class="shortinput" type="text" name="position" value="'.$last.'"/><br />
		
		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/>
			<input type="file" name="image"/></div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color"></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text"></div>				
		</div>
		
        <input type="submit" name="add_sale" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Добавление
if(isset($_POST["add_sale"]))
{
    $title = mysql_real_escape_string($_POST["title"]);
    $url = $_POST["url"];
    $meta_d = mysql_real_escape_string($_POST["meta_d"]);
    $meta_k = mysql_real_escape_string($_POST["meta_k"]);
    $text = mysql_real_escape_string($_POST["text"]);
    $background_color = mysql_real_escape_string($_POST["background_color"]);
    $background_text = mysql_real_escape_string($_POST["background_text"]);
    $include_file = mysql_real_escape_string($_POST["include_file"]);
    $h1 = mysql_real_escape_string($_POST["h1"]);
	$position = mysql_real_escape_string($_POST["position"]);
	$dop_text = mysql_real_escape_string($_POST["dop_text"]);
    $name = mysql_real_escape_string($_POST["name"]);
    if (!$url)
    {
        $url = translateURL($name);
    }
    $url = checkurl($url,"sales");



    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image']['tmp_name']);
		        $image->resizeToWidth(500);

        $image->save("../files/sales/big" . $photo_img,IMAGETYPE_PNG);

        $thumb = "files/sales/big" .$photo_img;
    }


    mysql_query("INSERT INTO sales (`url`,`title`, `meta_d`, `meta_k`, `text`, `include_file`,`h1`,`background`,`background_color`,`background_text`,`name`,`position`,`dop_text`) VALUES ('$url','$title', '$meta_d', '$meta_k', '$text', '$include_file','$h1','$thumb','$background_color','$background_text','$name','$position','$dop_text')");






    $_SESSION["message"] = "Акция добавлена";
    echo '<script>window.location="index.php?page=show_sales";</script>';
    exit();
}