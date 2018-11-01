<?php

//Редактирование категории
function Edit_Blog_Cats($id = NULL)
{
    global $db;
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `blog_cats` WHERE id=$id"));






    echo '
    <article class="module width_full">
    <header><h3>Редактирование категории блога</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    
    
		
		Название:<br/>
        <input type="text" name="name" value="'.$result["name"].'"/><br />
        URL:<br/>
        <input type="text" name="url" value="'.$result["url"].'"/><br />
		Title:<br/>
        <input type="text" name="title" value="'.$result["title"].'"/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d" value="'.$result["meta_d"].'"/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value="'.$result["meta_k"].'"/><br />
        H1:<br/>
        <input type="text" name="h1" value="'.$result["h1"].'"/><br />
        Текст:<br/>
        <textarea class="tinymce" name="text">'.$result["text"].'</textarea><br />
		
		
		Позиция:<br/>
        <input class="shortinput" type="text" name="position" value="' . $result["position"] . '"/><br/>
		
		
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
		
		
		

                <input type="hidden" name="id" value="'.$result["id"].'"/>


        <input type="submit" name="edit_blog_cats" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}




//Редактирование категории
if(isset($_POST["edit_blog_cats"]))
{
    $title = $_POST["title"];
    $url = $_POST["url"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $id = $_POST["id"];
    $h1 = $_POST["h1"];
    $position = $_POST["position"];
    $name = $_POST["name"];
    $text = $_POST["text"];

    $background_color = mysql_real_escape_string($_POST["background_color"]);
    $background_text = mysql_real_escape_string($_POST["background_text"]);

    if (!$url)
    {

        $url = translateURL($name);

    }

    $url = checkurl($url,"blogcats");

    $PAGE = mysql_fetch_array(mysql_query("SELECT * FROM `blog_cats` WHERE `id`='$id'"));

    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$PAGE["background"]);
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image']['tmp_name']);
        $image->save("../files/blog_cats/big" . $photo_img);

        $thumb = "files/blog_cats/big" .$photo_img;
    }else{
        $thumb = $PAGE["background"];
    }



    mysql_query("UPDATE `blog_cats` SET `title`='$title',`meta_d`='$meta_d',`meta_k`='$meta_k',`url`='$url', `h1`='$h1',`background`='$thumb', `background_color`='$background_color',`background_text`='$background_text',`position`='$position', `name`='$name',`text`='$text' WHERE id='$id'");






    $_SESSION["message"] = "Категория изменена";
    echo'<script>window.location="index.php?page=show_blog_cats";</script>';
    exit();
}