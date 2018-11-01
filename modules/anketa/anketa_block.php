<?php /*?><div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
    <div class="inner">
        <? //include_once("blocks/breadcrumbs.php");?>
		<? include_once("pages_include/services/module_block/4block_ceni.php");?>
    </div>
</div><?php */?>

    <link rel="stylesheet" type="text/css" href="<?=$base_url?>/modules/anketa/anketa.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>/modules/calculator/calculator.css" />
    <script type="text/javascript" src="<?=$base_url?>/modules/anketa/anketa.js"></script>


<?
//$bonus1 = 'Предварительный дизайн Вашего будущего сайта (пример <a href="/razrabotka_dizaina_saita_besplatno" target="_blank">здесь</a>)';
$bonus1 = 'Предварительный дизайн Вашего будущего сайта';
$bonus2 = 'Сметную стоимость сайта "Под ключ"';
$bonus3 = 'План по продвижению Вашего бизнеса в интернете';


$price_sitevizitka = 6000;
$price_landing = 10000;
$price_corpsite = 15000;
$price_catalog = 15000;
$price_magaz = 15000;
$price_individ = 25000;
$price_site_est = 6000;
$price_na_primere = 10000;


$price_design_unik = 10000;
$price_logo_shablon = 1500; $price_logo_unik = 3500;
$price_adaptive = 5000;

$price_cms_1cbitrix = 20000;
$price_cms_Wordpress = 2500;
$price_cms_Joomla = 2500;
$price_cms_Opencart = 5000;
$price_cms_other = 2500;

$price_multy_lang = 5000;
$price_regional = 5000;
$price_auto_import_export = 10000;
$price_individual_programming = 10000;


$price_napolnenie = 2500;

$price_domen = 500;
$price_hosting = 500;
$price_ssl = 1500;
$price_tehpodderzhka = 3000;



$price_kontext = 10000;
$price_target = 10000;

$price_seo1 = 10000;
$price_seo2 = 10000;
$price_smm = 10000;



