<li>
    <div class="imgdiv">

        <a rel="nofollow" class="portfolio-gallery" desc="<?=$resultPortfCat["name"];?>" link="<?=$resultPortfCat["site_href"];?>" iframe="<?= $resultPortfCat["iframe"];?>" title="<?=$resultPortfCat["name"]?>" titlemore="<?=$TEXTMORE?>" href="<?=$base_url.str_replace("thumb","main",$resultPortfCat["image"]);?>"><img class="sc-image" src="/<?=$resultPortfCat["image"];?>" alt="<?=$resultPortfCat["name"]?>" title="<?=$resultPortfCat["name"]?>" />
        </a>
        <div class="portfolio-bg" onclick="ShowGalleryImage2($(this));return false;" ></div>
        <div class="inner-icons">

            <a rel="nofollow" onclick="ShowGalleryImage($(this));return false;" class=" icon-1" data-fancybox-group="thumb" title="<?=$resultPortfCat["name"]?>"  href="<?=$base_url.str_replace("thumb","main",$resultPortfCat["image"]);?>">Увеличить</a>

            <? if($resultPortfCat["site_href"]):?>
                <noindex><a rel="nofollow" class="icon-2" href="http://<?=$resultPortfCat["site_href"]?>" target="_blank">На сайт</a></noindex>
            <? endif;?>

            <? if($resultPortfCat["public_text"]):?>
                <? $CATURL = str_replace("services","portfolio",GetPathCat($resultPortfCat["portfolio_cat"],"portf")); ?>
                <a class="icon-3" href='<?=$CATURL?>/<?=$resultPortfCat["url"];?>'>Подробнее</a><? endif;?>

        </div>


        <div class="title-label">
            <?=$resultPortfCat["name"];?>
        </div>
    </div>


</li>