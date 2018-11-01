<?php

function Add_Review()
{
	$date = date('Y-m-d');
    echo '
    <article class="module width_full">
    <header><h3>Добавление отзыва</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    Имя:<br/>
    <input type="text" name="name" value=""/><br />
    Контакт:<br/>
    <input type="text" name="link" value=""/><br />
    Услуга:<br/>
    <input type="text" name="type" value=""/><br />
    Дата:<br/>
    <input type="text" name="date" value="'.$date.'"/><br />
    Текст:<br/>
    <textarea class="tinymce" name="text"></textarea><br />
    <input type="file" name="image"/><br/>';

    echo'<br/>
    Опубликовано: <input type="checkbox" value="1" name="public" checked/><br/>


		
        <input type="submit" name="add_review" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}




if(isset($_POST["add_review"]))
{
    $name = htmlspecialchars(stripslashes($_POST["name"]));
    $link = htmlspecialchars(stripslashes($_POST["link"]));
    $text = $_POST["text"];
    $type1 = htmlspecialchars(stripslashes($_POST["type"]));
    $date = htmlspecialchars(stripslashes($_POST["date"]));
    $public = htmlspecialchars(stripslashes($_POST["public"]));

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
    }

    $db->query("INSERT INTO `comments` (`name`,`link`,`text`,`type`,`date`,`public`,`photo`) VALUES ('$name','$link','$text','$type1','$date','$public','$thumb')");

    echo '<script>window.location="index.php?page=reviews";</script>';
    exit();
}