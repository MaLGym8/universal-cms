<?php
//Добавление
function Add_Calculator_Item()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление значения</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return CheckFormCatalog();">

    <div style="float:left">Категория:<br/>
        <select name="category">';

    $queryC1 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`=0 ORDER by position ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do {
        if ($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["name"]
                . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC1["id"]."' ORDER by position ASC");
            $resultC2 = mysql_fetch_array($queryC2);

            do {
                if ($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $resultC2["name"]
                        . '</option>';

                    $queryC3 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC2["id"]."' ORDER by position ASC");
                    $resultC3= mysql_fetch_array($queryC3);

                    do {
                        if ($resultC3["id"]) {
                            echo '<option value="' . $resultC3["id"] . '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $resultC3["name"]
                                . '</option>';
                        }
                    } while ($resultC3 = mysql_fetch_array($queryC3));
                }
            } while ($resultC2 = mysql_fetch_array($queryC2));
        }
    } while ($resultC1 = mysql_fetch_array($queryC1));

?>
    </select></div><br clear="all"/>
    Название:<br/>
    <input type="text" name="name"/><br/>
    Стоимость:<br/>
    <input type="text" name="coast"/><br/>
    
    
    
    Подсказка:<br/>
    <textarea name="tooltip" value="" class="tinymce"></textarea><br />
    
    <label class="w100">
    Позиция:<br/>
    <input type="text" name="position" class="w50"/></label>
    
    <label class="w100" style="padding-top: 15px;">
    Публикация: 
    <input type="checkbox" name="public" checked value="1"/>
    </label>

    <label class="w150">
        Class:<br/>
        <input type="text" name="class_item" class="w150"/></label>
	
	
    <br clear="all"/><br/>
    <h1>Значения <span class="add_icon addcalcvalue add"></span></h1>
    <label class="w50">Тип значений:</label>
	<label class="w50">Check <input type="radio" name="type"  value="check"/ checked><br/></label>
    <label class="w50">Radio <input type="radio" name="type"  value="radio"/><br/></label>
    <label class="w50">Select <input type="radio" name="type"  value="select"/><br/></label>
    <br clear="all"/>
    <br clear="all"/>
   
    
<div class="calc-values">
    
    
    
<!-- вставка в js-->   
        <div class="calc-value">
            <div class="left-value">
                <div class="calc-value-label">
                    <span class="td1">Название</span>
                    <span class="td2"><input type="text" name="namev[]"></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Подсказка</span>
                    <span class="td2"><textarea name="tooltopv[]" ></textarea></span>
                </div>

                <div class="calc-value-label doppol">
                    <span class="td1">Доп радио св-ва</span>
                    <span class="td2"><input class="gray" type="text" name="dop_items[]"></span>
                </div>

                <div class="calc-value-label doppol">
                    <span class="td1">HTML</span>
                    <span class="td2"><textarea class="gray" name="htmlv[]"></textarea></span>
                </div>
            </div>
        
        
        
        <div class="right-value">   
             
            <div class="calc-value-label ">
                    <span class="td1">Цена <input class="price" type="text" name="coastv[]"></span>
                </div>
            <div class="calc-value-label ">
                    <span class="td1">Коэфф <input class="price" type="number" step="0.1" value="1" name="coeff[]"></span>
                </div>

                <div class="calc-value-label">
                    <span class="td1">Срок <input class="srok" type="text" name="timev[]" placeholder="д/ч 8,16,24,32,40"></span>
                </div> 
            
            <div class="calc-value-label">
                <span class="td1">Степень</span>
                
                <?php /*?><label>Старт <select name="stepen1[]"><option value="0">Нет</option><option value="1">Да</option></select> </label><br/><br/>
                <label>Стандарт <select name="stepen2[]"><option value="0">Нет</option><option value="1">Да</option></select></label><br/><br/>
                <label>Премиум <select name="stepen3[]"><option value="0">Нет</option><option value="1">Да</option></select></label><br/><br/>
                <label>ИМ <select name="stepen4[]"><option value="0">Нет</option><option value="1">Да</option></select></label><?php */?>
                
                <span class="td2">
                <input type="checkbox" name="stepen1[]" value="1"/>
                <input type="checkbox" name="stepen2[]" value="1"/>
                <input type="checkbox" name="stepen3[]" value="1"/>

                       <label>ИМ <select name="stepen4[]">
                            <option value="0">Сайт</option>
                            <option value="1">ИМ</option>
                            <option value="2">Исключить ИМ</option>
                        </select>
                    </label>

               <!-- mag<input type="checkbox" name="stepen4[]" value="1"/>-->
                </span>
                
            </div>  
            
            
            <span class="publclass">Публ.<br />
                <input type="checkbox" name="publicv[]" value="1"/ checked></span> 
        
            
            <div class="calc-value-label">
                <span class="td1">Кол-во <input type="checkbox" name="countv[]" value="1"/> <input class="price" type="text" name="textcountv[]"/ placeholder="текст кол-ва"></span> 
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
<!-- / вставка в js-->         
          
        
    
    
    </div>
        

		
        <input type="submit" name="add_calculator_item" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>

<? }




if(isset($_POST["add_calculator_item"]))
{


    $cat_id = $_POST["category"];
    $name = mysql_escape_string($_POST["name"]);
    $coast = $_POST["coast"];
    $tooltip = mysql_escape_string($_POST["tooltip"]);
    $position = $_POST["position"];
    $public = $_POST["public"];
    $type = $_POST["type"];
    $class_item = $_POST["class_item"];




    mysql_query("INSERT INTO calculator_items (`name`,`tooltip`,`coast`,`position`,`cat_id`,`public`,`type`,`class`) VALUES ('$name','$tooltip','$coast','$position','$cat_id','$public','$type','$class_item')");

    $lastid = mysql_fetch_array(mysql_query("SELECT * FROM `calculator_items` ORDER by id DESC LIMIT 1"));
    $id = $lastid["id"];

    @mkdir("../files/calculator/".$id, 0777);


    for($i=0;$i<count($_POST["namev"]);$i++) {
        $namev = mysql_escape_string($_POST["namev"][$i]);
        $tooltopv = mysql_escape_string($_POST["tooltopv"][$i]);
        $coastv = $_POST["coastv"][$i];
        $countv = $_POST["countv"][$i];
        $textcountv = $_POST["textcountv"][$i];
        $positionv = $_POST["positionv"][$i];
        $publicv = $_POST["publicv"][$i];
        $time = $_POST["timev"][$i];
        $class = $_POST["classv"][$i];
        $html = $_POST["htmlv"][$i];
        $stepen = $_POST["stepen"][$i];
        $dop_items = $_POST["dop_items"][$i];

        $stepen1 = $_POST["stepen1"][$i];
        $stepen2 = $_POST["stepen2"][$i];
        $stepen3 = $_POST["stepen3"][$i];
        $stepen4 = $_POST["stepen4"][$i];
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
            }


            mysql_query(
                "INSERT INTO `calculator_values` (`name`,`tooltip`,`coast`,`item_id`,`number`,`position`,`number_coast`,`image`,`public`,`time`,`html`,`class`,`stepen1`,`stepen2`,`stepen3`,`stepen4`,`dop_items`,`coeff`) VALUES ('$namev','$tooltopv','$coastv','$id','$countv','$positionv','$textcountv','$photosAll','$publicv','$time','$html','$class','$stepen1','$stepen2','$stepen3','$stepen4','$dop_items','$coeff')"
            );
        }
    }




    $_SESSION["message"] = "Значение добавлено";
    echo '<script>window.location="index.php?page=show_calculator";</script>';
    exit();
}