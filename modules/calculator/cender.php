<?
include_once("../../config.php");
//Форма заказа Bottom
if (isset($_POST["sendordercalc"])) {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['number'])) {
        $phone = $_POST['number'];
    }
    if (isset($_POST['message'])) {
        $text = $_POST['message'];
    }

    if (isset($_POST['formname'])) {
        $site = $_POST['formname'];
    }
    $link = $_POST["link"];
    $title = $_POST["title"];
    $typeform = $_POST["typeform"];

    $Array = $_POST["array"];
    $COASTALL = $_POST["coast"];
    $TIME = $_POST["time"];
    $tabid = $_POST["tabid"];
    if($tabid==1)
    {
        $AddQuery = " AND `stepen4`!=1 ";
    }else{
        $AddQuery = " AND `stepen4`!=2 ";

    }
    //===========================
    //===========================
    //===========================
    //===========================
    //===========================
    //===========================
    //===========================



$Options = json_decode(urldecode($Array));
$OptionFilter = array();
$CoastCats = json_decode(urldecode($_POST["coastcats"]));

if($Options)
{
    foreach ($Options as $Filter)
    {
        $OptionFilter[$Filter[0]] = $Filter[0];
        if($Filter[2]==0)
            $Filter[2]=1;
        $CountMain[$Filter[0]] = $Filter[2];
        $Filter = $Filter[0];
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












$stylesheet = file_get_contents(__DIR__.'/calculator_pdf.css');

$html_header = '<div class="heder-left"><img src="../../images/logo.png"/></div>
<div class="heder-center">Предварительный расчет стоимости работ</div>
<div class="heder-right"><b>'.$phone_m.'</b><br/>'.$EmailTO.'</div>';
$html .= $html_header;
$html .= '
<div class="calculator-main">
    <div class="calculator-left">';

$CATS1 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`=0 and `public`=1 ORDER by position ASC");
if($CATS1)
{
    //Главные категории
    foreach ($CATS1 as $CAT1)
    {
        $CATS2 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`='".$CAT1["id"]."' and `public`=1 ORDER by position ASC");




        if(is_numeric(array_search($CAT1["id"], $FilterCats))){

            $html .= '  <div class="calculator-cat-inner">

                <div class="calculator-cat1">
                    <div class="calcslideinner">'.$CAT1["name"].'</div>       
                           <div class="cat-itog">Цена: <span class="coast">'.$CoastCats[$CAT1["id"]].'</span> руб.</div>
                           
                </div>
                <div class="calculator-content">';




            //Подкатегории
            if($CATS2)
            {
                foreach ($CATS2 as $CAT2) {
                    if (is_numeric(array_search($CAT2["id"], $FilterCats))) {
                        //Разделы подкатегорий
                        $Items = $db->read_all(
                            "SELECT * FROM `calculator_items` WHERE `cat_id`='" . $CAT2["id"]
                            . "' and `public`=1 ORDER by position ASC"
                        );
                        if ($Items) {

                            $html .= ' <div class="calculator-cat2">'. $CAT2["name"].'</div>';

                            foreach ($Items as $Item) {
                                if(is_numeric(array_search($Item["id"], $FilterItems))) {

                                    //Значения разделов подкатегорий
                                    $Values = $db->read_all(
                                        "SELECT * FROM `calculator_values` WHERE `item_id`='" . $Item["id"]
                                        . "' AND `public`=1 $AddQuery ORDER by position ASC"
                                    );
                                    if ($Values) {
                                        $html .= '<div class="calculator-item"><span>'.$Item["name"].'</span></div>';
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
                                            $html .= '
<div class="calculator-value " '.$class1.'>';

                                            $COAST = $Value["coast"];
                                            if($tabid==2&&$Value["coeff"]>0&&$Value["coast"])
                                            {
                                                $COAST = intval($Value["coast"]*$Value["coeff"]);
                                            }elseif($tabid==2&&$Value["coeff"]==0){
                                                $COAST=0;
                                            }




                                            if($Item["type"]=="check"):
                                                $html .= '<input type="checkbox" class="calc-checkbox1" id="checkbox-2'.$Value["id"].'" coast="'.$COAST.'" '.$CH.'   name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="checkbox-2'.$Value["id"].'">'.$Value["name"].'</label>';

                                            else:
                                                $html .= '<input name="radio2-'.$Item["id"].'" type="radio" class="calc-radio1" id="radio-2'.$Value["id"].'" '.$CH.'  coast="'.$COAST.'"  name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="radio-2'.$Value["id"].'">'.$Value["name"].'</label>';
                                            endif;

											if($CountMain[$Value["id"]]==0)
												$CountMain[$Value["id"]]=1;
                                            if($Value["number"]){
                                                $html .= ' <input  value="'.$CountMain[$Value["id"]].'" class="calc-number" type="number" min="1" /> '.$Value["number_coast"].'';
                                            }
                                            if($COAST){
                                                $html .= '<span class="val-coast">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$COAST*$CountMain[$Value["id"]].' руб.</span>';
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
                                                    }else{
                                                        $CH2 = "  ";

                                                    }

                                                    $html .= '
                        <input id="radio-3'.$i.'" '.$CH2.' class="calc-radio1" name="radio3-'.$Value["id"].'" coast="'.$DopItem[1].'"   value="'.$DopItem[0].'" type="radio">
                        <label for="radio-3'.$i.'">'.$DopItem[0].''; if($DopItem[1]):
                                                    $html .= '<span class="val-coast"> <span>'.$DopItem[1].'</span>  руб.</span>';endif; $html .= '</label>';







                                                }
                                                $html .= '</div>';

                                            }

                                           $html .= '</div> ';

                                        }
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
                        $Values = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item["id"]."' AND `public`=1 $AddQuery ORDER by position ASC");
                        if($Values)
                        {
                            $html .= '<div class="calculator-item"><span>'.$Item["name"].'</span></div>';
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

                                $html .= '
<div class="calculator-value " '.$class1.'>';





                                $COAST = $Value["coast"];
                                if($tabid==2&&$Value["coeff"]>0&&$Value["coast"])
                                {
                                    $COAST = intval($Value["coast"]*$Value["coeff"]);
                                }elseif($tabid==2&&$Value["coeff"]==0){
                                    $COAST=0;
                                }

                                if($Item["type"]=="check"):
                                    $html .= '<input type="checkbox" '.$CH.' class="calc-checkbox1" id="checkbox-2'.$Value["id"].'" coast="'.$COAST.'"   name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="checkbox-2'.$Value["id"].'">'.$Value["name"].'</label>';

                                else:
                                    $html .= '<input '.$CH.' name="radio2-'.$Item["id"].'" type="radio" class="calc-radio1" id="radio-2'.$Value["id"].'"  coast="'.$COAST.'"  name="value-calc[]" value="'.$Value["id"].'"/>
    <label for="radio-2'.$Value["id"].'">'.$Value["name"].'</label>';
                                endif;

	if($CountMain[$Value["id"]]==0)
												$CountMain[$Value["id"]]=1;

                                if($Value["number"]){
                                    $html .= ' <input  value="'.$CountMain[$Value["id"]].'" class="calc-number" type="number" min="1" /> '.$Value["number_coast"].'';
                                }

							
                                if($COAST){
                                    $html .= '<span class="val-coast">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$COAST*$CountMain[$Value["id"]].' руб.</span>';
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
                                        }else{
                                            $CH2 = "";
                                        }

                                        $html .= '
                        <input id="radio-3'.$i.'" '.$CH2.' class="calc-radio1" name="radio3-'.$Value["id"].'" coast="'.$DopItem[1].'"   value="'.$DopItem[0].'" type="radio">
                       <label for="radio-3'.$i.'">'.$DopItem[0].''; if($DopItem[1]):
                                                    $html .= '<span class="val-coast"> <span>'.$DopItem[1].'</span>  руб.</span>';endif; $html .= '</label>';







                                    }
                                    $html .= '</div>';

                                }

                                $html .= '
            </div>

                                          

                                            
                                            ';

                            }
                        }
                    }
                }
            }

            $html .= ' </div>          </div>';

        }
    }
}




