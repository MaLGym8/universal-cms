<?php
//Добавление категории
function Add_services_cats()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление услуги</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">        
        
        Подкатегория:<br/>
        <select name="parent"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `services`  WHERE parent=0  ORDER by position");
    $resultC1 = mysql_fetch_array($queryC1);

    do{
        if($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["menu"] . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `services`  WHERE parent=". $resultC1["id"] ."  ORDER by position");
            $resultC2 = mysql_fetch_array($queryC2);
            do{
                if($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["menu"]
                        . '</option>';
                    $queryC3 = mysql_query("SELECT * FROM `services`  WHERE parent=". $resultC2["id"] ."  ORDER by position");
                    $resultC3 = mysql_fetch_array($queryC3);
                    do{
                        if($resultC3)
                        {
                            echo '<option value="' . $resultC3["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC3["menu"]
                                . '</option>';
                        }
                    }while($resultC3 = mysql_fetch_array($queryC3));


                }
            }while($resultC2 = mysql_fetch_array($queryC2));
        }





    }while($resultC1 = mysql_fetch_array($queryC1));

	  $pos = mysql_fetch_array(mysql_query("SELECT * FROM `services`   ORDER by position DESC LIMIT 1"));
	  $pos = $pos["position"]+1;
    echo'</select>
        <br/>
        Позиция:<br/>
        <input type="text" name="position" value="'. $pos .'" style="width: 75px;"/><br />
    
    
    

        Вывод страницы:<br/>
        <label><input type="radio" name="public" value="0" checked>Вывод из базы</label>
        <label><input type="radio" name="public" value="1">Подключение файла</label>
        <label><input type="radio" name="public" value="2">Полностью файл</label><br/><br/>
        Текст вместо ссылки: <input type="checkbox" name="type_text" value="1"/><br/><br/>
        Имя меню:<br/>
        <input type="text" name="menu" value=""/><br />
        Title:<br/>
        <input type="text" name="title" value=""/><br />
        URL:<br/>
        <input type="text" name="url" value=""/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d" value=""/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value=""/><br />
        H1:<br/>
        <input type="text" name="h1" value=""/><br />
        Краткое описание услуги:<br/>
        <input type="text" name="small_desc" value=""/><br />

        

        Описание:<br/>
        <textarea name="desc" class="tinymce" value=""></textarea><br />
        
		
		
		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/>
			<input type="file" name="image"/></div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color"></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text"></div>		
					<br clear="all"/><br/>Превью-изображение:<br/>
						<input type="file" name="mainimage" />
		</div>

       
       <!-- Теги <small>(через запятую)</small>:<br/>
        <textarea name="tags"></textarea><br/>-->
        


		
        <input type="submit" name="Add_services_cats" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Добавление категории
if(isset($_POST["Add_services_cats"]))
{

    $title = $_POST["title"];
    $url = $_POST["url"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $parent = $_POST["parent"];
    $desc = $_POST["desc"];
    $position = $_POST["position"];
    $menu = $_POST["menu"];
    $h1 = $_POST["h1"];
    $small_desc = $_POST["small_desc"];
    $type = $_POST["public"];
    $tags = $_POST["tags"];
    $type_text = $_POST["type_text"];

    if(!$title)
        $title = $menu;

    $background_color = mysql_real_escape_string($_POST["background_color"]);
    $background_text = mysql_real_escape_string($_POST["background_text"]);
    $TAGS = explode(",",$tags);

    if (!$url)
    {
        if($menu)
        {
            $url = translateURL($menu);
        }else{

            $url = translateURL($title);
        }
    }
    $url = checkurl($url,"services");


    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image']['tmp_name']);
        $image->save("../files/services/big" . $photo_img);

        $thumb = "files/services/big" .$photo_img;
    }

    if ($_FILES["mainimage"]['size'] != 0)
    {
        @unlink("../".$PAGE["image"]);
        $type = substr($_FILES['mainimage']['name'], strrpos($_FILES['mainimage']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['mainimage']['tmp_name']);
        $image->save("../files/services/big" . $photo_img);

        $image_ser = "files/services/big" .$photo_img;
    }


    mysql_query("INSERT INTO `services` (`title`,`meta_d`,`meta_k`,`desc`,`parent`,`position`,`url`,`menu`,`h1`,`type`,`background`,`background_color`,`background_text`,`public`,`small_desc`,`image`,`type_text`) VALUES ('$title','$meta_d','$meta_k','$desc','$parent','$position','$url','$menu','$h1','$type','$thumb','$background_color','$background_text','1','$small_desc','$image_ser','$type_text')");

   /* $lastid = mysql_fetch_array(mysql_query("SELECT * FROM `services` ORDER by id DESC LIMIT 1"));
    $lastid = $lastid["id"];
    if($TAGS)
    {
        foreach ($TAGS as $tag)
        {
            $tag = trim($tag);
            if($tag)
            {
                mysql_query("INSERT INTO `tags` (`services_id`,`name`) VALUES ('$lastid','$tag')");
            }
        }
    }

    $title_portfolio = $_POST["title_portfolio"];
    $url_portfolio = $_POST["url_portfolio"];
    $meta_d_portfolio = $_POST["meta_d_portfolio"];
    $meta_k_portfolio = $_POST["meta_k_portfolio"];
    $desc_portfolio = $_POST["desc_portfolio"];
    $menu_portfolio = $_POST["menu_portfolio"];
    $h1_portfolio = $_POST["h1_portfolio"];

    $background_color_portfolio = mysql_real_escape_string($_POST["background_color_portfolio"]);
    $background_text_portfolio = mysql_real_escape_string($_POST["background_text_portfolio"]);


    if (!$url_portfolio)
    {
        if($menu_portfolio)
        {
            $url_portfolio = translateURL($menu_portfolio);
        }else{

            $url_portfolio = translateURL($title_portfolio);
        }
    }

    if ($_FILES["image_portfolio"]['size'] != 0)
    {
        $type = substr($_FILES['image_portfolio']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image_portfolio']['tmp_name']);
        $image->save("../files/services/big" . $photo_img);

        $thumb = "files/services/big" .$photo_img;
    }else{
        $thumb="";
    }


    $url_portfolio = checkurl($url_portfolio,"services2");
    if(!$title_portfolio)$title_portfolio=$title;
    if(!$url_portfolio)$url_portfolio=$url;
    if(!$meta_d_portfolio)$meta_d_portfolio=$meta_d;
    if(!$meta_k_portfolio)$meta_k_portfolio=$meta_k;
    if(!$desc_portfolio)$desc_portfolio=$desc;
    if(!$menu_portfolio)$menu_portfolio=$menu;
    if(!$h1_portfolio)$h1_portfolio=$h1;





    mysql_query("INSERT INTO `portfolio_cat` (`title`,`meta_d`,`meta_k`,`desc`,`url`,`menu`,`h1`,`services_id`,`parent`,`background`,`background_color`,`background_text`,`public`) VALUES ('$title_portfolio','$meta_d_portfolio','$meta_k_portfolio','$desc_portfolio','$url_portfolio','$menu_portfolio','$h1_portfolio','$lastid','$parent','$thumb','$background_color','$background_text','0')");



*/

    $_SESSION["message"] = "Категория добавлена";
    echo'<script>window.location="index.php?page=show_services_cats";</script>';
    exit();
}