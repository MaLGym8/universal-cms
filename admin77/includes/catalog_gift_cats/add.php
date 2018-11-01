<?php
//Добавление категории
function Add_Catalog_Gift_Cat()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление категории подарков</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">

        Заголовок:<br/>
        <input type="text" name="title" value=""/><br />
       
        Позиция:<br/>
        <input type="text" name="position" value="" style="width: 75px;"/><br />
  


		
        <input type="submit" name="add_catalog_gift_cat" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



if(isset($_POST["add_catalog_gift_cat"]))
{
    $title = $_POST["title"];
    $position = $_POST["position"];
    mysql_query("INSERT INTO `catalog_gift_cat` (`title`,`position`) VALUES ('$title','$position')");
    $_SESSION["message"] = "Категория добавлена";
    echo'<script>window.location="index.php?page=show_catalog_gift_cat";</script>';
    exit();
}