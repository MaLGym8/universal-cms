<div class="top-bg"  <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><? if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["name"];
            ?></h1>
        <?if($Page["site_href"]):?>
            <noindex><div class="portfolio-site" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>>Сайт - <a rel="nofollow" href="http://<?=$Page["site_href"]?>" target="_blank" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?=$Page["site_href"]?></a> </div></noindex>
        <?endif;?>

    </div>
</div>


<div class="container">
    <div class="inner">
        <div class="text-current-portfolio"><?echo $Page["text"];?></div>
        <div class="image-current-portfolio">        <img src="/<?=str_replace("thumb","main",$Page["image"]);?>" />
        </div>


        <div class="images-current-portfolio">
            <?if($Page["images"]):?>
                <?
                $Images = explode(" ",trim($Page["images"]));
                ?>
                <? foreach($Images as $Image):?>
                    <img src="/<?=str_replace("small","big",$Image);?>" />
                <?endforeach;?>

            <?endif;?>
        </div>



</div>
</div>
