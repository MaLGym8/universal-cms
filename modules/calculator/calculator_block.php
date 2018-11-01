<link rel="stylesheet" type="text/css" href="<?=$base_url?>/modules/calculator/calculator.css" />
<script type="text/javascript" src="<?=$base_url?>/modules/calculator/calculator.js"></script>

        <div class="calculator-main<?=$hidden;?>">
            
            
            <? if($hidden){?><div class="calculator-bg"><div class="show-calc"><a href="" class="button">Раскрыть калькулятор</a></div></div>

<script>
$(document).on("click",".show-calc a",function(){
    $(".calculator-bg").remove();
    $(".calculator-mainhidden").css("height","auto");
    $(".calculator-mainhidden .calculator-right").show();
    $(".calculator-right").stick_in_parent();

    return false;
});
</script>
		
			<? }else{?>

                <script>
                    $(document).ready(function(){
                        $(".calculator-right").stick_in_parent();
                    });
                </script>


            <?}?>
            <div class="calculator-left">
                <?php

                $Site1Array = $db->read_all("SELECT * FROM `calculator_values` WHERE `stepen4`!=1");
                if($Site1Array)
                {
                    $TMP1 = array();
                    foreach($Site1Array as $Arr)
                    {
                        $Item = $db->read("SELECT * FROM `calculator_items` WHERE `id`='".$Arr["item_id"]."'");
                        $Cat = $db->read("SELECT * FROM `calculator_cats` WHERE `id`='".$Item["cat_id"]."'");
                        if($Cat["parent"]==1)
                        {
                            $TMP1[$Arr["id"]]=$Arr["id"];
                        }
                    }
                    $Site1Array="";
                    $Site1Array[0] = $TMP1;
                }


                $Site2Array = $db->read_all("SELECT * FROM `calculator_values` WHERE `stepen4`!='2'");
                if($Site2Array)
                {
                    $TMP2 = array();
                    foreach($Site2Array as $Arr)
                    {
                        $Item = $db->read("SELECT * FROM `calculator_items` WHERE `id`='".$Arr["item_id"]."'");
                        $Cat = $db->read("SELECT * FROM `calculator_cats` WHERE `id`='".$Item["cat_id"]."'");
                        if($Cat["parent"]==1)
                        {
                            $TMP2[$Arr["id"]]=$Arr["id"];
                        }
                    }
                    $Site2Array="";
                    $Site2Array[0] = $TMP2;
                }



                $Site1 = serialize($Site1Array);//Визитка
				$Site2 = serialize($Site2Array);//Landing
                $_SESSION["tab1"]=$Site1;
                $_SESSION["tab2"]=$Site2;
               /* $Site3 = $Site1;//Корпоратиный
                $Site4 = $Site1;//Сайт-каталог
                $Site5 = $Site1;//Интернет-магазин
                //$Site6 = $Site1;//Индивидуальный*/
                ?>





                <?if(isset($CalcFilter)):?>
                    <?include_once ("calc_pages.php")?>
                <?else:?>
                    <?include_once ("calc_main.php")?>
                <?endif;?>


                <div class="calculator-form">
                    <?include_once ("form.php")?>
                </div>

            </div>

            <div class="calculator-right">

                <div class="content">
                    <div class="adp-left">
                    
                    
                    
                    
                   <?php /*?><div class="title">Отметить сразу</div><?php */?>
                    <?php /*?><div class="title_span">Выберите конфигурацию<br />
<span>(это сбросит выбранные Вами опции)</span></div><?php */?>
                    <div class="form">
                        <input checked type="radio" name="showtypecalc" value="0" class="radio2-calc" id="radio0" />
                        <label for="radio0">Своя конфигурация</label>

                        <input type="radio" name="showtypecalc" value="1" class="radio2-calc" id="radio1" />
                        <label for="radio1">Базовый функционал (старт)</label>

                        <input type="radio" name="showtypecalc" value="2"  class="radio2-calc" id="radio2" />
                        <label for="radio2">Стандартный набор функций</label>

                        <input type="radio" name="showtypecalc" value="3"  class="radio2-calc" id="radio3" />
                        <label for="radio3">Расширенный (премиум)</label>


                    </div>
                    </div>


			<div id="changetab">
                <input type="checkbox" class="calc-checkbox1" id="checkbox-201_other" name="changetab">
                <label for="checkbox-201_other" class="boldpunkt">Элементы интернет магазина</label>
            </div>



                    <div class="calc-itog">
                        <div class="itog-1">Итого: <span></span> руб.</div>
                        <div class="itog-2">Срок: <span></span> дней</div>
                    </div>
                    
                    <div class="right_button">Оставить заявку<br />
                   		<span>и получить КП на e-mail</span>
                    </div>

                    <?php /*?><div class="info">
                        Возникли сложности? Позвоните нам <b>+7(916)476-81-32</b><br/>
                        И мы в реальном времени поможем с выбором и подберем для Вас лучшее решение!
                    </div><?php */?>

                </div>

            </div>




        </div>


