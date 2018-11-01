<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
    <div class="inner">
        <? include_once("blocks/breadcrumbs.php");?>
        <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["title"];
            ?></h1>
    </div>
</div>


<div class="container">
    <div class="inner">


        <? if ($Items): ?>
        <ul class="good-items">
        <? foreach ($Items as $product):
            $URL = "/".GetPathService($product["cat"],"catalog")."/".$product["url"];
            $Gift = CheckGift($product["id"]);
        ?><li class="good-item">
                <div class="good-img-div"><a href="<?=$URL?>"><img src="/<?=$product["image"]?>"></a>
                    <div class="good-quick-order-button" productid="<?=$product["id"]?>"><div>Заказать в 1 клик!</div></div>
                    <?if($Gift):?><div class="good-gift">+Подарок на выбор!</div><?endif;?>
                </div>
                <div class="good-name"><a href="<?=$URL?>"><?if($product["name"]):echo $product["name"];else:echo $product["title"];endif;?></a></div>
                <div class="good-desc"><?=$product["dopdesc"]?></div>
                <? if ($product["coast"] && CATALOGTYPE == 1 &&$MODULES[3][2]==1) { ?>


                <div class="good-cost"><?if($product["coast_old"]){?><span class="good-old-cost"><?=$product["coast_old"]?>р. </span><?}?> <?=$product["coast"]?>р.</div>
                <?}?>
            <?if(CATALOGCART==1):?>
            <div class="good-button button"><a onclick="BuyProduct1(<?= $product["id"]; ?>,$(this));return false;" href="">В корзину</a></div>
        <?else:?>
            <div class="good-button button"><a href="<?=$URL?>">Подробнее</a></div>
        <?endif;?>                </li><? endforeach; ?>
    </ul>
    <? endif; ?>
</div>
</div>