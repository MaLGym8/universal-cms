<?php
//Добавление
function Edit_Calculator_Item($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `calculator_items` WHERE id=$id"));

    if($result["public"]==1)
        $ch = "checked";

    echo '
    <article class="module width_full">
    <header><h3>Редактирование значения</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return CheckFormCatalog();">
	
	
	
	
	

    <div style="float:left">Категория:<br/>
        <select name="category"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`=0 ORDER by name ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do {
        if ($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;" '; if($result["cat_id"]==$resultC1["id"])echo'selected'; echo'>' . $resultC1["name"]
                . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC1["id"]."' ORDER by name ASC");
            $resultC2 = mysql_fetch_array($queryC2);

            do {
                if ($resultC2["id"]) {
                    echo '<option '; if($result["cat_id"]==$resultC2["id"])echo'selected'; echo' value="' . $resultC2["id"] . '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $resultC2["name"]
                        . '</option>';

                    $queryC3 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC2["id"]."' ORDER by name ASC");
                    $resultC3= mysql_fetch_array($queryC3);

                    do {
                        if ($resultC3["id"]) {
                            echo '<option '; if($result["cat_id"]==$resultC3["id"])echo'selected'; echo' value="' . $resultC3["id"] . '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $resultC3["name"]
                                . '</option>';








                        }


                    } while ($resultC3 = mysql_fetch_array($queryC3));






                }


            } while ($resultC2 = mysql_fetch_array($queryC2));





        }


    } while ($resultC1 = mysql_fetch_array($queryC1));


    echo '</select></div><br clear="all"/>

    Название:<br/>
    <input type="text" name="name" value="'.$result["name"].'"/><br/>
    Стоимость:<br/>
    <input type="text" name="coast"  value="'.$result["coast"].'"/><br/>
    
    
    
    Подсказка:<br/>
    <textarea name="tooltip" value="" class="tinymce" style="height:500px !important"> '.$result["tooltip"].'</textarea><br />

	<label class="w100">
    Позиция:<br/>
    <input type="text" name="position" class="w50"  value="'.$result["position"].'"/></label>
    
    <label class="w100" style="padding-top: 15px;">
    Публикация: 
    <input type="checkbox" name="public" '.$ch.' value="1"/>
    </label>
    
     <label class="w150">
        Class:<br/>
        <input type="text" name="class_item"  value="'.$result["class"].'" class="w150"/></label>
	
	
    <br clear="all"/><br/>
    <h1>Значения <span class="add_icon addcalcvalue"></span></h1>
    <label class="w50">Тип значений:</label>

	<label class="w50">Check <input type="radio" name="type" '; if($result["type"]=="check")echo'checked'; echo'  value="check"/><br/></label>
    <label class="w50">Radio <input type="radio" name="type"'; if($result["type"]=="radio")echo'checked'; echo'  value="radio"/><br/></label>
    <label class="w50">Select <input type="radio" name="type"  '; if($result["type"]=="select")echo'checked'; echo' value="select"/><br/></label>
    <br clear="all"/>
    <br clear="all"/>
    
    
    <div class="calc-values">
     
   ';
    $queryValues = mysql_query("SELECT * FROM `calculator_values` WHERE `item_id`='$id'");
    $resultValues = mysql_fetch_array($queryValues);
    do{
    ?>




        <div class="calc-value">
            <div class="left-value">
                <div class="calc-value-label">
                    <span class="td1">Название</span>
                    <span class="td2"><input type="text" name="namev[]"  value="<?=$resultValues["name"]?>"/></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Подсказка</span>
                    <span class="td2"><textarea name="tooltopv[]" ><?=$resultValues["tooltip"]?></textarea></span>
                </div>

                <div class="calc-value-label doppol">
                    <span class="td1">Доп радио св-ва</span>
                    <span class="td2"><input class="gray" type="text" name="dop_items[]"  value="<?=$resultValues["dop_items"]?>"/></span>
                </div>

                <div class="calc-value-label doppol">
                    <span class="td1">HTML</span>
                    <span class="td2"><textarea class="gray" name="htmlv[]"  value="<?=$resultValues["html"]?>"></textarea></span>
                </div>



            </div>

            <div class="right-value">

                <div class="calc-value-label ">
                    <span class="td1">Цена <input class="price" type="text" name="coastv[]"  value="<?=$resultValues["coast"]?>"/></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Срок <input class="srok" type="text" name="timev[]"  value="<?=$resultValues["time"]?>"/></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Степень</span>
                <span class="td2">

                    <label>Старт <select name="stepen1[]">
                            <option value="0" >Нет</option>
                            <option value="1" <?if($resultValues["stepen1"]==1){echo"selected";}?>>Да</option>
                        </select>
                    </label><br/><br/>
                    <label>Стандарт <select name="stepen2[]">
                            <option value="0">Нет</option>
                            <option value="1" <?if($resultValues["stepen2"]==1){echo"selected";}?>>Да</option>
                        </select>
                    </label><br/><br/>
                    <label>Премиум <select name="stepen3[]">
                            <option value="0">Нет</option>
                            <option value="1" <?if($resultValues["stepen3"]==1){echo"selected";}?>>Да</option>
                        </select></label><br/><br/>
                    <label>ИМ <select name="stepen4[]">
                            <option value="0">Нет</option>
                            <option value="1" <?if($resultValues["stepen4"]==1){echo"selected";}?>>Да</option>
                        </select>
                    </label>











</span>
                </div>

                
                   <span class="publclass">Публ.<br />
<input type="checkbox" <?if($resultValues["public"]==1){echo"checked";}?> name="publicv[]" value="1"/></span>

                <div class="calc-value-label">
                    <span class="td1">Кол-во <input type="checkbox" <?if($resultValues["number"]==1){echo"checked";}?> name="countv[]" value="1"/> <input class="price" type="text" value="<?=$resultValues["number_coast"]?>"  name="textcountv[]"/ placeholder="текст кол-ва"></span>
                </div>
                
                
                <div class="calc-value-label">
                    <span class="td1 doppole">Доп поля</span>
                </div>
                

                <div class="calc-value-label doppol">
                    <span class="td1">Изображение</span>
                    <span class="td2"><input type="file" name="imagev[]"/></span>
                </div>
                <div class="calc-value-label doppol">
                    <span class="td1">CSS</span>
                    <span class="td2"><input class="gray" type="text" name="classv[]"/></span>
                </div>


             <div class="calc-value-label deleteabs"><span class="td2"><span class="delete_icon removecalcvalue"></span></span></div>
  

            </div>


        </div>

        <?
    }while($resultValues = mysql_fetch_array($queryValues));

    echo'
    </div>
        

        <input type="hidden" name="id" value="'.$result["id"].'" >
        <input type="submit" name="edit_catalog_item" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}






if(isset($_POST["edit_catalog_item"]))
{
    $cat_id = $_POST["category"];
    $name = $_POST["name"];
    $coast = $_POST["coast"];
    $tooltip = $_POST["tooltip"];
    $position = $_POST["position"];
    $public = $_POST["public"];
    $type = $_POST["type"];
    $id = $_POST["id"];
    $class_item = $_POST["class_item"];




    mysql_query("UPDATE calculator_items SET `name`='$name',`tooltip`='$tooltip',`coast`='$coast',`position`='$position',`cat_id`='$cat_id',`public`='$public', `type`='$type', `class`='$class_item' WHERE `id`='$id'");



    mysql_query("DELETE FROM `calculator_values` WHERE `item_id`=$id");

    @mkdir("../files/calculator/".$id, 0777);

    for($i=0;$i<count($_POST["namev"]);$i++) {
        $namev = $_POST["namev"][$i];
        $tooltopv = $_POST["tooltopv"][$i];
        $coastv = $_POST["coastv"][$i];
        $countv = $_POST["countv"][$i];
        $textcountv = $_POST["textcountv"][$i];
        $positionv = $_POST["positionv"][$i];
        $publicv = $_POST["publicv"][$i];

        $time = $_POST["timev"][$i];
        $class = $_POST["classv"][$i];
        $html = $_POST["htmlv"][$i];
        $stepen1 = $_POST["stepen1"][$i];
        $stepen2 = $_POST["stepen2"][$i];
        $stepen3 = $_POST["stepen3"][$i];
        $stepen4 = $_POST["stepen4"][$i];
        $dop_items = $_POST["dop_items"][$i];


        if ($namev) {
            if ($_FILES["imagev"]['size'][$i]) {
                $type = substr(
                    $_FILES["imagev"]['name'][$i], strrpos($_FILES["imagev"]['name'][$i], '.') + 1
                );
                $photo_img = md5(date('YmdHis') . rand(100, 1000));
                $photo_img_big = $photo_img . "_big." . $type;
                $photo_img = $photo_img . "_small." . $type;

                $image = new CHImage();
                $image->load($_FILES["imagev"]['tmp_name'][$i]);
                $image->resizeToWidth(1000);
                $image->save("../files/calculator/$id/" . $photo_img_big);
                $image->load($_FILES["imagev"]['tmp_name'][$i]);
                $image->resizeToWidth(150);
                $image->save("../files/calculator/$id/" . $photo_img);
                $photosAll = "files/calculator/$id/" . $photo_img;
            }else{
                $photosAll = $_POST["image_v"][$i];
            }


            mysql_query(
                "INSERT INTO `calculator_values` (`name`,`tooltip`,`coast`,`item_id`,`number`,`position`,`number_coast`,`image`,`public`,`time`,`html`,`class`,`stepen1`,`stepen2`,`stepen3`,`stepen4`,`dop_items`) VALUES ('$namev','$tooltopv','$coastv','$id','$countv','$positionv','$textcountv','$photosAll','$publicv','$time','$html','$class','$stepen1','$stepen2','$stepen3','$stepen4','$dop_items')"
            );
        }
    }





    $_SESSION["message"] = "Значение изменено";
    echo '<script>window.location="index.php?page=show_calculator";</script>';
    exit();
}