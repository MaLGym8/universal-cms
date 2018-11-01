<?
if(!$_COOKIE["show_banner"])
{
	if($_COOKIE["addbanner"])
	{
		setcookie("show_banner",1,time()+(3600*24*7),"/");

	}else{
		$addcookie = 1;
	}
}
require_once("init.php");

//Подключение страницы целиком
if($Page["include_all"])
{
    include_once($Page["include_all"]);
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title><?= $Page["title"].$PageTitleAdd; ?></title>
    <meta name="description" content="<?= $Page["meta_d"]; ?>"/>
    <meta name="keywords" content="<?= $Page["meta_k"]; ?>"/>
    <?php /*?><link rel="canonical" href="<?= $base_url ?>"/><?php */?>

    <? include_once("blocks/head.php"); ?>

</head>
<?
if($GetSubDomain[1]=="blog")
{
	$PAGENAME = $GetSubDomain[1];
}else{
	$PAGENAME = $ROUTES[1];
}
?>
<body class="page-<?=$PAGENAME?> <?=$PageServices?> <?=$ROUTES[2]?>">




<?
if($GetSubDomain[1]=="blog")
{
	include_once("pages_include/blog/header.php");
}else{
	 include_once("blocks/header.php");
}


 ?>

 



<?
//Отображение страницы

if ($Page["include"]) {
    include_once($Page["include"]);//Если есть, что инклудить - инклудим
	
} else { ?>	
<div class="top-bg">
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");
	if($Page["h1"])  { $Title = $Page["h1"]; }else{ $Title = $Page["title"]; } ?>
    <h1 class="title"><?=$Title?></h1>
    </div>
</div>

<div class="container">
	<div class="inner">
        <?=$Page["text"]?>
	</div>
</div> <? /*Если нечего инклудить, то выводим текст*/ }?>


<?
if($GetSubDomain[1]=="blog")
{
	include_once("pages_include/blog/footer.php");
}else{
	 include_once("blocks/footer.php");
}


 ?>



<? if($addcookie):?>
<script>
$(document).ready(function(){
	setTimeout(function(){
		setCookie("addbanner","1",3600,"/");
	},10000);
});
</script>
<? endif;?>
</body>
</html>