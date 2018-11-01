<?php
//Добавление
function Add_Calculator_Cat()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление раздела калькулятора</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return CheckFormCatalog();">
	
    
	<div style="float:left">Категория:<br/>
        <select name="category"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`=0 ORDER by name ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do {
        if ($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["name"]
                . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC1["id"]."' ORDER by name ASC");
            $resultC2 = mysql_fetch_array($queryC2);

            do {
                if ($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $resultC2["name"]
                        . '</option>';

                    $queryC3 = mysql_query("SELECT * FROM `calculator_cats` WHERE `parent`='".$resultC2["id"]."' ORDER by name ASC");
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


    echo '</select></div><br clear="all"/>
    Название категории:<br/>
    <input type="text" name="name"/><br/>
    Стоимость:<br/>
    <input type="text" name="coast"/><br/>
    
    
    
    Подсказка:<br/>
    <textarea name="tooltip" value="" class="tinymce"></textarea><br />
    
    Позиция:<br/>
    <input type="text" name="position" class="w50"/><br/>
    Публикация: 
    <input type="checkbox" name="public" checked value="1"/><br/>
    
        

		
        <input type="submit" name="add_calculator_cat" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}






if(isset($_POST["add_calculator_cat"]))
{
    $cat = $_POST["category"];
    $name = $_POST["name"];
    $coast = $_POST["coast"];
    $tooltip = $_POST["tooltip"];
    $position = $_POST["position"];
    $public = $_POST["public"];




    mysql_query("INSERT INTO calculator_cats (`name`,`tooltip`,`coast`,`position`,`parent`,`public`) VALUES ('$name','$tooltip','$coast','$position','$cat','$public')");




    $_SESSION["message"] = "Категория добавлена";
    echo '<script>window.location="index.php?page=show_calculator";</script>';
    exit();
}