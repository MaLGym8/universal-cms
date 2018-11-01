<?php
include_once ($_SERVER["DOCUMENT_ROOT"]."/config.php");
include_once ($_SERVER["DOCUMENT_ROOT"]."/libs/functions.php");


if(isset($_POST['deleteimg']))
{
    $photo = $_POST['deleteimg'];
    $id = $_POST['id'];
    if($photo&&$id)
    {


        $result_photos = mysql_fetch_array(mysql_query("SELECT * FROM `catalog` WHERE `id`=$id LIMIT 1"));
        if($result_photos)
        {
            $photos = explode(' ',$result_photos["photos"]);
            $temp = array();
            foreach ($photos as $p)
            {
                if ($p === $photo)
                {
                    if (strlen($p) > 0)
                    {
                        @unlink('../../'.$p);
                        @unlink('../../'.str_replace("small","big",$p));
                    }
                }
                else
                {
                    $temp[] = $p;
                }
                $photos = implode(' ',$temp);
                mysql_query("UPDATE `catalog` SET `photos`='$photos' WHERE `id`=$id");
            }
        }
        echo "111";


    }
}





//----------------------------------------------------Добавление в корзину-------------------------------------------
if(isset($_POST["addgift"]))
{
    $gift = $_POST["addgift"];
    $product = $_POST["productid"];
    if($gift && $product)
    {
        $_SESSION["gift"] = $gift."&".$product;
    }
    echo "1";
}
if(isset($_POST["cartclear"]))
{
    $_SESSION["cart"]="";
	$_SESSION["dostavka"]="";
    $result["result"] = "1";
    echo json_encode($result);
}
if(isset($_POST["deletecart"]))
{
    $id = intval($_POST["deletecart"]);
    if($id)
    {
        $tmp = array();
        foreach($_SESSION["cart"] as $item)
        {
            if($item["0"]!=$id)
            {
                $tmp[] = $item;
            }
        }
        $_SESSION["cart"] = $tmp;
        $result["result"] = 1;
    }
    $checkCart = CheckCart();
    $result["coast"] = $checkCart["coast_clear"];
    $result["coast_dostavka"] = $checkCart["coast_dostavka"];

    $result["count"] = $checkCart["count"];
    echo json_encode($result);
}
if(isset($_POST["deletecartgift"]))
{
    $id = intval($_POST["deletecartgift"]);
    if($id)
    {
        $tmp = array();
        foreach($_SESSION["cart_gift"] as $item)
        {
            if($item["0"]!=$id)
            {
                $tmp[] = $item;
            }
        }
        $_SESSION["cart_gift"] = $tmp;
        $result["result"] = 1;
    }
    $checkCart = CheckCart();
    $result["coast"] = $checkCart["coast_clear"];
    $result["coast_dostavka"] = $checkCart["coast_dostavka"];
    $result["count"] = $checkCart["count"];
    echo json_encode($result);
}
if(isset($_POST["changecountcart"])){


    $id = $_POST["changecountcart"];
    $count = $_POST["count"];

    if($_SESSION["cart"])
    {
        $tmp = array();
        foreach($_SESSION["cart"] as $item)
        {
            if($item["0"]==$id)
            {
                $product = mysql_fetch_array(mysql_query("SELECT * FROM `catalog` WHERE id=$id"));

                $item[2] = intval($count);

            }
            $tmp[] = $item;
        }
        $_SESSION["cart"] = $tmp;
    }

    $checkCart = CheckCart();
    $result["coast"] = $checkCart["coast"];
    $result["count"] = $checkCart["count"];

    $result["coast_clear"] = $checkCart["coast_clear"];
    $result["coast_dostavka"] = $checkCart["coast_dostavka"];
    $result["result"] = "1";
    echo json_encode($result);

}
if(isset($_POST["changecountcartgift"])){


    $id = $_POST["changecountcartgift"];
    $count = $_POST["count"];

    if($_SESSION["cart_gift"])
    {
        $tmp = array();
        foreach($_SESSION["cart_gift"] as $item)
        {
            if($item["0"]==$id)
            {
                $product = mysql_fetch_array(mysql_query("SELECT * FROM `catalog_gift` WHERE id=$id"));

                $item[2] = intval($count);

            }
            $tmp[] = $item;
        }
        $_SESSION["cart_gift"] = $tmp;
    }

    $checkCart = CheckCart();
    $result["coast"] = $checkCart["coast"];
    $result["count"] = $checkCart["count"];

    $result["coast_clear"] = $checkCart["coast_clear"];
    $result["coast_dostavka"] = $checkCart["coast_dostavka"];

    $result["result"] = "1";
    echo json_encode($result);

}
if(isset($_POST["checkcart"]))
{

    $result["cart"] = GetCartPopUp();
    if ($_SESSION["cart"]) {
        $result["result"] = 1;
    }
    echo json_encode($result);
}

