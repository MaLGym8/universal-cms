<div class="top-bg-catalog">
    <div class="inner">
        <? include_once("blocks/breadcrumbs.php");?>
    </div>
</div>

<div class="container">
<div class="inner">
    <?if($_SESSION["cart"]||$_SESSION["cart_gift"]):?>
        <div class="cart-inner">
    <div class="title cart-title marg0top">Ваши покупки</div>

    <table class="carttable">
        <thead>
        <tr>
            <td colspan="2">Товар</td>
            <td>Цена</td>
            <td>Кол-во</td>
            <td>Сумма</td>
            <td>&nbsp;</td>
        </tr>
        </thead>
        <tbody>
        <?php

        if($_SESSION["cart"])
        {
            $count=0;
            $coast=0;
            $CART='';
            foreach($_SESSION["cart"] as $item)
            {
                if($item[3])
                {
                    $gift = $db->read("SELECT * FROM `catalog_gift` WHERE `id`='".$item[3]."'");
                }else{
                    $gift="";
                }
                $product = mysql_fetch_array(mysql_query("SELECT * FROM `catalog` WHERE id=".$item[0].""));
                $count += $item[2];
                $coast += $item[2]*$item[1];
                if($product["name"])
                    $title = $product["name"];
                else
                    $title = $product["title"];

                if($product["image"])
                {
                    $IMG = "<img src='/".$product["image"]."'/>";
                }else{

                }



                echo '<tr  prodcoast="'.$product["coast"].'" prodid="'.$item[0].'">
                <td class="cart-img">'.$IMG.'</td>
                <td class="title-cart">'.$title.'';
                if($gift)
                {
                    echo "<br clear='all'/><div class='giftcart'><b>Подарок:</b><br/>".$gift["title"]."<img src='".$gift["image"]."'/> </div>";
                }

                echo'</td>
                <td class="">'.$item[1].'р.</td>
                <td>
                    <div class="cart-control"><span class="cart-minus">-</span><input type="text" value="'.$item[2].'"class="cart-count"><span class="cart-plus">+</span></div>
                </td>
                <td class="countincart">'.$item[1]*$item[2].'р.</td>
                
                <td>
                    <div class="delete-cart">✖</div>
                </td>
            </tr>';




            }
        }


        if($_SESSION["cart_gift"])
        {
            $CART='';
            foreach($_SESSION["cart_gift"] as $item)
            {

                $product = mysql_fetch_array(mysql_query("SELECT * FROM `catalog_gift` WHERE id=".$item[0].""));
                $count += $item[2];
                $coast += $item[2]*$item[1];
                $title = $product["title"];

                if($product["image"])
                {
                    $IMG = "<img src='/".$product["image"]."'/>";
                }else{

                }



                echo '<tr  prodcoast="'.$product["coast"].'" prodid="'.$item[0].'">
                <td class="cart-img">'.$IMG.'</td>
                <td class="title-cart">'.$title.'';


                echo'</td>
                <td class="">'.$item[1].'р.</td>
                <td>
                    <div class="cart-control"><span class="cart-minus-gift">-</span><input type="text" value="'.$item[2].'"class="cart-count-gift"><span class="cart-plus-gift">+</span></div>
                </td>
                <td class="countincart">'.$item[1]*$item[2].'р.</td>
                
                <td>
                    <div class="delete-cart-gift">✖</div>
                </td>
            </tr>';




            }
        }







        ?>
        <tr>
            <td class="cart-summall" colspan="6">Сумма:
                <span id="cartTotalPrice"><?=$coast?></span><span>р.</span>
            </td>
        </tr>
        </tbody>

    </table>


    <div class="cart-left">
        <div class="title cart-title border">Введите ваши данные:</div>
            <div class="personal-info">
                    <div class="row-form w100">
                        <input type="text" name="name" id="cart-name" placeholder="Ваше имя:"/ class="star">
                    </div>
                    <div class="row-form w100">
                    <div class="row-form w50">
                        <input type="text" name="phone" id="cart-phone" placeholder="Телефон:"/ class="star">
                    </div>

                    <div class="row-form w50">
                        <input type="text" name="email" id="cart-email" placeholder="Email:"/>
                    </div>
                    </div>

                    <div class="row-form w100">
                        <input type="text" name="adres" id="cart-adres" placeholder="Город и адрес доставки:"/>
                    </div>
            </div>

            <div class="title cart-title border">дополнительные опции:</div>

        <div class="row-form w100">
            <input type="checkbox" name="options[]" class="checkbox" id="option1" value="Дополнительная опция 1" />
            <label for="option1">Дополнительная опция 1</label>
        </div>

        <div class="row-form w100">
            <input type="checkbox" name="options[]" class="checkbox" id="option2" value="Дополнительная опция 2" />
            <label for="option2">Дополнительная опция 2</label>
        </div>

        <div class="row-form w100">
            <input type="checkbox" name="options[]" class="checkbox" id="option3" value="Дополнительная опция 3" />
            <label for="option3">Дополнительная опция 3</label>
        </div>

        <div class="row-form w100">
            <input type="checkbox" name="options[]" class="checkbox" id="option4" value="Дополнительная опция 4" />
            <label for="option4">Дополнительная опция 4</label>
        </div>

    </div>

    <div class="cart-right">
        <div class="title cart-title border">Способ доставки:</div>
            <div class="dostavka">
                    <div class="row-form w100">
                        <input coast="300" checked type="radio" name="dostavka" value="Курьером в пределах МКАД" class="radio" id="dostavka1" <?if($_SESSION["dostavka"][0]=="Курьером в пределах МКАД"){echo "checked";}?> />
                        <label for="dostavka1">Курьером в пределах МКАД <span>300р.</span></label>
                    </div>


                    <div class="row-form w100">
                        <input coast="500" type="radio" name="dostavka" value="Курьером в пределах 5 км от МКАД" class="radio" id="dostavka2" <?if($_SESSION["dostavka"][0]=="Курьером в пределах 5 км от МКАД"){echo "checked";}?> />
                        <label for="dostavka2">Курьером в пределах 5 км от МКАД <span>500р.</span></label>
                    </div>


                    <div class="row-form w100">
                        <input coast="700" type="radio" name="dostavka" value="Курьером в пределах 10 км от МКАД" class="radio" id="dostavka3" <?if($_SESSION["dostavka"][0]=="Курьером в пределах 10 км от МКАД"){echo "checked";}?> />
                        <label  for="dostavka3">Курьером в пределах 10 км от МКАД <span>700р.</span></label>
                    </div>

                    <div class="row-form w100">
                        <input coast="900" type="radio" name="dostavka" value="Курьером в пределах 15 км от МКАД" class="radio" id="dostavka4" <?if($_SESSION["dostavka"][0]=="Курьером в пределах 15 км от МКАД"){echo "checked";}?> />
                        <label for="dostavka4">Курьером в пределах 15 км от МКАД <span>900р.</span></label>
                    </div>

            </div>

        <div class="title cart-title border">Способ оплаты:</div>

        <div class="row-form w100">
            <input checked type="radio" name="pay" value="Наличные курьеру" class="radio" id="pay1" />
            <label for="pay1">Наличные курьеру <img src="/images/pay1.jpg"/></label>
        </div>
        <div class="row-form w100">
            <input  type="radio" name="pay" value="Банковские карты, Яндекс Деньги" class="radio" id="pay2" />
            <label for="pay2">Банковские карты, Яндекс Деньги <img src="/images/pay2.jpg"/></label>
        </div>
        <div class="row-form w100">
            <input  type="radio" name="pay" value="Карта Сбербанка" class="radio" id="pay3" />
            <label for="pay3">Карта Сбербанка <img src="/images/pay3.jpg"/></label>
        </div>

        <div class="row-form w100">
            <input  type="radio" name="pay" value="Другой вариант, обсудить с менеджером" class="radio" id="pay4" />
            <label for="pay4">Другой вариант, обсудить с менеджером</label>
        </div>

        <div class="title cart-title border">Подтверждение заказа:</div>

        <div class="row-form w100">
            <textarea name="cart-comment" placeholder="Комментарий к заказу, желаемое время и другое:"></textarea>

            <div id="coastordershipping">Доставка: <span><?=$_SESSION["dostavka"][1]?>р.</span></div>
            <div id="coastorderall">Итого: <span><?=$coast+$_SESSION["dostavka"][1]?>р.</span></div>

            <button id="cart-send"><i></i> Оформить заказ</button>
        </div>

    </div>
        </div>
        <?else:?>
    <div class="cart-inner">
        <div class="title cart-title">Ваша корзина пуста</div></div>

    <?endif;?>
</div>
</div>
<?php




