<?
include_once("../../../config.php");
//Звонок
if(isset($_POST["sendformzvonok"]))
{
    $name = $_POST["name"];
    $phone = $_POST["number"];
    $email = $_POST["email"];
    $zvonokformid = $_POST["sendformzvonok"];

    $link = $_POST["link"];
    $title = $_POST["title"];

    $subject = "Звонок (".$zvonokformid.") от ".$name;
    $ipadres = GetUserIP();
    $message
        = "
    Имя: " . $name . "<br />
    Телефон: " . $phone . "<br />
    E-mail: <a href='mailto:" . $email . "'>" . $email . "</a><br />
    IP-адрес: <a href='http://www.seogadget.ru/location?addr=" . $ipadres . "' target='_blank'>" . $ipadres . "</a><br/>
    Страница отправки: <a href='".$link."' target='_blank'>".$title."</a>";

    if(isset($_COOKIE["utm_source"]))
    {
        $message .= $MAILTABLE;
    }
	CreateMailFile($message);

    mail($EmailTO, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");
    if(!empty($EmailTO2)){mail($EmailTO2, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");}
    if($obratnoe_pismo_vklucheno){MailSubmit($email,$sitename,$text_uvedomlenie);}
    echo "1";
}
?>