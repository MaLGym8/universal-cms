<?
include_once("../../../config.php");
//Форма заказа Bottom
if (isset($_POST["sendorderbottom"])) {
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
    //===========================


    $fileElementName = $_POST["formelement"];
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

            move_uploaded_file($_FILES[$fileElementName]['tmp_name'], "../../../files/files_upload/".$file);
        }
    }

    //===========================

    if($_SESSION["refer"])
    {
        $refer = " (".$_SESSION["refer"].")";
    }
    $subject = "Заявка от $name (".$site." - ".$title."".$typeform.")";
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
".$typeformblock."
Страница отправки: <a href='".$link."' target='_blank'>".$title."".$typeform."</a>
";

    if(isset($_COOKIE["utm_source"]))
    {
        $message .= $MAILTABLE;
    }
	
	CreateMailFile($message);

    mail($EmailTO, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");
    if(!empty($EmailTO2)){mail($EmailTO2, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");}
    if($obratnoe_pismo_vklucheno){MailSubmit($email,$sitename,$text_uvedomlenie);}



    echo "{";
    echo				"error: '" . $error . "',\n";
    echo				"msg: '" . $msg . "'\n";
    echo "}";
    exit();

}

?>