<input type="hidden" id="calccat" value="<?=$CalcCat?>"/>
<input type="hidden" id="calctab" value="<?=$CalcTab?>"/>


<?php


function CalcCatCheck($CAT1)
{
    ?>
    <div class="label">
        <input type="checkbox" name="calc-cat1[]" class="calc-checkbox1" id="checkbox-1<?=$CAT1["id"]?>" coast="<?=$CAT1["coast"]?>"/>
        <label for="checkbox-1<?=$CAT1["id"]?>">Включить</label>
    </div>
    <?
}

function CalcCat1($CAT1)
{
    ?>
    <div class="click-blcok"></div>

    <div class="calcslideinner"><?=$CAT1["name"];?></div>

    <?
}

function CalcItem($Item)
{
    ?>
    <div class="calculator-item"><span><?=$Item["name"]?></span>
        <?if($Item["tooltip"]){?>
            <div class="tooltip-1 tooltip">
                <div class="tooltiptext "><?=$Item["tooltip"];?></div>
            </div>
        <?}?>
        <?if($Item["name"]):?>
        <div class="control-item">
        <?if($Item["type"]=="radio"):?>
            <a href="" class="action-1">Снять</a>
        <?else:?>
            <a href="" class="action-2">Выделить</a> / <a href="" class="action-3">Снять</a>
        <?endif;?>
        </div><?endif;?>
    </div>
    <?
}

function CalcValue($Value,$Item)
{
    ?>
    <div class="calculator-value">
        <?if($Item["type"]=="check"):?>
            <input type="checkbox" class="calc-checkbox1" id="checkbox-2<?=$Value["id"]?>" coast="<?=$Value["coast"]?>" time="<?=$Value["time"]?>" stepen1="<?=$Value["stepen1"]?>" stepen2="<?=$Value["stepen2"]?>" stepen3="<?=$Value["stepen3"]?>" stepen4="<?=$Value["stepen4"]?>" name="value-calc[]" value="<?=$Value["id"]?>"/>
            <label for="checkbox-2<?=$Value["id"]?>"><?=$Value["name"]?></label>

        <?else:?>
            <input name="radio2-<?=$Item["id"]?>" type="radio" class="calc-radio1" id="radio-2<?=$Value["id"]?>"  coast="<?=$Value["coast"]?>" time="<?=$Value["time"]?>" stepen1="<?=$Value["stepen1"]?>" stepen2="<?=$Value["stepen2"]?>" stepen3="<?=$Value["stepen3"]?>" stepen4="<?=$Value["stepen4"]?>" name="value-calc[]" value="<?=$Value["id"]?>"/>
            <label for="radio-2<?=$Value["id"]?>"><?=$Value["name"]?></label>

        <?endif;?>


        <?if($Value["number"]){?>
            <input class="calc-number" type="number" min="1" value="1"/> <span class="text-count-calc"><?=$Value["number_coast"];?></span>
        <?}?>


        <?if($Value["tooltip"]){?>
            <div class="tooltip-1 tooltip"><div class="tooltiptext "><?=$Value["tooltip"];?></div></div>
        <?}?>

        <?if($Value["coast"]){?>
            <div class="val-coast"><span><?=$Value["coast"];?></span>  руб.</div>
        <?}?>


        <?
        if($Value["dop_items"]){
            echo'<br/><div class="calc-dopitems">';
            $DopItems = explode(",",$Value["dop_items"]);
            $i = 0;
            foreach($DopItems as $DopItem)
            {
                $i++;
                $DopItem = explode("|",$DopItem);

                $rand =rand(0,999);
                ?>


                <input id="radio-3<?=$i+$Value["id"]*$rand;?>" class="calc-radio1" name="radio3-<?=$Value["id"]?>" coast="<?=$DopItem[1]?>"   value="<?=$DopItem[0]?>" type="radio">
                <label for="radio-3<?=$i+$Value["id"]*$rand;?>"><?=$DopItem[0]?>

                    <?if($DopItem[1]):?><div class="val-coast"><span><?=$DopItem[1]?></span>  руб.</div><?endif;?>
                </label>






                <?
            }
            echo '</div>';

        }
        ?>

    </div>
    <?
}


