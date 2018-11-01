<div class="menu-top">

        <div class="amenu burger c-hamburger c-hamburger--htx" >

            <span class="lines"></span>
            Меню</div>
        <ul class="menu">
            <?
            $MenuTop = $db->read_all("SELECT * FROM `menu` WHERE public=1 and `parent`=0  ORDER by position ASC");
            if ($MenuTop) {



                foreach ($MenuTop as $Menu) {

                    //Обнуляем активный класс
                    $ACTIVE_LEVEl_1 = "";

                    //Подключаем меню услуг
                    if($Menu["link"]=="/services")
                    {
                        include_once ("uslugi-menu.php");
                    }elseif($Menu["link"]=="/portfolio")
                    {
                        include_once ("portfolio-menu.php");
                    /*}elseif($Menu["link"]=="sales")
                    {
                        include_once ("sales-menu.php");*/
                    }elseif($Menu["link"]=="/catalog")
                    {
                        include_once ("catalog-menu.php");

                    }elseif($Menu["link"]=="gallery")
                    {
                        $result = $db->read("SELECT `public` FROM `pages` WHERE `url`='".$Menu["link"]."'");
                        if ($result['public'] == 1 && $MODULES[26][2]==1) goto approved;
                    }
                    else
                    {
                        approved:
                        if($Menu["link"])//Если задана ссылка, то формируем урл и проверяем на активность
                        {
                            foreach ($ROUTES as $route) {
                                if($route==str_replace("/","",$Menu["link"]))
                                {
                                    $ACTIVE_LEVEl_1 = "active";
                                    break;
                                }

                            }
                            $URL = $Menu["link"];
                        }elseif($Menu["page"]){ //Если указана страница, то формируем урл и проверяем на активность
                            foreach ($ROUTES as $route) {
                                if($route==$Menu["page"])
                                {
                                    $ACTIVE_LEVEl_1 = "active";
                                    break;
                                }
                            }
                            $URL = $base_url.$Menu["page"];
                        }else{//Если ничего не задано, то это ссылка на главную
                            if($ROUTES[1]=="")
                                $ACTIVE_LEVEl_1 = "active";
                            $URL = "/";
                        }
/*--------------------------------------------/Подменю\-----------------------------------------------*/
                        $resultMenuParent = $db->read_all(
                            "SELECT * FROM `menu` WHERE public=1 and `parent`='" . $Menu["id"]
                            . "' ORDER by position ASC"
                        );

                        if ($resultMenuParent) {
                            $MenuParent = [];
                            foreach($resultMenuParent as $Parent) {
                                if (isset($Parent['page'])) {
                                    if ($Parent['page']=="news") {
                                        if ($MODULES[5][2] ==0) goto moduleDisable;
                                    }
                                    elseif ($Parent['page']=='sales'){
                                        if ($MODULES[24][2] ==0) goto moduleDisable;
                                    }
                                    elseif ($Parent['page']=='articles'){
                                        if ($MODULES[1][2] ==0) goto moduleDisable;
                                    }
                                    $resultPage = $db->read(
                                        "SELECT `public` FROM `pages` WHERE `url`='" . $Parent['page'] . "'"
                                    );
                                    if ($resultPage['public'] == 1) {
                                        array_push($MenuParent,$Parent);
                                    };
                                }
                                moduleDisable:
                            }
                            if (empty($MenuParent) || !isset($MenuParent[0])) goto noHaveActivePages;
                            $PARENT = "<ul>";
                            $class = "arrow podmenu";
                            foreach($MenuParent as $Parent)
                            {

								$ACTIVE_LEVEl_2="";
                                if($Parent["link"])//Если задана ссылка, то формируем урл и проверяем на активность
                                {
                                    foreach ($ROUTES as $route) {
                                        if($route==$Parent["link"])
                                        {
                                            $ACTIVE_LEVEl_2 = "active2";
                                            break;
                                        }

                                    }
                                    $URL1 = $base_url.$Parent["link"];
                                }elseif($Parent["page"]){ //Если указана страница, то формируем урл и проверяем на активность
                                    foreach ($ROUTES as $route) {
                                        if($route==$Parent["page"])
                                        {
                                            $ACTIVE_LEVEl_2 = "active2";
                                            break;
                                        }
                                    }
                                    $URL1 = $base_url.$Parent["page"];
                                }
                                $PARENT .=  '<li ><a class="'.$ACTIVE_LEVEl_2.'" href="' .$URL1 . '">' . $Parent["title"] . '</a></li>';
                            }
                            $PARENT .="</ul>";
                        } else {
                            noHaveActivePages:
                            $class = "";
                            $PARENT="";
                        }




                        //Выводим сам пункт меню
						//if($Menu["page"]=="sales") { $sales = "podmenu";}

                        echo '<li class="'.$ACTIVE_LEVEl_1.' '.$class.' '.$sales.'"><a href="' .$URL . '">' . $Menu["title"] . ''; if($PARENT){echo '<i></i>';} echo'</a>'; if($PARENT){echo $PARENT;} echo'</li>';

                    }


                }
            }
            ?>
        </ul>
</div>