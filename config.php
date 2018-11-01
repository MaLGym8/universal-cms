<?php
@session_start();
require_once("libs/database.php");
require_once("blocks/lang.php");
ini_set('display_errors',0);

/*-----------------------------start config-----------------------------*/
class Config{
    var $mysql_config = array (
        'host' => 'localhost',
        'user' => 'root',
        'passw' => '',
        'dbname' => 'universal2',
        'charset' => 'UTF8'
    );
}

$base_url  = "http://universal2/";
$base_url_blog  = "http://universal2/blog/";
$kod_metriki = "1";
/*-----------------------------end config-----------------------------*/
//*****************Подключение к базе********************/
$Config = new Config();
db::$config = $Config->mysql_config;
$db = db::getInstance();
/***************Временно*****************/
mysql_connect($Config->mysql_config[host],$Config->mysql_config[user],$Config->mysql_config[passw]) or die(mysql_error());
mysql_select_db($Config->mysql_config[dbname])or die(mysql_error());
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET NAMES utf8");
/********************************/
//Получение настроек
$result_settings = $db->read("SELECT * FROM options");
$EmailTO = $result_settings["email"];
$EmailTO2 = $result_settings["email2"];

$mobphone_m = $result_settings["mobphone"];
if(empty($result_settings["phone"])){ $phone_m = $result_settings["mobphone"];} else {$phone_m = $result_settings["phone"];}

$skype_m = $result_settings["skype"];
$address_m = $result_settings["address"];
$sitename = str_replace("http://","",$base_url);
$sitename = str_replace("www.","",$sitename);
$sitename = str_replace("/","",$sitename);
$briefnamedefault = "brief Artwebgroup.ru full.docx";
define('COUNTPAGE',$result_settings["adminquantity"]);
define('CATALOGTYPE',$result_settings["catalogtype"]);
define('CATALOGGIFTS',$result_settings["cataloggifts"]);
define('CATALOGCART',$result_settings["catalogcart"]);
define('sitequantity1',$result_settings["sitequantity1"]);
define('sitequantity2',$result_settings["sitequantity2"]);

define('header_change',$result_settings["header_change"]);

define('portfolioquantity1',$result_settings["portfolioquantity1"]);
define('portfolioquantity2',$result_settings["portfolioquantity2"]);

$MODULES = $db->readTableAsArray("SELECT * FROM modules");

//==========Настройки сжатия картинок==========
//Отзывы  $image->crop(array(0, 0, 250, 250)); делает квадрат
$Review_Big_Width = 500; // Если по ширине, исправляем на Width, по высоте на Heigth
$Review_Small_Width = 125; // Если по ширине, исправляем на Width, по высоте на Heigth


$actiondeadline = "Акция может закончится в любой момент!";
$text_zapros_otpravlen = "<div class='zapros-otpravlen'>Спасибо, что обратились к нам!<span><br><br>В ближайшее время мы<br /> свяжемся с Вами.</span></div>";
$text_uvedomlenie = "Спасибо, что обратились к нам! В ближайшее время мы свяжемся с Вами.";

$obratnoe_pismo_vklucheno = 1;


//======================================UTM метки===================================================================
//?utm_source=yandex&utm_medium=cpc&utm_campaign={campaign_id}&utm_content={ad_id}&utm_term={keyword}&addphras={addphrases}&postype={position_type}&pos={position}&source_t={source_type}&source={source}&param1={param1}&param2={param2}&phrase={phrase_id}&retargeting={retargeting_id}&gbid={gbid}
if($_REQUEST["utm_source"]) {
	$utm_date = date('d.m.Y');
   	$utm_time = date("G:i:s");
   	setcookie("utm_date", $utm_date." ".$utm_time, time() + 31536000, '/');
    setcookie("utm_source", $_REQUEST["utm_source"], time() + 31536000, '/');
    setcookie("utm_medium", $_REQUEST["utm_medium"], time() + 31536000, '/');
    setcookie("utm_campaign", $_REQUEST["utm_campaign"], time() + 31536000, '/');
    setcookie("utm_content", $_REQUEST["utm_content"], time() + 31536000, '/');
    setcookie("utm_term", $_REQUEST["utm_term"], time() + 31536000, '/');

    if($_REQUEST["utm_source"]=="yandex"||$_REQUEST["utm_source"]=="YANDEX") {
        setcookie("addphras", $_REQUEST["addphras"], time() + 31536000, '/');
        setcookie("postype", $_REQUEST["postype"], time() + 31536000, '/');
        setcookie("pos", $_REQUEST["pos"], time() + 31536000, '/');
        setcookie("source_t", $_REQUEST["source_t"], time() + 31536000, '/');
        setcookie("source", $_REQUEST["source"], time() + 31536000, '/');
        setcookie("param1", $_REQUEST["param1"], time() + 31536000, '/');
        setcookie("param2", $_REQUEST["param2"], time() + 31536000, '/');
        setcookie("phrase", $_REQUEST["phrase"], time() + 31536000, '/');
        setcookie("retargeting", $_REQUEST["retargeting"], time() + 31536000, '/');
        setcookie("gbid", $_REQUEST["gbid"], time() + 31536000, '/');
		setcookie("city", $_REQUEST["city"], time() + 31536000, '/');
    }
	
	if($_REQUEST["utm_source"]=="google"||$_REQUEST["utm_source"]=="GOOGLE") {
		setcookie("placement", $_REQUEST["placement"], time() + 31536000, '/');
		setcookie("adposition", $_REQUEST["adposition"], time() + 31536000, '/');
		setcookie("matchtype", $_REQUEST["matchtype"], time() + 31536000, '/');
		setcookie("device", $_REQUEST["device"], time() + 31536000, '/');
		setcookie("devicemodel", $_REQUEST["devicemodel"], time() + 31536000, '/');
		setcookie("target", $_REQUEST["target"], time() + 31536000, '/');      
    }
}


