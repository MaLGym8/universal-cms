<div class="top-bg"<? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?>
     <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
     
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title"><? if($Item["h1"])
            { echo $Item["h1"];
            }elseif($Item["menu"])
			{ echo $Item["menu"];
            }else{ echo $Item["title"];} ?></h1>

        <? if($Page["small_desc"]):?>
            <h2 class="small_desc"><?=$Page["small_desc"];?></h2>
        <? endif;?>
        
        <div class="services-order">
            <a href="" class="button">Получить консультацию</a>
        </div>



    </div>
</div>

<? include_once("pages_include/services/module_block/cat-tem-serv.php");?>
	
<? 
if ($Item["url"]=="sozdanie_saitov" or $Item["parent"]==1 or $Item["parent"]==11) {
//Простое подключение портфолио
$TitlePortfolio = "Портфолио - ".$Item["menu"];
$queryPortfCat  = "SELECT * FROM `portfolio_item` WHERE `public`=1 ORDEr by sort ASC";
//Если нужна связь портфолио
$ServicesPortfolio = $Item["id"];
include_once("pages_include/portfolio/module_block/module_portfolio.php");

//include_once("pages_include/services/module_block/schemstalk.php");
//include_once("pages_include/services/module_block/kakrabotaem.php");

//include_once("pages_include/services/module_block/protoadapt.php");
}
?>


<? if($Item["desc"]):?>
<div class="pagetext">
	<div class="inner">
    <? echo $Item["desc"]; ?>
    </div>
</div>
<? endif?>

<? //отзывы
//$queryComments = "SELECT * FROM comments WHERE public=1 ORDER by date DESC";
//include_once("modules/reviews/reviews_block.php");
?>




<?
if ($Item["url"]=="sozdanie_saitov" or $Item["parent"]==1 or $Item["parent"]==11) {} else { $linkbrief = 0;}
include_once("modules/forms/bottom/bottom_block.php");?>

</div>