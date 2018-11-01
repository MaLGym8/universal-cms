<?php
if($MODULES[3][2]==0)
{
    $Page = Error404();
}else {
//Проверяем, есть ли в урле параметр news и отсутствует ли второй. Если условие верно, то выводим все работы
    if ($ROUTES[1] == "cart" && !isset($ROUTES[2])) {
        $Page = $db->read("SELECT * FROM `pages` WHERE `url`='cart'");

        $Page["include"] = "pages_include/cart/current.php";

    } elseif ($ROUTES[1] == "success" && !isset($ROUTES[2])) {
        $Page = $db->read("SELECT * FROM `pages` WHERE `url`='success'");


        $Page["include"] = "pages_include/cart/success.php";
    } else {
        $Page = Error404();
    }

}
