<?php
//Добавление новости
function Add_News()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление новости/статьи</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    
    <label><input type="radio" name="type" value="1" checked/> Новость/Статья</label>
    <label><input type="radio" name="type" value="2"/> Статья</label>
	&nbsp;&nbsp;&nbsp;&nbsp; Вкл/Выкл: <input type="checkbox" name="public" value="1"/ checked><br/>
        Заголовок:<br/>
        <input type="text" name="title" value=""/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d" value=""/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k" value=""/><br />
        H1:<br/>
        <input type="text" name="h1" value=""/><br />
        Текст:<br/>
        <textarea class="tinymce" name="text"></textarea><br/>
        Изображение:<br/>
        <input type="file" name="image"/><br/>


        <input type="submit" name="add_news" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}

//Добавление новости/статьи
if(isset($_POST["add_news"]))
{
    $title = $_POST["title"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $type = $_POST["type"];
    $h1 = $_POST["h1"];
    $text = mysql_escape_string($_POST["text"]);
    $public = $_POST["public"];
    $datetime = date('Y-m-d')." ".date("G:i:s");


    $url = translateURL($title);

    $url = checkurl($url,"news_articles");



    if ($_FILES["image"]['size'] != 0)
    {
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

        $thumb = "files/news/small" .$photo_img;
    }
    mysql_query("INSERT INTO news (`url`,`title`, `meta_d`, `meta_k`, `text`, `image`,`date_add`,`public`,`type`,`h1`) VALUES ('$url','$title', '$meta_d', '$meta_k', '$text','$thumb', '$datetime','$public','$type','$h1')");

    $_SESSION["message"] = "Новость добавлена";
    echo '<script>window.location="index.php?page=show_news";</script>';
    exit();
}