?>


    <div class="container anketa_page">
        <div class="inner" style="overflow: hidden;">


            <!--Tab1-->
            <div class="tab-anketa" id="tab-anketa-1">

				<?php /*?><h1 id="s1-title">Потратьте 30 секунд на прохождение экспресс-теста из 6 вопросов</h1><?php */?>
                
                <?php /*?><h1 id="s1-title">Пройдите экспресс-тест из 6 вопросов</h1>
                <div id="s1-in-aboutq">Это не займет больше 1 минуты, затем введите Ваши контактные данные, и Вы получите:</div>
                <div id="s1-in"><?php */?>

                <<?=$tag_test;?> id="s1-title">Узнайте стоимость создания и продвижения сайта за 30 секунд</<?=$tag_test;?>>
                <div id="s1-in-aboutq">Пройдите экспресс-тест из 6 вопросов, и Вы получите:</div>
                <div id="s1-in">

                    <div id="s1-in-1">
                        <div id="s1-in-1-1">1</div>
                        <div id="s1-in-1-2"><?=$bonus1?></div>
                    </div>

                    <div id="s1-in-1">
                        <div id="s1-in-1-1">2</div>
                        <div id="s1-in-1-2"><?=$bonus2?></div>
                    </div>

                    <div id="s1-in-1">
                        <div id="s1-in-1-1">3</div>
                        <div id="s1-in-1-2"><?=$bonus3?></div>
                    </div>
                </div>

                <div id="s1-button" onclick="elemId('#tab-anketa-2'); return false;">
                    <div id="s1-button-1">ПРОЙТИ ТЕСТ И УЗНАТЬ СТОИМОСТЬ</div>
                    <div id="s1-button-2"></div>
                </div>

            </div>
            <!--Tab2-->
            <div class="tab-anketa active" id="tab-anketa-2">

                <div class="calculator-cat-inner anketa">
                    <div class="calculator-content-anketa">
                        <div class="main-block-item">
                            <a href="" class="anketa-back"><<< Вернуться назад</a>

                            <div class="calculator-item"><span>Для каких целей Вам нужен сайт?</span></div>
                            <div class="calculator-value-anketa">
                                <input name="anketa_1" class="calc-radio1" id="anketa_11" type="radio" value="1">
                                <label for="anketa_11">Для продажи товаров / услуг</label>
                            </div>
                            <div class="calculator-value-anketa">
                                <input name="anketa_1" class="calc-radio1" id="anketa_12" type="radio" value="2">
                                <label for="anketa_12">Создать, раскрутить сайт и зарабатывать с рекламы</label>
                            </div>
                            <div class="calculator-value-anketa">
                                <input name="anketa_1" class="calc-radio1" id="anketa_13" type="radio" value="3">
                                <label for="anketa_13">Просто заявить о себе в интернете</label>
                            </div>
                            <div class="calculator-value-anketa"><span>
                                <input name="anketa_1" class="calc-radio1" id="anketa_14" type="radio" value="4">
                                <label for="anketa_14">Другое <input type="text" name="anketa_1_text4"/></label></span>
                            </div>
                            <div class="anketa_next_step">Продолжить</div>

                        </div>


                    </div>
                </div>
            </div>

            <!--Tab3-->
            <div class="tab-anketa" id="tab-anketa-3">
                <div class="calculator-cat-inner anketa">
                    <div class="calculator-content-anketa">
                <div class="main-block-item"><a href="" class="anketa-back"><<< Вернуться назад</a>
                    <div class="calculator-item"><span>Какой сайт Вам нужен?</span></div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_21" type="radio" value="1">
                        <label for="anketa_21">Сайт-визитка <span class="anketaceni">от 10 000 руб.</span></label>
                        <span class="coast-element"><?=$price_sitevizitka?></span></span>

                    </div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_22" type="radio" value="2">
                        <label for="anketa_22">Landing page <span class="anketaceni">от 25 000 руб.</span></label>
                        <span class="coast-element"><?=$price_landing?></span></span>

                    </div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_23" type="radio" value="3">
                        <label for="anketa_23">Корпоративный сайт <span class="anketaceni">от 25 000 руб.</span></label><span class="coast-element"><?=$price_corpsite?></span></span>
                    </div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_24" type="radio" value="4">
                        <label for="anketa_24">Сайт-каталог (без корзины) <span class="anketaceni">от 30 000 руб.</span></label><span class="coast-element"><?=$price_catalog?></span></span>
                    </div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_25" type="radio" value="5">
                        <label for="anketa_25">Интернет-магазин <span class="anketaceni">от 25 000 руб.</span></label><span class="coast-element"><?=$price_magaz?></span></span>
                    </div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_26" type="radio" value="6">
                        <label for="anketa_26">Онлайн-сервис с индвидуальным программированием (доски, соц. сети, порталы и т.д.) <span class="anketaceni">от 60 000 руб.</span></label><span class="coast-element"><?=$price_individ?></span></span>
                    </div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_27" type="radio" value="7">
                        <label for="anketa_27">У меня есть сайт <input type="text" name="anketa_2_text7"/ placeholder="введите адрес"> нужны изменения </label><span class="coast-element"><?=$price_site_est?></span></span>
                    </div>
                    <div class="calculator-value-anketa">
                        <span><input name="anketa_2" class="calc-radio1" id="anketa_28" type="radio" value="8">
                        <label for="anketa_28">На примере сайта в интернете <input type="text" name="anketa_2_text8"/ placeholder="primer.ru"></label><span class="coast-element"><?=$price_na_primere?></span></span>
                    </div>

                    <div class="calculator-value-anketa">
                        <input name="anketa_2" class="calc-radio1" id="anketa_29" type="radio" value="9">
                        <label for="anketa_29">Не могу точно сказать, посоветуйте</label>
                    </div>

                    <div class="anketa_next_step">Продолжить</div>

                </div>
                </div>
                </div>
            </div>


            <!--Tab4-->
            <div class="tab-anketa" id="tab-anketa-4">

                <div class="calculator-cat-inner anketa">
                    <div class="calculator-content-anketa">

                        <div class="main-block-item"><a href="" class="anketa-back"><<< Вернуться назад</a>
                            <div class="calculator-item"><span>Дизайн</span></div>
                            <div class="calculator-value-anketa radio">
                                <b>Дизайн сайта</b>
                                <br clear="all">
                                <input name="anketa_3" class="calc-radio1" id="anketa_31" type="radio" value="1">
                                <label for="anketa_31">Шаблонный</label>

                                <span><input name="anketa_3" class="calc-radio1 radio-2" id="anketa_32" type="radio" value="2">
                                <label for="anketa_32">Уникальный</label><span class="coast-element"><?=$price_design_unik?></span></span>
                            </div>

