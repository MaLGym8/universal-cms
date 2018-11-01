<?
include_once("config.php");
include_once("../libs/functions.php");
include_once("functions.php");
include_once("../libs/resizeimg.php");

//Страницы
include_once ("includes/pages/add.php");
include_once ("includes/pages/edit.php");
include_once ("includes/pages/show.php");

//Акции
include_once ("includes/sales/add.php");
include_once ("includes/sales/edit.php");
include_once ("includes/sales/show.php");

//Меню
include_once ("includes/menu/add.php");
include_once ("includes/menu/edit.php");
include_once ("includes/menu/show.php");

//Новости/Статьи
include_once ("includes/news_articles/add.php");
include_once ("includes/news_articles/edit.php");
include_once ("includes/news_articles/show.php");

//Категории каталога
include_once("includes/catalog_cats/add.php");
include_once("includes/catalog_cats/edit.php");
include_once("includes/catalog_cats/show.php");


//Категории галереия
include_once("includes/portfolio_cats/add.php");
include_once("includes/portfolio_cats/edit.php");
include_once("includes/portfolio_cats/show.php");

//Портфолио
include_once ("includes/portfolio_item/add.php");
include_once ("includes/portfolio_item/show.php");

//Отзывы
include_once ("includes/reviews/add.php");
include_once ("includes/reviews/edit.php");
include_once ("includes/reviews/show.php");

//Настройки
include_once ("includes/settings/show.php");

//Категории блога
include_once ("includes/blog_cats/add.php");
include_once ("includes/blog_cats/edit.php");
include_once ("includes/blog_cats/show.php");

//Блог
include_once ("includes/blog/add.php");
include_once ("includes/blog/edit.php");
include_once ("includes/blog/show.php");

//Комментарии
include_once ("includes/comments/show.php");
include_once ("includes/comments/edit.php");
//Заявки
include_once ("includes/orders/show.php");
//Калькулятор - категории
include_once ("includes/calculator_cats/add.php");
include_once ("includes/calculator_cats/edit.php");
include_once ("includes/calculator_cats/show.php");
//Калькулятор - значения
include_once ("includes/calculator_items/add.php");
include_once ("includes/calculator_items/edit.php");
include_once ("includes/calculator_items/show.php");


include_once ("includes/services/add.php");
include_once ("includes/services/edit.php");
include_once ("includes/services/show.php");

//Slider
include_once ("includes/slider/slider.php");
//Gallery
include_once ("includes/gallery/gallery.php");
//Partners
include_once ("includes/partners/partners.php");
//Sert
include_once ("includes/certificates/certificates.php");



//Каталог
include_once ("includes/catalog/add.php");
include_once ("includes/catalog/edit.php");
include_once ("includes/catalog/show.php");

//Опции
include_once ("includes/options/add.php");
include_once ("includes/options/edit.php");
include_once ("includes/options/show.php");

//Категории каталога
include_once("includes/catalog_cats/add.php");
include_once("includes/catalog_cats/edit.php");
include_once("includes/catalog_cats/show.php");

//CMS
include_once("includes/cms/add.php");
include_once("includes/cms/edit.php");
include_once("includes/cms/show.php");

//Тип сайта
include_once("includes/type_site/add.php");
include_once("includes/type_site/edit.php");
include_once("includes/type_site/show.php");

//Тематика
include_once("includes/subject/add.php");
include_once("includes/subject/edit.php");
include_once("includes/subject/show.php");

//Подарки
include_once ("includes/catalog_gift_cats/add.php");
include_once ("includes/catalog_gift_cats/edit.php");
include_once ("includes/catalog_gift_cats/show.php");

include_once ("includes/catalog_gift/add.php");
include_once ("includes/catalog_gift/edit.php");
include_once ("includes/catalog_gift/show.php");

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Админ-панель</title>	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
    
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/tinymce/jquery.tinymce.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="js/jquery.equalHeight.js"></script>
    <script type="text/javascript">
        $(window).load(function(){ $('.column').equalHeight();
        });
    </script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

