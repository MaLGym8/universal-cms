<?php
//Редактирование каталога
function Edit_Catalog($id = NULL)
{
    global $db;
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `catalog` WHERE id=$id"));

    if ($result["public"] == 1) {
        $chkd = "checked";
        $public2 = "<b style='color:green'>БД</b>/.php";
    } else {
        $public2 = "БД/<b style='color:blue'>.php</b>";
    }

    echo '
    <article class="module width_full">
    <header><h3>Редактирование товара</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return CheckFormCatalog();">


 Вывод страницы:<br/>
        <label><input type="radio" name="public"';
    if ($result["public"] == 0) {
        echo ' checked ';
    }
    echo 'value="0">Вывод из базы</label>
        <label><input type="radio" name="public"';
    if ($result["public"] == 1) {
        echo ' checked ';
    }
    echo 'value="1">Подключение файла</label>
        <label><input type="radio" name="public"';
    if ($result["public"] == 2) {
        echo ' checked ';
    }
    echo ' value="2">Полностью файл</label><br/><br/>



        Title:<br/>
        <input type="text" name="title" value="' . $result["title"] . '"/><br />
        
        <div style="float:left;">
        Название товара:<br/>
        <input type="text"  style="width: 275px;" name="name" value="' . $result["name"] . '"/><br /></div>
         <div  style="float:left;margin-left:30px;">
        URL:<br/>
        <input type="text" style="width: 275px;" name="url" value="' . $result["url"] . '"/><br /></div><br clear="all"/>
        Краткое описание:<br/>
        <input type="text" name="meta_d" value="' . $result["meta_d"] . '"/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value="' . $result["meta_k"] . '"/><br />
        H1:<br/>
        <input type="text" name="h1" value="' . $result["h1"] . '"/><br />

        <div style="float:left">Категория:<br/>
        <select name="cat"><option value="0">Выберите категорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `catalog_cat`  WHERE parent=0  ORDER by title ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do {
        if ($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;"';
            if ($resultC1["id"] == $result["cat"]) {
                echo 'selected';
            }
            echo '>' . $resultC1["title"] . '</option>';

            $queryC2 = mysql_query(
                "SELECT * FROM `catalog_cat`  WHERE parent=" . $resultC1["id"] . "  ORDER by title ASC"
            );
            $resultC2 = mysql_fetch_array($queryC2);
            do {
                if ($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '" ';
                    if ($resultC2["id"] == $result["cat"]) {
                        echo 'selected';
                    }
                    echo '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["title"]
                        . '</option>';
                    $queryC3 = mysql_query(
                        "SELECT * FROM `catalog_cat`  WHERE parent=" . $resultC2["id"] . "  ORDER by title ASC"
                    );
                    $resultC3 = mysql_fetch_array($queryC3);
                    do {
                        if ($resultC3) {
                            echo '<option ';
                            if ($resultC3["id"] == $result["cat"]) {
                                echo 'selected';
                            }
                            echo ' value="' . $resultC3["id"]
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
        <input type="text" name="position" value="' . $result["position"] . '" style="width: 75px;"/></div>
		<br clear="all">';
		
		
		
		if (CATALOGTYPE == 1) {
			echo' <div style="float:left">
		Стоимость:<br/>
        <input type="text" name="coast" value="' . $result["coast"] . '" style="width: 175px;"/>
		</div>
		
		<div style="float:left; margin-left:30px;">
		Стоимость до скидки:<br/>
        <input type="text" name="coast_old" value="' . $result["coast_old"] . '" style="width: 175px;"/>
		</div>
		<br clear="all">';	
    }
		echo'<h2>Опции</h2>';

		$Options = $db->read_all("SELECT * FROM `options_catalog` ORDER by name ASC");

		if($Options)
        {
            foreach ($Options as $option)
            {
                echo'<div class="option-select"><h4>'.$option["name"].'</h4>';

                $values = $db->read_all("SELECT * FROM `options_values` WHERE `option_id`='".$option["id"]."'");
                if($values)
                {
                    echo '<select name="values['.$option["id"].'][]" multiple>';
                    echo '<option value=""/></option>';

                    foreach ($values as $value)
                    {
                        $check = $db->read("SELECT * FROM `options_products` WHERE `catalog_id`='$id' and `value_id`='".$value["id"]."'");
                        echo '<option value="'.$value["id"].'"'; if($check)echo"selected"; echo'/>'.$value["name"].'</option>';
                    }
                    echo '</select>';

                }


                echo'</div>';
            }
        }




		
		echo '
    
<br clear="all"/>









Краткое описание товара:<br/>
        <input type="text" name="dopdesc" value="' . $result["dopdesc"] . '" style="height:20px;"><br />

        Описание:<br/>
        <textarea name="desc" value="" class="tinymce">' . $result["desc"] . '</textarea><br />';



    echo'<b>Подарки:</b><br/>';
    $gifts = $db->read_all("SELECT * FROM `catalog_gift` ORDER by id DESC");

    if ($gifts)
    {
        foreach($gifts as $gift)
        {
            $check = $db->read("SELECT * FROM `catalog_gift_products` WHERE `catalog_id`='$id' AND `gift_id`='".$gift["id"]."'");

            echo "<label class='gift'>".$gift["title"]."<br/><img width='70' src='../".$gift["image"]."'/><br/><input type='checkbox' name='gifts[]'"; if($check){echo" checked ";} echo" value='".$gift["id"]."' /></label>";
        }
    }
    echo'<br clear="all"/>';








    
    echo '
        Изображение:<br/>';
    if ($result["image"]) {
        echo "<img width='70' src='../" . $result["image"] . "'/>";
    }
    echo '
        <input type="file" name="image"/><br/>
        Галерея:<br clear="all"/>';

    $photos = explode(" ", $result["photos"]);

    foreach ($photos as $item) {
        if ($item) {
            echo '<img class="delete_img1" img="' . $item . '" width="50" src="../' . $item . '"/>';
        }
    }


    echo '<br clear="all"/>
        <input multiple="multiple" type="file" name="photos[]"/><br/>
        <input type="hidden" name="id" value="' . $result["id"] . '" >

        
        <input type="submit" name="edit_catalog" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';

    ?>
    <script>
        $(document).ready(function(){

            $(".delete_img1").click(function(){
				 if(confirm("Удалить фото?"))
				 {
                $(this).remove();
                var img = $(this).attr("img");
                var id = $("input[name='id']").val();

                if(img&&id)
                {
                    dataString = {deleteimg:img,id:id};
                    $.ajax({
                        type: "POST",
                        async:false,
                        dataType:'json',
                        url: "/libs/ajax/catalog.php",
                        data:dataString,
                        cache:false,
                        success:function(html)
                        {
                        }
                    });
                }
				}
		});

        });
    </script>

    <?
}















if(isset($_POST["edit_catalog"]))
{





    $id = $_POST["id"];
    $title = $_POST["title"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $cat = $_POST["cat"];
    $desc = $_POST["desc"];
    $position = $_POST["position"];
    $coast = $_POST["coast"];
    $coast_old = $_POST["coast_old"];
    $dopdesc = $_POST["dopdesc"];
    $h1 = $_POST["h1"];
    $url = $_POST["url"];
    $public = $_POST["public"];
    $name = $_POST["name"];

    $values = $_POST["values"];
    if($values)
    {
        mysql_query("DELETE FROM options_products WHERE `catalog_id`='$id'");
        foreach ($values as $key=>$value)
        {
            if($value)
            {
                foreach ($value as $key2=>$value2) {



                    mysql_query("INSERT INTO `options_products` (`catalog_id`,`option_id`,`value_id`) VALUES ($id,$key,$value2)");


               }
            }


        }
    }




    if (!$url)
    {
        if($name)
            $url = translateURL($name);
        else
            $url = translateURL($title);

    }
    $url = checkurl($url,"catalog");



    mysql_query("DELETE FROM `catalog_gift_products` WHERE `catalog_id`='$id'");
    $gifts = $_POST["gifts"];

    if($gifts)
    {
        foreach($gifts as $gift)
        {
            mysql_query("INSERT INTO `catalog_gift_products` (`catalog_id`,`gift_id`) VALUES ('$id','$gift')");
        }
    }




    mysql_query("UPDATE `catalog` SET `cat`='$cat',`title`='$title',`meta_d`='$meta_d',`meta_k`='$meta_k',`desc`='$desc',`coast`='$coast',`coast_old`='$coast_old',`position`='$position',`url`='$url', `public`='$public', `h1`='$h1', `dopdesc`='$dopdesc', `name`='$name' WHERE id=$id");



    $result = mysql_fetch_array(mysql_query("SELECT * FROM  `catalog` WHERE id=$id"));
    $id = $result["id"];
    @mkdir("../files/catalog/".$id, 0777);

	// Главное изображение
    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$result["image"]);
        @unlink("../".str_replace("small","big",$result["image"]));

        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(1000);
        $image->save("../files/catalog/$id/big" . $photo_img);
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToHeight(300);
        $image->save("../files/catalog/$id/small" . $photo_img);
        $thumb = "files/catalog/$id/small" .$photo_img;
    }else{
        $thumb = $result["image"];
    }



    // Доп. изображения
    $photosAll = $result["photos"];
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


    mysql_query("UPDATE `catalog` SET `image`='$thumb', `photos`='$photosAll' WHERE id=$id");

    $_SESSION["message"] = "Товар изменён";
    echo '<script>window.location="index.php?page=show_catalog";</script>';
    exit();
}