<div class="footer">
	<div class="inner">
    
    	<div class="fleft">
            <a href="/" class="logo_footer"><img src="/images/logo.png"/></a>
			
            <div class="copyright">Copyright © <?php echo date('Y') ?></div>
            
            <div class="foot-socials">
                <ul>
                    <li><a href="#"><img src="/images/soc-icon-1.png"></a></li>
                    <li><a href="#"><img src="/images/soc-icon-2.png"></a></li>
                    <li><a href="#"><img src="/images/soc-icon-3.png"></a></li>
                </ul>
            </div>

        </div>


        <div class="fcenter">
			<ul>
            <?
            $MenuFoot = $db->read_all("SELECT * FROM `menu` WHERE public=1 and `parent`=0  ORDER by position ASC");
            if ($MenuFoot) {
                foreach ($MenuFoot as $Menu) {
                    if ($Menu["link"]) {
                        $link = $Menu["link"];
                    } else {
                        $link = "/" . $Menu["page"];
                    };

                    // if("/".$ROUTES[1]==$Menu["link"]||"/".$ROUTES[1]=="/".$Menu["page"]):
                    $classactive = "";
                    if ($Menu["page"]){
                        if($ROUTES[1]==$Menu["page"])
                            $classactive = ' class="active"';
                    }else{
                        if("/".$ROUTES[1]==$Menu["link"]||$ROUTES[1]==$Menu["link"])
                            $classactive = ' class="active" ';
                    }

                //    endif;


                    echo '<li><a '; echo "$classactive"; echo'href="' .$link . '">' . $Menu["title"] . '</a></li>';
                }
            }
            ?>
			</ul>
        </div>

        <div class="fright">
			<div class="contacts-block">
                <div class="phone"><a href="tel:<?=$phone_m ?>"><?=$phone_m ?></a></div><br clear="all">
                <div class="backcall"><a href="" formid="2" onclick="return false" class="plate zvonok-PopUp-Open">Заказать обратный звонок</a></div><br clear="all">
                <? if($EmailTO){?><div class="email"><i class="fa fa-envelope" aria-hidden="true"></i><?=$EmailTO?></div><br><? }?>
                <? if($address_m){?><div class="adress"><i class="fa fa-map-marker" aria-hidden="true"></i><?=$address_m?></div><? }?>
			</div>
    	</div>
    
	</div>
</div>






<noindex>
<? include_once ("modules/forms/zvonok/zvonok.php");?>
<? include_once ("modules/reviews/reviews_noindex.php");?>
<? include_once("modules/forms/bottom/bottom_noindex.php");?>
<? include_once("modules/forms/catalog/catalog_noindex.php");?>


    <!--форма с подсказкой-->
    <div id="form_help" class="PopUp">
        <div class="close">&nbsp;</div>
        <div class="inner">
            <div class="form span-smaller">
            Для связи по <span class="whatsapp">WhatsApp</span> или <span class="viber">Viber</span> откройте соответствующее приложение на Вашем устройстве, нажмите лупу или + , введите номер <span class="fontbold"><?=$mobphone_m;?></span> и появится возможность для диалога или звонка
            </div>
        </div>
    </div>




<? //include_once ("modules/forms/online_zapis/online_zapis.php");?>
<? //include_once ("modules/forms/main/main_noindex.php");?>
<script type="text/javascript" src="<?=$base_url?>js/libs/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?=$base_url?>js/libs/jquery.jcarousel.js"></script>
<script type="text/javascript" src="<?=$base_url?>js/libs/autoscroll.js"></script>
<script type="text/javascript" src="<?=$base_url?>js/libs/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?=$base_url?>js/libs/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?= $base_url?>js/libs/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="<?= $base_url?>js/libs/jquery.jcarousel-swipe.js"></script>
<script type="text/javascript" src="<?=$base_url?>js/libs/swiper.min.js"></script>

