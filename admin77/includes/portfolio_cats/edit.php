<?php

//Редактирование категории
function Edit_Portfolio_Cats($id = NULL)
{
    global $db;
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` WHERE id=$id"));

$tags = $db->read_all("SELECT * FROM `tags` WHERE services_id=$id");



    $tags = @implode(', ', array_map(function ($entry) {
        return $entry['name'];
    }, $tags));






    echo '
    <article class="module width_full">
    <header><h3>Редактирование категории портфолио</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    
 
    
    Подкатегория:<br/>
        <select name="parent"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=0  ORDER by position ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do{
        if($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;" '; if($result["parent"]== $resultC1["id"])echo'selected'; echo'>' . $resultC1["menu"] . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC1["id"] ."  ORDER by position ASC");
            $resultC2 = mysql_fetch_array($queryC2);
            do{
                if($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '"'; if($result["parent"]== $resultC2["id"])echo'selected'; echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["menu"]
                        . '</option>';
                    $queryC3 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC2["id"] ."  ORDER by position ASC");
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


    echo'</select><br/><!--
 Вывод страницы:<br/>
        <label><input type="radio" name="type"';if($result["type"]==0)echo' checked '; echo'value="0">Вывод из базы</label>
        <label><input type="radio" name="type"';if($result["type"]==1)echo' checked '; echo'value="1">Подключение файла</label>
        <label><input type="radio" name="type"';if($result["type"]==2)echo' checked '; echo' value="2">Полностью файл</label><br/><br/>-->
    
     Позиция:<br/>
        <input type="text" name="position" value="'.$result["position"].'" style="width: 75px;"/><br />
    
   
          Имя меню:<br/>
        <input type="text" name="menu_portfolio" value="'.$result["menu"].'"/><br />
        Title:<br/>
        <input type="text" name="title_portfolio" value="'.$result["title"].'"/><br />
         URL:<br/>
        <input type="text" name="url_portfolio" value="'.$result["url"].'"/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d_portfolio" value="'.$result["meta_d"].'"/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k_portfolio" value="'.$result["meta_k"].'"/><br />
        
        H1:<br/>
        <input type="text" name="h1_portfolio" value="'.$result["h1"].'"/><br />
        Описание:<br/>
        <textarea name="desc_portfolio" class="tinymce" value="">'.$result["desc"].'</textarea><br />
        Теги <small>(через запятую)</small>:<br/>
        <textarea name="tags">'.$tags.'</textarea><br/><br/>
        
             
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


        <input type="submit" name="edit_portfolio_cats" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}




//Редактирование категории
if(isset($_POST["edit_portfolio_cats"]))
{

    $id = $_POST["id"];
    $services_id = $_POST["services_id"];
    $parent = $_POST["parent"];

    $resultCat = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` WHERE id=$id"));


    $tags = $_POST["tags"];
    $TAGS = explode(",",$tags);

    $db->query("DELETE FROM `tags` WHERE `services_id`='$id'");


    if($TAGS)
    {
        foreach ($TAGS as $tag)
        {
            $tag = trim($tag);
            if($tag)
            {
                mysql_query("INSERT INTO `tags` (`services_id`,`name`) VALUES ('$id','$tag')");
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
    $type = $_POST["type"];
    $position = $_POST["position"];

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

    $url_portfolio = checkurl($url_portfolio,"services2");


    $PAGE = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` WHERE `id`='$id'"));

    $url_portfolio_file = GetPathPortfolio($id);
    @mkdir("../files/portfolio/".$url_portfolio_file."", 0777,true);


    if ($_FILES["image_portfolio"]['size'] != 0)
    {
        @unlink("../".$PAGE["background"]);

        $type = substr($_FILES['image_portfolio']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image_portfolio']['tmp_name']);
        $image->save("../files/portfolio/$url_portfolio_file/big" . $photo_img);

        $thumb = "files/portfolio/$url_portfolio_file/big" .$photo_img;
    }else{
        $thumb="";
    }



    mysql_query("UPDATE `portfolio_cat` SET `title`='$title_portfolio',`meta_d`='$meta_d_portfolio',`meta_k`='$meta_k_portfolio',`desc`='$desc_portfolio',`parent`='$parent', `url`='$url_portfolio',`menu`='$menu_portfolio',`h1`='$h1_portfolio', `background`='$thumb', `background_color`='$background_color_portfolio',`background_text`='$background_text_portfolio',`type`='$type',`position`='$position',`services_id`='$services_id' WHERE id='$id'");





    $_SESSION["message"] = "Категория изменена";
    echo'<script>window.location="index.php?page=show_portfolio_cats";</script>';
    exit();
}