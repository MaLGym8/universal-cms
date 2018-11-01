<? if($MODULES[4][2]==1):?>
<div class="block-catalog">
    <div class="inner">
        <div class="title">Каталог:</div>
        <ul class="good-items">
            <?
            $IndexProducts = $db->read_all("SELECT * FROM `catalog`  ORDER by coast,id limit 8");

            if($IndexProducts)
            {
                foreach($IndexProducts as $product):
                    $URL = GetPathService($product["cat"],"catalog")."/".$product["url"];
                     $Gift = CheckGift($product["id"]);
                    ?><li class="good-item">
                    <div class="good-img-div"><a href="<?=$URL?>"><img src="/<?=$product["image"]?>"></a>
                        <div class="good-quick-order-button" productid="<?=$product["id"]?>"><div>Заказать в 1 клик!</div></div>
                        <? if($Gift && $result_settings["cataloggifts"]==1):?><div class="good-gift">+Подарок на выбор!</div><?endif;?>
                    </div>
                    <div class="good-name"><a href="<?=$URL?>"><?if($product["name"]):echo $product["name"];else:echo $product["title"];endif;?></a></div>
                    <div class="good-desc"><?=$product["dopdesc"]?></div>
                    <?if(CATALOGTYPE==1):?> <div class="good-cost"><?if($product["coast_old"]){?><span class="good-old-cost"><?=$product["coast_old"]?>р. </span><?}?> <?=$product["coast"]?>р.</div> <?endif;?>
                    <?if(CATALOGCART==1):?>
                    <div class="good-button button"><a onclick="BuyProduct1(<?= $product["id"]; ?>,$(this));return false;" href="">В корзину</a></div>
                <?else:?>
                        <div class="good-button button"><a href="<?=$URL?>">Подробнее</a></div>
                    <?endif;?>

                    </li><? endforeach;
            }

            ?>




        </ul>
    </div>
</div>
<?endif;?>