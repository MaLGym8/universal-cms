<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["title"];
            ?></h1>
    </div>
</div>



<div class="container">
    <div class="inner" <?php /*?>style="max-width:1000px; margin:0 auto;"<?php */?>>
    	
<?=$Page["text"]?>



<div class="contatstext">
    <div style="float:left">
        <? if(!empty($result_settings["phone"])){ ?><p class="contadd">Тел: <a class="fontbold contphone" href="tel:<?=$phone_m?>"><?=$phone_m ?></a></p><? }?>
        <? if($mobphone_m){?><p class="contadd"><? if(!empty($result_settings["phone"])) echo "Моб:"; else echo "Тел:";?> <a href="tel:<?=$mobphone_m?>"><?=$mobphone_m ?></a> <?=$print_whatsapp_viber?></p><? }?>
        <? if($EmailTO){?><p class="contadd">E-mail: <a href="mailto:<?=$EmailTO?>"><?=$EmailTO?></a><? if($EmailTO2){?>, <a href="mailto:<?=$EmailTO2?>"><?=$EmailTO2?></a><? }?></p><? }?>
        <? if($skype_m){?><p class="contadd"><a class="skype" href="skype:live:<?=$skype_m?>?add"><span class="con-skype">Skype:</span></a> <a href="skype:live:<?=$skype_m?>?add"><?=$skype_m?></a></p><? }?>
        <? if($address_m){?><p class="contadd">Адрес: <?=$address_m?></p><? }?>
    </div>
    
<?php /*?>    <div style="float:right; text-align:left;">
        <p class="contadd"></p>
        <p class="contadd"></p>
    </div><?php */?>
    
<br clear="all"><br />
<? if($address_m){?><div id="yamap">
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script type="text/javascript"><!--
	ymaps.ready(init_map);
	$('#yamap');
	function init_map(){
		var address = '<?=$address_m; ?>';
		var geocoder = ymaps.geocode(address);
		geocoder.then(
			function (res) {
				var coordinates = res.geoObjects.get(0).geometry.getCoordinates();
				var map = new ymaps.Map("yamap", {
					center: coordinates,
					zoom: 15,
					controls: [
						'typeSelector',
						'zoomControl'
					]
				});			
				map.geoObjects.add(new ymaps.Placemark(
					coordinates,
					{
						'hintContent': address,
						'balloonContent': '<? //$sitename?>'
					},
					{
						'preset': 'islands#redDotIcon'
					}
				));
			}
		);
	}
	//--></script>
</div><? }?>
</div>


<div class="contatsformright">
    <div class="contatsform">
    <form action="" method="post" enctype="multipart/form-data">
    
    <h3>Обратная связь</h3>
      <br>              
    <label>Имя:</span><br clear="all">
    <input type="text" name="name" id="contacts_name" class="input_green"/></label>
    <br clear="all"><br>                    
    <label><span style="font-weight:bold;">E-mail / Телефон / Skype:<span class="star">*</span></span><br clear="all">
    <input type="text" name="email" id="contacts_email" class="input_green"/></label>
    <br clear="all"><br>
    <label><span>Сообщение:</span><br clear="all">
    <textarea class="green_text_area_small" id="contacts_text" name="vopros"></textarea></label>
    <br clear="all">
        <input type="hidden" name="contacts_form" value="1"/>
    <input type="button" name="voprossubmit" class="button_order_small button" id="contacts_send" value="Отправить"/>
    </form>
    </div>
</div>

<br clear="all"><br>
    
 

	</div>
</div>
<script type="text/javascript" src="/modules/forms/contact-form/contact-form.js"></script>
<!--Форма в контактах попап-->
<div class="PopUp form_vopros_send">
    <div class="close"></div>
    <div class="inner">
        <?=$text_zapros_otpravlen?>
    </div>
</div>