if($_COOKIE["utm_source"]) {

$MAILTABLE = "<br/><h1>".$_COOKIE["utm_source"]." <small style='font-size:50%'>".$_COOKIE["utm_date"]."</small></h1><table cellspacing='5' cellpadding='5' width='100%' border='1' style='border-collapse: collapse;'>
  <tbody><tr>
    <td>Источник перехода</td>
    <td>".$_COOKIE["utm_source"]."</td>
  </tr>
  <tr>
    <td>Средство маркетинга</td>
    <td>".$_COOKIE["utm_medium"]."</td>
  </tr>
  <tr>
    <td>тип площадки: поиск или контекст</td>
    <td>".$_COOKIE["utm_campaign"]."</td>
  </tr>
  <tr>
    <td>уникальный идентификатор объявления</td>
    <td>".$_COOKIE["utm_content"]."</td>
  </tr>
  <tr>
    <td>Ключевое слово</td>
    <td>".urldecode($_COOKIE["utm_term"])."</td>
  </tr></tbody></table>";

}





if($_COOKIE["utm_source"]=="yandex"||$_COOKIE["utm_source"]=="YANDEX") {
	
	$MAILTABLE = "<br/><h1>".$_COOKIE["utm_source"]." <small style='font-size:50%'>".$_COOKIE["utm_date"]."</small></h1><table cellspacing='5' cellpadding='5' width='100%' border='1' style='border-collapse: collapse;'>
  <tbody><tr>
    <td>Источник перехода</td>
    <td>".$_COOKIE["utm_source"]."</td>
    <td>yandex, google</td>
  </tr>
  <tr>
    <td>Средство маркетинга</td>
    <td>".$_COOKIE["utm_medium"]."</td>
    <td>cpc, баннер</td>
  </tr>
  <tr>
    <td>Название кампании</td>
    <td><a href='https://direct.yandex.ru/registered/main.pl?cmd=showCamp&cid=".$_COOKIE["utm_campaign"]."' target='_blank'>".$_COOKIE["utm_campaign"]."</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Идентификатор объявления</td>
    <td>".$_COOKIE["utm_content"]."</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Ключевое слово</strong></td>
    <td>".urldecode($_COOKIE["utm_term"])."</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Регион</strong></td>
    <td>".$_COOKIE["city"]."</td>
    <td>&nbsp;</td>
  </tr>";


    $MAILTABLE .="
	<tr>
    <td>Тип площадки, на которой произведён показ объявления</td>
    <td>".$_COOKIE["source_t"]."</td>
    <td>
	 &bull; search &ndash; поисковая площадка<br />
     &bull; context &ndash; тематическая
	</td>
  </tr>
	<tr>
    <td>Название площадки РСЯ</td>
    <td>".$_COOKIE["source"]."</td>
    <td>
	 &bull; домен площадки &ndash; при показе на сайте РСЯ<br />
     &bull; none &ndash; при показе на поиске Яндекса
	</td>
	</tr>
	
	<tr>
    <td>Инициирован ли этот показ «дополнительными релевантными фразами»</td>
    <td>".$_COOKIE["addphras"]."</td>
    <td>
	 &bull; yes &ndash;показ по одной из дополнительных фраз<br />
     &bull; no &ndash; показ по одной из исходных фраз
	</td>
  </tr>
  <tr>
    <td>Тип блока, если показ произошёл на странице с результатами поиска Яндекса</td>
    <td>".$_COOKIE["postype"]."</td>
    <td>
	 &bull; premium &ndash; спецразмещение<br />
     &bull; other &ndash; блок внизу<br />
     &bull; none &ndash; блок не на поиске Яндекса
    </td>
  </tr>
  <tr>
    <td>Точная позиция объявления в блоке</td>
    <td>".$_COOKIE["pos"]."</td>
    <td>
	 &bull; номер позиции в блоке<br />
     &bull; 0 &ndash; если объявление было показано на тематической площадке РСЯ.
	</td>
  </tr>
  
  
  	<tr>
    <td>Первый параметр ключевой фразы</td>
    <td>".$_COOKIE["param1"]."</td>
    <td>Значение первого параметра для данной ключевой фразы.
	</td>
  	</tr>
	<tr>
    <td>Второй параметр ключевой фразы</td>
    <td>".$_COOKIE["param2"]."</td>
    <td>Значение второго параметра для данной ключевой фразы.
	</td>
  	</tr>
	<tr>
    <td>Номер (ID) ключевой фразы</td>
    <td>".$_COOKIE["phrase"]."</td>
    <td>&nbsp;
	</td>
  	</tr>
	<tr>
    <td>Номер (ID) условия ретаргетинга</td>
    <td>".$_COOKIE["retargeting"]."</td>
    <td>&nbsp;
	</td>
  	</tr>
	<tr>
    <td>Номер (ID) группы</td>
    <td>".$_COOKIE["gbid"]."</td>
    <td>&nbsp;
	</td>
  	</tr>";
}

