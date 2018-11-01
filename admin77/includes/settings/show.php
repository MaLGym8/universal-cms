<?
function Settings()
{
    global $db;
    $result_settings = mysql_fetch_array(mysql_query("SELECT * FROM options"));

    echo '<article class="module width_full">
			<header><h3>Настройки</h3></header>
			<div class="module_content">
				<form action="" method="post" enctype="multipart/form-data">

<div style="width:45%; float:left">
<strong>Основной E-mail (все заявки сюда)</strong><br />
<input type="text" name="email" value="' . $result_settings["email"] . '"/><br />
Второстепенный E-mail (дубль основного)<br />
<input type="text" name="email2" value="' . $result_settings["email2"] . '"/><br />

<strong>Тел (как основ без whatsapp)</strong><br />
<input type="text" name="phone" value="' . $result_settings["phone"] . '"/><br />
<strong>Моб (основ с whatsapp, если 1-ый пустой)</strong><br />
<input type="text" name="mobphone" value="' . $result_settings["mobphone"] . '"/><br />

<strong>Адрес (с картой):</strong><br />
<input type="text" name="address" value="' . $result_settings["address"] . '"/><br />
<strong>Скайп:</strong><br />
<input type="text" name="skype" value="' . $result_settings["skype"] . '"/><br />
<h2>Дизайн шапки</h2>';?>

<label><input type="radio" name="header_change" value="0" <? if($result_settings["header_change"]==0)echo'checked'; ?>/> Первый</label> <label><input type="radio" name="header_change" value="1" <? if($result_settings["header_change"]==1)echo'checked'; ?>/> Второй</label>
<br/><br />
<h2>Настройки модулей</h2>
<?
    $modules = $db->read_all("SELECT * FROM `modules` WHERE `parent`=0 ORDER by name ASC");
    if($modules)
    {
        foreach ($modules as $module)
        {
            if($module["public"]==1)
                $chk=" checked ";
            else
                $chk = "";
            echo "<div><label><input $chk type='checkbox' value='1' name='modules[".$module["module"]."]'/> <b>".$module["name"]."</b></label></div>";

            if($module["name"]=="Каталог")
            {
                ?>
                <div style="float:left; margin-left:50px;"><label><input type="radio" name="catalogtype" value="1"<? if($result_settings["catalogtype"]==1)echo'checked'; ?>/> С ценами</label>
                    <label><input type="radio" name="catalogtype" value="2"<? if($result_settings["catalogtype"]==2)echo'checked'; ?>/> Без цен</label></div>
                <?
            }

            if($module["name"]=="Каталог")
            {
                ?>
                <div style="float:left; margin-left:50px;">Подарки:
                    <label><input type="radio" name="cataloggifts" value="1"<? if($result_settings["cataloggifts"]==1)echo'checked'; ?>/> Вкл</label>
                    <label><input type="radio" name="cataloggifts" value="0"<? if($result_settings["cataloggifts"]==0)echo'checked'; ?>/> Выкл</label></div><br clear="all">

                <?
            }
            if ($module["name"]=="Корзина")
            {
                ?>
                <div style="float:left; margin-left:50px;">Подробнее/В корзину:
                    <label><input type="radio" name="catalogcart" value="1"<? if($result_settings["catalogcart"]==1)echo'checked'; ?>/> В корзину</label>
                    <label><input type="radio" name="catalogcart" value="0"<? if($result_settings["catalogcart"]==0)echo'checked'; ?>/> Подробнее</label></div><br clear="all">
                <?
            }

            $check_parent = $db->read_all("SELECT * FROM `modules` WHERE `parent`='".$module["id"]."'");
            if($check_parent)
            {
                foreach($check_parent as $parent)
                {
                    ?>
                    <div style="float:left; margin-left:50px;"><?=$parent["name"]?>:
                        <label><input type="radio" name='modules[<?=$parent["module"]?>]' value="1"<? if($parent["public"]==1)echo'checked'; ?>/> Вкл</label>
                        <label><input type="radio" name='modules[<?=$parent["module"]?>]' value="0"<? if($parent["public"]==0)echo'checked'; ?>/> Выкл</label></div><br clear="all">
                    <?
                }
            }
        }
    }

    echo'
</div>

<div style="width:45%; float:right">
<strong>Логин администратора:</strong><br />
<input type="text" name="user" value="' . $result_settings["user"] . '"/><br />
<strong>Пароль администратора:</strong><br />
<input type="text" name="password" value="' . $result_settings["pass"] . '"/><br />


<div style="float:left">
Элементов в блоге:<br />
<input type="text" name="sitequantity1" value="' . $result_settings["sitequantity1"] . '"/></div>
<div style="float:left">
Подгружаемых AJAX:<br />
<input type="text" name="sitequantity2" value="' . $result_settings["sitequantity2"] . '"/></div>



<br clear="all">


<div style="float:left">
Элементов в портфолио:<br />
<input type="text" name="portfolioquantity1" value="' . $result_settings["portfolioquantity1"] . '"/></div>
<div style="float:left">
Подгружаемых AJAX:<br />
<input type="text" name="portfolioquantity2" value="' . $result_settings["portfolioquantity2"] . '"/></div>

<br clear="all">

Кол-во элементов на страницах админки:<br />
<input type="text" name="adminquantity" value="' . $result_settings["adminquantity"] . '"/><br />


</div>
<br clear="all">

<div align="center"><input type="submit" style="float:none" value="Изменить" name="edit_settings" /></div>

				</form>


				<div class="clear"></div>
			</div>
		</article>';
}







