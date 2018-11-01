<?php
//Добавление категории
function Add_blog_cats()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление категории блога</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">        
    
        
        
		Название:<br/>
        <input type="text" name="name" value=""/><br />
        URL:<br/>
        <input type="text" name="url" value=""/><br />
		Title:<br/>
        <input type="text" name="title" value=""/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d" value=""/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value=""/><br />
        H1:<br/>
        <input type="text" name="h1" value=""/><br />
		 Текст:<br/>
        <textarea class="tinymce" name="text"></textarea><br />
 
 
 		Позиция:<br/>
        <input class="shortinput" type="text" name="position" value="' . $result["position"] . '"/><br/>      

		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/>
			<input type="file" name="image"/></div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color"></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text"></div>				
		</div>



        
          

		
        <input type="submit" name="add_blog_cats" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Добавление категории
if(isset($_POST["add_blog_cats"]))
{
    $title = $_POST["title"];
    $url = $_POST["url"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
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

    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image']['tmp_name']);
        $image->save("../files/blog_cats/big" . $photo_img);

        $thumb = "files/blog_cats/big" .$photo_img;
    }




    mysql_query("INSERT INTO `blog_cats` (`title`,`meta_d`,`meta_k`,`h1`,`url`,`background`,`background_color`,`background_text`,`public`,`position`,`name`,`text`) VALUES ('$title','$meta_d','$meta_k','$h1','$url','$thumb','$background_color','$background_text','1','$position','$name','$text')");






    $_SESSION["message"] = "Категория добавлена";
    echo'<script>window.location="index.php?page=show_blog_cats";</script>';
    exit();
}