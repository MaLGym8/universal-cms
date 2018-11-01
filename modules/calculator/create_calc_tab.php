<?php
include_once("../../config.php");

if(isset($_POST["create_tab"]))
{
    $Filter = unserialize(urldecode($_POST["create_tab"]));
    $tabid = $_POST["tabid"];

    $Options = $Filter[0];


    if($Options)
    {
        foreach ($Options as $Filter)
        {
            $OptionFilter[$Filter] = $Filter;

            $Filter = $Filter;
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






    $CATS2 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`='1' and `public`=1 ORDER by position ASC");




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

                    $html .= ' <div class="calculator-cat2">'. $CAT2["name"].'</div>';

                    foreach ($Items as $Item) {
                        if(is_numeric(array_search($Item["id"], $FilterItems))) {

                            //Значения разделов подкатегорий
                            $Values = $db->read_all(
                                "SELECT * FROM `calculator_values` WHERE `item_id`='" . $Item["id"]
                                . "' AND `public`=1  ORDER by position ASC"
                            );
                            if ($Values) {
                                $html .= '<div class="main-block-item '.$Item["class"].'"><div class="calculator-item"><span>'.$Item["name"].'</span>';
                                if($Item["name"]):
                                $html .='<div class="control-item">';
        if($Item["type"]=="radio"):
            $html .='<a href="" class="action-1">Снять</a>';
else:
    $html .='<a href="" class="action-2">Выделить</a> / <a href="" class="action-3">Снять</a>';
endif;$html .='</div>';

endif;
                                $html .='</div>
                ';
                                foreach($Values as $Value)
                                {
                                    // if(is_numeric(array_search($Value["id"], $FilterValues)))
                                    if(is_numeric(array_search($Value["id"],$OptionFilter))){

                                        $COAST = $Value["coast"];
                                        $TIME = $Value["time"];

                                        if($tabid==2&&$Value["coeff"]>0&&$Value["coast"])
                                        {
                                            $COAST = intval($Value["coast"]*$Value["coeff"]);
                                            $TIME = intval($Value["time"]*$Value["coeff"]);
                                        }elseif($tabid==2&&$Value["coeff"]==0){
                                            $COAST=0;
                                            $TIME=0;
                                        }

                                        $html .= '
<div class="calculator-value">';

                                    if($Item["type"]=="check"):
                                        $html .= '<input type="checkbox" class="calc-checkbox1" id="checkbox-2'.$Value["id"].'" coast="'.$COAST.'" '.$CH.'   name="value-calc[]" value="'.$Value["id"].'"  time="'.$TIME.'" stepen1="'.$Value["stepen1"].'" stepen2="'.$Value["stepen2"].'" stepen3="'.$Value["stepen3"].'" stepen4="'.$Value["stepen4"].'" />
    <label for="checkbox-2'.$Value["id"].'">'.$Value["name"].'</label>';

                                    else:
                                        $html .= '<input name="radio2-'.$Item["id"].'" type="radio" class="calc-radio1" id="radio-2'.$Value["id"].'" '.$CH.'  coast="'.$COAST.'"  name="value-calc[]" value="'.$Value["id"].'"  time="'.$TIME.'" stepen1="'.$Value["stepen1"].'" stepen2="'.$Value["stepen2"].'" stepen3="'.$Value["stepen3"].'" stepen4="'.$Value["stepen4"].'"  />
    <label for="radio-2'.$Value["id"].'">'.$Value["name"].'</label>';
                                    endif;


                                    if($Value["number"]){
                                        $html .= ' <input class="calc-number" type="number" min="1" value="1"/>  <span class="text-count-calc">'.$Value["number_coast"].'</span>';
                                    }

                        if($Value["tooltip"]){
                            $html .= '<div class="tooltip-1 tooltip"><div class="tooltiptext ">'.$Value["tooltip"].'</div></div>';
                        }

                        if($COAST){
                            $html .= '<div class="val-coast"><span>'.$COAST.'</span>  руб.</div>';
                        }





                                    if($Value["dop_items"]){
                                        $html .= '<br/><div class="calc-dopitems">';
                                        $DopItems = explode(",",$Value["dop_items"]);
                                        $i = 0;
                                        foreach($DopItems as $DopItem)
                                        {
                                            $i++;
                                            $DopItem = explode("|",$DopItem);

                                            if(is_numeric(array_search($Value["id"],$OptionFilter)))
                                            {
                                                $count = intval(array_search($Value["id"],$OptionFilter));
                                                $OPT="";
                                                foreach($Options as $Opt)
                                                {

                                                    if($Opt[0]==$count)
                                                    {
                                                        $OPT = $Opt[1];
                                                    }else{

                                                    }
                                                }
                                            }

                                            if($DopItem[0]==$OPT)
                                            {

                                                $CH2 = " checked=\"checked\" ";
                                            }
                                            $iii=$i+$Value["id"];

                                            $html .= '
                        <input id="radio-3'.$iii.'" '.$CH2.' class="calc-radio1" name="radio3-'.$Value["id"].'" coast="'.$DopItem[1].'"   value="'.$DopItem[0].'" type="radio">
                        <label for="radio-3'.$iii.'">'.$DopItem[0].'';
if($DopItem[1]): $html .='<div class="val-coast"><span>'.$DopItem[1].'</span>  руб.</div>'; endif;

                        $html .='</label>';







                                        }
                                        $html .= '</div>';

                                    }

                                    $html .= '</div>';

                                }//value
                                }//value
                                $html .='</div>';
                            }
                        }
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
            if(is_numeric(array_search($Item["id"], $FilterItems))) {
                //Значения разделов подкатегорий
                $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1  ORDER by position ASC");
                if($Values)
                {
                    $html .= '<div class="main-block-item '.$Item["class"].'"><div class="calculator-item"><span>'.$Item["name"].'</span>';   $html .='<div class="control-item">';

                    if($Item["name"]):
                    if($Item["type"]=="radio"):
                        $html .='<a href="" class="action-1">Снять</a>';
                    else:
                        $html .='<a href="" class="action-2">Выделить</a> / <a href="" class="action-3">Снять</a>';
                    endif;
                    $html .='</div>';
                        endif;
                    $html .='</div>';
                    foreach($Values as $Value)
                    {
                        // if(is_numeric(array_search($Value["id"], $FilterValues)))
                        //
                        if(is_numeric(array_search($Value["id"],$OptionFilter)))
                        {
                            $TIME = $Value["time"];
                            $COAST = $Value["coast"];
                            if($tabid==2&&$Value["coeff"]>0&&$Value["coast"])
                            {
                                $COAST = intval($Value["coast"]*$Value["coeff"]);
                                $TIME = intval($Value["time"]*$Value["coeff"]);

                            }elseif($tabid==2&&$Value["coeff"]==0){
                                $COAST=0;
                                $TIME=0;
                            }

                        $html .= '
<div class="calculator-value">';





                        if($Item["type"]=="check"):
                            $html .= '<input type="checkbox" '.$CH.' class="calc-checkbox1" id="checkbox-2'.$Value["id"].'" coast="'.$COAST.'"   name="value-calc[]" value="'.$Value["id"].'" time="'.$TIME.'"  stepen1="'.$Value["stepen1"].'" stepen2="'.$Value["stepen2"].'" stepen3="'.$Value["stepen3"].'" stepen4="'.$Value["stepen4"].'" />
    <label for="checkbox-2'.$Value["id"].'">'.$Value["name"].'</label>';

                        else:
                            $html .= '<input '.$CH.' name="radio2-'.$Item["id"].'" type="radio" class="calc-radio1" id="radio-2'.$Value["id"].'"  coast="'.$COAST.'"  name="value-calc[]" value="'.$Value["id"].'"  time="'.$TIME.'"  stepen1="'.$Value["stepen1"].'" stepen2="'.$Value["stepen2"].'" stepen3="'.$Value["stepen3"].'" stepen4="'.$Value["stepen4"].'" />
    <label for="radio-2'.$Value["id"].'">'.$Value["name"].'</label>';
                        endif;


                        if($Value["number"]){
                            $html .= ' <input class="calc-number" type="number" min="1" value="1"/>  <span class="text-count-calc">'.$Value["number_coast"].'</span>';
                        }



                        if($Value["tooltip"]){
                            $html .= '<div class="tooltip-1 tooltip"><div class="tooltiptext ">'.$Value["tooltip"].'</div></div>';
                        }

                        if($COAST){
                            $html .= '<div class="val-coast"><span>'.$COAST.'</span> руб.</div>';
                        }



                        if($Value["dop_items"]){
                            $html .= '<br/><div class="calc-dopitems">';
                            $DopItems = explode(",",$Value["dop_items"]);
                            $i = 0;
                            foreach($DopItems as $DopItem)
                            {
                                $i++;
                                $DopItem = explode("|",$DopItem);

                                if(is_numeric(array_search($Value["id"],$OptionFilter)))
                                {
                                    $count = intval(array_search($Value["id"],$OptionFilter));
                                    $OPT="";
                                    foreach($Options as $Opt)
                                    {

                                        if($Opt[0]==$count)
                                        {
                                            $OPT = $Opt[1];
                                        }else{

                                        }
                                    }
                                }

                                if($DopItem[0]==$OPT)
                                {


                                }

                                $iii=$i+$Value["id"];

                                $html .= '
                        <input id="radio-3'.$iii.'" '.$CH2.' class="calc-radio1" name="radio3-'.$Value["id"].'" coast="'.$DopItem[1].'"   value="'.$DopItem[0].'" type="radio">
                        <label for="radio-3'.$iii.'">'.$DopItem[0].'</label>';







                            }
                            $html .= '</div>';

                        }

                        $html .= '
            </div>

                                          

                                            
                                            ';

                    }
                    }
                    $html .='</div>';
                }
            }
        }
    }

    echo $html;




}