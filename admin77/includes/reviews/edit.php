<?php

function Edit_Review($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `comments` WHERE id=$id"));



    echo '
    <article class="module width_full">
    <header><h3>Редактирование отзыва</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    Имя:<br/>
    <input type="text" name="name" value="' . $result["name"] . '"/><br />
    Контакт:<br/>
    <input type="text" name="link" value="' . $result["link"] . '"/><br />
	Услуга:<br/>
    <input type="text" name="type" value="' . $result["type"] . '"/><br />
    Дата:<br/>
    <input type="text" name="date" value="' . $result["date"] . '"/><br />
    Текст:<br/>
    <textarea class="tinymce" name="text">' . $result["text"] . '</textarea><br />
    <input type="file" name="image"/><br/>';
    if($result["photo"])
    {
        echo "<img src='../files/reviews_photos/".$result["photo"]."'/>";
    }
    echo'<br/>
    Опубликовано: <input type="checkbox" value="1" name="public"'; if($result["public"]==1)echo'checked'; echo' /><br/>


		
        <input type="hidden" name="id" value="' . $result["id"] . '"/>
        <input type="submit" name="edit_review" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';

}



if(isset($_POST["edit_review"]))
{

    $name = htmlspecialchars(stripslashes($_POST["name"]));
    $link = htmlspecialchars(stripslashes($_POST["link"]));
    $text = $_POST["text"];
    $type1 = htmlspecialchars(stripslashes($_POST["type"]));
    $date = htmlspecialchars(stripslashes($_POST["date"]));
    $public = htmlspecialchars(stripslashes($_POST["public"]));
    $id = htmlspecialchars(stripslashes($_POST["id"]));
    $IMG = $db->read("SELECT * FROM `comments` WHERE `id`='$id'");




    if ($_FILES["image"]['size'] != 0)
    {


        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
		
			//Маленькая картинка
			$image->load($_FILES['image']['tmp_name']);
			if($Review_Small_Width) $image->resizeToWidth($Review_Small_Width);
			else $image->resizeToHeight($Review_Small_Heigth);
			$image->save("../files/reviews_photos/".$photo_img);
			
			//Большая картинка
			$image->load($_FILES['image']['tmp_name']);
			if($Review_Big_Width) $image->resizeToWidth($Review_Big_Width);
			else $image->resizeToHeight($Review_Big_Heigth);
			$image->save("../files/reviews_photos/full/".$photo_img);

        $thumb = $photo_img;

        @unlink("../files/reviews_photos/".$IMG["photo"]);
        @unlink("../files/reviews_photos/full/".$IMG["photo"]);
    }else{
        $thumb = $IMG["photo"];
    }

    $db->query("UPDATE `comments` SET `name`='$name', `link`='$link', `text`='$text', `photo`='$thumb', `type`='$type1', `date`='$date', `public`='$public' WHERE `id`='$id'");

    echo '<script>window.location="index.php?page=reviews";</script>';
    exit();

}