<? //$_COOKIE["utm_content"]?>
<div class="header">
        <div class="inner">
            <div class="logo">
                    <a href="<?= $base_url ?>"><img src="/images/logo<? if(header_change==1){?>-instagram<? }?>.png"></a>
            </div>

            

            <div class="headcontacts">
                <div class="phone"><?=$phone_m ?> <i class="fa fa-chevron-down"></i>

                    <ul class="dropdown-info">
                        <li class="mobile-phone"><a href="tel:<?=$phone_m?>">Позвонить</a></li>
                        <? if($mobphone_m){?><li class="dropdown-tel">
							<? if(!empty($result_settings["phone"])){?>
                            <i class="fa fa-mobile" aria-hidden="true"></i><a href="tel:<?=$mobphone_m?>"><?=$mobphone_m?></a><img src="/modules/calculator/images/info-calc.png"><? }?>
                        <? 
						$mobphone_m_viber = $mobphone_m;
						$mobphone_m_viber = str_replace(" ","",$mobphone_m_viber);
						$mobphone_m_viber = str_replace("+","",$mobphone_m_viber);
						$mobphone_m_viber = str_replace("(","",$mobphone_m_viber);
						$mobphone_m_viber = str_replace(")","",$mobphone_m_viber);
						$mobphone_m_viber = str_replace("-","",$mobphone_m_viber);
						
						
						$print_whatsapp_viber = '<span class="span-smaller">Написать:
                        <a class="whatsapp" title="WhatsApp" href="whatsapp://send?phone='.$mobphone_m_viber.'">в&nbsp;WhatsApp</a>
						<a class="viber" title="Viber" href="viber://add?number='.$mobphone_m_viber.'">в&nbsp;Viber</a></span>';
						echo $print_whatsapp_viber;?>
                        </li><? }?>
                        <? if($EmailTO){?><li class="dropdown-mail"><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?=$EmailTO?>"><?=$EmailTO?></a></li><? }?>
                        <? if($skype_m){?><li class="dropdown-mail"><i class="fa fa-skype" aria-hidden="true"></i><a href="skype:live:<?=$skype_m?>?add"><?=$skype_m?></a></li><? }?>
                        <? if($address_m){?><li class="dropdown-address"><i class="fa fa-map-marker" aria-hidden="true"></i><?=$address_m;?></li><? }?>
                        <li class="phone-order"><a href="" formid="1" onclick="return false" class="zvonok-PopUp-Open">Заказать обратный звонок</a></li>
                    </ul>

                </div>
                <br clear="all">
				<? if($EmailTO){?><div class="email"><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?=$EmailTO?>"><?=$EmailTO?></a></div><? }else{?>
                <div class="zvonok_otdelno"><a href="" formid="1" onclick="return false" class="zvonok-PopUp-Open">Заказать звонок</a></div><? }?>
            </div>
            
            
            <? if(header_change==0){ ?>
            <div class="text-header">
            Оказываем услуги под ключ 
            <br />
			<div>От простых до сложных проектов!</div>
            </div>
            <? } else {include_once("menu-block.php"); }?>
   
           


    </div>

</div>

<? if(header_change==0){ include_once("menu-block.php"); }?>