<div class="block-map-form anketa-form">
    <div class="inner">





        <div class="zayavka">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="div-name"><input type="text" name="name" <?php /*?>onblur="if (this.value == '') {this.value ='Имя';}" onfocus="if (this.value == 'Имя') {this.value = '';}"<?php */?> placeholder="Имя"></div>

                <div class="div-email"><input type="text" name="email" placeholder="E-mail"></div>

                <div class="div-phone"><input type="text" name="phone" placeholder="Телефон / Skype"></div>

                <br clear="all">

                <div class="div-text"><textarea name="message" placeholder="Любые пожелания и комментарии по проекту"></textarea></div>


                <div class="input-file sendorder">
                    <span class="fileInputText input-small fileText1">Прикрепить файл</span>
                    <div class="input"><input type="file" onchange="$(this).parent('div').parent('div').children('.fileText1').html(this.value);" size="49" name="question_file2" id="question_file2"></div>

                   
                </div>
                <input type="hidden" name="form-name" value="calculator">
                <input type="hidden" name="form-type" value="">
                <input type="button" name="send-order" class="send-order send-order-anketa button" value="Оставить заявку">
                <?php /*?><div class="actionend">* Акция может закончится в любой момент!</div><?php */?>
            </form>
        </div>
    </div>
</div>

<noindex>
    <div class="PopUp form_zayavka_send_calculator">
        <div class="close"></div>
        <div class="inner">
            <?=$text_zapros_otpravlen?>
        </div>
    </div>
</noindex>