if($_COOKIE["utm_source"]=="google"||$_COOKIE["utm_source"]=="GOOGLE") {

$MAILTABLE = "<br/><h1>".$_COOKIE["utm_source"]." <small style='font-size:50%'>".$_COOKIE["utm_date"]."</small></h1><table cellspacing='5' cellpadding='5' width='100%' border='1' style='border-collapse: collapse;'>

  <tbody><tr>
    <td>Источник перехода</td>
    <td>".$_COOKIE["utm_source"]."</td>
    <td>yandex, google</td>
  </tr>
  <tr>
    <td>Средство маркетинга</td>
    <td>".$_COOKIE["utm_medium"]."</td>
    <td>cpc, баннер</td>
  </tr>
  <tr>
    <td>тип площадки: поиск или контекст</td>
    <td>".$_COOKIE["utm_campaign"]."</td>
    <td>g (поиск Google), s (поисковые партнеры) или d (КМС)</td>
  </tr>
  <tr>
    <td>уникальный идентификатор объявления</td>
    <td>".$_COOKIE["utm_content"]."</td>
    <td>16541940833 (чтобы увидеть идентификатор в AdWords, добавьте соответствующий столбец на вкладке)</td>
  </tr>
  <tr>
    <td><strong>Ключевое слово</strong></td>
    <td>".urldecode($_COOKIE["utm_term"])."</td>
    <td>ключевое слово</td>
  </tr>";
	


    $MAILTABLE .="<tr>
    <td>площадка, только для КМС</td>
    <td>".$_COOKIE["placement"]."</td>
    <td>адрес площадки</td>
  </tr>
  <tr>
    <td>позиция объявления</td>
    <td>".$_COOKIE["adposition"]."</td>
    <td>1t2(страница 1, вверху, место 2), 1s3 (страница 1, справа, место 3) или none (КМС)</td>
  </tr>
	<tr>
    <td>тип соответствия ключевого слова</td>
    <td>".$_COOKIE["matchtype"]."</td>
    <td><strong>e</strong> (точное соответствие), <strong>p</strong> (фразовое) или <strong>b</strong> (широкое)</td>
  </tr>
	<tr>
    <td>тип устройства</td>
    <td>".$_COOKIE["device"]."</td>
    <td><strong>m</strong> (мобильный телефон), <strong>t</strong> (планшетный ПК) или <strong>c</strong> (компьютер, ноутбук)</td>
	</tr>
	
	<tr>
    <td>марка и модель устройства</td>
    <td>".$_COOKIE["devicemodel"]."</td>
    <td>Apple+iPhone</td>
  </tr>
  <tr>
    <td>категория места размещения (только для таргетинга на места размещения)</td>
    <td>".$_COOKIE["target"]."</td>
    <td>категория места размещения (например, кулинария)</td>
  </tr>";
}

$MAILTABLE .="</tbody></table>";


//функция уведомления отправителю
function MailSubmit($email,$sitename,$message)
{
    $subject = "Уведомление от ".$sitename;
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		mail($email, $subject, $message, "Content-type:text/html; charset=utf-8\r\n");
	}
}

//функция определения ip
function GetUserIP()
{
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return ($ip);
}

function CreateMailFile($MAIL)
{
	$filename = dirname(__FILE__)."/files/leads/".date("d_m_Y_G_i_s").".html";
		
	$f = fopen($filename, 'w');    
    fwrite($f, '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$MAIL);       
    fclose($f);
}

?>