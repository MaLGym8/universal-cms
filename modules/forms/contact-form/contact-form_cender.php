<?
include_once("../../../config.php");
//Форма в контактах
if(isset($_POST["sendformcontacts"]))
{
	$name = $_POST["name"];
	$email = $_POST["email"];
	$text = $_POST["text"];
	
	$subject = "Контакты от ".$name;
    $ipadres = GetUserIP();
    $message
        = "
    Имя: " . $name . "<br />
    Контакт: " . $email . "<br />	
	IP-адрес: <a href='http://www.seogadget.ru/location?addr=" . $ipadres . "' target='_blank'>" . $ipadres . "</a><br />
    Сообщение: " . $text;

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