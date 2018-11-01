<?php
//Добавление категории
function Add_Catalog_Gift()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление подарка</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
        Категория:
           <select name="cat"><option value="0">Выберите подкатегорию</option>';

                        $queryC1 = mysql_query("SELECT * FROM `catalog_gift_cat` ORDER by title ASC");
                        $resultC1 = mysql_fetch_array($queryC1);

                        do{
                            if($resultC1["id"]) {
                                echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["title"]
                                    . '</option>';


                            }
                        }while($resultC1 = mysql_fetch_array($queryC1));

echo'
                    </select>
<br/>
        Заголовок:<br/>
        <input type="text" name="title" value=""/><br />
        
        Описание:<br/>
        <textarea name="desc" value="" class="tinymce"></textarea><br />  
        ';
    if (CATALOGTYPE == 1)
    {
       echo' Стоимость:<br/>
        <input type="text" name="coast" value="" style="width: 175px;"/><br />';

        echo' Стоимость до скидки:<br/>
        <input type="text" name="coast_old" value="" style="width: 175px;"/><br />';
    }
        echo'
       
        Изображение:<br/>
        <input type="file" name="image"/><br/>
  


		
        <input type="submit" name="add_catalog_gift" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



if(isset($_POST["add_catalog_gift"]))
{
    $title = $_POST["title"];
    $cat = $_POST["cat"];
    $desc = $_POST["desc"];
    $coast = $_POST["coast"];
    $coast_old = $_POST["coast_old"];


    mysql_query("INSERT INTO catalog_gift (`cat`,`title`,`desc`,`coast`,`coast_old`) VALUES ('$cat','$title','$desc','$coast','$coast_old')");

    $result = mysql_fetch_array(mysql_query("SELECT * FROM  `catalog_gift` ORDER by id DESC LIMIT 1"));
    $id = $result["id"];
    @mkdir("../files/gift/".$id, 0777);

    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToWidth(1000);
        $image->save("../files/gift/$id/big" . $photo_img);
        $image->load($_FILES['image']['tmp_name']);
        $image->resizeToHeight(200);
        $image->save("../files/gift/$id/small" . $photo_img);
        $thumb = "files/gift/$id/small" .$photo_img;

        mysql_query("UPDATE catalog_gift SET `image`='$thumb' WHERE id=$id");

    }



    $_SESSION["message"] = "Подарок добавлен";
    echo'<script>window.location="index.php?page=show_catalog_gift";</script>';
    exit();
}