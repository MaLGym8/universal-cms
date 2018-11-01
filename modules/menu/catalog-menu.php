<?
//Проверяем, находимся ли мы в разделе с услугами
$CheckCatalog = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$ROUTES[1]'");



if ("catalog" == $ROUTES[1]||$CheckCatalog) {
    $ACTIVE_LEVEl_1 = "active";
} else {
    $ACTIVE_LEVEl_1 = "";
}
$CheckSubCats = $db->read_all("SELECT * FROM `catalog_cat` WHERE `parent`=1  ORDER by `position` ASC");
if($CheckSubCats)
{
   $addMenuClass = "";
}else{
    $addMenuClass = " podmenu ";
}


?>


<li class="<?echo $ACTIVE_LEVEl_1; echo $addMenuClass;?> arrow"><a href="/catalog">Каталог <i></i></a>
<ul>
<?
//Получаем список родителей
$resultC1 = $db->read_all("SELECT * FROM `catalog_cat` WHERE `parent`=0 ORDER by `position` ASC");

foreach ($resultC1 as $C1)
{

    //Проверяем, если ли вложенности
    $resultC2 = $db->read_all("SELECT * FROM `catalog_cat` WHERE `parent`='".$C1["id"]."' ORDER by `position` ASC");

    //Получаем структуру ссылки
    $URL = GetPathCat(  $C1["id"],"catalog" );

    //Проверяем, не находимся ли мы в этой категории
    if($ROUTES[1]==$C1["url"])
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

    //Вывод самого пункта
    echo '<li><a class="'.$act.' '.$hover1.'" href="'.$URL.'">' .$title1. '';if($resultC2){echo"<i></i>";} echo'</a>';

    //Если есть вложенность
    if($resultC2) {
        echo "<ul>";

        foreach($resultC2 as $C2)
        {
            //Проверяем на вложенность
            $resultC3 = $db->read_all("SELECT * FROM `catalog_cat` WHERE `parent`='".$C2["id"]."' ORDER by `position` ASC");

            //Проверяем, не находимся ли мы в этой категории
            if($ROUTES[2]==$C2["url"])
            {
                $act = " active2 ";
            }else{
                $act = "";
            }

            //Получаем структуру ссылки
            $URL1 = GetPathCat(  $C2["id"] ,"catalog" );

            //Проверяем, что выводить в пункт меню
            if( $C2["menu"])
                $title2 =  $C2["menu"];
            else
                $title2 =  $C2["title"];
            
            //Вывод самого пункта
            echo '<li class="';if($resultC3){echo"parent";} echo' "><a class="'.$act.' '.$hover2.'" href="' .$URL1 . '">' .$title2 . '';if($resultC3){echo"<i></i>";} echo'</a>';


            if($resultC3) {
                echo "<ul>";

                foreach($resultC3 as $C3) {
                    $URL2 = GetPathCat($C3["id"],"catalog" );

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

                    echo '<li><a class="' . $act . ' " href="' . $URL2 . '">' . $title3
                        . '</a></li>';
                }

                echo "</ul>";
            }


        }

        echo "</ul>";
    }
}


?>
<?php /*?><div class="menu_action">
	<a href="/start_v_internet_biznese">Пакет услуг к сайту в подарок!</a>
</div><?php */?>


</ul>
    </li>
