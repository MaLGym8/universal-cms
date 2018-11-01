<?php


//Обрезка текста
function CutTextNews($text, $count = 100, $in_charset = "utf-8", $add = "...")
{
    $item["text"] = substr(iconv($in_charset, "cp1251", strip_tags($text)), 0, $count);
    $item["text"] = substr($item["text"], 0, strrpos(trim($item["text"]), " "));

    $item["text"] = iconv("cp1251", $in_charset, $item["text"]) . $add;
    return $item["text"];
}

//404 ошибка
function Error404()
{
    header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
    $Page["title"] = "Ошибка 404";
    $Page["error"] = 1;
    return $Page;
}

//Структура урла в категория
function GetPathCat($ID,$type="")
{
    global  $db;

    if($type=="portf")
    {

        $SUB1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`=$ID");
        if(!$SUB1)
            $SUB1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`=$ID");

        if(!$SUB1)
            $SUB1 = $db->read("SELECT * FROM `services` WHERE `id`=$ID");

        $SUB2 = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='".$SUB1["parent"]."'");

        if(!$SUB2)
            $SUB2 = $db->read("SELECT * FROM `portfolio_item` WHERE `id`='".$SUB1["parent"]."'");

        $SUB3 = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='".$SUB2["parent"]."'");


        if(!$SUB3)
            $SUB3 = $db->read("SELECT * FROM `portfolio_item` WHERE `id`='".$SUB2["parent"]."'");


    }elseif($type=="catalog"){
        $SUB1 = $db->read("SELECT * FROM `catalog_cat` WHERE `id`=$ID");
        $SUB2 = $db->read("SELECT * FROM `catalog_cat` WHERE `id`='".$SUB1["parent"]."'");
        $SUB3 = $db->read("SELECT * FROM `catalog_cat` WHERE `id`='".$SUB2["parent"]."'");


     }else{
        $SUB1 = $db->read("SELECT * FROM `services` WHERE `id`=$ID and `type_text`=0");
        $SUB2 = $db->read("SELECT * FROM `services` WHERE `id`='".$SUB1["parent"]."' and `type_text`=0");
        $SUB3 = $db->read("SELECT * FROM `services` WHERE `id`='".$SUB2["parent"]."' and `type_text`=0");

    }

    if($type=="portf")
    {
        if($SUB2&&!$SUB3)
        {
            return "/services/".$SUB2["url"]."/".$SUB1["url"];

        }elseif($SUB3){

            return "/services/".$SUB3["url"]."/".$SUB2["url"]."/".$SUB1["url"];
        }else{
            return "/services/".$SUB1["url"];
        }
    }elseif($type=="catalog") {
        if($SUB2&&!$SUB3)
        {
            return "/".$SUB2["url"]."/".$SUB1["url"];

        }elseif($SUB3){

            return "/".$SUB3["url"]."/".$SUB2["url"]."/".$SUB1["url"];
        }else{
            return "/".$SUB1["url"];
        }
    }else{
        if($SUB2&&!$SUB3)
        {
            return "/".$SUB2["url"]."/".$SUB1["url"];

        }elseif($SUB3){

            return "/".$SUB3["url"]."/".$SUB2["url"]."/".$SUB1["url"];
        }else{
            return "/".$SUB1["url"];
        }
    }

}

//Структура урла для товара
function GetPathService($ID,$type="")
{
    global  $db;


    if($type=="portf"){

        $SUB1 = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`=$ID");
        if(!$SUB1)
            $SUB1 = $db->read("SELECT * FROM `services` WHERE `id`=$ID");



        $SUB2 = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$SUB1["parent"]."'");
        if(!$SUB2)
            $SUB2 = $db->read("SELECT * FROM `services` WHERE `id`='".$SUB1["parent"]."'");



        $SUB3 = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='".$SUB2["parent"]."'");
        if(!$SUB3)
            $SUB3 = $db->read("SELECT * FROM `services` WHERE `id`='".$SUB2["parent"]."'");

    }elseif($type=="catalog") {

        $SUB1 =  $db->read("SELECT * FROM `catalog_cat` WHERE `id`=$ID");



        $SUB2 =  $db->read("SELECT * FROM `catalog_cat` WHERE `id`='".$SUB1["parent"]."'");

        $SUB3 =  $db->read("SELECT * FROM `catalog_cat` WHERE `id`='".$SUB2["parent"]."'");




        if($SUB3)
        {
            return "".$SUB3["url"]."/".$SUB2["url"]."/".$SUB1["url"];

        }elseif($SUB2){

            return "".$SUB2["url"]."/".$SUB1["url"];
        }else{
            return "".$SUB1["url"];

        }

    }else{
        $SUB1 =  $db->read("SELECT * FROM `services` WHERE `id`=$ID");

        $SUB2 =  $db->read("SELECT * FROM `services` WHERE `id`='".$SUB1["parent"]."'");

        $SUB3 =  $db->read("SELECT * FROM `services` WHERE `id`='".$SUB2["parent"]."'");
    }




if($type!="catalog") {
    if ($SUB3) {
        return "services/" . $SUB3["url"] . "/" . $SUB2["url"] . "/" . $SUB1["url"];

    } elseif ($SUB2) {

        return "services/" . $SUB2["url"] . "/" . $SUB1["url"];
    } else {
        return "services/" . $SUB1["url"];
    }
}


}

//Провекра на наличие подарка
function CheckGift($ID)
{
    global $db;
    $check = $db->read("SELECT * FROM `catalog_gift_products` WHERE `catalog_id`=$ID");
    if($check)
    {
        return true;
    }else{
        return false;
    }
}

function Show_CommentsAll($id_article)
{

    $res = mysql_query("select * from comments where cat = $id_article and public = 1 order by date_add");
    while($arr = mysql_fetch_array($res))
    {

        echo "
			<div class=main>
			<img style='width: 30px;' src=/images/chcomments/nophoto.png>
				<div class=block_name>
					<span class=name>".$arr['name']."</span>
					<span class=date>".$arr['date_add']."</span>
				</div>
				<div class=coment>
					<div>".$arr['text']."</div>
				</div>
			</div>
		";
    }
}