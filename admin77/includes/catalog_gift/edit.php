<?
//Редактирование категории
function Edit_Catalog_Gift($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `catalog_gift` WHERE id=$id"));

    echo '
    <article class="module width_full">
    <header><h3>Редактирование подарка</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    
    
            Категория:
           <select name="cat"><option value="0">Выберите подкатегорию</option>';

                        $queryC1 = mysql_query("SELECT * FROM `catalog_gift_cat` ORDER by title ASC");
                        $resultC1 = mysql_fetch_array($queryC1);

                        do{
                            if($resultC1["id"]) {
                                echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;"'; if($result["cat"]==$resultC1["id"])echo'selected'; echo'>' . $resultC1["title"]
                                    . '</option>';


                            }
                        }while($resultC1 = mysql_fetch_array($queryC1));

echo'
                    </select>
<br/>

        Заголовок:<br/>
        <input type="text" name="title" value="'.$result["title"].'"/><br />
        
      Описание:<br/>
        <textarea name="desc" value="" class="tinymce">'.$result["desc"].'</textarea><br />         ';
    if (CATALOGTYPE == 1)
    {
       echo' Стоимость:<br/>
        <input type="text" name="coast" value="'.$result["coast"].'" style="width: 175px;"/><br />';

        echo' Стоимость до скидки:<br/>
        <input type="text" name="coast_old" value="'.$result["coast_old"].'" style="width: 175px;"/><br />';
    }
        echo'
       
        Изображение:<br/>
        <input type="file" name="image"/><br/>';
        if($result["image"])
        {
            echo "<img src='../".$result["image"]."'/><br/>";
        }
    echo'
   
        <input type="hidden" name="id" value="'.$result["id"].'"/>



        <input type="submit" name="edit_catalog_gift" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}




if(isset($_POST["edit_catalog_gift"]))
{
    $id = $_POST["id"];
    $title = $_POST["title"];
    $cat = $_POST["cat"];
    $desc = $_POST["desc"];
    $coast = $_POST["coast"];
    $coast_old = $_POST["coast_old"];

    mysql_query("UPDATE  catalog_gift SET `cat`='$cat',`title`='$title',`desc`='$desc',`coast`='$coast',`coast_old`='$coast_old' WHERE `id`='$id'");


    $result = mysql_fetch_array(mysql_query("SELECT * FROM  `catalog_gift` WHERE id=$id"));
    $id = $result["id"];
    @mkdir("../files/gift/".$id, 0777);

    if ($_FILES["image"]['size'] != 0)
    {
        @unlink("../".$result["image"]);
        @unlink("../".str_replace("small","big",$result["image"]));

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
    }else{
        $thumb = $result["image"];
    }
    mysql_query("UPDATE `catalog_gift` SET `image`='$thumb' WHERE id=$id");



    $_SESSION["message"] = "Подарок изменен";
    echo'<script>window.location="index.php?page=show_catalog_gift";</script>';
    exit();
}