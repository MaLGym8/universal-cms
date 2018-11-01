<?php
//Добавление
function Add_Blog()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление поста</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
	 Вывод страницы:<br/>
        <label><input type="radio" name="type" value="0" checked>Вывод из базы</label>
        <label><input type="radio" name="type" value="1">Подключение файла</label>
        <label><input type="radio" name="type" value="2">Полностью файл</label><br/><br/>
    
	<div style="float:left">Категория:<br/>
        <select name="cat"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `blog_cats`  ORDER by title ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do {
        if ($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["title"]
                . '</option>';


        }


    } while ($resultC1 = mysql_fetch_array($queryC1));


    echo '</select></div>
	<div style="float:left; margin-left:25px;">
	Дата добавления:<br/>
    <input style="width:100%" type="text" name="date_add"/ value="'.date('Y-m-d G:i:s').'"></div>
	
	<br clear="all">
    

        SEO title:<br/>
        <input type="text" name="title" value=""/><br />   
		SEO meta-description<br/>
        <input type="text" name="meta_d" value=""/><br />
        SEO meta-keywords<br/>
        <input type="text" name="meta_k" value=""/><br /> 	
        <!--Текст в шапке:<br/>
        <input type="text" name="dop_title" value=""/><br />-->
		H1:<br/>
        <input type="text" name="h1" value=""/><br />		
        URL:<br/>
        <input type="text" name="url" value=""/><br />
        <br />

        Описание:<br/>
        <textarea name="desc" value="" class="tinymce"></textarea><br />
		
		

		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/>
			<input type="file" name="image"/></div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color"></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text"></div>				
		</div>
        

		
        <input type="submit" name="add_blog" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}






if(isset($_POST["add_blog"]))
{
    $title = $_POST["title"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $cat = $_POST["cat"];
    $desc = $_POST["desc"];
    $url = $_POST["url"];
    $h1 = $_POST["h1"];
    $dop_title = $_POST["dop_title"];
    $type = $_POST["type"];
    $date = $_POST["date_add"];

    $background_color = mysql_real_escape_string($_POST["background_color"]);
    $background_text = mysql_real_escape_string($_POST["background_text"]);


    if (!$url)
    {

            $url = translateURL($title);

    }
    $url = checkurl($url,"blog");


    mysql_query("INSERT INTO blog (`cat`,`title`,`meta_d`,`meta_k`,`text`,`url`,`h1`,`date_add`,`background_color`,`background_text`,`dop_title`,`type`,`public`) VALUES ('$cat','$title','$meta_d','$meta_k','$desc','$url','$h1','$date','$background_color','$background_text','$dop_title','$type','1')");

    $result = mysql_fetch_array(mysql_query("SELECT * FROM  `blog` ORDER by id DESC LIMIT 1"));
    $id = $result["id"];
    @mkdir("../files/blog/".$id, 0777);

    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        //$image->resizeToWidth(500);
        $image->save("../files/blog/$id/big" . $photo_img);
        //$image->load($_FILES['image']['tmp_name']);
        //$image->resizeToHeight(200);
        //$image->save("../files/blog/$id/small" . $photo_img);
        //$thumb = "files/blog/$id/small" .$photo_img;
		$thumb = "files/blog/$id/big" .$photo_img;
    }



    mysql_query("UPDATE blog SET `image`='$thumb' WHERE id=$id");

    $_SESSION["message"] = "Пост добавлен";
    echo '<script>window.location="index.php?page=show_blog";</script>';
    exit();
}