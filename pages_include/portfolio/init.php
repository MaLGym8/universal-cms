<?
$LIMITIMG = 15;
if($ROUTES[1]&&!isset($ROUTES[2]))
{
    $Page = $db->read("SELECT * FROM `pages` WHERE `url`='portfolio'");
   //$MainCats = $db->readTableAsArray("SELECT * FROM `portfolio_cat` INNER JOIN portfolio_item ON portfolio_cat.id = portfolio_item.portfolio_cat  WHERE  `portfolio_cat`.`public`=1 GROUP by portfolio_cat.id ORDER by portfolio_cat.position ASC");
    $MainCats = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`=0");




    if($MainCats)
    {
        $TMP = array();
        foreach($MainCats as $Cat)
        {
          /*  $Check1 = $db->read("SELECT * FROM `portfolio_item` WHERE `portfolio_cat`='".$Cat["id"]."'");
            if(!$Check1)
            {
                $Cats1 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Cat["id"]."'");
                if($Cats1)
                {
                    foreach($Cats1 as $Cat1)
                    {
                        $Check1 = $db->read("SELECT * FROM `portfolio_item` WHERE `portfolio_cat`='".$Cat1["id"]."'");

                        if(!$Check1)
                        {
                            $Cats2 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Cat1["id"]."'");
                            if($Cats2)
                            {
                                foreach($Cats2 as $Cat2)
                                {
                                    $Check1 = $db->read("SELECT * FROM `portfolio_item` WHERE `portfolio_cat`='".$Cat2["id"]."'");
                                }
                            }
                        }
                    }
                }
            }
            if($Check1)*/
                $TMP[] = $Cat;
        }
        $MainCats = $TMP;
    }

    /*if(isset($_GET["tag"]))
    {
        $Tag1 = htmlspecialchars(stripslashes($_GET["tag"]));
        $TagInfo = $db->read("SELECT * FROM `tags` WHERE `name`='$Tag1'");
        if($TagInfo)
        {

            $Page["title"] =  $Page["menu"].": ".$Tag1;

        }
    }*/
    $ParentCats = 0;
	
	if(isset($_GET["tag"]))
        {
            $Tag1 = htmlspecialchars(stripslashes($_GET["tag"]));
            $TagInfo = $db->read("SELECT * FROM `tags` WHERE `name`='$Tag1'");
            if($TagInfo)
            {
                switch($Page["id"])
                {
                    case "1":
                        $Page["title"] .=  $Tag1;
                        $Page["meta_d"] .= " : ".$Tag1." с продвижением под ключ по доступной цене и точно в срок. Полный пакет услуг";
                        $Page["meta_k"] ="";
                        break;
                    case "3":
                        $Page["title"] .= " : ".$Tag1;
						$Page["meta_d"] .= " : ".$Tag1.". Высокая конверсия, доступная цена, точно в срок. Яндекс Директ в подарок!";
                        $Page["meta_k"] ="";
                        break;
                    case "4":
                        $Page["title"] .= " : ".$Tag1;
						$Page["meta_d"] .= " : ".$Tag1.". Адаптивный дизайн, доступная цена, точно в срок. SEO продвижение и техническое сопровождение.";
                        $Page["meta_k"] ="";
                        break;
                    case "5":
                        $Page["title"] .= " : ".$Tag1." от 25000 руб.";
						$Page["meta_d"] .= " : ".$Tag1.". Адаптивный дизайн, доступная цена, точно в срок. SEO продвижение и техническое сопровождение.";
                        $Page["meta_k"] ="";
                        break;
                    case "6":
                        $Page["title"] .= " : ".$Tag1;
						$Page["meta_d"] .= " : ".$Tag1." под ключ. Полный функционал. Эксклюзивный продающий дизайн. Прост и удобен для Ваших покупателей. Дружелюбен к SEO";
                        $Page["meta_k"] ="";
                        break;
                    case "8":
                        $Page["title"] .= " : ".$Tag1." под ключ";
						$Page["meta_d"] .= " : ".$Tag1.". Работа точно в срок по доступной цене. Дальнейшее SEO и SMM продвижение.";
                        $Page["meta_k"] ="";
                        break;
                }
            }
        }
	
    $Page["include"] = "pages_include/portfolio/list-main.php";


}else{
    if(strpos($_SERVER['REQUEST_URI'],"//"))
    {
        $Page = Error404();
    }else{

        $URL = htmlspecialchars(stripslashes(end($ROUTES)));
        //$URL = $db->es($URL);
        $Page = $db->read("SELECT * FROM `portfolio_cat` WHERE `url`='$URL' and `public`=1");

        $ParentCats = 1;




        if(isset($_GET["tag"]))
        {
            $Tag1 = htmlspecialchars(stripslashes($_GET["tag"]));
            $TagInfo = $db->read("SELECT * FROM `tags` WHERE `name`='$Tag1'");
            if($TagInfo)
            {
                switch($Page["id"])
                {
                    case "1":
                        $Page["title"] =  "Создание и продвижение сайта: ".$Tag1;
                        $Page["meta_d"] ="Закажите создание сайта ".$Tag1." с продвижением под ключ по доступной цене и точно в срок. Полный пакет услуг";
                        $Page["meta_k"] ="";
                        break;
                    case "3":
                        $Page["title"] =  "Создание Landing Page: ".$Tag1;
						$Page["meta_d"] ="Разработка продающих Лендингов ".$Tag1.". Высокая конверсия, доступная цена, точно в срок. Яндекс Директ в подарок!";
                        $Page["meta_k"] ="";
                        break;
                    case "4":
                        $Page["title"] =  "Заказать создание корпоративного сайта: ".$Tag1;
						$Page["meta_d"] ="Создаем эксклюзивные корпоративные сайты ".$Tag1.". Адаптивный дизайн, доступная цена, точно в срок. SEO продвижение и техническое сопровождение.";
                        $Page["meta_k"] ="";
                        break;
                    case "5":
                        $Page["title"] =  "Стоимость создания сайта ".$Tag1." от 25000 руб.";
						$Page["meta_d"] ="Закажите разработку сайта каталога по тематике ".$Tag1.". Адаптивный дизайн, доступная цена, точно в срок. SEO продвижение и техническое сопровождение.";
                        $Page["meta_k"] ="";
                        break;
                    case "6":
                        $Page["title"] =  "Создание интернет-магазина: ".$Tag1;
						$Page["meta_d"] ="Закажите у нас создание интернет-магазина ".$Tag1." под ключ. Полный функционал. Эксклюзивный продающий дизайн. Прост и удобен для Ваших покупателей. Дружелюбен к SEO";
                        $Page["meta_k"] ="";
                        break;
                    case "8":
                        $Page["title"] =  "Создание интернет сайта: ".$Tag1." под ключ";
						$Page["meta_d"] ="Создаем сайты по тематике: ".$Tag1.". Работа точно в срок по доступной цене. Дальнейшее SEO и SMM продвижение.";
                        $Page["meta_k"] ="";
                        break;
                }
            }
        }

        if($Page)
        {
            $MainCats = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Page["id"]."' and `public`=1 ORDER by `position` ASC");
            if(!$MainCats)
            {
                $MainCats = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Page["parent"]."' and `public`=1 ORDER by `position` ASC");
                $Parent = $Page["id"];
                $ParentCat =  $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='".$Page["parent"]."' and `public`=1 ORDER by `position` ASC");
            }

			
			
                $Check1 =  str_replace("services","portfolio",GetPathCat($Page["id"],"portf"));
                $Check2 = "/" . implode("/", $ROUTES);
				
			
if($Check1==$Check2){
            if($MainCats) {
                $TMP=array();
                foreach ($MainCats as $Cat)
                {
                    /*$CheckCat = $db->read_all("SELECT * FROM `portfolio_item` WHERE `portfolio_cat`='".$Cat["id"]."'");
                    if($CheckCat)
                        $TMP[] = $Cat;

                    $CheckCat = 1;*/
                    $TMP[] = $Cat;
                    $CheckCat = 1;
                }
                $MainCats = $TMP;


                $Page["include"] = "pages_include/portfolio/list-main.php";
            }else{
                $Items = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Page["services_id"]."'  and `public`=1 ORDER by id ASC");
                $ParentCats = 2;
                $Page["include"] = "pages_include/portfolio/list-main.php";
}}else{                $Page = Error404();
}
        }else{
            $Page = $db->read("SELECT * FROM `portfolio_item` WHERE `url`='".$URL."' AND `public`=1 AND `public_text`=1");
            if($Page)
            {
                
                $Page["include"] = "pages_include/portfolio/current.php";
            }else{
                $Page = Error404();

            }
        }
    }
}


/*
if($ROUTES[1]&&!isset($ROUTES[2]))
{
    $Page = $db->read("SELECT * FROM `pages` WHERE `url`='portfolio'");
    $Page["include"] = "pages_include/portfolio/list.php";
}elseif($ROUTES[1]&&$ROUTES[2]&&!isset($ROUTES[3]))
{
    $page = htmlspecialchars(stripslashes($ROUTES[2]));

    $Page = $db->read("SELECT * FROM portfolio_item WHERE link='$page' and `public`=1");
    if($Page) {
        $Page["title"] = $Page["description"];
        $Page["include"] = "pages_include/portfolio/current.php";
    }else{
        $Page = Error404();
    }
}else{
    $Page = Error404();
}*/