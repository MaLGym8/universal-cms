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
    <h1>Значения <span class="add_icon addcalcvalue edit"></span></h1>
    <label class="w50">Тип значений:</label>

	<label class="w50">Check <input type="radio" name="type" '; if($result["type"]=="check")echo'checked'; echo'  value="check"/><br/></label>
    <label class="w50">Radio <input type="radio" name="type"'; if($result["type"]=="radio")echo'checked'; echo'  value="radio"/><br/></label>
    <label class="w50">Select <input type="radio" name="type"  '; if($result["type"]=="select")echo'checked'; echo' value="select"/><br/></label>
    <br clear="all"/>
    <br clear="all"/>
    
    
    <div class="calc-values">
     
   ';
    $queryValues = mysql_query("SELECT * FROM `calculator_values` WHERE `item_id`='$id'  ORDER by position ASC");
    $resultValues = mysql_fetch_array($queryValues);
    do{
    ?>




        <div class="calc-value">
            <div class="left-value">
                <div class="calc-value-label">
                    <span class="td1">Название</span>
                    <span class="td2"><input type="text" name="namev[<?=$resultValues["id"]?>]"  value="<?=$resultValues["name"]?>"/></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Подсказка</span>
                    <span class="td2"><textarea name="tooltopv[<?=$resultValues["id"]?>]" ><?=$resultValues["tooltip"]?></textarea></span>
                </div>

                <div class="calc-value-label doppol">
                    <span class="td1">Доп радио св-ва</span>
                    <span class="td2"><input class="gray" type="text" name="dop_items[<?=$resultValues["id"]?>]"  value="<?=$resultValues["dop_items"]?>"/></span>
                </div>

                <div class="calc-value-label doppol">
                    <span class="td1">HTML</span>
                    <span class="td2"><textarea class="gray" name="htmlv[<?=$resultValues["id"]?>]"  value="<?=$resultValues["html"]?>"></textarea></span>
                </div>



            </div>

            <div class="right-value">

                <div class="calc-value-label ">
                    <span class="td1">Цена <input class="price" type="text" name="coastv[<?=$resultValues["id"]?>]"  value="<?=$resultValues["coast"]?>"/></span>
                </div>

                <div class="calc-value-label ">
                    <span class="td1">Коэфф <input class="price" type="number" step="0.1" name="coeff[<?=$resultValues["id"]?>]"  value="<?=$resultValues["coeff"]?>"/></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Срок <input class="srok" type="text" name="timev[<?=$resultValues["id"]?>]"  value="<?=$resultValues["time"]?>"/ placeholder="д/ч 8,16,24,32,40"></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Степень</span>
                <span class="td2">

<?php /*?>                    <label>Старт <select name="stepen1[<?=$resultValues["id"]?>]">
                            <option value="0" >Нет</option>
                            <option value="1" <? if($resultValues["stepen1"]==1){echo"selected";}?>>Да</option>
                        </select>
                    </label><br/><br/>
                    <label>Стандарт <select name="stepen2[<?=$resultValues["id"]?>]">
                            <option value="0">Нет</option>
                            <option value="1" <? if($resultValues["stepen2"]==1){echo"selected";}?>>Да</option>
                        </select>
                    </label><br/><br/>
                    <label>Премиум <select name="stepen3[<?=$resultValues["id"]?>]">
                            <option value="0">Нет</option>
                            <option value="1" <? if($resultValues["stepen3"]==1){echo"selected";}?>>Да</option>
                        </select></label><br/><br/>
                    <label>ИМ <select name="stepen4[<?=$resultValues["id"]?>]">
                            <option value="0">Нет</option>
                            <option value="1" <? if($resultValues["stepen4"]==1){echo"selected";}?>>Да</option>
                        </select>
                    </label><?php */?>

<input type="checkbox" <? if($resultValues["stepen1"]==1){echo"checked";} ?> class="stepen1" name="stepen1[<?=$resultValues["id"]?>]" value="1"/>
<input type="checkbox" <? if($resultValues["stepen2"]==1){echo"checked";} ?> class="stepen2" name="stepen2[<?=$resultValues["id"]?>]" value="1"/>
<input type="checkbox" <? if($resultValues["stepen3"]==1){echo"checked";} ?> class="stepen3" name="stepen3[<?=$resultValues["id"]?>]" value="1"/>

         <label>ИМ <select name="stepen4[<?=$resultValues["id"]?>]">
                            <option value="0">Сайт</option>
                            <option value="1" <? if($resultValues["stepen4"]==1){echo"selected";}?>>ИМ</option>
                            <option value="2" <? if($resultValues["stepen4"]==2){echo"selected";}?>>Исключить ИМ</option>
                        </select>
                    </label>

<!-- mag<input type="checkbox" <?/* if($resultValues["stepen4"]==1){echo"checked";} */?> class="stepen4" name="stepen4[<?/*=$resultValues["id"]*/?>]" value="1"/>-->









</span>
                </div>

                
                   <span class="publclass">Публ.<br />
<input type="checkbox" <? if($resultValues["public"]==1){echo"checked";} ?> name="publicv[<?=$resultValues["id"]?>]" value="1"/></span>

                <div class="calc-value-label">
                    <span class="td1">Кол-во <input type="checkbox" <?if($resultValues["number"]==1){echo"checked";}?> name="countv[<?=$resultValues["id"]?>]" value="1"/> <input class="price" type="text" value="<?=$resultValues["number_coast"]?>"  name="textcountv[<?=$resultValues["id"]?>]"/ placeholder="текст кол-ва"></span>
                </div>
                
                
                <div class="calc-value-label">
                    <span class="td1 doppole">Доп поля</span>
                </div>
                

                <div class="calc-value-label doppol">
                    <span class="td1">Изображение</span>
                    <span class="td2"><input type="file" name="imagev[<?=$resultValues["id"]?>]"/></span>
                </div>
                <div class="calc-value-label doppol">
                    <span class="td1">CSS</span>
                    <span class="td2"><input class="gray" type="text" name="classv[<?=$resultValues["id"]?>]"/></span>
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
    $name = mysql_escape_string($_POST["name"]);
    $coast = $_POST["coast"];
    $tooltip = mysql_escape_string($_POST["tooltip"]);
    $position = $_POST["position"];
    $public = $_POST["public"];
    $type = $_POST["type"];
    $id = $_POST["id"];
    $class_item = $_POST["class_item"];




    mysql_query("UPDATE calculator_items SET `name`='$name',`tooltip`='$tooltip',`coast`='$coast',`position`='$position',`cat_id`='$cat_id',`public`='$public', `type`='$type', `class`='$class_item' WHERE `id`='$id'");




    @mkdir("../files/calculator/".$id, 0777);
    $TMPARRAY = array();
    foreach($_POST["namev"] as $key=>$value)
    {

        $namev = mysql_escape_string($_POST["namev"][$key]);
        $tooltopv = mysql_escape_string($_POST["tooltopv"][$key]);
        $coastv = $_POST["coastv"][$key];
        $countv = $_POST["countv"][$key];
        $textcountv = $_POST["textcountv"][$key];
        $positionv = $_POST["positionv"][$key];
        $publicv = $_POST["publicv"][$key];

        $time = $_POST["timev"][$key];
        $class = $_POST["classv"][$key];
        $html = $_POST["htmlv"][$key];
        $stepen1 = $_POST["stepen1"][$key];
        $stepen2 = $_POST["stepen2"][$key];
        $stepen3 = $_POST["stepen3"][$key];
        $stepen4 = $_POST["stepen4"][$key];
        $coeff = $_POST["coeff"][$key];
        $dop_items = $_POST["dop_items"][$key];


        mysql_query(
            "UPDATE `calculator_values` SET `name`='$namev',`tooltip`='$tooltopv',`coast`='$coastv',`item_id`='$id',`number`='$countv',`number_coast`='$textcountv',`image`='$photosAll',`public`='$publicv',`time`='$time',`html`='$html',`class`='$class',`stepen1`='$stepen1',`stepen2`='$stepen2',`stepen3`='$stepen3',`stepen4`='$stepen4',`dop_items`='$dop_items', `coeff`='$coeff' WHERE `id`='$key'"
        ); //,`position`='$positionv'
        $TMPARRAY[$key] = $key;
    }
    $ITEMS = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='$id'");
    if($ITEMS)
    {
        foreach ($ITEMS as $Item)
        {
            if(!is_numeric(array_search($Item["id"], $TMPARRAY)))
            {
                $db->query("DELETE FROM `calculator_values` WHERE `id`='".$Item["id"]."'");
            }

        }
    }

    for($i=0;$i<count($_POST["namev_new"]);$i++) {
        $namev = $_POST["namev_new"][$i];
        $tooltopv = $_POST["tooltopv_new"][$i];
        $coastv = $_POST["coastv_new"][$i];
        $countv = $_POST["countv_new"][$i];
        $textcountv = $_POST["textcountv_new"][$i];
        $positionv = $_POST["positionv_new"][$i];
        $publicv = $_POST["publicv_new"][$i];

        $time = $_POST["timev_new"][$i];
        $class = $_POST["classv_new"][$i];
        $html = $_POST["htmlv_new"][$i];
        $stepen1 = $_POST["stepen1_new"][$i];
        $stepen2 = $_POST["stepen2_new"][$i];
        $stepen3 = $_POST["stepen3_new"][$i];
        $stepen4 = $_POST["stepen4_new"][$i];
        $dop_items = $_POST["dop_items_new"][$i];
        $coeff = $_POST["coeff"][$i];


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
                "INSERT INTO `calculator_values` (`name`,`tooltip`,`coast`,`item_id`,`number`,`position`,`number_coast`,`image`,`public`,`time`,`html`,`class`,`stepen1`,`stepen2`,`stepen3`,`stepen4`,`dop_items`, `coeff`) VALUES ('$namev','$tooltopv','$coastv','$id','$countv','$positionv','$textcountv','$photosAll','$publicv','$time','$html','$class','$stepen1','$stepen2','$stepen3','$stepen4','$dop_items','$coeff')"
            );
        }
    }



    $_SESSION["message"] = "Значение изменено";
    echo '<script>window.location="index.php?page=show_calculator";</script>';
    exit();
}