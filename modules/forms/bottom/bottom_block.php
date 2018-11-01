<div class="block-map-form scroll">
    <div class="inner">


        <div class="formname">
    <span>
    <? if(!$formtitle) { echo "Есть вопросы? Оставьте заявку для бесплатной консультации"; }else { echo $formtitle; } ?>
    </span>
        </div>



        <div class="zayavka">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="div-name"><input type="text" name="name" <?php /*?>onblur="if (this.value == '') {this.value ='Имя';}" onfocus="if (this.value == 'Имя') {this.value = '';}"<?php */?> placeholder="Имя"></div>

                <div class="div-email"><input type="text" name="email" placeholder="E-mail *"></div>

                <div class="div-phone"><input type="text" name="phone" placeholder="Телефон / Skype"></div>

                <br clear="all">

                <div class="div-text"><textarea name="message" placeholder="Сообщение"></textarea></div>



                <div class="input-file sendorder">
                    <span class="fileInputText input-small fileText1">Прикрепить файл</span>
                    <div class="input"><input type="file" onchange="$(this).parent('div').parent('div').children('.fileText1').html(this.value);" size="49" name="question_file1" id="question_file1"></div>

                    <?php /*?><? if(!isset($linkbrief)):?>
                    <a class="a1" href="/files/brief/<?=$briefnamedefault?>" download="<?=$briefnamedefault?>"><img class="img1" src="/images/word.png" alt="" width="18">Скачать Бриф</a>
                     <? elseif($linkbrief != '0'):?>
                     <a class="a1" href="/files/brief/<?=$linkbrief?>" download="<?=$linkbrief?>"><img class="img1" src="/images/word.png" alt="" width="18">Скачать Бриф</a>
					<? elseif($linkbrief == '0'):?><? endif?><?php */?>
                </div>
                <input type="hidden" name="form-name" value="Bottom">
                <input type="hidden" name="form-type" value="">
                <input type="button" name="send-order" class="send-order send-order-bottom button" value="Оставить заявку">
                <?php /*?><div class="actionend">* Акция может закончится в любой момент!</div><?php */?>
            </form>
        </div>
    </div>
</div>

