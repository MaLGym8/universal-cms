<?
if($MODULES[2][2]==0)
{
    $Page = Error404();
}else{
//Проверяем, есть ли в урле параметр news и отсутствует ли второй. Если условие верно, то выводим листинг новостей
if($ROUTES[1]&&!isset($ROUTES[2]))
{
    $Page = $db->read("SELECT * FROM `pages` WHERE `url`='blog'");
    //$CATS = $db->readTableAsArray("SELECT * FROM blog_cats INNER JOIN blog ON blog_cats.id = blog.cat WHERE blog_cats.public = 1 AND blog.public=1   GROUP by blog_cats.id");
    $CATS = $db->readTableAsArray("SELECT * FROM blog_cats WHERE blog_cats.public = 1   ORDER by `position` ASC");

    $Page["include"] = "pages_include/blog/list.php";
}elseif($ROUTES[1]&&$ROUTES[2]&&!isset($ROUTES[3]))
{
    $URL = htmlspecialchars(stripslashes(end($ROUTES)));
    $Page = $db->read("SELECT * FROM `blog_cats` WHERE `url`='".$URL."' and `public`=1");
    if(!$Page)
    {
		    $Page = $db->read("SELECT * FROM `blog` WHERE `url`='".$URL."' AND `public`=1");





       if(!$Page||($Page["cat"]&&!$ROUTES[3]))
    {
        $Page = Error404();
    }else{

        if ($Page["type"] == 0) {
            $Page["include"] = "pages_include/blog/current.php";
        } elseif ($Page["type"] == 1) {
            $Page["include"] = "pages_include/blog/files/" . $Page["url"] . ".php";
        } else {
            $Page["include_all"] = "pages_include/blog/files/" . $Page["url"] . ".php";
        }



    }

    }else{
        $CATS = $db->readTableAsArray("SELECT * FROM blog_cats  WHERE blog_cats.public = 1 ORDER by `position` ASC");
        $CURRENTCAT = $Page["id"];
        $Page["title"] = $Page["title"];
        $Page["include"] = "pages_include/blog/list.php";
    }
}elseif($ROUTES[1]&&$ROUTES[2]&&isset($ROUTES[3])){
    $URL = htmlspecialchars(stripslashes(end($ROUTES)));
    $Page = $db->read("SELECT * FROM `blog` WHERE `url`='".$URL."' AND `public`=1");
    if(!$Page)
    {
        $Page = Error404();
    }else{

        if ($Page["type"] == 0) {
            $Page["include"] = "pages_include/blog/current.php";
        } elseif ($Page["type"] == 1) {
            $Page["include"] = "pages_include/blog/files/" . $Page["url"] . ".php";
        } else {
            $Page["include_all"] = "pages_include/blog/files/" . $Page["url"] . ".php";
        }



    }

}else{
    $Page = Error404();
}}