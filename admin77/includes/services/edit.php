<?php

//Редактирование категории
function Edit_services_cats($id = NULL)
{
    global $db;
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `services` WHERE id=$id"));
    $result2 = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` WHERE services_id=$id"));
$tags = $db->read_all("SELECT * FROM `tags` WHERE services_id=$id");



    $tags = @implode(', ', array_map(function ($entry) {
        return $entry['name'];
    }, $tags));






    echo '
    <article class="module width_full">
    <header><h3>Редактирование услуги</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    
    
    Подкатегория:<br/>
        <select name="parent"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `services`  WHERE parent=0  ORDER by position");
    $resultC1 = mysql_fetch_array($queryC1);

    do{
        if($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;" '; if($result["parent"]== $resultC1["id"])echo'selected'; echo'>' . $resultC1["menu"] . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `services`  WHERE parent=". $resultC1["id"] ." ORDER by position");
            $resultC2 = mysql_fetch_array($queryC2);
            do{
                if($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '"'; if($result["parent"]== $resultC2["id"])echo'selected'; echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["menu"]
                        . '</option>';
                    $queryC3 = mysql_query("SELECT * FROM `services`  WHERE parent=". $resultC2["id"] ." ORDER by position");
                    $resultC3 = mysql_fetch_array($queryC3);
                    do{
                        if($resultC3)
                        {
                            echo '<option value="' . $resultC3["id"] . '" '; if($result["parent"]== $resultC3["id"])echo'selected'; echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC3["menu"]
                            . '</option>';
                        }
                    }while($resultC3 = mysql_fetch_array($queryC3));


                }
            }while($resultC2 = mysql_fetch_array($queryC2));
        }





    }while($resultC1 = mysql_fetch_array($queryC1));


    echo'</select><br/>
    
     Позиция:<br/>
        <input type="text" name="position" value="'.$result["position"].'" style="width: 75px;"/><br />
    
        Вывод страницы:<br/>
        <label><input type="radio" name="public"';if($result["type"]==0)echo' checked '; echo'value="0">Вывод из базы</label>
        <label><input type="radio" name="public"';if($result["type"]==1)echo' checked '; echo'value="1">Подключение файла</label>
        <label><input type="radio" name="public"';if($result["type"]==2)echo' checked '; echo' value="2">Полностью файл</label><br/><br/>
 
         Текст вместо ссылки: <input type="checkbox" name="type_text" value="1" ';if($result["type_text"]==1)echo' checked '; echo'/><br/><br/>

        Имя меню:<br/>
        <input type="text" name="menu" value="'.$result["menu"].'"/><br />
        Title:<br/>
        <input type="text" name="title" value="'.$result["title"].'"/><br />
         URL:<br/>
        <input type="text" name="url" value="'.$result["url"].'"/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d" value="'.$result["meta_d"].'"/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value="'.$result["meta_k"].'"/><br />
        
        H1:<br/>
        <input type="text" name="h1" value="'.$result["h1"].'"/><br />
        Краткое описание услуги:<br/>
        <input type="text" name="small_desc" value="'.$result["small_desc"].'"/><br />
        Описание:<br/>
        <textarea name="desc" class="tinymce" value="">'.$result["desc"].'</textarea><br />
 
 
        
		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/><input type="file" name="image"/><br/>';
			if ($result["background"]) {
			echo '<img width="100" type="backserv" class="delete_img" type="page" src="../' . $result["background"] . '" alt="' . $result["background"] . '"/><br/>'; }
			echo'</div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color" value="' . $result["background_color"] . '"/></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text" value="' . $result["background_text"] . '"/></div>	
						<br clear="all"/><br/>Превью-изображение:<br/>
						<input type="file" name="mainimage" />';
			if ($result["image"]) {
			echo '<br/><img width="100" type="imageserv" class="delete_img" type="page" src="../' . $result["image"] . '" alt="' . $result["image"] . '"/><br/>'; }
			echo'
						
		</div>

        

        
                <input type="hidden" name="id" value="'.$result["id"].'"/>


        <input type="submit" name="Edit_services_cats" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}




//Редактирование категории
if(isset($_POST["Edit_services_cats"]))
{
    $title = $_POST["title"];
    $url = $_POST["url"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $parent = $_POST["parent"];
    $desc = $_POST["desc"];
    $position = $_POST["position"];
    $type = $_POST["public"];
    $id = $_POST["id"];
    $resultCat = mysql_fetch_array(mysql_query("SELECT * FROM `services` WHERE id=$id"));

    $background_color = mysql_real_escape_string($_POST["background_color"]);
    $background_text = mysql_real_escape_string($_POST["background_text"]);


    $tags = $_POST["tags"];
    $type_text = $_POST["type_text"];
    $TAGS = explode(",",$tags);

    $menu = $_POST["menu"];
    $h1 = $_POST["h1"];
    $small_desc = $_POST["small_desc"];

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


    $PAGE = mysql_fetch_array(mysql_query("SELECT * FROM `services` WHERE `id`='$id'"));


    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$PAGE["background"]);
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image']['tmp_name']);
        $image->save("../files/services/big" . $photo_img);

        $thumb = "files/services/big" .$photo_img;
    }else{
        $thumb  = $PAGE["background"];
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
    }else{
        $image_ser  = $PAGE["image"];
    }

    mysql_query("UPDATE `services` SET `title`='$title',`meta_d`='$meta_d',`meta_k`='$meta_k',`desc`='$desc',`background`='$thumb',`parent`='$parent',`position`='$position', `url`='$url',`menu`='$menu',`h1`='$h1', `type`='$type', `background_color`='$background_color',`background_text`='$background_text', `small_desc`='$small_desc', `image`='$image_ser', `type_text`='$type_text' WHERE id='$id'");


    $_SESSION["message"] = "Категория изменена";
    echo'<script>window.location="index.php?page=show_services_cats";</script>';
    exit();
}