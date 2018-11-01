<?


$Anketa .='
<div class="calculator-main pdfanketa">
    <div class="calculator-left">

<div class="calculator-cat-inner">
    <div class="calculator-content">


       
        <div class="calculator-item2">
            <div class="calculator-item"><span>Для каких целей Вам нужен сайт?</span></div>
            <div class="calculator-value">
                <input name="anketa_1" class="calc-radio1" '; if($Anketa1["anketa_1"][1]) $Anketa .='checked="checked" '; $Anketa .=' id="anketa_11" type="radio" value="1">
                <label for="anketa_11">Для продажи товаров / услуг</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_1" class="calc-radio1" '; if($Anketa1["anketa_1"][2]) $Anketa .='checked="checked" '; $Anketa .=' id="anketa_12" type="radio" value="2">
                <label for="anketa_12">Создать, раскрутить сайт и зарабатывать с рекламы</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_1" class="calc-radio1" '; if($Anketa1["anketa_1"][3]) $Anketa .='checked="checked" '; $Anketa .=' id="anketa_13" type="radio" value="3">
                <label for="anketa_13">Просто заявить о себе в интернете</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_1" class="calc-radio1" id="anketa_14" '; if($Anketa1["anketa_1"][4]) $Anketa .='checked="checked" '; $Anketa .=' type="radio" value="4">
                <label for="anketa_14">Другое <span class="inputborder">'.$Anketa1["anketa_1"][4][1].'</span></label>
            </div>
        </div>
     
        <div class="calculator-item2">
            <div class="calculator-item"><span>Какой сайт вам нужен?</span></div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_21" type="radio" value="1" '; if($Anketa1["anketa_2"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_21">Сайт-визитка</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_22" type="radio" value="2" '; if($Anketa1["anketa_2"][2]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_22">Landing page</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_23" type="radio" value="3" '; if($Anketa1["anketa_2"][3]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_23">Корпоративный сайт</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_24" type="radio" value="4" '; if($Anketa1["anketa_2"][4]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_24">Сайт-каталог (без корзины)</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_25" type="radio" value="5" '; if($Anketa1["anketa_2"][5]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_25">Интернет-магазин</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_26" type="radio" value="6" '; if($Anketa1["anketa_2"][6]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_26">Онлайн-сервис с индвидуальным программированием (доски, соц. сети, порталы и т.д.)</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_27" type="radio" value="7" '; if($Anketa1["anketa_2"][7]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_27">У меня есть сайт, нужны изменения <span class="inputborder">'.$Anketa1["anketa_2"][7][1].'</span></label>
            </div>
            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_28" type="radio" value="8" '; if($Anketa1["anketa_2"][8]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_28">На примере сайта в интернете <span class="inputborder">'.$Anketa1["anketa_2"][8][1].'</span></label>
            </div>

            <div class="calculator-value">
                <input name="anketa_2" class="calc-radio1" id="anketa_29" type="radio" value="9" '; if($Anketa1["anketa_2"][9]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_29">Не могу точно сказать, посоветуйте</label>
            </div>
        </div>
    
        <div class="calculator-item2">
            <div class="calculator-item"><span>Дизайн</span></div>
            <div class="calculator-value">
                <span class="boldpunkt">Дизайн сайта</span> <input name="anketa_3" class="calc-radio1" id="anketa_31" type="radio" value="1" '; if($Anketa1["anketa_3"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_31">Шаблонный</label>

                <input name="anketa_3" class="calc-radio1 radio-2" id="anketa_32" type="radio" value="2" '; if($Anketa1["anketa_3"][2]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_32">Уникальный</label>
            </div>
        </div>
     
        <div class="no-margin-all margin-minus-top">

            <div class="calculator-value">
               <span class="boldpunkt">Логотип</span> <input id="anketa_41" class="calc-checkbox1" name="anketa_4" value="1"  type="radio" '; if($Anketa1["anketa_4"][1]) $Anketa .='checked="checked" '; $Anketa .='>
			     <label for="anketa_41">
Упрощенный вариант</label>
			   <input id="anketa_42" class="calc-checkbox1" name="anketa_4" value="2"  type="radio" '; if($Anketa1["anketa_4"][2]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_42">