if(isset($_POST["checkcartsumm"]))
{


    echo json_encode(CheckCart());
}

if(isset($_POST["adddostavka"]))
{
	$coast = $_POST["coast"];
	$name = $_POST["name"];
	$_SESSION["dostavka"][0] = $name;
	$_SESSION["dostavka"][1] = $coast;


    echo json_encode(CheckCart());
}



if(isset($_POST["addtocart"]))
{
    $id = intval($_POST["addtocart"]);
    $gift = intval($_POST["gift"]);
    if($id&&!$gift) {
        $query = mysql_query("SELECT * FROM `catalog` WHERE id=$id");
        $product = mysql_fetch_array($query);

        //echo"<pre>";
        //echo print_r($product,1);
        //echo"</pre>";

        if ($product) {
            if($_SESSION["gift"])
            {
                $gift = explode("&",$_SESSION["gift"]);

                if($gift[1]==$id)
                    $giftid = $gift[0];


            }
            $_SESSION["gift"]="";

            $cart = array($id, $product["coast"], 1,$giftid);

            if ($_SESSION["cart"]) {
                $tmp = array();
                foreach ($_SESSION["cart"] as $item) {
                    if ($item["0"] == $id) {

                        $item[2] = intval($item[2]) + 1;

                        $Count = 1;
                    }

                    $tmp[] = $item;
                }
                $_SESSION["cart"] = $tmp;
                if ($Count == 0) {
                    $_SESSION["cart"][] = $cart;
                }

            } else {
                $_SESSION["cart"][] = $cart;
            }
            $result["result"] = 1;

        }

        if ($_SESSION["cart"]) {
            $checkCart = CheckCart();
            $result["coast"] = $checkCart["coast"];
            $result["count"] = $checkCart["count"];
            $result["cart"] = GetCartPopUp();
        }
    }else{
        $query = mysql_query("SELECT * FROM `catalog_gift` WHERE id=$id");
        $product = mysql_fetch_array($query);

        if ($product) {


            $cart = array($id, $product["coast"], 1,$giftid);

            if ($_SESSION["cart_gift"]) {
                $tmp = array();
                foreach ($_SESSION["cart_gift"] as $item) {
                    if ($item["0"] == $id) {

                        $item[2] = intval($item[2]) + 1;

                        $Count = 1;
                    }

                    $tmp[] = $item;
                }
                $_SESSION["cart_gift"] = $tmp;
                if ($Count == 0) {
                    $_SESSION["cart_gift"][] = $cart;
                }

            } else {
                $_SESSION["cart_gift"][] = $cart;
            }
            $result["result"] = 1;

        }

        if ($_SESSION["cart_gift"]) {
            $checkCart = CheckCart();
            $result["coast"] = $checkCart["coast"];
            $result["count"] = $checkCart["count"];
            $result["cart"] = GetCartPopUp();
        }

    }

    echo json_encode($result);
}


function CheckCart()
{
    $count = 0;
    $coast = 0;
    if($_SESSION["cart"])
    {
        foreach($_SESSION["cart"] as $item)
        {
            $count += $item[2];
            $coast += $item[2]*$item[1];
        }
    }

    if($_SESSION["cart_gift"])
    {
        foreach($_SESSION["cart_gift"] as $item)
        {
            $count += $item[2];
            $coast += $item[2]*$item[1];
        }
    }

    $res["count"] = $count;
    $res["coast"] = $coast+$_SESSION["dostavka"][1];
    $res["coast_clear"] = $coast;
    $res["coast_dostavka"] = $_SESSION["dostavka"][1];
    return $res;
}


