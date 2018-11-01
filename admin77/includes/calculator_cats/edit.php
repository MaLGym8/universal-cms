<?php
//Добавление
function Edit_Calculator_Cat($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `calculator_cats` WHERE id=$id"));

    if($result["public"]==1)
        $ch = "checked";

    echo '
    <article class="module width_full">
    <header><h3>Редактирование раздела калькулятора</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return CheckFormCatalog();">
	
    
	<div style="float:left">Категория:<br/>
        <select name="category"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `calculator_cats`  ORDER by name ASC");
    $resultC1 = mysql_fetch_array($queryC1);


    $queryC1 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`=0 ORDER by name ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do {
        if ($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;" '; if($result["parent"]==$resultC1["id"]){echo'selected';} echo'>' . $resultC1["name"]
                . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC1["id"]."' ORDER by name ASC");
            $resultC2 = mysql_fetch_array($queryC2);

            do {
                if ($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '" '; if($result["parent"]==$resultC2["id"]){echo'selected';} echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $resultC2["name"]
                        . '</option>';

                    $queryC3 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC2["id"]."' ORDER by name ASC");
                    $resultC3= mysql_fetch_array($queryC3);

                    do {
                        if ($resultC3["id"]) {
                            echo '<option '; if($result["parent"]==$resultC3["id"]){echo'selected';} echo' value="' . $resultC3["id"] . '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $resultC3["name"]
                                . '</option>';








                        }


                    } while ($resultC3 = mysql_fetch_array($queryC3));






                }


            } while ($resultC2 = mysql_fetch_array($queryC2));





        }


    } while ($resultC1 = mysql_fetch_array($queryC1));









    echo '</select></div><br clear="all"/>
    Название категории:<br/>
    <input type="text" name="name" value="'.$result["name"].'"/><br/>
    Стоимость:<br/>
    <input type="text" name="coast"  value="'.$result["coast"].'"/><br/>
    
    
    
    Подсказка:<br/>
    <textarea name="tooltip" value="" class="tinymce"> '.$result["tooltip"].'</textarea><br />
    
    Позиция:<br/>
    <input type="text" name="position" class="w50"  value="'.$result["position"].'"/><br/>
    Публикация: 
    <input type="checkbox" name="public" '.$ch.' value="1"/><br/>
    <input type="hidden" name="id" value="'.$result["id"].'" />
        

		
        <input type="submit" name="edit_catalog_cat" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}






if(isset($_POST["edit_catalog_cat"]))
{
    $cat = $_POST["category"];
    $name = $_POST["name"];
    $coast = $_POST["coast"];
    $tooltip = $_POST["tooltip"];
    $position = $_POST["position"];
    $public = $_POST["public"];
    $id = $_POST["id"];




    mysql_query("UPDATE calculator_cats SET `name`='$name',`tooltip`='$tooltip',`coast`='$coast',`position`='$position',`parent`='$cat',`public`='$public' WHERE `id`='$id'");




    $_SESSION["message"] = "Категория изменена";
    echo '<script>window.location="index.php?page=show_calculator";</script>';
    exit();
}