Профессиональная разработка</label>
            </div>
        </div>
    
        <div class="no-margin-all">

            <div class="calculator-value">
                <input id="anketa_51" class="calc-checkbox1" name="anketa_5" value="1"  type="checkbox" '; if($Anketa1["anketa_5"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_51">Адаптивная верстка под все устройства (планшеты, телефоны)</label>
            </div>

        </div>
     
        <div class="calculator-item2">
            <div class="calculator-item"><span>Система управления</span></div>
            <div class="calculator-value">
                <input name="anketa_6" class="calc-radio1" id="anketa_61" type="radio" value="1" '; if($Anketa1["anketa_6"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_61">1С-Bitrix</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_6" class="calc-radio1" id="anketa_62" type="radio" value="2" '; if($Anketa1["anketa_6"][2]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_62">Wordpress</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_6" class="calc-radio1" id="anketa_63" type="radio" value="3" '; if($Anketa1["anketa_6"][3]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_63">Joomla</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_6" class="calc-radio1" id="anketa_64" type="radio" value="4" '; if($Anketa1["anketa_6"][4]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_64">Opencart</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_6" class="calc-radio1" id="anketa_65" type="radio" value="5" '; if($Anketa1["anketa_6"][5]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_65">Другая <span class="inputborder">'.$Anketa1["anketa_6"][5][1].'</span></label>
            </div>
            <div class="calculator-value">
                <input name="anketa_6" class="calc-radio1" id="anketa_66" type="radio" value="6" '; if($Anketa1["anketa_6"][6]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_66">Не знаю, посоветуйте </label>
            </div>
        </div>
		
		
		
		
		<div class="calculator-item2">
            <div class="calculator-item"><span>Функционал</span></div>

            <div class="calculator-value">
                <input id="anketa_71" class="calc-checkbox1" name="anketa_7" value="1"  type="checkbox" '; if($Anketa1["anketa_7"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_71">Сайт на нескольких языках</label>
            </div>
        </div>
        <div class="calculator-item1 no-margin-all margin-minus-top">

            <div class="calculator-value">
                <input id="anketa_81" class="calc-checkbox1" name="anketa_8" value="1"  type="checkbox" '; if($Anketa1["anketa_8"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_81">Региональный сайт с выбором городов/стран</label>
            </div>
        </div>
        <div class="calculator-item1 no-margin-all margin-minus-top">

            <div class="calculator-value">
                <input id="anketa_91" class="calc-checkbox1" name="anketa_9" value="1"  type="checkbox" '; if($Anketa1["anketa_9"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_91">Автоматический импорт/экспорт данных на сайте (либо интеграция 1С, парсинг с других сайтов)</label>
            </div>
        </div>



        <div class="calculator-item1 no-margin-all margin-minus-top">

            <div class="calculator-value">
                <input id="anketa_912" class="calc-checkbox1" name="anketa_92" value="1"  type="checkbox" '; if($Anketa1["anketa_92"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_912">Нестандартный функционал с индивидуальным программированием</label>
            </div>
        </div>
		
		
		

        <div class="calculator-item2">
            <div class="calculator-item"><span>Наполнение, размещение, обслуживание</span></div>
            <div class="calculator-value">
                <span class="boldpunkt">Наполнение сайта </span><input name="anketa_10" class="calc-radio1" id="anketa_101" type="radio" value="1" '; if($Anketa1["anketa_10"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_101">Cамостоятельно</label>

                <input name="anketa_10" class="calc-radio1 radio-2" id="anketa_102" type="radio" value="2" '; if($Anketa1["anketa_10"][2]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_102">Необходимо наполнение <span class="inputborder">'.$Anketa1["anketa_10"][2][1].'</span></label>
            </div>
        </div>

        <div class="calculator-item1 no-margin-all margin-minus-top">

            <div class="calculator-value">
                <input id="anketa_111" class="calc-checkbox1" name="anketa_11" value="1"  type="checkbox" '; if($Anketa1["anketa_11"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_111">Домен</label>
            </div>
        </div>

        <div class="calculator-item1 no-margin-all margin-minus-top">
            <div class="calculator-value">
                <input id="anketa_121" class="calc-checkbox1" name="anketa_12" value="1"  type="checkbox" '; if($Anketa1["anketa_12"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_121">Хостинг</label>
            </div>
        </div>
       
        <div class="calculator-item1 no-margin-all margin-minus-top">
            <div class="calculator-value">
                <input id="anketa_131" class="calc-checkbox1" name="anketa_13" value="1"  type="checkbox" '; if($Anketa1["anketa_13"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_131">SSL сертификат (https)</label>
            </div>
        </div>
      
        <div class="calculator-item1 no-margin-all margin-minus-top">
            <div class="calculator-value">
                <input id="anketa_141" class="calc-checkbox1" name="anketa_14" value="1"  type="checkbox" '; if($Anketa1["anketa_14"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_141">Ежемесячная тех. поддержка, наполнение и обслуживание сайта</label>
            </div>
        </div>

       
        <div class="calculator-item2">
            <div class="calculator-item"><span>Быстрый поток клиентов на сайт (оплата за переходы)</span></div>
            <div class="calculator-value">
                <input name="anketa_15[]" class="calc-checkbox1" id="anketa_151" type="checkbox" value="1" '; if($Anketa1["anketa_15[]"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_151">Контекстная реклама Яндекс директ, Гугл Эдвордс</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_15[]" class="calc-checkbox1" id="anketa_152" type="checkbox" value="2" '; if($Anketa1["anketa_15[]"][2]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_152">Таргетированная реклама в соц сетях (vk,ok,fb,insta)</label>
            </div>
        </div>

        
        <div class="calculator-item2">
            <div class="calculator-item"><span>Долгосрочное продвижение (результат не сразу, но окупается со временем в разы)</span></div>
            <div class="calculator-value">
                <input name="anketa_16[]" class="calc-checkbox1" id="anketa_161" type="checkbox" value="1" '; if($Anketa1["anketa_16[]"][1]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_161">SEO оптимизация (разовая услуга, после которой ваш сайт постепенно начнет выходить в топ по низко и среднечастотным запросам)</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_16[]" class="calc-checkbox1" id="anketa_162" type="checkbox" value="2" '; if($Anketa1["anketa_16[]"][2]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_162">SEO продвижение в топ 10 (постоянная ежемесячная работа с гарантией результата от 3 мес)</label>
            </div>
            <div class="calculator-value">
                <input name="anketa_16[]" class="calc-checkbox1" id="anketa_163" type="checkbox" value="3" '; if($Anketa1["anketa_16[]"][3]) $Anketa .='checked="checked" '; $Anketa .='>
                <label for="anketa_163">SMM (продвижение в соц. сетях: создание, оформление продающих страниц и групп, раскрутка и ведение)</label>
            </div>
        </div>











    </div>
</div>


</div>
</div>



';


