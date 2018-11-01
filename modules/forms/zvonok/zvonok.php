<!--форма звонка-->
<div id="zvonok_send" class="PopUp">
    <div class="close">&nbsp;</div>
    <div class="inner">
        <div class="form">
            <form enctype="multipart/form-data" method="post" action="">
                <h3>Мы перезвоним Вам</h3>
                <label>Имя: <input type="text" value="" id="phone_name" name="name"></label>
                <label style="font-weight:bold;">Телефон / Skype: <font color="red">*</font><input type="text" value="" id="phone_number" name="phone"></label>
                <label>E-mail:<input type="text" value="" id="phone_email" name="email"></label>
                <?php /*?><label>Комментарий:<textarea style="height:100px;" rows="10" cols="30" id="phone_message" name="message"></textarea> </label> <?php */?>
                <input type="hidden" id="zvonokformid" name="zvonokformid" value="0"/>
                <input class="button_red send_order_phone button" type="button" value="Позвоните мне"
                       name="phone_zvonok"/>
            </form>
        </div>
    </div>
</div>

<!--заказать звонок попап-->
<div class="PopUp form_zvonok_send">
    <div class="close"></div>
    <div class="inner">
        <?=$text_zapros_otpravlen?>
    </div>
</div>