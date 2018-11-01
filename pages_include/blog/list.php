<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title"  <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
                if($Page["h1"]):
                    echo $Page["h1"];
                else:
                    echo $Page["title"];
                endif;
                ?></h1>
    </div>
</div>

<div class="container">
    <div class="inner">


        <?  if($CATS):?>
            <ul class="block-universal-button">
                <li <? if($CURRENTCAT==0):?> class="active"<?endif;?>><a href="/blog">Все</a></li>
                <? foreach ($CATS AS $CAT):?>
                    <li <? if($CURRENTCAT==$CAT[0]):?>class="active"<?endif;?>><a href="/blog/<?=$CAT[4]?>"><?=$CAT[2]?></a></li>
                <? endforeach;?>
            </ul>
        <? endif;?>

<?php

$currentPage=intval($_GET["page"]);
$num=sitequantity1;
if($CURRENTCAT)
    $result = $db->read_all("SELECT COUNT(*) as rec FROM `blog` WHERE `cat`=$CURRENTCAT and `public`=1");
else
    $result = $db->read_all("SELECT COUNT(*) as rec FROM `blog` WHERE `public`=1");

//============================================
if($CURRENTCAT)
    $newsQ = $db->read_all("SELECT * FROM `blog` WHERE `cat`='$CURRENTCAT' and `public`=1 ORDER by `date_add` DESC LIMIT 0, ".sitequantity1."");
else
    $newsQ = $db->read_all("SELECT * FROM `blog` WHERE  `public`=1 ORDER by `date_add` DESC LIMIT 0, ".sitequantity1."");

include_once("pages_include/blog/include-list.php");

?>
<? if($result[0]["rec"]>sitequantity1):?>
<br clear="all">
<div class="ajaxloadblog" catid="<?=$CURRENTCAT?>"><span class="button">Показать больше</span></div>
<? endif;?>
	<div class="blog-cat-text">
<?=$Page["text"];?>
</div>
    </div>


</div>

<input type="hidden" id="limitajaxload" value="<?=sitequantity2?>"/>