<script type="text/javascript" src="<?= $base_url?>modules/menu/menu.js"></script>
<script type="text/javascript" src="<?= $base_url?>modules/sliders/top/top.js"></script>
<script type="text/javascript" src="<?= $base_url ?>modules/sliders/logo_cert.js"></script>
<script type="text/javascript" src="<?= $base_url?>pages_include/portfolio/module_block/module_portfolio.js"></script>
<script type="text/javascript" src="<?= $base_url?>pages_include/blog/blog.js"></script>

<script type="text/javascript" src="<?=$base_url?>modules/forms/forms.js"></script>
<script type="text/javascript" src="<?=$base_url?>modules/forms/bottom/bottom.js"></script>
<script type="text/javascript" src="<?=$base_url?>modules/forms/zvonok/zvonok.js"></script>
<script type="text/javascript" src="<?=$base_url?>js/other.js"></script>
<? if(header_change==0){?><script type="text/javascript" src="<?=$base_url?>js/fxd-menu.js"></script><? }?>


<? if($MODULES[4][2]==1):?>
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>css/catalog.css" />
    <script type="text/javascript" src="<?=$base_url?>js/catalog.js"></script>
<?endif;?>


<? if($MODULES[6][2]==1):?>
    <script type="text/javascript" src="<?=$base_url?>js/portfolio.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>css/portfolio.css" />
<?endif;?>





    <!--jcarousel-->
<script type="text/javascript">
    function SetMetrika(Text)
    {
        yaCounter<?=$kod_metriki?>.reachGoal(Text);
    }


        $(document).ready(function(){
            $('.fancybox-thumbs').fancybox({
                prevEffect : 'none',
                nextEffect : 'none',
                closeBtn  : true,
                arrows    : true,
                nextClick : true
            });

            $('.portfolio-gallery1').fancybox({
                prevEffect: 'none',
                nextEffect: 'none',
                closeBtn: true,
                arrows: true,
                nextClick: true,
                autoSize   : false,
                autoHeight : false,
                autoWidth  : false,
                autoResize  : false,
                fitToView   : false
            });

            $('.lightview').fancybox({
                prevEffect: 'none',
                nextEffect: 'none',
                closeBtn: true,
                arrows: true,
                nextClick: true,
                autoSize   : false,
                autoHeight : false,
                autoWidth  : false,
                autoResize  : false,
                fitToView   : false
            });
        });
</script>
<!--галерея popup-->
<div class="PopUp gallery-portfolio">
    <div class="gallery-portfolio-close"></div>
    <div class="gallery-portfolio-prev"></div>
    <div class="gallery-portfolio-next"></div>
    <div class="inner">
    </div>
</div>
<div id="upgo"></div>
</noindex>


<!-- GoogleAnalytics -->



<!-- Yandex.Metrika counter -->
 <script type="text/javascript">
var yaParams = {ip_adress: "<? echo $_SERVER['REMOTE_ADDR'];?>"};
//объявляем параметр ip_adress и записываем в него IP посетителя
</script> 
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter<?=$kod_metriki?> = new Ya.Metrika({
					id:<?=$kod_metriki?>,
					params:window.yaParams,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/<?=$kod_metriki?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<span style="display:none;">
<!--LiveInternet counter--><!--/LiveInternet-->
</span>




<?php  //if($addcookie):?>
<?php /*?><div id="slide-banner">
	<div class="inner">
		<div class="bannertitle"><a href="/start_v_internet_biznese">Закажите сайт и получите пакет услуг на сумму, более 50 000 руб. - в подарок!</a></div>
		<div class="bannertext">Копирайтинг. SEO-оптимизация. Реклама Я.Директ, G.Adwords. Оформление аккаунтов: vk, ok, fb, instagram. Реклама в соц. сетях.</div>
	</div>
<div id="slide-banner-close"></div>
</div>
<script>
$(document).ready(function(){
	setTimeout(function(){
		$("#slide-banner").slideDown();
	},10000);
	$("#slide-banner-close").click(function(){
		$("#slide-banner").slideUp();		
	});
});
</script><?php */?>
<? //endif;?>