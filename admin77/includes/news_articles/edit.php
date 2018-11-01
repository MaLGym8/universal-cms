<?php
//Редактирование новости
function Edit_News($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `news` WHERE id=$id"));
    echo '
    <article class="module width_full">
    <header><h3>Редактирование новости/статьи</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    <label><input type="radio" name="type" value="1"'; if($result["type"]==1)echo'checked'; echo'/> Новость</label>
    <label><input type="radio" name="type" value="2"'; if($result["type"]==2)echo'checked'; echo'/> Статья</label>
	
	
	&nbsp;&nbsp;&nbsp;&nbsp; Вкл/Выкл: <input type="checkbox" name="public" value="1"';
    if ($result["public"] == 1) {
        echo 'checked="checked"';
    }
    echo '/>
	
    <br/>
        Заголовок:<br/>
        <input type="text" name="title" value="' . $result["title"] . '"/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d" value="' . $result["meta_d"] . '"/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value="' . $result["meta_k"] . '"/><br />
        H1:<br/>
        <input type="text" name="h1" value="' . $result["h1"] . '"/><br />
        Текст:<br/>
        <textarea class="tinymce" name="text">' . $result["text"] . '</textarea><br/>';

    if ($result["image"]) {
        echo '<img class="delete_img" src="../' . $result["image"] . '" alt="' . $result["image"] . '"/><br/>';
    }

    echo '
        Изображение:<br/>
        <input type="file" name="image"/><br/>
        <input type="hidden" id="id" name="id" value="' . $result["id"] . '"/>

        <input type="hidden" id="img" name="img" value="' . $result["image"] . '"/>
        <input type="submit" name="edit_news" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}

//Редактирование новости/статьи
if(isset($_POST["edit_news"]))
{
    $id = $_POST["id"];
    $title = $_POST["title"];
    $meta_d = $_POST["meta_d"];
    $type = $_POST["type"];
    $meta_k = $_POST["meta_k"];
    $text = @mysql_escape_string($_POST["text"]);
    $datetime = date('Y-m-d')." ".date("G:i:s");
    $public = $_POST["public"];
    $img = $_POST["img"];
    $h1 = $_POST["h1"];


    if(!$url)
        $url = translateURL($title);

    $url = checkurl($url,"news_articles");



    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$img);
        @unlink("../".str_replace("small","big",$img));
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(150);
        //$image->crop(array(0, 0, 150, 150));
        $image->save("../files/news/small" . $photo_img);

        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(800);
        $image->save("../files/news/big" . $photo_img);

        $img = "files/news/small" .$photo_img;
    }

    mysql_query("UPDATE news SET `title`='$title', `meta_d`='$meta_d', `meta_k`='$meta_k', `text`='$text', `image`='$img', `public`='$public', `url`='$url', `type`='$type', `h1`='$h1' WHERE id=$id");

    $_SESSION["message"] = "Новость изменена";
    echo '<script>window.location="index.php?page=edit_news&id='.$id.'";</script>';
    exit();
}