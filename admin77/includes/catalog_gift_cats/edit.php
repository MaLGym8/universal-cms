<?
//Редактирование категории
function Edit_Catalog_Gift_Cat($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `catalog_gift_cat` WHERE id=$id"));

    echo '
    <article class="module width_full">
    <header><h3>Редактирование категории</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">

        Заголовок:<br/>
        <input type="text" name="title" value="'.$result["title"].'"/><br />
        
        Позиция:<br/>
        <input type="text" name="position" value="'.$result["position"].'" style="width: 75px;"/><br />
   
        <input type="hidden" name="id" value="'.$result["id"].'"/>



        <input type="submit" name="edit_catalog_gift_cat" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}




if(isset($_POST["edit_catalog_gift_cat"]))
{
    $id = $_POST["id"];
    $title = $_POST["title"];
    $position = $_POST["position"];
    mysql_query("UPDATE `catalog_gift_cat` SET `title`='$title', `position`='$position' WHERE `id`='$id'");
    $_SESSION["message"] = "Категория изменена";
    echo'<script>window.location="index.php?page=show_catalog_gift_cat";</script>';
    exit();
}