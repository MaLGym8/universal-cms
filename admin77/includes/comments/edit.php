<?php

function Edit_Comment($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `commentsystem` WHERE id=$id"));



    echo '
    <article class="module width_full">
    <header><h3>Редактирование отзыва</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
    Имя:<br/>
    <input type="text" name="name" value="' . $result["name"] . '"/><br />
    Email:<br/>
    <input type="text" name="mail" value="' . $result["mail"] . '"/><br />
   
    Дата:<br/>
    <input type="text" name="date" value="' . $result["date_add"] . '"/><br />
    Текст:<br/>
    <textarea class="tinymce" name="text">' . $result["text"] . '</textarea><br />
    
    Опубликовано: <input type="checkbox" value="1" name="public"'; if($result["public"]==1)echo'checked'; echo' /><br/>


		
        <input type="hidden" name="id" value="' . $result["id"] . '"/>
        <input type="submit" name="edit_comment" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';

}



if(isset($_POST["edit_comment"]))
{

    $name = htmlspecialchars(stripslashes($_POST["name"]));
    $mail = htmlspecialchars(stripslashes($_POST["mail"]));
    $text = htmlspecialchars(stripslashes($_POST["text"]));
 
    $date = htmlspecialchars(stripslashes($_POST["date"]));
    $public = htmlspecialchars(stripslashes($_POST["public"]));
    $id = htmlspecialchars(stripslashes($_POST["id"]));
  





    $db->query("UPDATE `commentsystem` SET `name`='$name', `mail`='$mail', `text`='$text', `date_add`='$date', `public`='$public' WHERE `id`='$id'");

    echo '<script>window.location="index.php?page=comments";</script>';
    exit();

}