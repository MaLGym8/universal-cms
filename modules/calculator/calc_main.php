<?php
$CATS1 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`=0 and `public`=1 ORDER by position ASC");
if($CATS1)
{
    //Главные категории
    foreach ($CATS1 as $CAT1)
    {
        $CATS2 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`='".$CAT1["id"]."' and `public`=1 ORDER by position ASC");
        $CheckCatItems = array();
        $CheckCatItems[0] = $db->read("SELECT `public`,`cat_id`,`position` FROM `calculator_items` WHERE `cat_id`='".$CAT1["id"]."' and public=1 ORDER by position ASC");

        if($CATS2)
        {
            foreach($CATS2 as $CAT2)
            {
                $CheckCatItems[] = $db->read("SELECT `public`,`cat_id`,`position` FROM `calculator_items` WHERE `cat_id`='".$CAT2["id"]."' and public=1 ORDER by position ASC");
            }
        }




        if($CheckCatItems[0]!=''||$CheckCatItems[1]!=''){
            ?>
            <div class="calculator-cat-inner" calccatid="<?=$CAT1["id"];?>">

                <div class="calculator-cat1">
                    <?CalcCat1($CAT1)?>
                    <?CalcCatCheck($CAT1)?>
                    <div class="cat-itog">Цена: <span class="coast">0</span> руб.</div>


                </div>
                <div class="calculator-content">
                    
                    <?
                    if($CAT1["id"]==1):
                       
                        include_once ("calc_tabs.php");
                    else:
                    ;
                        ?>



                    <?
                    //Подкатегории
                    if($CATS2)
                    {
                        foreach ($CATS2 as $CAT2)
                        {
                            //Разделы подкатегорий
                            $Items = $db->read_all("SELECT * FROM `calculator_items` WHERE `cat_id`='".$CAT2["id"]."' and `public`=1 ORDER by position ASC");
                            if($Items)
                            {
                                ?>
                                <div class="calculator-cat2"><?=$CAT2["name"]?></div>
                                <?
                                foreach ($Items as $Item)
                                {

                                    //Значения разделов подкатегорий
                                    $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1 ORDER by position ASC");
                                    if($Values)
                                    {
                                        echo '<div class="main-block-item '.$Item["class"].'">';
                                        CalcItem($Item);
                                        foreach($Values as $Value)
                                        {
                                            CalcValue($Value,$Item);
                                        }
                                        echo '</div>';
                                    }
                                }
                            }
                        }
                    }

                    //Значения 1-го уровня категорий
                    $Items = $db->read_all("SELECT * FROM `calculator_items` WHERE `cat_id`='".$CAT1["id"]."' and `public`=1 ORDER by position ASC");
                    if($Items)
                    {
                        foreach ($Items as $Item)
                        {
                            //Значения разделов подкатегорий
                            $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1 ORDER by position ASC");
                            if($Values)
                            {echo '<div class="main-block-item '.$Item["class"].'">';
                                CalcItem($Item);
                                foreach($Values as $Value)
                                {
                                    CalcValue($Value,$Item);

                                }
                                echo '</div>';
                            }
                        }
                    }
                    endif;
                    ?>
                </div>
            </div>
            <?
        }
    }
}
?>