<br clear="all"><br />


                            <div class="main-block-item no-margin-all margin-minus-top">

                                <div class="calculator-value-anketa radio">
                                    <b>Логотип</b>
                                    <br clear="all">
                                    
                               <span>     
                                    <input name="anketa_4" class="calc-radio1" id="anketa_41" type="radio" value="1">
                                    <label for="anketa_41">Упрощенный вариант</label><span class="coast-element"><?=$price_logo_shablon?></span>
								</span>


							   <span> 
                                    <input name="anketa_4" class="calc-radio1 radio-2" id="anketa_42" type="radio" value="2">
                                    <label for="anketa_42">Профессиональная разработка</label><span class="coast-element"><?=$price_logo_unik?></span>
                               </span>
                                    
                                    
                                    
                                </div>
                            </div>
                            <!---5--->
<br clear="all"><br />


                            <div class="main-block-item no-margin-all margin-minus-top">

                                <div class="calculator-value-anketa"><span>
                                    <input id="anketa_51" class="calc-checkbox1" name="anketa_5" value="1"  type="checkbox">
                                    <label for="anketa_51">Адаптивная верстка под все устройства (планшеты, телефоны)</label><span class="coast-element"><?=$price_adaptive?></span>

                                </span></div>

                            </div>

                            <div class="anketa_next_step">Продолжить</div>

                        </div>


                    </div>
                </div>
            </div>


            <!--Tab5-->
            <div class="tab-anketa" id="tab-anketa-5">

                <div class="calculator-cat-inner anketa">
                    <div class="calculator-content-anketa">
                        <div class="main-block-item colons2"><a href="" class="anketa-back"><<< Вернуться назад</a>
                        <div class="colons2left">

                            <div class="calculator-item"><span>Система управления</span></div>
                            
                            <div class="calculator-value-anketa"><span>
                                <input name="anketa_6" class="calc-radio1" id="anketa_61" type="radio" value="1">
                                <label for="anketa_61">1С-Bitrix</label><span class="coast-element"><?=$price_cms_1cbitrix?></span>
                            </span></div>
                            
                            <div class="calculator-value-anketa"><span>
                                <input name="anketa_6" class="calc-radio1" id="anketa_62" type="radio" value="2">
                                <label for="anketa_62">Wordpress</label><span class="coast-element"><?=$price_cms_Wordpress?></span>
                            </span></div>
                            
                            <div class="calculator-value-anketa"><span>
                                <input name="anketa_6" class="calc-radio1" id="anketa_63" type="radio" value="3">
                                <label for="anketa_63">Joomla</label><span class="coast-element"><?=$price_cms_Joomla?></span>
                            </span></div>
                            
                            <div class="calculator-value-anketa"><span>
                                <input name="anketa_6" class="calc-radio1" id="anketa_64" type="radio" value="4">
                                <label for="anketa_64">Opencart</label><span class="coast-element"><?=$price_cms_Opencart?></span>
                            </span></div>
                            
                            <div class="calculator-value-anketa"><span>
                                <input name="anketa_6" class="calc-radio1" id="anketa_65" type="radio" value="5">
                                <label for="anketa_65">Другая <input type="text" name="anketa_6_text5"/></label><span class="coast-element"><?=$price_cms_other?></span>
                            </span></div>
                            
                            <div class="calculator-value-anketa"><span>
                                <input name="anketa_6" class="calc-radio1" id="anketa_66" type="radio" value="6">
                                <label for="anketa_66">Не знаю, посоветуйте</label>
                            </span></div>
                            
                        </div>


                        <div class="colons2right">
                                <div class="calculator-item"><span>Функционал</span></div>


                                <div class="calculator-value-anketa"><span>
                                    <input id="anketa_71" class="calc-checkbox1" name="anketa_7" value="1"  type="checkbox">
                                    <label for="anketa_71">Сайт на нескольких языках</label><span class="coast-element"><?=$price_multy_lang?></span>
                                </span></div>

                                <div class="calculator-value-anketa"><span>
                                    <input id="anketa_81" class="calc-checkbox1" name="anketa_8" value="1"  type="checkbox">
                                    <label for="anketa_81">Региональный сайт с выбором городов/стран</label><span class="coast-element"><?=$price_regional?></span>
                                </span></div>

                                <div class="calculator-value-anketa"><span>
                                    <input id="anketa_91" class="calc-checkbox1" name="anketa_9" value="1"  type="checkbox">
                                    <label for="anketa_91">Автоматический импорт/экспорт данных на сайте (либо интеграция 1С, парсинг с других сайтов)</label><span class="coast-element"><?=$price_auto_import_export?></span>
                                </span></div>
                                
                                <div class="calculator-value-anketa"><span>
                                    <input id="anketa_912" class="calc-checkbox1" name="anketa_92" value="1"  type="checkbox">
                                    <label for="anketa_912">Нестандартный функционал с индивидуальным программированием</label><span class="coast-element"><?=$price_individual_programming?></span>
                                </span></div>




                        </div><br clear="all">

                            <div class="anketa_next_step">Продолжить</div>
                    </div>
                </div>
            </div>
            </div>




            <!--Tab6-->
            <div class="tab-anketa" id="tab-anketa-6">

                <div class="calculator-cat-inner anketa">
                    <div class="calculator-content-anketa">

                        <div class="main-block-item"><a href="" class="anketa-back"><<< Вернуться назад</a>

                            <div class="calculator-item"><span>Наполнение, размещение, обслуживание</span></div>
                            <div class="calculator-value-anketa radio">
                                <b>Наполнение сайта</b>
                                <br clear="all">
                                <span><input name="anketa_10" class="calc-radio1" id="anketa_101" type="radio" value="1">
                                <label for="anketa_101">Cамостоятельно</label></span>

                                <span><input name="anketa_10" class="calc-radio1 radio-2" id="anketa_102" type="radio" value="2">
                                <label for="anketa_102">Необходимо наполнение<input type="text" name="anketa_10_text2"/ placeholder="Кол-во страниц" style="width:30%;"></label><span class="coast-element"><?=$price_napolnenie?></span></span>
                            </div>


                                <div class="calculator-value-anketa">
                                    <span><input id="anketa_111" class="calc-checkbox1" name="anketa_11" value="1"  type="checkbox">
                                    <label for="anketa_111">Домен</label><span class="coast-element"><?=$price_domen?></span></span>
                                </div>



                                <div class="calculator-value-anketa">
                                    <span><input id="anketa_121" class="calc-checkbox1" name="anketa_12" value="1"  type="checkbox">
                                    <label for="anketa_121">Хостинг</label><span class="coast-element"><?=$price_hosting?></span></span>
                                </div>

                                <div class="calculator-value-anketa">
                                    <span><input id="anketa_131" class="calc-checkbox1" name="anketa_13" value="1"  type="checkbox">
                                    <label for="anketa_131">SSL сертификат (https)</label><span class="coast-element"><?=$price_ssl?></span></span>
                                </div>

                                <div class="calculator-value-anketa">
                                    <span><input id="anketa_141" class="calc-checkbox1" name="anketa_14" value="1"  type="checkbox">
                                    <label for="anketa_141">Ежемесячная тех. поддержка, наполнение и обслуживание сайта</label><span class="coast-element"><?=$price_tehpodderzhka?></span></span>
                                </div>

                            <div class="anketa_next_step">Продолжить</div>
                        </div>


                    </div>
                </div>
            </div>








            <!--Tab7-->
            <div class="tab-anketa" id="tab-anketa-7">

                <div class="calculator-cat-inner anketa">
                    <div class="calculator-content-anketa">
                        <div class="main-block-item">

                            <a href="" class="anketa-back"><<< Вернуться назад</a>



                                <div class="calculator-item"><span>Реклама и продвижение</span></div>
                                <div class="calculator-value-anketa"><b>Быстрый поток клиентов на сайт <span>(оплата за переходы)</span></b><br/>
                                    <span><input name="anketa_15[]" class="calc-checkbox1" id="anketa_151" type="checkbox" value="1">
                                    <label for="anketa_151">Контекстная реклама Яндекс директ, Гугл Эдвордс</label><span class="coast-element"><?=$price_kontext?></span></span>
                                </div>
                                <div class="calculator-value-anketa">
                                    <span><input name="anketa_15[]" class="calc-checkbox1" id="anketa_152" type="checkbox" value="2">
                                    <label for="anketa_152">Таргетированная реклама в соц сетях (vk,ok,fb,insta)</label><span class="coast-element"><?=$price_target?></span></span>
                                </div>
                            <br clear="all"/> <br clear="all"/>
                                <div class="calculator-value-anketa"><b>Долгосрочное продвижение <span>(результат не сразу, но окупается со временем в разы)</span></b><br/>
                                    <span><input name="anketa_16[]" class="calc-checkbox1" id="anketa_161" type="checkbox" value="1">
                                    <label for="anketa_161">SEO оптимизация <span>(разовая услуга, после которой ваш сайт постепенно начнет выходить в топ по низко и среднечастотным запросам)</span></label><span class="coast-element"><?=$price_seo1?></span></span>
                                </div>
                                <div class="calculator-value-anketa">
                                    <span><input name="anketa_16[]" class="calc-checkbox1" id="anketa_162" type="checkbox" value="2">
                                    <label for="anketa_162">SEO продвижение в топ 10 <span>(постоянная ежемесячная работа с гарантией результата от 3 мес)</span></label><span class="coast-element"><?=$price_seo2?></span></span>
                                </div>
                                
                         <div class="calculator-value-anketa">
                                    <span><input name="anketa_16[]" class="calc-checkbox1" id="anketa_163" type="checkbox" value="3">
 <label for="anketa_163">SMM <span>(продвижение в соц. сетях: создание, оформление продающих страниц и групп, раскрутка и ведение)</span></label><span class="coast-element"><?=$price_smm?></span></span>
            </div>       
                                
                                
                                
                                
                                
                            <div class="anketa_next_step">Продолжить</div>
        </div>





                        </div>
                    </div>
                </div>



            <!--Tab8-->
<div class="tab-anketa" id="tab-anketa-8">

    <div class="calculator-cat-inner anketa">
        <div class="calculator-content-anketa">
            <div class="main-block-item">


                <a href="" class="anketa-back anketa-final"><<< Вернуться назад</a></div></div></div>

                <div id="s1-title">Благодарим за ответы</div>
                <div id="s1-title-coast">Примерная стоимость выбранных Вами услуг:<br />
<span><b></b> <strong>руб.</strong></span></div>
                
                
                <div id="s3-in-final">
                <div id="s1-in-aboutq"><b>Оставьте заявку и получите:</b></div>
                
                    <div>1 - <?=$bonus1?></div>
                    <div>2 - <?=$bonus2?></div>
                    <div>3 - <?=$bonus3?></div>
                </div>

                <? include_once ("form.php");?>





            </div>









        </div>
    </div>




<div id="anketa-coast-all">
    <span>0</span> рублей
</div>