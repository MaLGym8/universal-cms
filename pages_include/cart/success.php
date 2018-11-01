

<? 



if($_SESSION["typepay"]):?>

<div class="container">
    <div class="inner">
        <div class="cart-inner">
            <div class="title">Ваш заказ оформлен</div>
            <div class="success-text">Благодарим Вас за офомление заказа! Наши менеджеры свяжутся с Вами в ближайшее время!</div>
        
            <? if($_SESSION["typepay"]=="Банковские карты, Яндекс Деньги"):?><br/><br/><br/>
                <div class="success-text"><b>Вы можете оплатить свой заказ:</b></div>
                <center>
                <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/quickpay/shop-widget?account=41001172981364&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=%D0%97%D0%B0%D0%BA%D0%B0%D0%B7&targets-hint=&default-sum=<?=$_SESSION["coast"];?>&button-text=01&phone=on&successURL=http%3A%2F%2Fflorentale%2Fpay" width="450" height="199"></iframe>
                </center>
            <? endif;?>
        </div>
    </div>
</div>
<?php
else:?>
<div class="container">
    <div class="inner">
        <div class="cart-inner">
        	<div class="title">Заказ не найден</div>
        </div>
    </div>
</div>
<? endif;
$_SESSION["typepay"]="";
?>
