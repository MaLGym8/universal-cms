<? if(header_change==1){ ?>
<div class="shapka2-zagolovok-text">
    <div class="inner">
        <div class="shapka2-wrap-left">
            <?php /*?><div class="shapka2-zagolovok">Раскрутка и продвижение в Инстаграм</div>
            <div class="shapka2-text">Комплексное увеличение продаж</div><?php */?>
             <div class="shapka2-zagolovok">Работа по верстке на этом движке -</div>
            <div class="shapka2-text">Напишите в скайп <strong>myskypeserg</strong></div>   

        </div>
        <? 
		if($MODULES[11][2]==1): //форма в серединке страницы
		include ("modules/forms/top_form.php"); endif;?>

<br clear="all">

 <div class="prozrachniy"><a class="button-down-order button" href="">Заказать услугу</a></div>
     </div>       
     
     

     
     
     
        
        <div class="header-dark"> 
		<div class="inner">
        
			<div class="icon i1">
            Авторские композиции от
профессиональных флористов</div>

			<div class="icon i2">
            Только свежие цветы
премиум класса,
хранящиеся от 14 дней</div>

			<div class="icon i3">
            Доставка в течение
2 часов. Прием заказов
круглосуточно!</div>

			<div class="icon i4">
            Поможем в выборе.
Учтем все Ваши
пожелания</div>

			

        </div>
	</div>
        
        

</div>
<? }?> 


<?
if(header_change==0){ include_once ("modules/sliders/top/top.php");}

if ($MODULES[9][2]==1) include_once ("modules/sliders/slider/slider.php");
if ($MODULES[4][2]==1) include_once ("pages_include/catalog/module_block/module_catalog.php");

if ($MODULES[7][2]==1): //услуги
    ?>
    <div class="block-text index">
        <div class="inner">
        <? include_once ("pages_include/services/module_block/module_services.php");?>
        </div>
    </div>
    <? 
endif;

if ($MODULES[6][2]==1 && $MODULES[10][2]==1): //портфолио
    $queryPortfCat  = "SELECT * FROM `portfolio_item` WHERE `public`=1 ORDEr by sort ASC LIMIT 18";
    include_once("pages_include/portfolio/module_block/module_portfolio.php");
endif;

?>


<div class="index-block-4">
    <div class="inner">
        <div class="title white">В чем уникальность Landing Page</div>
 			<div style="width:100%; text-align:center;"><img src="/images/elements/multilending.png" style="margin:10px 0 30px 0; width:100%; max-width:888px;"></div>
    </div>
</div>





<div class="pagetext construktor">
	<div class="inner">
<script src="/pages_include/services/module_block/constructor_cen.js"></script>
<? include_once("pages_include/services/module_block/construktors_cen/tarif3.php");?>
<? include_once("pages_include/services/module_block/construktors_cen/tarif4.php");?>
    </div>
</div>




<? include_once("pages_include/services/module_block/action_start_v_internet_biznese.php"); ?>


<?
if ($MODULES[13][2] == 1 && $MODULES[12][2]==1) include_once("modules/reviews/reviews_block.php"); //отзывы




if($MODULES[11][2]==1): //форма в серединке страницы
    ?>
    <div class="block-text index">
        <div class="inner">
        <h1 class="title"><?=$Page["h1"]; ?></h1>
        <?=$Page["text"]; ?>

			
        

<?

if($MODULES[11][2]==1): //форма в серединке страницы
include ("modules/forms/top_form.php"); endif;

?>
 <div class="prozrachniy black"><a class="button-down-order button" href="">Заказать услугу</a></div>       
        </div>
    </div>
<? endif;


if ($MODULES[2][2]==1 && $MODULES[14][2]==1): //блог
    ?>
    <div class="block-blog">
        <div class="inner">
        <div class="title">Из блога</div>
        <?
    $newsQ = $db->read_all("SELECT * FROM `blog` ORDER by `date_add` DESC LIMIT 0, 3");
    include_once("pages_include/blog/include-list.php");
    ?>
    
    <br clear="all">
    <div class="moreblog"><a class="button" href="<?=$base_url_blog;?>">Перейти в блог</a></div>
        </div>
    </div>
<?endif;

if ($MODULES[5][2] == 1 || $MODULES[1][2]==1) ://новости
    ?>
    <div class="block-news-articles">
        <div class="inner">
    <? if ($MODULES[17][2]==1) include_once ("pages_include/news/module_block/module_news.php");?>
    <? if ($MODULES[18][2]==1) include_once ("pages_include/articles/module_block/module_articles.php");?>
        </div>
    </div><?
endif;

if ($MODULES[19][2]==1) include_once("modules/sliders/cert.php"); //сертификаты
if ($MODULES[20][2]==1) include_once("modules/sliders/logo.php"); //партнеры
if ($MODULES[27][2]==1) include_once("modules/faq/faq.php"); //faq
if ($MODULES[21][2]==1) include_once("modules/forms/bottom/bottom_block.php"); //форма обратной связи внизу