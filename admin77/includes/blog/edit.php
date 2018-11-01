<?php
//Редактирование каталога
function Edit_Blog($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `blog` WHERE id=$id"));



    echo '
    <article class="module width_full">
    <header><h3>Редактирование поста</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">



    Вывод страницы:<br/>
        <label><input type="radio" name="type"';if($result["type"]==0)echo' checked '; echo'value="0">Вывод из базы</label>
        <label><input type="radio" name="type"';if($result["type"]==1)echo' checked '; echo'value="1">Подключение файла</label>
        <label><input type="radio" name="type"';if($result["type"]==2)echo' checked '; echo' value="2">Полностью файл</label><br/><br/>

    <div style="float:left">Категория:<br/>
        <select name="cat"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `blog_cats`  ORDER by title ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do{

            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;"'; if($resultC1["id"]==$result["cat"])echo'selected'; echo'>' . $resultC1["title"] . '</option>';




    }while($resultC1 = mysql_fetch_array($queryC1));


    echo'</select></div>
	<div style="float:left; margin-left:25px;">
	Дата добавления:<br/>
    <input style="width:100%" type="text" name="date_add"/ value="'.$result["date_add"].'"></div>
	
	<br clear="all">


 SEO title:<br/>
        <input type="text" name="title" value="'.$result["title"].'"/><br /> 
        Title 2:<br/>
        <input type="text" name="titlee" value="'.$result["titlee"].'"/><br />  
        SEO meta-description<br/>
        <input type="text" name="meta_d" value="'.$result["meta_d"].'"/><br />
        SEO meta-keywords<br/>
        <input type="text" name="meta_k" value="'.$result["meta_k"].'"/><br /> 
		
		H1: <br/>
        <input type="text" name="h1" value="'.$result["h1"].'"/><br />
        
       <!-- Текст в шапке:<br/>
        <input type="text" name="dop_title" value="'.$result["dop_title"].'"/><br />-->
		
        URL:<br/>
        <input type="text" name="url" value="'.$result["url"].'"/><br />
        <br />



     

  

        Описание:<br/>
        <textarea name="desc" value="" class="tinymce">'.$result["text"].'</textarea><br />


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


        <input type="hidden" name="id" value="'.$result["id"].'" >
        <input type="submit" name="edit_blog" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';



}















if(isset($_POST["edit_blog"]))
{
    $id = $_POST["id"];
    $title = $_POST["title"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $cat = $_POST["cat"];
    $desc = $_POST["desc"];
    $h1 = $_POST["h1"];
    $dop_title = $_POST["dop_title"];
    $type = $_POST["type"];
    $date = $_POST["date_add"];
    $titlee = $_POST["titlee"];


    $background_color = mysql_real_escape_string($_POST["background_color"]);
    $background_text = mysql_real_escape_string($_POST["background_text"]);

    $url = $_POST["url"];


    if (!$url)
    {

            $url = translateURL($title);

    }
    $url = checkurl($url,"blog");


    mysql_query("UPDATE `blog` SET `cat`='$cat',`title`='$title',`meta_d`='$meta_d',`meta_k`='$meta_k',`text`='$desc',`url`='$url',  `h1`='$h1',`background_color`='$background_color',`background_text`='$background_text', `dop_title`='$dop_title', `type`='$type', `date_add`='$date', `titlee`='$titlee' WHERE id=$id");



    $result = mysql_fetch_array(mysql_query("SELECT * FROM  `blog` WHERE id=$id"));
    $id = $result["id"];
    @mkdir("../files/blog/".$id, 0777);

    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$result["image"]);
        @unlink("../".str_replace("small","big",$result["image"]));

        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        //$image->resizeToWidth(500);
        $image->save("../files/blog/$id/big" . $photo_img,IMAGETYPE_PNG);
        //$image->load($_FILES['image']['tmp_name']);
        //$image->resizeToHeight(200);
        //$image->save("../files/blog/$id/small" . $photo_img,IMAGETYPE_PNG);
        $thumb = "files/blog/$id/big" .$photo_img;
    }else{
        $thumb = $result["image"];
    }

    mysql_query("UPDATE `blog` SET `image`='$thumb' WHERE id=$id");

    $_SESSION["message"] = "Блог изменён";
    echo '<script>window.location="index.php?page=show_blog";</script>';
    exit();
}