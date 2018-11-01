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
    $anketacoast = $_POST["anketacoast"];

    $ArrayFinalAnketa = $_POST["arrayfinalanketa"];
    $ArrayFinalAnketaQ = $_POST["ArrayFinalAnketaQuest"];

    $ArrayFinalAnketa = json_decode(urldecode($ArrayFinalAnketa));
    $ArrayFinalAnketaQ = json_decode(urldecode($ArrayFinalAnketaQ));


    if($ArrayFinalAnketa)
    {
        $Anketa1 = array();
        foreach($ArrayFinalAnketa as $value)
        {
            $TMP[0] = $value[0];
            $TMP[1] = $value[2];
            $Anketa1[$value[1]][$value[0]] = $TMP;
        }
    }

    if($ArrayFinalAnketaQ)
    {
        $Anketa2 = array();
        foreach($ArrayFinalAnketaQ as $value)
        {

            $Anketa2[$value[1]] = $value[0];
        }
    }


$stylesheet = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/modules/anketa/anketa_pdf.css");

$html_header = '<div class="heder-left"><img src="../../images/logo-page.png"/></div>
<div class="heder-center">Анкета на создание, продвижение сайта</div>
<div class="heder-right"><b>'.$phone_m.'</b><br/>'.$EmailTO.'</div>';
$html .= $html_header;


$html_footer .= '<div class="footer">';
 
$html_footer .= '<div class="footer-left"><div>Свяжитесь с нами:</div>
    Тел: '.$phone_m.'<br/>
	Моб: '.$mobphone_m.' <img src="../../modules/calculator/images/info-calc.png"/> <br/>
    E-mail: '.$EmailTO.'<br/>
    Адрес: '.$address_m.'<br/>
  </div>';


    $html_footer .= '<div class="footer-right" style="padding-top: 50px;">
  <span>Итого:</span> '.$anketacoast.' рублей<br/>
 
</div></div>';



$html_footer .= '</div>';


    include_once ("anketa_pdf.php");
    $html.=$Anketa;

$html .= $html_footer;

  

//$FILENAME = time()+rand(1000,9999);
$FILENAME = "anketa-artweb_".date('H-i-s')."_".date("d-m-Y");

include($_SERVER["DOCUMENT_ROOT"]."/modules/calculator/pdf/mpdf.php");
//$mpdf=new mPDF('utf-8','A4');
$mpdf=new mPDF('utf-8', 'A3', 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
$mpdf->Output($_SERVER["DOCUMENT_ROOT"].'/files/pdf/'.$FILENAME.'.pdf','F');
//file_put_contents($_SERVER["DOCUMENT_ROOT"].'/files/pdf/'.$FILENAME.'.html',"<style>".$stylesheet."</style>".$html);
$pdffile = "Анкета: <a href='".$base_url."files/pdf/".$FILENAME.".pdf'>скачать pdf</a><br/>";



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
    $subject = "Заявка с анкеты от $name";
    $ipadres = GetUserIP();
    $message = "
Имя: " . $name . "<br />";
    if($site1){$message .= "Сайт: " . $site1 . "<br />";}


    $message .= "
	<style>$stylesheet</style>
E-mail: <a href='mailto:$email'>$email</a><br/>
Телефон: " . $phone . "<br />
Сообщение: $text<br/>
IP-адрес: <a href='http://www.seogadget.ru/location?addr=" . $ipadres . "' target='_blank'>" . $ipadres . "</a><br/>
".$link_file."
".$pdffile.$pdffile_admin."
Примерная стоимость: $anketacoast рублей<br/>
Страница отправки: <a href='".$link."' target='_blank'>".$title."".$typeform."</a><br/>
<br/><br/><br/>$Anketa
";

    if(isset($_COOKIE["utm_source"]))
    {
        $message .= $MAILTABLE;
    }

    CreateMailFile($message);




  



    mail($EmailTO, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");
  //  mail($email, "Расчёт стоимости от ".$sitename."", $messageclient, "Content-type:text/html; charset=utf-8\r\n");
  //  if(!empty($EmailTO2)){mail($EmailTO2, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");}
      if($obratnoe_pismo_vklucheno){MailSubmit($email,$sitename,$text_uvedomlenie);}



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