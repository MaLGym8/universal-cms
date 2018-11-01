<?php
if($MODULES[7][2]==0)
{
    $Page = Error404();
}else{
$PageServices = "page-services";
if($ROUTES[1]=="services"&&$ROUTES[2]!=''){    $Page = Error404();
}else{
if($ROUTES[1]=="services")
{
    $Page = $db->read("SELECT * FROM `pages` WHERE `url`='services'");
    $MainCats = $db->read_all("SELECT * FROM `services` WHERE `parent`='0' and `public`=1 and `type_text`=0 ORDER by `position` ASC");
    $Page["include"] = "pages_include/services/list-main.php";
    $Parent = 0;
}else{
if(strpos($_SERVER['REQUEST_URI'],"//"))
{
    $Page = Error404();
}else{
    $URL = htmlspecialchars(stripslashes(end($ROUTES)));
    $Page = $db->read("SELECT * FROM `services` WHERE `url`='$URL'");


    $Check1 = GetPathCat($Page["id"]);
    $Check2 = "/" . implode("/", $ROUTES);

    if($Check1!=$Check2) {
        $Page = Error404();

    }else{

    $Parent = 1;
    if($Page)
    {
        $MainCats = $db->read_all("SELECT * FROM `services` WHERE `parent`='".$Page["id"]."' and `public`=1  ORDER by `position` ASC");
        if($MainCats)
        {
          
           // $Page["include"] = "pages_include/services/list-main.php";
        }else{


            $MainCats = $db->read_all("SELECT * FROM `services` WHERE `parent`='".$Page["parent"]."' and `public`=1  ORDER by `position` ASC");

            //  $Items = $db->read_all("SELECT * FROM `services` WHERE `parent`='".$Page["id"]."' ORDER by position ASC");
          //  $Page["include"] = "pages_include/services/list-items.php";
        }

        $Item = $db->read("SELECT * FROM `services` WHERE `url`='".$URL."' and `public`=1 ");
		
		
        if($Item) {
			$ItemParent0=1;
		if($Item["parent"])
		{
			$ItemParent = $db->read("SELECT * FROM `services` WHERE `id`='".$Item["parent"]."' and `public`=1 ");
			if($ItemParent["parent"])
			$ItemParent2 = $db->read("SELECT * FROM `services` WHERE `id`='".$ItemParent["parent"]."' and `public`=1 ");
			else
                $ItemParent2=1;


			
			if(!$ItemParent||!$ItemParent2)
			{
				
				$ItemParent0 = 0;
				
			}	
	
		}
			if($ItemParent0==1)
			{
            if ($Item["type"] == 0) {
                $Page["include"] = "pages_include/services/list-current.php";
            } elseif ($Item["type"] == 1) {
                $Page["include"] = "pages_include/services/files/" . $Item["url"] . ".php";
            } else {
                $Page["include_all"] = "pages_include/services/files/" . $Item["url"] . ".php";
            }
            $Page["title"] = $Item["title"];
            $Page["meta_d"] = $Item["meta_d"];
            $Page["meta_k"] = $Item["meta_k"];
			}else{
				$Page = Error404();
			}
        }else{
       
                $Page = Error404();


        }



    }else{
        $Item = $db->read("SELECT * FROM `services` WHERE `url`='".$URL."' and `public`=1");
        if($Item)
        {

            $photos = explode(" ", trim($Item["photos"]));
            if($Item["type"]==0)
            {
                $Page["include"] = "pages_include/services/list-current.php";
            }elseif($Item["type"]==1){
                $Page["include"] = "pages_include/services/files/".$Item["url"].".php";
            }else{
                $Page["include_all"] = "pages_include/services/files/".$Item["url"].".php";
            }
            $Page["title"] = $Item["title"];
            $Page["meta_d"] = $Item["meta_d"];
            $Page["meta_k"] = $Item["meta_k"];
        }else{
            $Page = Error404();

        }
    }
    }
    }
}
}
}