//Редактирование настроек
if (isset($_POST["edit_settings"]))
{

    $modules = $db->read_all("SELECT * FROM `modules` ORDER by name ASC");
    if($modules) {
        foreach ($modules as $module) {
            $db->query("UPDATE `menu` SET `public`=0 WHERE `link`='/".$module["module"]."'");
            $db->query("UPDATE `menu` SET `public`=0 WHERE `page`='".$module["module"]."'");
        }
    }

    mysql_query("UPDATE modules SET `public`=0");
    foreach($_POST["modules"] as $key=>$value)
    {
        mysql_query("UPDATE modules SET `public`='$value' WHERE `module`='$key'");
        $db->query("UPDATE `menu` SET `public`=1 WHERE `link`='/".$key."'");
        $db->query("UPDATE `menu` SET `public`=1 WHERE `page`='".$key."'");

    }

    if($_POST["modules"]['gallery'] == 1) {
        mysql_query("UPDATE `pages` SET `public`='1' WHERE `url`='gallery'");
        mysql_query("UPDATE `menu` SET `public`='1' WHERE `link`='gallery'");
    }
    else{
        mysql_query("UPDATE `pages` SET `public`='0' WHERE `url`='gallery'");
        mysql_query("UPDATE `menu` SET `public`='0' WHERE `link`='gallery'");
    }


    $email = $_POST["email"];
    $email2 = $_POST["email2"];

    $user = $_POST["user"];
    $password = $_POST["password"];

    $phone = $_POST["phone"];
    $skype = $_POST["skype"];
    $mobphone = $_POST["mobphone"];
    $address = $_POST["address"];

    $sitequantity1 = $_POST["sitequantity1"];
    $sitequantity2 = $_POST["sitequantity2"];

    $portfolioquantity1 = $_POST["portfolioquantity1"];
    $portfolioquantity2 = $_POST["portfolioquantity2"];

    $adminquantity = $_POST["adminquantity"];
    $catalogtype = $_POST["catalogtype"];
    $cataloggifts = $_POST["cataloggifts"];
    $catalogcart = $_POST["catalogcart"];
    $header_change = $_POST["header_change"];


    mysql_query("UPDATE options SET  `email`='$email', `email2`='$email2', `user`='$user', `pass`='$password', `phone`='$phone', `skype`='$skype', `mobphone`='$mobphone', `address`='$address', 
`sitequantity1`='$sitequantity1', 
`sitequantity2`='$sitequantity2',
`portfolioquantity1`='$portfolioquantity1', 
`portfolioquantity2`='$portfolioquantity2',
`header_change`='$header_change',
 `adminquantity`='$adminquantity', `catalogtype`='$catalogtype', `cataloggifts`='$cataloggifts', `catalogcart`='$catalogcart'");
    $_SESSION["message"] = "Настройки изменены";
    echo '<script>window.location="index.php?page=settings";</script>';
    exit();
}



?>