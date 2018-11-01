<script type="text/javascript" src="<?= $base_url ?>modules/reviews/reviews.js"></script>

    <!--отзыв попап-->
    <div class="PopUp form_otziv_send">
        <div class="close"></div>
        <div class="inner">
            <div class='zapros-otpravlen' style='font-size:24px;'>Спасибо, Ваш отзыв будет опубликован после модерации.
            </div>
        </div>
    </div>
    <!--отзыв-->
    <div id="otziv_send" class="PopUp">
        <div class="close">&nbsp;</div>
        <div class="inner">
            <div class="form">
                <h3>Оставьте Ваш отзыв</h3>
                <label style="font-weight:bold">Ваше имя <span class="star">*</span><input id="chComments-Name" name="name" type="text" value=""/></label>
                <label>Ваши контакты<input id="chComments-Link" type="text" value=""/></label>
                <label>Какую услугу Вам делали<input id="chComments-TypeServ" type="text" value=""/></label>
                <label>
                    <div class="input-file">
                        <span class="fileInputText input-small" id="fileInputText1">Прикрепить фото</span>

                        <div class="input">
                            <input id="chComments-Photo" type="file" name="chComments-Photo" size="49"
                                   onchange="document.getElementById('fileInputText1').innerHTML = this.value;"/></div>
                    </div>
                </label>

                <label style="font-weight:bold">Напишите отзыв <span class="star">*</span><textarea id="chComments-Text"></textarea>
                </label> <input id="chComments-Send" class="button" type="submit" value="Оставить отзыв"/></div>
        </div>
    </div>
