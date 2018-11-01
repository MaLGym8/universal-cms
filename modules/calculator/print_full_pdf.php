<?




$stylesheet = file_get_contents(__DIR__.'/calculator_pdf.css');
$html_full = '
<div class="calculator-main">
    <div class="calculator-left">';

$CATS1 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`=0 and `public`=1 ORDER by position ASC");
if($CATS1)
{
    //Главные категории
    foreach ($CATS1 as $CAT1)
    {
        $CATS2 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`='".$CAT1["id"]."' and `public`=1 ORDER by position ASC");





        $html_full .= '  <div class="calculator-cat-inner">

                <div class="calculator-cat1">
                    <div class="calcslideinner">'.$CAT1["name"].'</div>       
                           <div class="cat-itog">Цена: <span class="coast">'.$CoastCats[$CAT1["id"]].'</span> руб.</div>
                           
                </div>
                <div class="calculator-content">';




        //Подкатегории
        if($CATS2)
        {
            foreach ($CATS2 as $CAT2) {

                //Разделы подкатегорий
                $Items = $db->read_all(
                    "SELECT * FROM `calculator_items` WHERE `cat_id`='" . $CAT2["id"]
                    . "' and `public`=1 ORDER by position ASC"
                );
                if ($Items) {

                    $html_full .= ' <div class="calculator-cat2">'. $CAT2["name"].'</div>';

                    foreach ($Items as $Item) {


                        //Значения разделов подкатегорий
                        $Values = $db->read_all(
                            "SELECT * FROM `calculator_values` WHERE `item_id`='" . $Item["id"]
                            . "' AND `public`=1 $AddQuery ORDER by position ASC"
                        );
                        if ($Values) {
                            $html_full .= '<div class="calculator-item"><span>'.$Item["name"].'</span></div>';
                            foreach($Values as $Value)
                            {
                                // if(is_numeric(array_search($Value["id"], $FilterValues)))
                                if(is_numeric(array_search($Value["id"],$OptionFilter)))
                                {
                                    $CH = " checked=\"checked\" ";
                                    $class1=" style='color:#000;'";
                                }else{
                                    $CH = " ";
                                    $class1="";
                                }
                                $html_full .= '
<div class="calculator-value " '.$class1.'>';

                                $COAST = $Value["coast"];
                                if($tabid==2&&$Value["coeff"]>0&&$Value["coast"])
                                {
                                    $COAST = intval($Value["coast"]*$Value["coeff"]);
                                }elseif($tabid==2&&$Value["coeff"]==0){
                                    $COAST=0;
                                }




                                if($Item["type"]=="check"):
                                    $html_full .= '<input type="checkbox" class="calc-checkbox1" id="checkbox-2'.$Value["id"].'" coast="'.$COAST.'" '.$CH.'   name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="checkbox-2'.$Value["id"].'">'.$Value["name"].'</label>';

                                else:
                                    $html_full .= '<input name="radio2-'.$Item["id"].'" type="radio" class="calc-radio1" id="radio-2'.$Value["id"].'" '.$CH.'  coast="'.$COAST.'"  name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="radio-2'.$Value["id"].'">'.$Value["name"].'</label>';
                                endif;

		if($CountMain[$Value["id"]]==0)
												$CountMain[$Value["id"]]=1;
                                if($Value["number"]){
                                    $html_full .= ' <input class="calc-number" type="number" min="1" value="'.$CountMain[$Value["id"]].'"/> '.$Value["number_coast"].'';
                                }
								
						
                                if($COAST){
                                    $html_full .= '<span class="val-coast">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$COAST*$CountMain[$Value["id"]].' руб.</span>';
                                }





                                if($Value["dop_items"]){
                                    $html_full .= '<br/><div class="calc-dopitems">';
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
                                        }else{
                                            $CH2 = "  ";

                                        }

                                        $html_full .= '
                        <input id="radio-3'.$i.'" '.$CH2.' class="calc-radio1" name="radio3-'.$Value["id"].'" coast="'.$DopItem[1].'"   value="'.$DopItem[0].'" type="radio">
                        <label for="radio-3'.$i.'">'.$DopItem[0].''; if($DopItem[1]):
                                        $html_full .= '<span class="val-coast"> <span>'.$DopItem[1].'</span>  руб.</span>';endif; $html_full .= '</label>';







                                    }
                                    $html_full .= '</div>';

                                }

                                $html_full .= '</div> ';

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

                //Значения разделов подкатегорий
                $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1 $AddQuery ORDER by position ASC");
                if($Values)
                {
                    $html_full .= '<div class="calculator-item"><span>'.$Item["name"].'</span></div>';
                    foreach($Values as $Value)
                    {
                        // if(is_numeric(array_search($Value["id"], $FilterValues)))

                        if(is_numeric(array_search($Value["id"],$OptionFilter)))
                        {
                            $CH = " checked=\"checked\" ";
                            $class1=" style='color:#000;'";
                        }else{
                            $CH = "";
                            $class1="";

                        }

                        $html_full .= '
<div class="calculator-value " '.$class1.'>';





                        $COAST = $Value["coast"];
                        if($tabid==2&&$Value["coeff"]>0&&$Value["coast"])
                        {
                            $COAST = intval($Value["coast"]*$Value["coeff"]);
                        }elseif($tabid==2&&$Value["coeff"]==0){
                            $COAST=0;
                        }

                        if($Item["type"]=="check"):
                            $html_full .= '<input type="checkbox" '.$CH.' class="calc-checkbox1" id="checkbox-2'.$Value["id"].'" coast="'.$COAST.'"   name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="checkbox-2'.$Value["id"].'">'.$Value["name"].'</label>';

                        else:
                            $html_full .= '<input '.$CH.' name="radio2-'.$Item["id"].'" type="radio" class="calc-radio1" id="radio-2'.$Value["id"].'"  coast="'.$COAST.'"  name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="radio-2'.$Value["id"].'">'.$Value["name"].'</label>';
                        endif;

	if($CountMain[$Value["id"]]==0)
												$CountMain[$Value["id"]]=1;
                        if($Value["number"]){
                            $html_full .= ' <input class="calc-number" type="number" min="1"   value="'.$CountMain[$Value["id"]].'"/> '.$Value["number_coast"].'';
                        }


					
                        if($COAST){
                            $html_full .= '<span class="val-coast">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$COAST*$CountMain[$Value["id"]].' руб.</span>';
                        }


                        if($Value["dop_items"]){
                            $html_full .= '<br/><div class="calc-dopitems">';
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
                                }else{
                                    $CH2 = "";
                                }

                                $html_full .= '
                        <input id="radio-3'.$i.'" '.$CH2.' class="calc-radio1" name="radio3-'.$Value["id"].'" coast="'.$DopItem[1].'"   value="'.$DopItem[0].'" type="radio">
                       <label for="radio-3'.$i.'">'.$DopItem[0].''; if($DopItem[1]):
                                $html_full .= '<span class="val-coast"> <span>'.$DopItem[1].'</span>  руб.</span>';endif; $html_full .= '</label>';







                            }
                            $html_full .= '</div>';

                        }

                        $html_full .= '
            </div>

                                          

                                            
                                            ';

                    }
                }

            }
        }

        $html_full .= ' </div>          </div>';


    }
}




$html_full .= ' 
            
    </div>            
  </div>
 ';