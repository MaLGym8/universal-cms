<?php

//Редактирование категории
function Edit_Cms($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `cms` WHERE id=$id"));

    echo '
    <article class="module width_full">
    <header><h3>Редактирование CMS</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">

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
        Наименование:<br/>
        <input type="text" name="namecms" value="'.$result["cms_name"].'"/><br />
        Подкатегория:<br/>
        <select name="parent"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `cms`  WHERE parent=0  ORDER by title ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do{
        if($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;" '; if($result["parent"]== $resultC1["id"])echo'selected'; echo'>' . $resultC1["title"] . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `cms`  WHERE parent=". $resultC1["id"] ."  ORDER by title ASC");
            $resultC2 = mysql_fetch_array($queryC2);
            do{
                if($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '"'; if($result["parent"]== $resultC2["id"])echo'selected'; echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["title"]
                        . '</option>';
                    $queryC3 = mysql_query("SELECT * FROM `cms`  WHERE parent=". $resultC2["id"] ."  ORDER by title ASC");
                    $resultC3 = mysql_fetch_array($queryC3);
                    do{
                        if($resultC3)
                        {
                            echo '<option value="' . $resultC3["id"] . '" '; if($result["parent"]== $resultC3["id"])echo'selected'; echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC3["title"]
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
        <textarea name="desc" class="tinymce" value="">'.$result["desc"].'</textarea><br />
        Позиция:<br/>
        <input type="text" name="position" value="'.$result["position"].'" style="width: 75px;"/><br />';
    if($result['image'])
    {
        echo'<img src="/'.$result["image"].'"/>';
    }
    echo'
        <input type="file" name="image"/><br/>
        <input type="hidden" name="id" value="'.$result["id"].'"/>



        <input type="submit" name="edit_cms" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}




//Редактирование категории
if(isset($_POST["edit_cms"]))
{
    $title = $_POST["title"];
    $url = $_POST["url"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $parent = $_POST["parent"];
    $desc = $_POST["desc"];
    $position = $_POST["position"];
    $id = $_POST["id"];
    $resultCat = mysql_fetch_array(mysql_query("SELECT * FROM `cms` WHERE id=$id"));

    $menu = $_POST["menu"];
    $h1 = $_POST["h1"];
    $cms_name = $_POST["namecms"];

    if (!$url)
    {
        if($menu)
        {
            $url = translateURL($menu);
        }else{
            $url = translateURL($title);
        }
    }

    $url = checkurl($url,"cms");


    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$resultCat["image"]);
        @unlink("../".str_replace("small","big",$resultCat["image"]));
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
    }else{

        $thumb = $resultCat["image"];
    }

    mysql_query("UPDATE `cms` SET `title`='$title',`meta_d`='$meta_d',`meta_k`='$meta_k',`desc`='$desc',`image`='$thumb',`parent`='$parent',`position`='$position', `url`='$url',`menu`='$menu',`h1`='$h1',`cms_name`='$cms_name' WHERE id='$id'");

    $_SESSION["message"] = "CMS изменена";
    echo'<script>window.location="index.php?page=show_cms";</script>';
    exit();
}