$html .= ' 
            
    </div>            
  </div>';


    $html_footer .= '
  <div class="footer">';
 
$html_footer .= '<div class="footer-left"><div>Свяжитесь с нами:</div>
    Тел: '.$phone_m.' <img src="../../modules/calculator/images/info-calc.png"/> <br/>
    E-mail: '.$EmailTO.'<br/>
    Адрес: '.$address_m.'<br/>
  </div>';
  
$html_footer .= '<div class="footer-right">
  <span>Итого:</span> '.$COASTALL.' рублей<br/>
  <span>Срок:</span>  '.$TIME.' дней<br/>
 
</div></div>';

    $html .= $html_footer;


    include_once ("print_full_pdf.php");
    $html_full = $html_header.$html_full.$html_footer;

//$FILENAME = time()+rand(1000,9999);
$FILENAME = "kp-artweb_".date('H-i-s')."_".date("d-m-Y");

include(__DIR__."/pdf/mpdf.php");
//$mpdf=new mPDF('utf-8','A4');
$mpdf=new mPDF('utf-8', 'A3', 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($stylesheet,1);
if(!$Options)
{
    $mpdf->WriteHTML($html_full);
}
else{
    $mpdf->WriteHTML($html);
}
$mpdf->Output($_SERVER["DOCUMENT_ROOT"].'/files/pdf/'.$FILENAME.'.pdf','F');
//file_put_contents($_SERVER["DOCUMENT_ROOT"].'/files/pdf/'.$FILENAME.'.html',"<style>".$stylesheet."</style>".$html);

    $pdffile = "Предварительное КП: <a href='".$base_url."files/pdf/".$FILENAME.".pdf'>скачать pdf</a><br/>";


if($Options) {
    $mpdf = new mPDF('utf-8', 'A3', 0, '', 0, 0, 0, 0, 0, 0);
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($html_full);
    $mpdf->Output($_SERVER["DOCUMENT_ROOT"] . '/files/pdf/' . $FILENAME . '_full.pdf', 'F');
    $pdffile_admin = "Предварительное КП (полностью): <a href='" . $base_url . "files/pdf/" . $FILENAME
        . "_full.pdf'>скачать pdf</a><br/>";
}


//===========================
    //===========================
    //===========================
    //===========================
    //===========================
    //===========================
    //===========================
    //===========================
























    $fileElementName = 'question_file2';
    $error = "";
    $msg = "";
    if(!empty($_FILES[$fileElementName]['error']))
    {
        switch($_FILES[$fileElementName]['error'])
        {
            case '1':
                $error = 'Размер файла слишком велик.';
                break;
            case '2':
                $error = 'Размер файла слишком велик.';
                break;
            case '3':
                $error = 'Ошибка при загрузке файла #3.';
                break;
            case '4':
                $error = 'Файл не выбран.';
                break;

            case '6':
                $error = 'Ошибка при загрузке файла #6.';
                break;
            case '7':
                $error = 'Ошибка при загрузке файла #7.';
                break;
            case '8':
                $error = 'Ошибка при загрузке файла #8.';
                break;
            case '999':
            default:
                $error = 'Ошибка при загрузке файла #0.';
        }
    }elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
    {
        $error = 'Файл не выбран.';

    }else{
        $msg .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
        $msg .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);
        if($_FILES[$fileElementName]['size']!= 0)
        {
            $type = substr($_FILES[$fileElementName]['name'], strrpos($_FILES[$fileElementName]['name'], '.')+1);
            $file=md5(date('YmdHis').rand(100,1000)).".".$type;
            $link_file = "Файл: <a href='".$base_url."files/files_upload/".$file."'>скачать</a><br/>";

            move_uploaded_file($_FILES[$fileElementName]['tmp_name'], "../../files/files_upload/".$file);
        }
    }

    //===========================

    if($_SESSION["refer"])
    {
        $refer = " (".$_SESSION["refer"].")";
    }
	//$subject = "Заявка с калькулятора от $name (".$site." - ".$title."".$typeform.")";
    $subject = "Заявка с калькулятора от $name";
    $ipadres = GetUserIP();
    $message = "
