<div class="menu-top-main">
    <div class="inner">
        <div class="menu">
            <? include_once("modules/menu/menu.php"); ?>


            <div class="orderonline">
                <?
                if(CATALOGTYPE==1&&$MODULES[3][2]==1&&$MODULES[4][2]==1):
                    $countAll=0;
                    $coastAll=0;
                    if($_SESSION["cart"])
                    {
                        foreach($_SESSION["cart"] as $item)
                        {
                            $countAll += $item[2];
                            $coastAll += $item[2]*$item[1];
                        }
                    }

                    if($_SESSION["cart_gift"])
                    {
                        foreach($_SESSION["cart_gift"] as $item)
                        {
                            $countAll += $item[2];
                            $coastAll += $item[2]*$item[1];
                        }
                    }

                    ?>
                    <a href="/cart" class="cart-top"><?php /*?>Корзина <span>(<?=$countAll?>)</span><?php */?>

                    </a>
                    <div class="cart-more">
                        <?if($countAll):?>
                            <span class="cart-count"><?=$countAll?> шт.</span>
                            <span class="cart-coast"> на <?=$coastAll;?> руб.</span>
                            <a href="/cart">В корзину</a>
                        <?else:?>
                            Корзина пуста
                        <?endif;?>
                    </div>


                    <?
                endif;
                ?>
            </div>
        </div>
    </div>
</div>