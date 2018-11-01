<?
include_once("config.php");

if(isset($_POST["loadinfoservices"]))
{
    $id = $_POST["loadinfoservices"];
    global $db;
    $info = $db->read("SELECT * FROM `services` WHERE `id`='$id'");
    echo json_encode($info);

}

if(isset($_POST["delete_img"]))
{
    $id = $_POST["delete_img"];
    $type = $_POST["type"];
    $image = $_POST["image"];

    switch($type)
    {
        case "page":

            $result = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE id=$id"));
            mysql_query("UPDATE  `pages` SET `background`='' WHERE id=$id");


            @unlink("../".$result["background"]);
            @unlink("../".str_replace("small","big",$result["background"]));


            break;
            case "backserv":

            $result = mysql_fetch_array(mysql_query("SELECT * FROM  `services` WHERE id=$id"));
            mysql_query("UPDATE  `services` SET `background`='' WHERE id=$id");


            @unlink("../".$result["background"]);
            @unlink("../".str_replace("small","big",$result["background"]));


            break;
            case "imageserv":

            $result = mysql_fetch_array(mysql_query("SELECT * FROM  `services` WHERE id=$id"));
            mysql_query("UPDATE  `services` SET `image`='' WHERE id=$id");


            @unlink("../".$result["image"]);
            @unlink("../".str_replace("small","big",$result["image"]));


            break;
        case "bg_portfolio":

            $result = mysql_fetch_array(mysql_query("SELECT * FROM  `portfolio_item` WHERE id=$id"));
            mysql_query("UPDATE  `portfolio_item` SET `background`='' WHERE id=$id");


            @unlink("../".$result["background"]);
            @unlink("../".str_replace("small","big",$result["background"]));


            break;
        case "images":

            $result_photos = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_item` WHERE id=$id"));
            if($result_photos)
            {
                $photos = explode(' ',trim($result_photos["images"]));
                $temp = array();
                foreach ($photos as $p)
                {
                    if ($p === $image)
                    {
                        if (strlen($p) > 0)
                        {

                            @unlink('../'.$p);
                            @unlink('../'.str_replace("small","big",$p));
                        }
                    }
                    else
                    {
                        $temp[] = $p;
                    }
                    $photos = implode(' ',$temp);
                    mysql_query("UPDATE `portfolio_item` SET images='$photos' WHERE id=$id");
                }
            }


            break;
        case "blog_cats":

            $result = mysql_fetch_array(mysql_query("SELECT * FROM  `blog_cats` WHERE id=$id"));
            mysql_query("UPDATE  `blog_cats` SET `background`='' WHERE id=$id");


            @unlink("../".$result["background"]);
            @unlink("../".str_replace("small","big",$result["background"]));


            break;

    }
}









if(isset($_POST["gettagbyid"]))
{
    $id = $_POST["gettagbyid"];
    $catid = $_POST["catid"];
    global $db;

   /* $tags = $db->read_all("SELECT * FROM `tags` WHERE `services_id`='$catid'");
    if($tags)
    {
        $html = "";
        foreach ($tags as $tag)
        {
            $tagsselected = $db->read("SELECT * FROM `tags_ids` WHERE `obj_id`='$id' AND `tag_id`='".$tag["id"]."' AND `obj_type`='image'");

            if($tagsselected)
                $ch = "checked";
            else
                $ch = "";
            $html .="<label><input $ch type='checkbox' name='tags[]' value='".$tag["id"]."'/>".$tag["name"]."</label><br/>";
        }
    }
    echo $html;*/
    $tags = $db->read_all("SELECT * FROM `tags` WHERE `services_id`='$catid'");
    if($tags)
    {
        $html = "";
        foreach ($tags as $tag)
        {
            $tagsselected = $db->read("SELECT * FROM `tags_ids` WHERE `obj_id`='$id' AND `tag_id`='".$tag["id"]."' AND `obj_type`='image'");
            if($tagsselected)
                $ch = "checked";
            else
                $ch = "";

            $html .="<label><input $ch type='checkbox' name='tags[]' value='".$tag["id"]."'/>".$tag["name"]."</label><br/>";
        }
    }else{
        $GetInfoCat = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='$catid'");
        $GetInfoCat1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$GetInfoCat["parent"]."'");

        if($GetInfoCat)
        {
            $tags = $db->read_all("SELECT * FROM `tags` WHERE `services_id`='".$GetInfoCat1["id"]."'");
            if($tags)
            {
                $html = "";
                foreach ($tags as $tag)
                {
                    $tagsselected = $db->read("SELECT * FROM `tags_ids` WHERE `obj_id`='$id' AND `tag_id`='".$tag["id"]."' AND `obj_type`='image'");
                    if($tagsselected)
                        $ch = "checked";
                    else
                        $ch = "";

                    $html .="<label><input $ch type='checkbox' name='tags[]' value='".$tag["id"]."'/>".$tag["name"]."</label><br/>";
                }
            }else{
                $GetInfoCat = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$GetInfoCat["parent"]."'");
                $GetInfoCat1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$GetInfoCat["parent"]."'");

                if($GetInfoCat)
                {
                    $tags = $db->read_all("SELECT * FROM `tags` WHERE `services_id`='".$GetInfoCat1["id"]."'");
                    if($tags)
                    {
                        $html = "";
                        foreach ($tags as $tag)
                        {
                            $tagsselected = $db->read("SELECT * FROM `tags_ids` WHERE `obj_id`='$id' AND `tag_id`='".$tag["id"]."' AND `obj_type`='image'");
                            if($tagsselected)
                                $ch = "checked";
                            else
                                $ch = "";

                            $html .="<label><input $ch type='checkbox' name='tags[]' value='".$tag["id"]."'/>".$tag["name"]."</label><br/>";
                        }
                    }

                }




            }

        }
    }
    echo $html;

}


if(isset($_POST["gettagbycat"]))
{
    $catid = $_POST["gettagbycat"];
    global $db;
    $tags = $db->read_all("SELECT * FROM `tags` WHERE `services_id`='$catid'");
    if($tags)
    {
        $html = "";
        foreach ($tags as $tag)
        {
            $html .="<label><input type='checkbox' name='tags[]' value='".$tag["id"]."'/>".$tag["name"]."</label><br/>";
        }
    }else{
        $GetInfoCat = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='$catid'");
        $GetInfoCat1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$GetInfoCat["parent"]."'");

        if($GetInfoCat)
        {
            $tags = $db->read_all("SELECT * FROM `tags` WHERE `services_id`='".$GetInfoCat1["id"]."'");
            if($tags)
            {
                $html = "";
                foreach ($tags as $tag)
                {
                    $html .="<label><input type='checkbox' name='tags[]' value='".$tag["id"]."'/>".$tag["name"]."</label><br/>";
                }
            }else{
                $GetInfoCat = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$GetInfoCat["parent"]."'");
                $GetInfoCat1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$GetInfoCat["parent"]."'");

                if($GetInfoCat)
                {
                    $tags = $db->read_all("SELECT * FROM `tags` WHERE `services_id`='".$GetInfoCat1["id"]."'");
                    if($tags)
                    {
                        $html = "";
                        foreach ($tags as $tag)
                        {
                            $html .="<label><input type='checkbox' name='tags[]' value='".$tag["id"]."'/>".$tag["name"]."</label><br/>";
                        }
                    }

                }




            }

        }
    }
    echo $html;

}
function removeDirRec($dir)
{
    if ($objs = glob($dir."/*")) {
        foreach($objs as $obj) {
            is_dir($obj) ? removeDirRec($obj) : unlink($obj);
        }
    }
    rmdir($dir);
}
//--------------------------------------------------Вспомогоательные функции--------------------------------------------
//Разбитие строки
function str_split_unicode($str, $l = 0) {
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}
//Преобразование в нижний регистр
function cyr_strtolower($a) {
    $offset=32;
    $m=array();
    for($i=192;$i<224;$i++)$m[chr($i)]=chr($i+$offset);
    return strtr($a,$m);
}
//Проверка урла
function checkurl($url,$type="")
{
    global $id;
    global $db;

    switch ($type)
    {
        case "catalog_cats":
            $CheckURL = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;
        case "catalog":
            $CheckURL = $db->read("SELECT * FROM `catalog` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `catalog` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }
            break;
        case "catalog":
            $CheckURL = $db->read("SELECT * FROM `catalog` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `catalog` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }
            break;
        case "services":
            $CheckURL = $db->read("SELECT * FROM `services` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `services` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;
        case "services2":
            $CheckURL = $db->read("SELECT * FROM `portfolio_cat` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `portfolio_cat` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;
        case "news_articles":
            $CheckURL = $db->read("SELECT * FROM `news` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `news` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }
            break;
        case "pages":
            $CheckURL = $db->read("SELECT * FROM `pages` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `pages` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;   case "sales":
            $CheckURL = $db->read("SELECT * FROM `sales` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `sales` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;
        case "portfolio":
            $CheckURL = $db->read("SELECT * FROM `portfolio_item` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `portfolio_item` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;
        case "blogcats":
            $CheckURL = $db->read("SELECT * FROM `blog_cats` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `blog_cats` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;
        case "blog":
            $CheckURL = $db->read("SELECT * FROM `blog` WHERE `url`='$url' AND `id`!='$id'");
            if($CheckURL)
            {
                for($i=1;$i<=100;$i++)
                {
                    $URL = $url."_".$i;
                    $CheckURL = $db->read("SELECT * FROM `blog` WHERE `url`='$URL' AND `id`!='$id'");
                    if(!$CheckURL)
                    {
                        $RETURNURL = $URL;
                        break;
                    }

                }
            }else{
                $RETURNURL = $url;
            }

            break;

    }
    return $RETURNURL;
}

function translitIt($str){
    $tr = array(
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g","Д"=>"d",
        "Е"=>"e","Ё"=>"yo","Ж"=>"j","З"=>"z","И"=>"i",
        "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"c","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"yo","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
        " "=> "_", "."=> "", "/"=> "_"
    );
    return strtr($str,$tr); 
}
 



//Транслит URL
function translateURL($urlstr)
{
	if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
		$urlstr = translitIt($urlstr);
		$urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
	}
	$urlstr = substr($urlstr,0,50);
return  $urlstr;
}
//Структура урла в категория
function GetPathPortfolio($ID)
{
    global  $db;


    $SUB1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`=$ID");

    $SUB2 = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='".$SUB1["parent"]."'");

    $SUB3 = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='".$SUB2["parent"]."'");




    if($SUB1&&$SUB2&&!$SUB3)
    {
        return "".$SUB2["url"]."/".$SUB1["url"];

    }elseif($SUB3&&$SUB2&&$SUB1){

        return "".$SUB3["url"]."/".$SUB2["url"]."/".$SUB1["url"];
    }elseif($SUB1){
        return "".$SUB1["url"];
    }else{
        return"";
    }
}

