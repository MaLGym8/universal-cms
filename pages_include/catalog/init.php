<?php
if($MODULES[4][2]==0)
{
    $Page = Error404();
}else {
    if ($ROUTES[1] == "catalog"&& !isset($ROUTES[2])) {
        $Page = $db->read("SELECT * FROM `pages` WHERE `url`='catalog'");
        $MainCats = $db->read_all("SELECT * FROM `catalog_cat` WHERE `parent`='0' ORDER by `position` ASC");
        $Page["include"] = "pages_include/catalog/list-main.php";
        $Parent = 0;

    } else {

        if (strpos($_SERVER['REQUEST_URI'], "//")) {
            $Page = Error404();

        } else {

            $URL = htmlspecialchars(stripslashes(end($ROUTES)));
            $Page = $db->read("SELECT * FROM `catalog_cat` WHERE `url`='$URL'");
            $Parent = 1;
            if ($Page) {
                $MainCats = $db->read_all(
                    "SELECT * FROM `catalog_cat` WHERE `parent`='" . $Page["id"] . "' ORDER by `position` ASC"
                );
                if ($MainCats) {
                    $Page["include"] = "pages_include/catalog/list-main.php";
                } else {
                    $Items = $db->read_all(
                        "SELECT * FROM `catalog` WHERE `cat`='" . $Page["id"] . "' ORDER by coast,id ASC"
                    );
                    $Page["include"] = "pages_include/catalog/list-items.php";
                }
            } else {
                $Item = $db->read("SELECT * FROM `catalog` WHERE `url`='" . $URL . "'");
                if ($Item) {
                    $photos = explode(" ", trim($Item["photos"]));
                    if ($Item["public"] == 0) {
                        $Page["include"] = "pages_include/catalog/list-current.php";
                    } elseif ($Item["public"] == 1) {
                        $Page["include"] = "pages_include/catalog/files/" . $Item["url"] . ".php";
                    } else {
                        $Page["include_all"] = "pages_include/catalog/files/" . $Item["url"] . ".php";
                    }
                    $Page["title"] = $Item["title"];
                    $Page["meta_d"] = $Item["meta_d"];
                    $Page["meta_k"] = $Item["meta_k"];

                    //Выбираем подарки отмеченные в адмнке
                    $Gifts = $db->read_all(
                        "SELECT * FROM `catalog_gift_products` WHERE `catalog_id`='" . $Item["id"] . "' "
                    );

                    if ($Gifts) {
                        $GIFTS = array();

                        foreach ($Gifts as $gift) {
                            $QUERY .= " AND `id`!= '" . $gift["gift_id"] . "' ";
                            $GIFTS[] = $db->read("SELECT * FROM `catalog_gift` WHERE `id`='" . $gift["gift_id"] . "'");

                        }

                    }
                    //Выбираем остальные подарки
                    $GiftsAll = $db->read_all("SELECT * FROM `catalog_gift` WHERE id!=0  $QUERY");


                } else {
                    $Page = Error404();

                }
            }
        }
    }
}