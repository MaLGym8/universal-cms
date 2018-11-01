<?
//Проверяем, находимся ли мы в разделе с услугами
if ("portfolio" == $ROUTES[1]) {
    $ACTIVE_LEVEl_1 = "active";
} else {
    $ACTIVE_LEVEl_1 = "";
}
$resultC1 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`=0 and `public`=1 ORDER by `position` ASC");

?>


<li class="<?=$ACTIVE_LEVEl_1;?><? if($resultC1)
{?>  arrow podmenu<?}?>"><a href="/portfolio">Портфолио<? if($resultC1)
        {?> <i></i><?}?></a>

        <?
        //Получаем список родителей
        if($resultC1)
        {
            echo "  <ul>";


            //Проверяем, если ли вложенности
//            $resultC2 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='0' and `public`=1 ORDER by `position` ASC");

            //Получаем структуру ссылки
//            $URL =str_replace("services","portfolio", GetPathCat(  $C1["id"],"portf" ));

            //Проверяем, не находимся ли мы в этой категории
            if($ROUTES[2]==$C1["url"])
            {
                $act = " active ";
            }else{
                $act = "";
            }

            //Проверяем, что выводить в пункт меню
            if( $C1["menu"])
                $title1 =  $C1["menu"];
            else
                $title1 =  $C1["title"];

            //Если есть вложенность
            if($resultC1) {
                //echo "<ul>";

                foreach($resultC1 as $C2)
                {
                    //Проверяем на вложенность
                    $resultC3 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$C2["id"]."' and `public`=1 ORDER by `position` ASC");

                    //Проверяем, не находимся ли мы в этой категории
                    if($ROUTES[2]==$C2["url"])
                    {
                        $act = " active2 ";
                    }else{
                        $act = "";
                    }

                    //Получаем структуру ссылки
                    $URL1 = str_replace("services","portfolio",GetPathCat(  $C2["id"],"portf" ));

                    //Проверяем, что выводить в пункт меню
                    if( $C2["menu"])
                        $title2 =  $C2["menu"];
                    else
                        $title2 =  $C2["title"];

                    //Вывод самого пункта
                    echo '<li class="cat2 ';if($resultC3){echo"parent";} echo' "><a class="cat2-a '.$act.' '.$hover2.'" href="' .$URL1 . '">' .$title2 . '';if($resultC3){echo"<i></i>";} echo'</a></li>';


                    if($resultC3) {
                        echo "<ul>";

                        foreach($resultC3 as $C3) {
                            $URL2 =str_replace("services","portfolio", GetPathCat($C3["id"],"portf"));

                            if ($ROUTES[3] == $C3["url"]) {
                                $act = " active ";
                            } else {
                                $act = "";
                            }

                            if ($C3["menu"]) {
                                $title3 = $C3["menu"];
                            } else {
                                $title3 = $C3["title"];
                            }

                            echo '<li class="cat3"><a class="cat3-a ' . $act . ' " href="' . $URL2 . '">' . $title3
                                . '</a></li>';
                        }

                        echo "</ul>";
                    }


                }

                //echo "</ul>";
            }

        echo "</ul>";
        }

        ?>
</li>
