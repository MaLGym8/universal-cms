<div class="calc-tabs">
    <div class="section">
        <div class="ulcenter" id="calc-tab">
        
        <?php /*?>
        	<div align="center" class="titlecalc">Готовые наборы функций</div>
            <ul class="portfolio-cats list">
                <li class="current"></li>
                <li tabid="1" filter="<?=urlencode($Site1)?>" ><a href="#calc-tab">
				Сайт визитка<div>от 10 000 руб.</div></a></li>
                <li tabid="2" filter="<?=urlencode($Site2)?>"><a href="#calc-tab">
                Landing page<div>от 25 000 руб.</div></a></li>
                <li tabid="3" filter="<?=urlencode($Site3)?>"><a href="#calc-tab">
                Корпоративный сайт<div>от 35 000 руб.</div></a></li>
                <li tabid="4" filter="<?=urlencode($Site4)?>"><a href="#calc-tab">
                Сайт-каталог<div>от 35 000 руб.</div></a></li>
                <li tabid="5" filter="<?=urlencode($Site5)?>"><a href="#calc-tab">
                Интернет-магазин<div>от 50 000 руб.</div></a></li>
                <!--<li tabid="6" filter="<?=urlencode($Site6)?>"><a href="#calc-tab">Индивидуальный проект</a></li>-->
            </ul>
            <?php */?>

            <div id="changetab">
                <input type="checkbox" class="calc-checkbox1" id="checkbox-201" name="changetab"/>
                <label for="checkbox-201" class="boldpunkt">Показать элементы интернет магазина</label>
            </div>



            <ul class="portfolio-cats list" style="display: none;">

                <li tabid="1"  id="calctab=1" filter="<?=urlencode($Site1)?>" ><a href="#calctab=1">
                        Сайт<?php /*?><div> от 10 000 руб.</div><?php */?></a></li>
                <li tabid="2"  class="current" id="calctab=2" filter="<?=urlencode($Site2)?>"><a href="#calctab=2">
                        Интернет-магазин<?php /*?><div> от 25 000 руб.</div><?php */?></a></li>
            </ul>

            
        </div><br />

        
        
        <?/*<div class="box visible tbl0"><?

            if($CATS2)
            {
                foreach ($CATS2 as $CAT2)
                {
                    //Разделы подкатегорий
                    $Items = $db->read_all("SELECT * FROM `calculator_items` WHERE `cat_id`='".$CAT2["id"]."' and `public`=1  ORDER by position ASC");
                    if($Items)
                    {
                        ?>
                        <div class="calculator-cat2"><?=$CAT2["name"]?></div>
                        <?
                        foreach ($Items as $Item)
                        {

                            //Значения разделов подкатегорий
                            $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1  ORDER by position ASC");
                            if($Values)
                            {
                                echo '<div class="main-block-item '.$Item["class"].'">';
                                CalcItem($Item);
                                foreach($Values as $Value)
                                {
                                    CalcValue($Value,$Item);
                                }
                                echo'</div>';

                            }
                        }
                    }
                }
            }

            //Значения 1-го уровня категорий
            $Items = $db->read_all("SELECT * FROM `calculator_items` WHERE `cat_id`='".$CAT1["id"]."' and `public`=1  ORDER by position ASC");
            if($Items)
            {
                foreach ($Items as $Item)
                {
                    //Значения разделов подкатегорий
                    $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1  ORDER by position ASC");
                    if($Values)
                    {
                        CalcItem($Item);
                        echo '<div class="main-block-item '.$Item["class"].'">';
                        foreach($Values as $Value)
                        {
                            CalcValue($Value,$Item);

                        }
                        echo '</div>';
                    }
                }
            }
            ?></div>*/?>
        <div class="box tbl1">1</div>
        <div class="box tbl2">2</div>
    </div>
</div>