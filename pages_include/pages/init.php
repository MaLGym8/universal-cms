<?php
if(isset($ROUTES[1])&&!isset($ROUTES[2]))
{

    $PageUrl = htmlspecialchars(stripslashes($ROUTES[1]));

    if($ROUTES[1]=="")
        $PageUrl ="index";

    $Page = $db->read("SELECT * FROM `pages` WHERE `url`='$PageUrl' AND `public`=1");

    if(!$Page) {
        $Page = $db->read("SELECT * FROM `sales` WHERE `url`='$PageUrl' AND `public`=1");
        if(!$Page || $MODULES[24][2]==0)
        {
             $Page = Error404();
        }else{
            $Page["background"]="";
if($Page["include_file"]==1)
    {
        if(file_exists("pages_include/pages/".$PageUrl.".php"))
            $Page["include"] = "pages_include/pages/".$PageUrl.".php";
    }elseif($Page["include_file"]==2)
    {
        if(file_exists("pages_include/pages/".$PageUrl.".php"))
            $Page["include_all"] = "pages_include/pages/".$PageUrl.".php";
    }
        }

       
    }else{
        if($Page["include_file"]==1)
        {
            if(file_exists("pages_include/pages/".$PageUrl.".php"))
            $Page["include"] = "pages_include/pages/".$PageUrl.".php";
        }elseif($Page["include_file"]==2)
        {
            if(file_exists("pages_include/pages/".$PageUrl.".php"))
                $Page["include_all"] = "pages_include/pages/".$PageUrl.".php";
        }
    }

}else{
    $Page = Error404();
}




