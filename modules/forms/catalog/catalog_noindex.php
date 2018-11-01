<!--корзина popup-->
<div class="PopUp cartpopup">
    <div class="close"></div>
    <div class="inner">


        <table class="carttable">
            <thead>
            <tr>
                <td>Наименование</td>
                <td>Кол.</td>
                <td>Стоимость</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            <tbody>

            </tbody>

        </table>

        <div class="buttons-cart">
            <div class="button red send-cart">Оформить заказ</div>
            <div class="button gray cancel-cart">Купить еще</div>
            <div class="button gray clear-cart">Очистить</div>
        </div>


    </div>
</div>
<!--оформление заказа-->
<div id="zakaz_send" class="PopUp">
    <div class="close">&nbsp;</div>
    <div class="inner">
        <div class="form">
            <form enctype="multipart/form-data" method="post" action="">
                <h3>Оформление заказа</h3>
                <label>Имя: <input type="text" value="" id="zakaz_name" name="name"></label>

                <label style="font-weight:bold;">Телефон: <font color="red">*</font><input type="text" value="" id="zakaz_number" name="phone"></label>

                <label>E-mail:<input type="text" value="" id="zakaz_email" name="email"></label>

                <?php ?><label>Комментарий:<textarea style="height:100px;" rows="10" cols="30" id="zakaz_message" name="message"></textarea> </label> <?php ?>
                <input type="hidden" id="quickorderid">
                <input class="button_red send_order_zakaz_quick button" type="button" value="Оформить заказ" />
            </form>
        </div>
    </div>
</div>

<!--заказать товары-->
<div class="PopUp form_zakaz_send">
    <div class="close"></div>
    <div class="inner">
    	<div class='zapros-otpravlen'>Ваш заказ успешно оформлен!<span><br><br>В ближайшее время мы<br /> свяжемся с Вами.</span></div>
    </div>
</div>

<?php /*?><!--Заявка на композицию-->
<div id="zapisonline_send" class="PopUp">
    <div class="close">&nbsp;</div>
    <div class="inner">
        <div class="form">
            <form enctype="multipart/form-data" method="post" action="">
                <h3>Заявка на композицию</h3>
                <label>Имя: <input type="text" value="" id="zapisonline_name" name="name"></label>

                <label style="font-weight:bold;">Телефон: <font color="red">*</font><input type="text" value=""
                                                                                           id="zapisonline_number"
                                                                                           name="phone"></label>

                <label>E-mail:<input type="text" value="" id="zapisonline_email" name="email"></label>

                <!--<label>Комментарий:<textarea style="height:100px;" rows="10" cols="30" id="phone_message" name="message"></textarea> </label>-->
                <input type="hidden" id="zapisonlineformid" name="zapisonlineformid" value="0"/>
                <input class="button_red send_order_zapisonline button" type="button" value="Отправить"
                       name="zapisonline_zvonok"/>
            </form>
        </div>
    </div>
</div>

<?php */?>