<? if($ROUTES[1]!=""):


    ?>
<div class="breadcrumbs">
	<?php /*?><div class="inner"><?php */?>
        <div class="page-navigator">
            <a class="first-elem" href="/">Главная</a>
            <?
			if(!$Page["error"]) {
            //Проходим по всему урлу

            foreach ($ROUTES as $route)
            {

                    //Проверяем, какой компонент выводится
                    switch ($ROUTES[1])
                    {

                        case "catalog":
                            $Text = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$route'");
                            if (!$Text) {
                                $Text = $db->read("SELECT * FROM `catalog` WHERE `url`='$route'");
                            }
                            if (!$Text) {
                                $Text = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");
                            }
                            if($Text["name"])
                                $Text["title"] = $Text["name"];
                        break;

                        case "services":
                            $Text = $db->read("SELECT * FROM `services` WHERE `url`='$route'");
                            if(!$Text) $Text = $db->read("SELECT * FROM `services` WHERE `url`='$route'");
                            if(!$Text)
                            {
                                $TextPage = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");
                                if($TextPage["h1"])
                                    $Text["title"] = $TextPage["h1"];
                                else
                                    $Text["title"] = $TextPage["title"];
                            }
                            if($Text["name"])
                                $Text["title"] = $Text["name"];

                            if($Text["menu"])
                                $Text["title"] = $Text["menu"];
                            break;
                        case "portfolio":
                            $Text = $db->read("SELECT * FROM `services` WHERE `url`='$route'");
                            if(!$Text) $Text = $db->read("SELECT * FROM `services` WHERE `url`='$route'");
                            if(!$Text) $Text = $db->read("SELECT * FROM `portfolio_cat` WHERE `url`='$route'");
                            if(!$Text) $Text = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");
                            if(!$Text) $Text = $db->read("SELECT * FROM `portfolio_item` WHERE `url`='$route'");

                            if($Text["name"])
                                $Text["title"] = $Text["name"];
                            if($Text["h1"])
                                $Text["title"] = $Text["h1"];
                            break;
                        case "news":
                        case "articles":
                            $Text = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");
                            if(!$Text) $Text = $db->read("SELECT * FROM `news` WHERE `url`='$route'");
                            break;
                       case "blog":

                           $Text = $db->read("SELECT * FROM `blog_cats` WHERE `url`='$route'");
                           if(!$Text) $Text = $db->read("SELECT * FROM `blog` WHERE `url`='$route'");
                           if(!$Text) $Text = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");

                           if($Text["name"])
                               $Text["title"] = $Text["name"];
                           if($Text["h1"])
                               $Text["title"] = $Text["h1"];

                           break;
                        default:
                            $route1 = htmlspecialchars(stripslashes($ROUTES[1]));
                            $CheckServisec = $db->read("SELECT * FROM `services` WHERE `url`='$route1'");
                            $CheckCatalog = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$route1' and `parent`=0");
                            if($CheckServisec)
                            {
                                $Text = $db->read("SELECT * FROM `services` WHERE `url`='$route'");
                                if(!$Text) $Text = $db->read("SELECT * FROM `services` WHERE `url`='$route'");
                                if(!$Text)
                                {
                                    $TextPage = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");
                                    if($TextPage["h1"])
                                        $Text["title"] = $TextPage["h1"];
                                    else
                                        $Text["title"] = $TextPage["title"];
                                }
                                if($Text["name"])
                                    $Text["title"] = $Text["name"];

                                if($Text["menu"])
                                    $Text["title"] = $Text["menu"];
                            }elseif($CheckCatalog) {

                                $Text = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$route'");
                                if (!$Text) {
                                    $Text = $db->read("SELECT * FROM `catalog` WHERE `url`='$route'");
                                }

                                if($Text["name"])
                                    $Text["title"] = $Text["name"];
								if($Text["menu"])
                                    $Text["title"] = $Text["menu"];	

                            }else{


                                $Text = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");
                                if (!$Text) {
                                    $Text = $db->read("SELECT * FROM `sales` WHERE `url`='$route'");
                                    if ($Text["name"]) {
                                        $Text["title"] = $Text["name"];
                                    }
                                } else {
                                    if ($Text["h1"]) {
                                        $Text["title"] = $Text["h1"];
                                    }
                                }

                            }
                           
                            break;
                    }


                    switch ($GetSubDomain[1])
                    {
                         
                       case "blog":

                           $Text = $db->read("SELECT * FROM `blog_cats` WHERE `url`='$route'");
                           if(!$Text) $Text = $db->read("SELECT * FROM `blog` WHERE `url`='$route'");
                           if(!$Text) $Text = $db->read("SELECT * FROM `pages` WHERE `url`='$route'");

                           if($Text["name"])
                               $Text["title"] = $Text["name"];
                           if($Text["h1"])
                               $Text["title"] = $Text["h1"];

                           break;
                       
                    }

                    //Формируем иерархию ссылки
                    $Link .= "/".$route;

                //Проверяем на последний элемент в ссылке

                if($route!=end($ROUTES))
                {

                        $LINK .= " <a href='" . $Link . "'>" . $Text["title"] . "</a>";

                }else{
                    $LINK .= " <span>".$Text["title"]."</span>";
                }


            }

            echo $LINK;//Выводим всё
			}


            ?>
        </div>
	<?php /*?></div><?php */?>
</div>
<? endif;?>