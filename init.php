<?
require_once("config.php");
require_once("libs/functions.php");

$IP = GetUserIP();//Для сайта

//****************Определяем что отправляем на вывод**************
if(strpos($_SERVER['REQUEST_URI'],"//"))
{
    $Page = Error404();
}
$ROUTES = explode('/',$_SERVER['REQUEST_URI']);//Разбираем урл
unset($ROUTES[0]);
//Очищаем урл от GET запросов
if($ROUTES[1]){$ROUTES[1] = explode("?",$ROUTES[1]);$ROUTES[1]=$ROUTES[1][0];}
if($ROUTES[2]){$ROUTES[2] = explode("?",$ROUTES[2]);$ROUTES[2]=$ROUTES[2][0];}
if($ROUTES[3]){$ROUTES[3] = explode("?",$ROUTES[3]);$ROUTES[3]=$ROUTES[3][0];}
if($ROUTES[4]){$ROUTES[4] = explode("?",$ROUTES[4]);$ROUTES[4]=$ROUTES[4][0];}
if($ROUTES[5]){$ROUTES[5] = explode("?",$ROUTES[5]);$ROUTES[5]=$ROUTES[5][0];}


$GetSubDomain = explode(".",$_SERVER["HTTP_HOST"]);

if($GetSubDomain[1])
{
    switch ($GetSubDomain[1])
    {
        case "blog":$ROUTES[1]="blog";break;
    }
}
//Определяем, какой компонент подключать
switch ($ROUTES[1])
{
    case "services":
        if ($MODULES[7][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "services";break;
    case "news":
        if ($MODULES[5][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "news";break;
    case "articles":
        if ($MODULES[1][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "articles";break;
    case "portfolio":
        if ($MODULES[6][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "portfolio";break;
    case "blog":
        if ($MODULES[2][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "blog";break;
    case "catalog":
        if ($MODULES[4][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "catalog";break;
    case "cart":
        if ($MODULES[3][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "cart";break;
    case "success":
        if ($MODULES[3][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "cart";break;
    case "reviews":
        if ($MODULES[12][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "pages";
        break;
    case "sales":
        if ($MODULES[24][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "pages";
        break;
    case "prices":
        if ($MODULES[25][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "pages";
        break;
    case "gallery":
        if ($MODULES[12][2]==0){
            $PageLoad = NULL;
            $Page = Error404();
            break;
        }
        $PageLoad = "pages";
        break;
    case "index.php":header("Location: /");break;
    case "index":header("Location: /");break;
    default:
        $route = htmlspecialchars(stripslashes($ROUTES[1]));
        $CheckServisec = $db->read("SELECT * FROM `services` WHERE `url`='$route' and `type_text`=0");
        $CheckCatalog = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$route' and parent=0");
        $CheckSale = $db->read("SELECT * FROM `sales` WHERE `url`='$route'");



        if($CheckServisec)
            $PageLoad = "services";
        elseif($CheckCatalog)
            $PageLoad = "catalog";
        elseif($CheckSale)
            $PageLoad = "pages";
        else
            $PageLoad = "pages";
        break;
}

//Подключаем выбранный компонент
if($PageLoad)
{
    require_once($_SERVER["DOCUMENT_ROOT"]."/pages_include/".$PageLoad."/init.php");
}

//Дебаг
if(isset($_GET["D"]))
{
    echo $PageLoad;
    echo"<pre>";
    echo print_r($ROUTES,1);
    echo"</pre>";
}