<? include_once("lock.php");?>
<?
if($_SESSION["message"])
{?>
<script>
$(document).ready(function()
{
    $("body").append('<div id="message_block"><?=$_SESSION["message"]?></div>');
    $("#message_block").fadeIn('slow');
    setTimeout(function(){$("#message_block").fadeOut('slow',function(){{$("#message_block").remove();}});},100);
    <? $_SESSION["message"]="";?>
});
</script>
<?
}
?>
    <script type="text/javascript">
        $(document).ready(function() {
        
          
            <?if($_GET["page"]!='add_calculator_item'&&$_GET["page"]!="edit_calculator_item"):?>
        
            $(".tablesorter").tablesorter();
                <?endif;?>

        });
	function my_cleanup_callback(type,value) {
  switch (type) {
    case 'get_from_editor':
      // Remove &nbsp; characters
      value = value.replace(/&nbsp;/ig, ' ');
      break;
    case 'insert_to_editor':
    case 'submit_content':
    case 'get_from_editor_dom':
    case 'insert_to_editor_dom':
    case 'setup_content_dom':
    case 'submit_content_dom':
    default:
      break;
  }
  return value;
}
        $().ready(function() {
            $('textarea.tinymce').tinymce({
                script_url : 'js/tinymce/tiny_mce.js',
				width : "1000",
                height : "500",
                theme : "advanced",
                plugins : "pagebreak,images,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

                theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,line-height",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,images,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,
				language : 'ru',
                verify_html : false,cleanup : false,
                valid_elements : '*[*]',cleanup_callback: 'my_cleanup_callback',

                content_css : "../css/style.css, css/tiny.css",

                template_external_list_url : "lists/template_list.js",
                external_link_list_url : "lists/link_list.js",
                external_image_list_url : "lists/image_list.js",
                media_external_list_url : "lists/media_list.js",
				theme_advanced_font_sizes        : '10px,11px,12px,13px,14px,16px,18px,24px,30px,36px,48px,60px,72px',
                cleanup : false,
                verify_html : false,
                cleanup_on_startup : false,
                forced_root_block : "",
                validate_children : false,
                remove_redundant_brs : false,
                remove_linebreaks : false,
                force_p_newlines : false,
                validate: false,
                fix_table_elements : false,
                fix_list_elements:false,
				relative_urls : false,

            });
        });
    </script>
</head>


