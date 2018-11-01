<?php 
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
sleep(1);
while(list ($key, $val) = each ($_POST)){$_POST[$key]=iconv("UTF-8","UTF-8", $_POST[$key]);}

include('lib/includes.php');
include('lang.php');
include('config_comments.php');

if(isset($_POST['uid']))
{
	// Устанавливаем значения некоторых полей по умолчанию
	$d = date('d.m.Y в H:i');
	$pub = 0;
	if(!isset($_POST['pid'])){$pid='';}else
	{
		// вычисляем парент ид
		$countprefiks = strlen($id_pref);
		$pid=substr($_POST['pid'], $countprefiks);
	}
	$uid=$_POST['uid'];
	if(!isset($_POST['idm'])){$idm='';}else{$idm=$_POST['idm'];}
	//Устанавливаем параметры валидации
$n = $_POST['name']; $m = $_POST['mail']; $s=trim($_POST['site']); $t = $_POST['text'];
	if($n==$name_area){$n='';}
	if($m==$mail_area){$m='';}
	if($s==$site_area){$s='';}
	if($t==$text_area){$t='';}
	$nl = strlen($n);
	$ml = strlen($m);
	$ml = strlen($u);
	$tl = strlen($t);

	if($n=='' or $nl>60 or $m=='' or $ml>60 or $t=='' or $tl>1500 or $s>60)
	{
		$validate = false;
	}
	elseif(!eregi('^[a-z0-9]+(([a-z0-9_.-]+)?)@[a-z0-9+](([a-z0-9_.-]+)?)+\.+[a-z]{2,4}$',$m))
	{
		$validate = false;
	}
	elseif($s!='')
	{
		if(preg_match('/([a-zA-Z]+:\/\/[a-z0-9\_\.\-]+\.[a-z]{2,6}([a-zA-Z0-9\/\*\-\_\?\&\%\=\,\+\.]+)?)/', $s))
		{
			$validate = true;
		}
	}
	else
	{
		$validate = true;
	}
	
	// Если пройшли валидацию
	if($validate)
	{
		include('config_comments.php');
		
		mysql_query("insert into ".$c_tab." (parent_id,url_id,id_material,name,url,mail,text,date_add,public) values ('{$pid}','{$uid}','{$idm}','{$n}','{$s}','{$m}','{$t}','{$d}','{$pub}')") or die ("Err!");
		$keys = array("[#name]","[#date]","[#text]","[#res_ok]");
		$vals = array($n,$d,$t,$res_ok);
		echo templater($theme_path."response_good.php", $keys, $vals);
	}
	else
	{
		$keys = array("[#res_err]");
		$vals = array($res_err);
		echo templater($theme_path."response_error.php", $keys, $vals);
	}
}
else
{
	echo "ERROR, unknown UID!";
}

?>