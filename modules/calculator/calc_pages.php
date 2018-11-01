<?php
$CalcFilter = unserialize($CalcFilter);


$FilterValues = $CalcFilter[0];

if($FilterValues)
{
    foreach ($FilterValues as $Filter)
    {
        $TMP = $db->read("SELECT * FROM `calculator_values` WHERE `id`='$Filter'");
        $TMP = $db->read("SELECT * FROM `calculator_items` WHERE `id`='".$TMP["item_id"]."'");
        $FilterItems[$TMP["id"]] = $TMP["id"];
        $TMP = $db->read("SELECT * FROM `calculator_cats` WHERE `id`='".$TMP["cat_id"]."'");
        $FilterCats[$TMP["id"]] = $TMP["id"];
        if($TMP["parent"])
        {
            $TMP = $db->read("SELECT * FROM `calculator_cats` WHERE `id`='".$TMP["parent"]."'");
            $FilterCats[$TMP["id"]] = $TMP["id"];

        }
    }
}





$CATS1 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`=0 and `public`=1 ORDER by position ASC");
if($CATS1)
{
    //Главные категории
    foreach ($CATS1 as $CAT1)
    {
        $CATS2 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`='".$CAT1["id"]."' and `public`=1 ORDER by position ASC");




        if(is_numeric(array_search($CAT1["id"], $FilterCats))){
            ?>
            <div class="calculator-cat-inner" calccatid="<?=$CAT1["id"];?>">

                <div class="calculator-cat1">
                    <?CalcCat1($CAT1)?>
                    <?CalcCatCheck($CAT1)?>
                    <div class="cat-itog">Цена: <span class="coast">0</span> руб.</div>
                </div>
                <div class="calculator-content">



                    <?
                    //Подкатегории
                    if($CATS2)
                    {
                        foreach ($CATS2 as $CAT2) {
                            if (is_numeric(array_search($CAT2["id"], $FilterCats))) {
                                //Разделы подкатегорий
                                $Items = $db->read_all(
                                    "SELECT * FROM `calculator_items` WHERE `cat_id`='" . $CAT2["id"]
                                    . "' and `public`=1  ORDER by position ASC"
                                );
                                if ($Items) {
                                    ?>
                                    <div class="calculator-cat2"><?= $CAT2["name"] ?></div>
                                    <?
                                    foreach ($Items as $Item) {
                                        if(is_numeric(array_search($Item["id"], $FilterItems))) {

                                            //Значения разделов подкатегорий
                                            $Values = $db->read_all(
                                                "SELECT * FROM `calculator_values` WHERE `item_id`='" . $Item["id"]
                                                . "' AND `public`=1 "
                                            );
                                            if ($Values) {echo '<div class="main-block-item '.$Item["class"].'">';
                                                CalcItem($Item);
                                                foreach ($Values as $Value) {
                                                    if(is_numeric(array_search($Value["id"], $FilterValues)))
                                                        CalcValue($Value, $Item);
                                                }
                                                echo '</div>';
                                            }
                                        }
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
                            if(is_numeric(array_search($Item["id"], $FilterItems))) {
                            //Значения разделов подкатегорий
                            $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1 ORDER by position ASC");
                            if($Values)
                            {echo '<div class="main-block-item '.$Item["class"].'">';
                                CalcItem($Item);
                                foreach($Values as $Value)
                                {
                                    if(is_numeric(array_search($Value["id"], $FilterValues)))
                                        CalcValue($Value,$Item);

                                }
                                echo '</div>';
                            }
                        }
                        }
                    }
                    ?>
                </div>
            </div>
            <?
        }
    }
}
?>