<body>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.php">Админ-панель</a></h1>
			<div class="btn_view_site"><a href="index.php?page=settings">Настройки</a><a target="_blank" href="../">На сайт</a><a href="index.php?page=logout">Выход</a></div>
		</hgroup>
	</header>


    <aside id="sidebar" class="column">
        <div сlass="menu-left">
            <ul>
                <li><a href="index.php?page=show_pages">Страницы <small>(на главную)</small></a></li>
                <li><a href="index.php?page=show_menu">Меню</a></li>
                <? if($MODULES[24][2]==1){?><li><a href="index.php?page=show_sales">Акции</a></li> <? }?>
                <? if(($MODULES[5][2]==1) or ($MODULES[1][2]==1)){?><li><a href="index.php?page=show_news">Новости/Статьи</a></li><? }?>
                <br/>
                <? if($MODULES[7][2]==1){?><li><a href="index.php?page=show_services_cats">Услуги</a></li><br/><? }?>
                <? if($MODULES[6][2]==1){?><li><a href="index.php?page=show_portfolio_cats">Категории портфолио</a></li>
                    <li><a href="index.php?page=show_portfolio">Работы портфолио</a></li> <? }?>
                <? if($MODULES[2][2]==1){?><br/>
                    <li><a href="index.php?page=show_blog_cats">Категории блога</a></li>
                    <li><a href="index.php?page=show_blog">Посты блога</a></li>
                    <li><a href="index.php?page=comments">Комментарии блога</a></li>
                    <br/> <? }?>
                <? if($MODULES[12][2]==1){?><li><a href="index.php?page=reviews">Отзывы</a></li>  <? }?>
                <? if($MODULES[22][2]==1){?><br/>
                    <li><a href="index.php?page=add_lang">Добавить язык</a></li>
                    <li><a href="index.php?page=show_langs">Просмотр/Редактирование языков</a></li>
                    <br/>   <? }?>
                <? if($MODULES[9][2]==1){?> <li><a href="index.php?page=show_sliders">Слайдер</a></li> <? }?>
               <? if($MODULES[26][2]==1){?><li><a href="index.php?page=show_gallery">Галерея</a></li><? }?>
               <? if($MODULES[20][2]==1){?> <li><a href="index.php?page=show_part">Партнёры</a></li>       <? }?>
               <? if($MODULES[19][2]==1){?> <li><a href="index.php?page=show_sert">Сертификаты</a></li>    <? }?>
                <br/>
                <br/>

                <? if($MODULES[4][2]==1){?>
                    <!--<li><a href="index.php?page=show_cats">Категории товаров</a></li>-->
                    <li><a href="index.php?page=show_subject">Тематика</a></li>
                    <li><a href="index.php?page=show_cms">CMS</a></li>
                    <li><a href="index.php?page=show_type_site">Тип сайта</a></li>
                    <li><a href="index.php?page=show_catalog">Товары</a></li>
                    <li><a href="index.php?page=show_options">Опции</a></li>

                    <br/><br/><? }?>

                <? if(CATALOGGIFTS==1 && $MODULES[4][2]==1){?>
                    <li><a href="index.php?page=show_catalog_gift_cat">Категории подарков</a></li>
                    <li><a href="index.php?page=show_catalog_gift">Подарки</a></li>
                    <br>

                    <br/><br/><? }?>
            </ul>
        </div>
    </aside>
	
	<section id="main" class="column">
	<?

    
    switch ($_GET["page"])
    {
        case "add_menu": Add_Menu();break;
        case "edit_menu": Edit_Menu($_GET["id"]);break;
        case "show_menu": Show_Menu();break;

        case "add_page": Add_Page();break;
        case "edit_page": Edit_Page($_GET["id"]);break;
        case "show_pages": Show_Pages();break;

		 case "add_geo": Add_Geo();break;
        case "edit_geo": Edit_Geo($_GET["id"]);break;
        case "show_geo": Show_Geo();break;

		case "add_sale": Add_Sale();break;
        case "edit_sale": Edit_Sale($_GET["id"]);break;
        case "show_sales": Show_Sales();break;

        case "add_services_cats": Add_services_cats();break;
        case "edit_services_cats": Edit_services_cats($_GET["id"]);break;
        case "show_services_cats": Show_services_cats();break;


        case "add_portfolio_cats": Add_PortfolioCat();break;
        case "edit_portfolio_cats": Edit_Portfolio_Cats($_GET["id"]);break;
        case "show_portfolio_cats": Show_Portfolio_Cats();break;


        case "add_news": Add_News();break;
        case "edit_news": Edit_News($_GET["id"]);break;
        case "show_news": Show_News();break;

        case "show_portfolio": show_portfolio();break;
        case "show_portfolio_add": show_portfolio_Add();break;

		case "reviews":Show_Reviews();break;
		case "edit_review":Edit_Review($_GET["id"]);break;
		case "add_review":Add_Review();break;
		case "settings":Settings();break;

        case "comments":Show_Comments();break;
        case "edit_comment":Edit_Comment($_GET["id"]);break;
        case "add_comment":Add_Comment();break;


        case "add_blog_cats": Add_blog_Cats();break;
        case "edit_blog_cats": Edit_blog_Cats($_GET["id"]);break;
        case "show_blog_cats": Show_blog_Cats();break;

        case "add_blog": Add_blog();break;
        case "edit_blog": Edit_blog($_GET["id"]);break;
        case "show_blog": Show_blog();break;
		
        case "orders": Show_Orders();break;
		
		
        case "add_calculator_cat": Add_Calculator_Cat();break;
        case "edit_calculator_cat": Edit_Calculator_Cat($_GET["id"]);break;
        case "show_calculator_cats": Show_Calculator_Cats();break;

        case "add_calculator_item": Add_Calculator_Item();break;
        case "edit_calculator_item": Edit_Calculator_Item($_GET["id"]);break;
        case "show_calculator_items": Show_Calculator_Items();break;
        case "show_calculator": Show_Calculator();break;

        case "show_sliders": Show_Sliders();break;
        case "show_sliders_add": Show_Sliders_Add();break;

        case "show_gallery": Show_Gallery();break;
        case "show_gallery_add": Show_Gallery_Add();break;

        case "show_part": Show_Part();break;
        case "show_part_add": Show_Part_Add();break;
        case "show_sert": Show_Sert();break;
        case "show_sert_add": Show_Sert_Add();break;

        case "add_catalog": Add_Catalog();break;
        case "edit_catalog": Edit_Catalog($_GET["id"]);break;
        case "show_catalog": Show_Catalog();break;

        case "add_catalog_gift_cat": Add_Catalog_Gift_Cat();break;
        case "edit_catalog_gift_cat": Edit_Catalog_Gift_Cat($_GET["id"]);break;
        case "show_catalog_gift_cat": Show_Catalog_Gift_Cat();break;

        case "add_catalog_gift": Add_Catalog_Gift();break;
        case "edit_catalog_gift": Edit_Catalog_Gift($_GET["id"]);break;
        case "show_catalog_gift": Show_Catalog_Gift();break;

        case "add_cats": Add_Cats();break;
        case "edit_cats": Edit_Cats($_GET["id"]);break;
        case "show_cats": Show_Cats();break;

        //Раздел CMS
        case "add_cms": Add_Cms();break;
        case "edit_cms": Edit_Cms($_GET["id"]);break;
        case "show_cms": Show_Cms();break;

        //Раздел Тип сайта
        case "add_type_site": Add_Type_Site();break;
        case "edit_type_site": Edit_Type_Site($_GET["id"]);break;
        case "show_type_site": Show_Type_Site();break;

        //Раздел Тематика
        case "add_subject": Add_Subject();break;
        case "edit_subject": Edit_Subject($_GET["id"]);break;
        case "show_subject": Show_Subject();break;



        case "add_options": Add_Options();break;
        case "edit_options": Edit_Options($_GET["id"]);break;
        case "show_options": Show_Options();break;


        default:Show_Pages();
    }
    ?>	
<div class="spacer"></div>
	</section>
</body>
</html>