Имя: " . $name . "<br />";
    if($site1){$message .= "Сайт: " . $site1 . "<br />";}

    if($typeform){$typeformblock = "Комплектация - $typeform<br/>";}

    $message .= "
E-mail: <a href='mailto:$email'>$email</a><br/>
Телефон: " . $phone . "<br />
Сообщение: $text<br/>
IP-адрес: <a href='http://www.seogadget.ru/location?addr=" . $ipadres . "' target='_blank'>" . $ipadres . "</a><br/>
".$link_file."
".$pdffile.$pdffile_admin."
".$typeformblock."
Страница отправки: <a href='".$link."' target='_blank'>".$title."".$typeform."</a>
";

    if(isset($_COOKIE["utm_source"]))
    {
        $message .= $MAILTABLE;
    }

    CreateMailFile($message);




    $messageclient .= "
Спасибо, что обратились к нам! В приложении ссылка на скачивание предварительного КП в pdf<br/><br/>
Ваше имя:  $name <br />
Ваш e-mail: <a href='mailto:$email'>$email</a><br/>
Ваш телефон: " . $phone . "<br />
Ваше сообщение: $text<br/>
".$link_file."
".$pdffile."<br/>
<br/>

С уважением, команда Арт-Веб<br/>
".$phone_m." (whatsapp, viber, telegram)<br/>
".$EmailTO."<br/>
<a href='".$base_url."'>".$base_url."</a>

";

    $text_uvedomlenie='';

    mail($EmailTO, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");
    mail($email, "Расчёт стоимости от ".$sitename."", $messageclient, "Content-type:text/html; charset=utf-8\r\n");
  //  if(!empty($EmailTO2)){mail($EmailTO2, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");}
     // MailSubmit($email,$sitename,$text_uvedomlenie);



    echo "{";
    echo				"error: '" . $error . "',\n";
    echo				"msg: '" . $msg . "'\n";
    echo "}";


/*=======================================PDF=======================================*/
/*=======================================PDF=======================================*/
/*=======================================PDF=======================================*/
/*=======================================PDF=======================================*/
/*=======================================PDF=======================================*/
/*=======================================PDF=======================================*/

















}

?>