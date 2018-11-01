<?php
//Добавление категории
function Add_Subject()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление тематики</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">

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
        Наименование:<br/>
        <input type="text" name="namesub" value=""/><br />

        Подкатегория:<br/>
        <select name="parent"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `subject`  WHERE parent=0  ORDER by title ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do{
        if($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["title"] . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `subject`  WHERE parent=". $resultC1["id"] ."  ORDER by title ASC");
            $resultC2 = mysql_fetch_array($queryC2);
            do{
                if($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["title"]
                        . '</option>';
                    $queryC3 = mysql_query("SELECT * FROM `subject`  WHERE parent=". $resultC2["id"] ."  ORDER by title ASC");
                    $resultC3 = mysql_fetch_array($queryC3);
                    do{
                        if($resultC3)
                        {
                            echo '<option value="' . $resultC3["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC3["title"]
                                . '</option>';
                        }
                    }while($resultC3 = mysql_fetch_array($queryC3));


                }
            }while($resultC2 = mysql_fetch_array($queryC2));
        }





    }while($resultC1 = mysql_fetch_array($queryC1));


    echo'</select>
        <br/>

        Описание:<br/>
        <textarea name="desc" class="tinymce" value=""></textarea><br />
        Позиция:<br/>
        <input type="text" name="position" value="0" readonly style="width: 75px;"/><br />
        <input type="file" name="image"/><br/>


		
        <input type="submit" name="add_subject" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Добавление категории
if(isset($_POST["add_subject"]))
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
    $namesub = $_POST["namesub"];

    if (!$url)
    {
        if($menu)
        {
            $url = translateURL($menu);
        }else{
            $url = translateURL($title);
        }
    }
    $url = checkurl($url,"subject");


    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(300);

        $image->save("../files/cats/small" . $photo_img);

        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(500);
        $image->save("../files/cats/big" . $photo_img);

        $thumb = "files/cats/small" .$photo_img;
    }

    mysql_query("INSERT INTO `subject` (`title`,`meta_d`,`meta_k`,`desc`,`image`,`parent`,`position`,`url`,`menu`,`h1`,`subject_name`) VALUES ('$title','$meta_d','$meta_k','$desc','$thumb','$parent','$position','$url','$menu','$h1','$namesub')");

    $_SESSION["message"] = "Тематика добавлена";
    echo'<script>window.location="index.php?page=show_subject";</script>';
    exit();
}