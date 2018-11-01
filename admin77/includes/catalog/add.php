<?php
//Добавление
function Add_Catalog()
{
    global $db;
    echo '
    <article class="module width_full">
    <header><h3>Добавление товара</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return CheckFormCatalog();">
	
	    Вывод страницы:<br/>
        <label><input type="radio" name="public" value="0" checked>Вывод из базы</label>
        <label><input type="radio" name="public" value="1">Подключение файла</label>
        <label><input type="radio" name="public" value="2">Полностью файл</label><br/><br/>

        Title:<br/>
        <input type="text" name="title" value=""/><br />  
       
        <div style="float:left;">
        Название товара:<br/>
        <input type="text" style="width: 275px;" name="name" value=""/><br /></div>
         <div  style="float:left;margin-left:30px;">
        URL:<br/>
        <input type="text" style="width: 275px;" name="url" value=""/><br /></div>
      <br clear="all"/>
        Краткое описание:<br/>
        <input type="text" name="meta_d" value=""/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value=""/><br /> 
        H1:<br/>
        <input type="text" name="h1" value=""/><br />

		
        <div style="float:left">Категория:<br/>
        <select name="cat"><option value="0">Выберите категорию</option> ';

    $queryC1 = mysql_query("SELECT * FROM `catalog_cat`  WHERE parent=0  ORDER by title ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do {
        if ($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["title"]
                . '</option>';

            $queryC2 = mysql_query(
                "SELECT * FROM `catalog_cat`  WHERE parent=" . $resultC1["id"] . "  ORDER by title ASC"
            );
            $resultC2 = mysql_fetch_array($queryC2);
            do {
                if ($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["title"]
                        . '</option>';
                    $queryC3 = mysql_query(
                        "SELECT * FROM `catalog_cat`  WHERE parent=" . $resultC2["id"] . "  ORDER by title ASC"
                    );
                    $resultC3 = mysql_fetch_array($queryC3);
                    do {
                        if ($resultC3) {
                            echo '<option value="' . $resultC3["id"]
                                . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-'
                                . $resultC3["title"]
                                . '</option>';
                        }
                    } while ($resultC3 = mysql_fetch_array($queryC3));


                }
            } while ($resultC2 = mysql_fetch_array($queryC2));
        }


    } while ($resultC1 = mysql_fetch_array($queryC1));


    echo '</select></div>
        
		<div style="float:left; margin-left:30px;">Позиция:<br/>
        <input type="text" name="position" value="" style="width: 75px;"/></div>
		<br clear="all">';
		
		if (CATALOGTYPE == 1)
    {
       echo' <div style="float:left">
		Стоимость:<br/>
        <input type="text" name="coast" value="" style="width: 175px;"/>
		</div>
		
		<div style="float:left; margin-left:30px;">
		Стоимость до скидки:<br/>
        <input type="text" name="coast_old" value="" style="width: 175px;"/>
		</div>
		<br clear="all">';
    }
		
		
		
		
		echo 'Краткое описание товара:<br/>
        <input type="text" name="dopdesc" value="" style="height:20px;"><br />

        Описание:<br/>
        <textarea name="desc" value="" class="tinymce"></textarea><br />';

    echo'<b>Подарки:</b><br/>';
    $gifts = $db->read_all("SELECT * FROM `catalog_gift` ORDER by id DESC");

    if ($gifts)
    {
        foreach($gifts as $gift)
        {


            echo "<label class='gift'>".$gift["title"]."<br/><img width='70' src='../".$gift["image"]."'/><br/><input type='checkbox' name='gifts[]' value='".$gift["id"]."' /></label>";
        }
    }
    echo'<br clear="all"/>';



    
        echo'
        
        Изображение:<br/>
        <input type="file" name="image"/><br/>
        Галерея:<br clear="all"/>
        <input multiple="multiple" type="file" name="photos[]"/><br/>


		
        <input type="submit" name="add_catalog" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}






if(isset($_POST["add_catalog"]))
{
    $title = $_POST["title"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $cat = $_POST["cat"];
    $desc = $_POST["desc"];
    $position = $_POST["position"];
    $coast = $_POST["coast"];
    $coast_old = $_POST["coast_old"];
    $url = $_POST["url"];
    $public = $_POST["public"];
    $h1 = $_POST["h1"];
    $dopdesc = $_POST["dopdesc"];
    $name = $_POST["name"];

    if (!$url)
    {
        if($name)
            $url = translateURL($name);
        else
            $url = translateURL($title);

    }
    $url = checkurl($url,"catalog");


    mysql_query("INSERT INTO catalog (`cat`,`title`,`meta_d`,`meta_k`,`desc`,`coast`,`position`,`url`,`public`,`h1`,`coast_old`,`dopdesc`,`name`) VALUES ('$cat','$title','$meta_d','$meta_k','$desc','$coast','$position','$url','$public','$h1','$coast_old','$dopdesc','$name')");

    $result = mysql_fetch_array(mysql_query("SELECT * FROM  `catalog` ORDER by id DESC LIMIT 1"));
    $id = $result["id"];
    @mkdir("../files/catalog/".$id, 0777);
	
	// Главное изображение
    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(1000);
        $image->save("../files/catalog/$id/big" . $photo_img);
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(300);
        $image->save("../files/catalog/$id/small" . $photo_img);
        $thumb = "files/catalog/$id/small" .$photo_img;
    }
	
	// Доп. изображения
    $photosAll = "";
    if($_FILES["photos"]["name"])
        foreach($_FILES["photos"]["name"] as $keys=>$item)
        {

            if( $_FILES["photos"]['size'][$keys])
            {
                $type = substr(
                    $_FILES["photos"]['name'][$keys], strrpos($_FILES["photos"]['name'][$keys], '.') + 1
                );
                $photo_img = md5(date('YmdHis') . rand(100, 1000));
                $photo_img_big = $photo_img . "_big." . $type;
                $photo_img = $photo_img . "_small." . $type;

                $image = new CHImage();
                $image->load($_FILES["photos"]['tmp_name'][$keys]);
                $image->resizeToWidth(1000);
                $image->save("../files/catalog/$id/" . $photo_img_big);
                $image->load($_FILES["photos"]['tmp_name'][$keys]);
                $image->resizeToWidth(150);
                $image->save("../files/catalog/$id/" . $photo_img);
                $photosAll .= " files/catalog/$id/" . $photo_img;
            }
        }


    mysql_query("UPDATE catalog SET `image`='$thumb', `photos`='$photosAll' WHERE id=$id");

    $gifts = $_POST["gifts"];

    if($gifts)
    {
        foreach($gifts as $gift)
        {
            mysql_query("INSERT INTO `catalog_gift_products` (`catalog_id`,`gift_id`) VALUES ('$id','$gift')");
        }
    }


    $_SESSION["message"] = "Товар добавлен";
    echo '<script>window.location="index.php?page=show_catalog";</script>';
    exit();
}