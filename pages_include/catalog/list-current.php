<div class="top-bg-catalog">
    <div class="inner">
        <? include_once("blocks/breadcrumbs.php");?>
    </div>
</div>



<div class="container">
    <div class="inner">
        <div class="catalog2">

            <div class="product-left">

                <div class="catalog2-image"><a data-fancybox-group="thumb" class="fancybox-thumbs"
                                               href="/<?= str_replace(
                                                   "small", "big", $Item["image"]
                                               ); ?>"><img
                            src="/<?= str_replace("small", "big", $Item["image"]); ?>"/></a></div>


                <div class="catalog2-photos">

                    <?
                    foreach ($photos as $item) {
                        if($item)
                        echo '<a class="fancybox-thumbs" data-fancybox-group="thumb" title="" href="/'
                            . str_replace("small", "big", $item) . '"><img src="/' . $item . '" alt="" />
        </a>';
                    }
                    ?>

                </div>

            </div>
            <div class="product-right">

                <h1 class="title"><?
                    if ($Item["h1"]) {
                        echo $Item["h1"];
                    } else {
                    if($Item["name"]):echo $Item["name"];else:echo $Item["title"];endif;
                    }

                    ?>


                </h1>


                <? if ($Item["coast"] && CATALOGTYPE == 1&&$MODULES[3][2]==1) { ?><? if($Item["coast_old"]):?><div class="catalog2-coast-old"><?= number_format($Item["coast_old"], 0, "", " "); ?> <span>руб.</span></div><?endif;?><div class="catalog2-coast"><?= number_format($Item["coast"], 0, "", " "); ?> <span>руб.</span></div><? } ?>
                    


                    <div class="catalog2-buttons">
                    <? if ($Item["coast"] && CATALOGTYPE == 1&&$MODULES[3][2]==1) { ?><span class="catalog2-buy" onclick="BuyProduct2(<?= $Item["id"]; ?>,$(this));">В корзину</span><? } ?>
					<div class="good-quick-order-button" productid="<?=$Item["id"]?>"><div>Заказать в 1 клик!</div></div>
                    </div>


                    

                <!-------Табы------------>
                <? include_once ("pages_include/catalog/tabs.php")?>
            </div>


            <?php /*?><div class="product-icons">
                <div class="icon i1">
                    Авторские композиции от
                    профессионых флористов
                    и дизайнеров</div>

                <div class="icon i2">
                    Только свежие цветы
                    премиум класса,
                    хранящиеся от 14 дней</div>

                <div class="icon i3">
                    Доставка в течение
                    2 часов. Прием заказов
                    круглосуточно!</div>

                <div class="icon i4">
                    Поможем в выборе.
                    Учтем все Ваши
                    пожелания</div>

                <!--<div class="icon i5">
                    Отправим фото
                    композиции перед
                    доставкой</div>-->
            </div><?php */?>




           <?
            if ($GIFTS && CATALOGGIFTS==1) {
                echo "<ul class='good-items gifts'>";
                echo "<div class='title'>Выберите бесплатный подарок на выбор к данной композиции:</div>";
                foreach ($GIFTS as $gift) {
                    ?>

                    <li class="good-item">
                        <div class="good-button button"><a class="gift-to-cart" giftid="<?= $gift["id"] ?>"
                                                           productid="<?= $Item["id"] ?>" href="#">В подарок!</a></div>
                        <div class="good-img-div"><img src="/<?= $gift["image"] ?>">
                        </div>
                        <div class="good-name"><?= $gift["title"] ?></div>
                        <div class="good-desc"><?= $gift["desc"] ?></div>
                        <div class="good-cost"><? if ($gift["coast_old"]) {
                                ?><span class="good-old-cost"><?= $gift["coast_old"] ?>р. </span><?
                            } ?> 0р.
                        </div>

                        <div class="good-button-bottom">

                            <a class="gift-to-cart" giftid="<?= $gift["id"] ?>"
                               productid="<?= $Item["id"] ?>" href="#">Хочу этот!</a>

                        </div>

                    </li>

                    <?
                }
                echo "</ul>";
            }

if(CATALOGGIFTS==1):
            ?>


            <br clear="all"/>
            <div class="gifts-all">
            <?


                echo "<div class='title'>Прекрасное дополнение к композиции:</div>";?>

                <!-------Табы------------>

                <div class="section gifts-tabs-block">
                    <ul class="gifts-tabs">
                        <li class="current">Все товары</li>
                        <?
                            $giftscats = $db->read_all("SELECT * FROM `catalog_gift_cat` ORDER by `position` ASC");
                            if($giftscats)
                            {
                                foreach($giftscats as $cat)
                                {
                                    echo "<li>".$cat["title"]."</li>";
                                }
                            }
                        ?>
                    </ul>
                    <div class="box visible">
                    <?
                    $GiftsAll = $db->read_all("SELECT * FROM `catalog_gift` ORDER by id DESC");

                    echo "<ul class='good-items gifts-all-ul'>";
                    foreach ($GiftsAll as $gift) {
                        ?>

                        <li class="good-item">
                            <div class="good-img-div"><img src="/<?= $gift["image"] ?>">
                            </div>
                            <div class="good-name"><?= $gift["title"] ?></div>
                            <!--<div class="good-desc"><?= $gift["desc"] ?></div>-->
                            <?if(CATALOGTYPE==1):?><div class="good-cost"><? if ($gift["coast_old"]) {
                                    ?><span class="good-old-cost"><?= $gift["coast_old"] ?>р. </span><?
                                } ?> <?= $gift["coast"] ?>р.
                            </div>
                            <?endif;?>

                            <div class="good-button button"><a href=""   onclick="BuyProduct3(<?= $gift["id"]; ?>,$(this));return false;">В корзину</a></div>


                        </li>

                        <?
                    }
                    echo "</ul>";?>




                    </div>
                    <?

                    if($giftscats)
                    {
                        foreach($giftscats as $cat)
                        {
                            echo '<div class="box">';


                    $GiftsAll = $db->read_all("SELECT * FROM `catalog_gift` WHERE `cat`='".$cat["id"]."' ORDER by id DESC");

                    echo "<ul class='good-items gifts-all-ul'>";
                    foreach ($GiftsAll as $gift) {
                        ?>

                        <li class="good-item">
                            <div class="good-img-div"><img src="/<?= $gift["image"] ?>">
                            </div>
                            <div class="good-name"><?= $gift["title"] ?></div>
                            <!--<div class="good-desc"><?= $gift["desc"] ?></div>-->
                            <div class="good-cost"><? if ($gift["coast_old"]) {
                                    ?><span class="good-old-cost"><?= $gift["coast_old"] ?>р. </span><?
                                } ?> <?= $gift["coast"] ?>р.
                            </div>

                            <div class="good-button button"><a href=""   onclick="BuyProduct3(<?= $gift["id"]; ?>,$(this));return false;">В корзину</a></div>


                        </li>

                        <?
                    }
                    echo "</ul>";


                    echo'</div>';
                        }
                    }

                    ?>

                </div>

            </div>


<?
endif;

/*





*/

?>



        </div>
    </div>
</div>
