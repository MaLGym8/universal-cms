<?
if($MODULES[5][2]==0)
{
    $Page = Error404();
}else{
//Проверяем, есть ли в урле параметр news и отсутствует ли второй. Если условие верно, то выводим листинг новостей
if($ROUTES[1]&&!isset($ROUTES[2]))
{
    $Page = $db->read("SELECT * FROM `pages` WHERE `url`='news' AND `public`=1");
    $Page["include"] = "pages_include/news/list.php";
}elseif($ROUTES[1]&&$ROUTES[2]&&!isset($ROUTES[3]))
{
    $page = htmlspecialchars(stripslashes($ROUTES[2]));

    $Page = $db->read("SELECT * FROM news WHERE url='$page' and `type`=1 AND `public`=1");
    if($Page)
    $Page["include"] = "pages_include/news/current.php";
    else
    $Page = Error404();

}else{
    $Page = Error404();
}}