function GetCartPopUp()
{

    if($_SESSION["cart"])
    {
        $count=0;
        $coast=0;
        $CART='';
        foreach($_SESSION["cart"] as $item)
        {
            $product = mysql_fetch_array(mysql_query("SELECT * FROM `catalog` WHERE id=".$item[0].""));
            $count += $item[2];
            $coast += $item[2]*$item[1];
            $title = $product["title"];
            $CART .='<tr  prodcoast="'.$product["coast"].'" prodid="'.$item[0].'">
                <td>'.$title.'</td>
                <td>
                    <input type="text" value="'.$item[2].'"class="cart-count">
                </td>
                <td class="countincart">'.$item[1].' руб.</td>
                <td>
                    <div class="delete-cart">✖</div>
                </td>
            </tr>';




        }
    }



    $CART .='
            <tr>
                <td align="right" colspan="2">Итого</td>
                <td><span id="cartTotalPrice">'.$coast.'</span> руб.</td>
                <td></td>
            </tr>';
    return $CART;
}


//            dataString = {sendcart:1,name:name,phone:phone,email:email,adres:adres,comment:comment,dostavka:dostavka,pay:pay,options:options};

if(isset($_POST["sendcart"]))
{
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $adres = $_POST["adres"];
    $comment = $_POST["comment"];
    $dostavka = $_POST["dostavka"];
    $pay = $_POST["pay"];
    $options = $_POST["options"];
	if($options) $print_options = "Параметры: $options<br/>";

    $subject = "Оформление заказа от ".$name;
    $ipadres = GetUserIP();
	    $message
        = "
    Имя: " . $name . "<br />
    Телефон: " . $phone . "<br />
    E-mail: <a href='mailto:" . $email . "'>" . $email . "</a><br />
    IP-адрес: <a href='http://www.seogadget.ru/location?addr=" . $ipadres . "' target='_blank'>" . $ipadres . "</a>
    <br/>Комментарий: $comment<br/>
    Оплата: $pay<br/>
	$print_options";

$CARTCOAST = CheckCart();
    $CARTCOAST = $CARTCOAST["coast"];
	
	   $_SESSION["typepay"] = $pay;
    $_SESSION["phone"] = $phone;
    $_SESSION["email"] = $email;
    $_SESSION["coast"] = $CARTCOAST;
	
    if($_SESSION["cart"])
    {

        $HTML = "
<br/><br/><br/>
			<table class='table1' cellspacing='0' ><thead><tr>
			<th align='center' style='  background: #f1faff none repeat scroll 0 0;    font-size: 14px;    font-weight: bold;    padding: 10px 0 10px 10px;    vertical-align: bottom;    white-space: nowrap;'>Товар</th>
			<th align='center' style='  background: #f1faff none repeat scroll 0 0;    font-size: 14px;    font-weight: bold;    padding: 10px 0 10px 10px;    vertical-align: bottom;    white-space: nowrap;'>Цена</th>
			<th style='  background: #f1faff none repeat scroll 0 0;    font-size: 14px;    font-weight: bold;    padding: 10px 0 10px 10px;    vertical-align: bottom;    white-space: nowrap;' align='center'>Количество</th>
			<th style='  background: #f1faff none repeat scroll 0 0;    font-size: 14px;    font-weight: bold;    padding: 10px 0 10px 10px;    vertical-align: bottom;    white-space: nowrap;' align='center'>Сумма</th>
			</tr></thead><tbody>";
        foreach($_SESSION["cart"] as $item)
        {

            $tmp = mysql_fetch_array(mysql_query("SELECT * FROM `catalog` WHERE `id`='".$item[0]."'"));
            if($tmp["name"])
                $title = $tmp["name"];
            else
                $title = $tmp["title"];
            if($tmp)
            {

                $URL = 'http://'.$_SERVER["HTTP_HOST"]."/".GetPathService($tmp["cat"],"catalog")."/".$tmp["url"];

                $HTML .= '<tr>
				 <td style="border: 1px solid #ddd;padding:5px;" align="center">
				<a href="'.$URL.'">'.$title.' - '.$tmp["id"].'</a>
				 </td>

				 <td align="center" style="border: 1px solid #ddd;padding:5px;">'.$tmp["coast"].'р.</td>
				 <td align="center" style="border: 1px solid #ddd;padding:5px;">'.$item[2].'</td>
				 <td align="center" style="border: 1px solid #ddd;padding:5px;">'.$item[2]*$tmp["coast"].'р.</td>
				 </tr>';
                $coastall += $item[2]*$tmp["coast"];
                //$HTML .='<a href="http://'.$_SERVER['SERVER_NAME'].'/administrator/index.php?page=edit_catalog&id='.$tmp["id"].'">('.$tmp["id"].') '.$tmp["type"].' '.$tmp["designation"].' - '.$tmp["coast"].' ('.$item[2].')</a><br/>';
            }
        }
        if($_SESSION["cart_gift"])
        foreach($_SESSION["cart_gift"] as $item)
        {
            $tmp = mysql_fetch_array(mysql_query("SELECT * FROM `catalog_gift` WHERE `id`='".$item[0]."'"));
            if($tmp)
            {
                $HTML .= '<tr>
				 <td style="border: 1px solid #ddd;padding:5px;" align="center">'.$tmp["title"].'
				 </td>

				 <td align="center" style="border: 1px solid #ddd;padding:5px;">'.$tmp["coast"].'</td>
				 <td align="center" style="border: 1px solid #ddd;padding:5px;">'.$item[2].'</td>
				 </tr>';
                //$HTML .='<a href="http://'.$_SERVER['SERVER_NAME'].'/administrator/index.php?page=edit_catalog&id='.$tmp["id"].'">('.$tmp["id"].') '.$tmp["type"].' '.$tmp["designation"].' - '.$tmp["coast"].' ('.$item[2].')</a><br/>';
            }
        }

        $HTML .= '<tr>
				 <td colspan="3" style="border: 1px solid #ddd;padding:5px;font-weight: bold;" align="center">'.$dostavka.':
				 </td>

				 <td align="center" style="border: 1px solid #ddd;padding:5px;font-weight: bold;">   '.$_SESSION["dostavka"][1].'р.<br/></td>
				 </tr>';

        $HTML .= '<tr>
				 <td colspan="3" style="border: 1px solid #ddd;padding:5px;font-weight: bold;" align="center">Итого:
				 </td>

				 <td align="center" style="border: 1px solid #ddd;padding:5px;font-weight: bold;">'.$coastall.'р.</td>
				 </tr>';

        $HTML .= "</tbody></table>";
        $_SESSION["cart"]="";
        $_SESSION["dostavka"]="";
        $_SESSION["cart_gift"]="";
    }



    mail($EmailTO, $subject, $message.$HTML.$MAILTABLE, "Content-type:text/html; charset=utf-8\r\n");
    if(!empty($EmailTO2)){mail($EmailTO2, $subject, $message.$HTML.$MAILTABLE, "Content-type:text/html; charset=utf-8\r\n");}
	if($obratnoe_pismo_vklucheno){MailSubmit($email,$sitename,$text_uvedomlenie);}
 
    echo "1";
}
if(isset($_POST["sendzakazquick"]))
{
    $name = $_POST["name"];
    $phone = $_POST["number"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $id = $_POST["sendzakazquick"];
    $subject = "Быстрый заказ от ".$name;
    $ipadres = GetUserIP();
    $product = $db->read("SELECT * FROM `catalog` WHERE `id`='$id'");

    $URL = 'http://'.$_SERVER["HTTP_HOST"]."/".GetPathService($product["cat"],"catalog")."/".$product["url"];

    $message
        = "
    Имя: " . $name . "<br />
    Телефон: " . $phone . "<br />
    E-mail: <a href='mailto:" . $email . "'>" . $email . "</a><br />
    IP-адрес: <a href='http://www.seogadget.ru/location?addr=" . $ipadres . "' target='_blank'>" . $ipadres . "</a><br/>
	Комментарий: $message<br/>
	Товар: <a href='".$URL."'>".$product["name"]."</a>";





    mail($EmailTO, $subject, $message.$HTML.$MAILTABLE, "Content-type:text/html; charset=utf-8\r\n");
    if(!empty($EmailTO2)){mail($EmailTO2, $subject, $message.$HTML.$MAILTABLE, "Content-type:text/html; charset=utf-8\r\n");}
	if($obratnoe_pismo_vklucheno){MailSubmit($email,$sitename,$text_uvedomlenie);}

    echo "1";
}