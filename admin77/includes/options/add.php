<?php
//Добавление
function Add_Options()
{
    global $db;
    echo '
    <article class="module width_full">
    <header><h3>Добавление опции</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
	
	    

        Название:<br/>
        <input type="text" name="name" value="" class="w150"/><br />  
        
        Тип опции:<br/>
        <label><input type="radio" name="type" value="1" checked> Checkbox</label>
        <label><input type="radio" name="type" value="2"> Radio</label>
        <label><input type="radio" name="type" value="3"> Image</label><br/><br/>
        Позиция: 
        <input type="text" name="position" class="w50"/> <br/>
        <label>Отображать в фильтре: 
        <input type="checkbox" name="tofilter" value="1" checked/><br/></label><br/>
        <label>Опубликовано: 
        <input type="checkbox" name="public" value="1" checked/></label><br/>
        <br/>
        <h2>Значения: <span class="add_icon addoptionvalue add"></span></h2><br/>
        <div class="options-table">
            <div class="options-table-row">
                <div class="width_quarter">Название:<br/><input type="text" name="options_name[]"/></div>
                <div class="width_quarter">Изображение:<br/><input type="file" name="options_image[]"/></div>
                <div class="width_quarter">Позиция:<br/><input type="text" name="options_position[]" placeholder="Позиция"/></div>
                <div class="width_quarter">Публикация:<br/><input value="1" type="checkbox" name="options_public[]"/></div>
                <div class="width_quarter"><span class="delete_icon removeoptionvalue"></span></div>

            </div>        
        </div>
        
       


		<br clear="all"/>
        <input type="submit" name="add_options" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}






if(isset($_POST["add_options"]))
{
    $name = $_POST["name"];
    $type = $_POST["type"];
    $position = $_POST["position"];
    $tofilter = $_POST["tofilter"];
    $public = $_POST["public"];

    $db->query("INSERT INTO options_catalog (`name`,`type`,`position`,`public`,`tofilter`) VALUES ('$name','$type','$position','$public','$tofilter')");
    $last = $db->last_id();
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

            $db->query("INSERT INTO `options_values` (`option_id`,`name`,`image`,`position`,`public`) VALUES ('$last','$o_name','$thumb','$o_position','$o_public')");




        }
    }
























    $_SESSION["message"] = "Опция добавлена";
    echo '<script>window.location="index.php?page=show_options";</script>';
    exit();
}