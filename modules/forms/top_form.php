<div class="top_form">
        <span class="spt1">Консультация по ценам и условиям работы</span>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="div-name"><input type="text" name="name" placeholder="Имя"></div>

                <div class="div-email"><input type="text" name="email" placeholder="E-mail *"></div>

                <div class="div-phone"><input type="text" name="phone" placeholder="Телефон / Skype"></div>

                <div class="div-text"><textarea name="message" placeholder="Сообщение"></textarea></div>

                <div class="input-file sendorder">
                    <span class="fileInputText input-small fileText1">Прикрепить файл</span>
                    <div class="input"><input type="file" onchange="$(this).parent('div').parent('div').children('.fileText1').html(this.value);" size="49" name="question_file2" id="question_file2"></div>
                </div>
                
               <?php /*?> <div class="brief_right"><a class="a1" href="/files/brief/<?=$briefnamedefault?>" download="<?=$briefnamedefault?>"><img class="img1" src="/images/word.png" alt="" width="18">Скачать Бриф</a></div><?php */?>
                
                <input type="hidden" name="form-name" value="Top">
                <input type="hidden" name="form-type" value="">
                <input type="button" name="send-order" class="send-order send-order-bottom button" value="Оставить заявку">
            </form>
	</div>