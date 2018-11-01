<?php
function Edit_Options($id = NULL)
{
    global $db;

    $result = mysql_fetch_array(mysql_query("SELECT * FROM `options_catalog` WHERE id=$id"));

    if($result["public"]==1)
        $ch1 = "checked";

    if($result["tofilter"]==1)
        $ch2 = "checked";
    echo '
    <article class="module width_full">
    <header><h3>Редактирование опции</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
	
	    

        Название:<br/>
        <input type="text" name="name" value="'.$result["name"].'" class="w150"/><br />  
        
        Тип опции:<br/>
        <label><input type="radio" name="type" value="1"'; if($result["type"]==1)echo "checked"; echo'> Checkbox</label>
        <label><input type="radio" name="type" value="2"'; if($result["type"]==2)echo "checked"; echo'> Radio</label>
        <label><input type="radio" name="type" value="3"'; if($result["type"]==3)echo "checked"; echo'> Image</label><br/><br/>
        Позиция: 
        <input type="text" name="position" class="w50" value="'.$result["position"].'"/> <br/>
        <label>Отображать в фильтре: 
        <input type="checkbox" name="tofilter" value="1" '.$ch2.'/><br/></label><br/>
        <label>Опубликовано: 
        <input type="checkbox" name="public" value="1" '.$ch1.'/></label><br/>
        <br/>
        <h2>Значения: <span class="add_icon addoptionvalue add"></span></h2><br/>
        <div class="options-table">';
        $options = $db->read_all("SELECT * FROM `options_values` WHERE `option_id`=$id");
        if($options)
        {
            foreach($options as $option)
            {
                echo ' <div class="options-table-row">
                <div class="width_quarter">Название:<br/><input value="'.$option["name"].'" type="text" name="options_edit_name['.$option["id"].']"/></div>
                <div class="width_quarter">Изображение:<br/><input type="file" name="options_edit_image['.$option["id"].']"/><br/>';
                if($option["image"])
                {
                    echo '<img src="../'.$option["image"].'" style="width:100%;"/>';
                }

                echo'
                
                
                </div>
                <div class="width_quarter">Позиция:<br/><input value="'.$option["position"].'" type="text" name="options_edit_position['.$option["id"].']" placeholder="Позиция"/></div>
                <div class="width_quarter">Публикация:<br/><input value="1" type="checkbox" name="options_edit_public['.$option["id"].']"'; if($option["public"]==1)echo'checked'; echo'/></div>
                <div class="width_quarter"><span class="delete_icon removeoptionvalue"></span></div>

            </div> ';
            }
        }

        echo'
            <div class="options-table-row">
                <div class="width_quarter">Название:<br/><input type="text" name="options_name[]"/></div>
                <div class="width_quarter">Изображение:<br/><input type="file" name="options_image[]"/></div>
                <div class="width_quarter">Позиция:<br/><input type="text" name="options_position[]" placeholder="Позиция"/></div>
                <div class="width_quarter">Публикация:<br/><input value="1" type="checkbox" name="options_public[]"/></div>
                <div class="width_quarter"><span class="delete_icon removeoptionvalue"></span></div>

            </div>        
        </div>
        
       


		<br clear="all"/>
        <input type="hidden" name="id" value="'.$id.'" >
        <input type="submit" name="edit_options" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}


if(isset($_POST["edit_options"]))
{
    $id = $_POST["id"];
    $name = $_POST["name"];
    $type = $_POST["type"];
    $position = $_POST["position"];
    $tofilter = $_POST["tofilter"];
    $public = $_POST["public"];

    $db->query("UPDATE options_catalog SET `name`='$name',`type`='$type',`position`='$position',`public`='$public',`tofilter`='$public' WHERE id=$id");
    $last = $id;

    @mkdir("../files/options/".$last, 0777);

    if($_POST["options_name"])
    {
        foreach ($_POST["options_name"] as $key=>$value)
        {
            $o_name = $_POST["options_name"][$key];
            $o_position = $_POST["options_position"][$key];
            $o_public = $_POST["options_public"][$key];


            if($_FILES["options_image"]['size'][$key] != 0)
            {
                $type = substr($_FILES['options_image']['name'][$key], strrpos($_FILES['options_image']['name'][$key], '.') + 1);
                $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

                $image = new CHImage();
                $image->load($_FILES['options_image']['tmp_name'][$key]);
                $image->resizeToWidth(1000);
                $image->save("../files/options/$last/big" . $photo_img);
                $image->load($_FILES['options_image']['tmp_name'][$key]);
                $image->resizeToWidth(300);
                $image->save("../files/options/$last/small" . $photo_img);
                $thumb = "files/options/$last/small" .$photo_img;
            }
    if($o_name)
            $db->query("INSERT INTO `options_values` (`option_id`,`name`,`image`,`position`,`public`) VALUES ('$last','$o_name','$thumb','$o_position','$o_public')");




        }
    }


    if($_POST["options_edit_name"])
    {
        foreach ($_POST["options_edit_name"] as $key=>$value)
        {
            $o_name = $_POST["options_edit_name"][$key];
            $o_position = $_POST["options_edit_position"][$key];
            $o_public = $_POST["options_edit_public"][$key];


            if($_FILES["options_edit_image"]['size'][$key] != 0)
            {
                $type = substr($_FILES['options_edit_image']['name'][$key], strrpos($_FILES['options_image']['name'][$key], '.') + 1);
                $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

                $image = new CHImage();
                $image->load($_FILES['options_edit_image']['tmp_name'][$key]);
                $image->resizeToWidth(1000);
                $image->save("../files/options/$last/big" . $photo_img);
                $image->load($_FILES['options_edit_image']['tmp_name'][$key]);
                $image->resizeToWidth(300);
                $image->save("../files/options/$last/small" . $photo_img);
                $thumb = "files/options/$last/small" .$photo_img;
            }

            $db->query("UPDATE `options_values` SET `name`='$o_name',`position`='$o_position',`public`='$o_public' WHERE `id`=$key");




        }
    }



















    $_SESSION["message"] = "Опция изменена";
    echo '<script>window.location="index.php?page=show_options";</script>';
    exit();
}
