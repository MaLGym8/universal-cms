<?php
//Редактирование меню
function Edit_Menu($id = NULL)
{
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `menu` WHERE id=$id"));
    if ($result["public"] == 1) {
        $chkd = "checked";
        $public2 = "<b style='color:green'>Вкл</b>/Выкл";
    }else{
        $public2 = "Вкл/<b style='color:red'>Выкл</b>";}

    echo '
    <article class="module width_full">
    <header><h3>Редактирование меню</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
        Заголовок:<br/>
        <input type="text" name="title" value="' . $result["title"] . '"/><br />';




    echo 'Ссылка  <small>(на файл или на внешний ресурс, если на файл - ставим /)</small>:<br/>
        <input type="text" name="url" value="' . $result["link"] . '" id="pageURL"/><br />';
    echo'<span id="pagePAGE">Страница <small>(созданная страница из БД pages)</small>:<br/>
        <select name="page"><option value="">Выберите страницу</option>';

    $queryPages = mysql_query("SELECT * FROM `pages` where public=1 ORDER by title ASC");
    $resultPages = mysql_fetch_array($queryPages);
    do {
        if ($resultPages) {
            echo "<option value='" . $resultPages["url"] . "'";
            if ($result["page"] == $resultPages["url"]) {
                echo "selected";
            }
            echo ">" . $resultPages["title"] . "</option>";
        }
    } while ($resultPages = mysql_fetch_array($queryPages));

    echo '</select><br/></span>
    Подменю:   <br/>
<select name="parent" id="parent">
<option value="0">Нет</option>
    ';

    $query_parent = mysql_query("SELECT * FROM menu WHERE parent=0 and public=1 ORDER by position ASC");
    $result_parent = mysql_fetch_array($query_parent);
    do {
        echo '<option value="' . $result_parent["0"] . '" ';
        if ($result["parent"] == $result_parent["0"]) {
            echo 'selected="selected"';
        }
        echo ' >' . $result_parent["1"] . '</option>';?>


        <?php /*?><? if($result_parent[0]==7)
            {
                echo '<option value="26"';
                if ($result["parent"] == 26) {
                    echo 'selected="selected"';
                }
                echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Создание сайтов</option>';
                echo '<option value="27"';
                if ($result["parent"] == 27) {
                    echo 'selected="selected"';
                }
                echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дополнительные услуги</option>';
            }?><?php */?>

        <?
    } while ($result_parent = mysql_fetch_array($query_parent));
    echo '

</select><br />';







    echo'

        Позиция:<br/> <input type="text" name="position" value="' . $result["position"] . '" class="w50"/><br />

        '.$public2.' <input type="checkbox" name="public" value="1" ' . $chkd . '/><br />
        <input type="hidden" name="id" value="' . $result["id"] . '"/>
        <input type="submit" name="edit_menu" value="Изменить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Редактирование меню
if(isset($_POST["edit_menu"]))
{
    $id = $_POST["id"];
    $title = $_POST["title"];
    $url = $_POST["url"];
    $page = $_POST["page"];
    $position = $_POST["position"];
    $public = $_POST["public"];
    $parent = $_POST["parent"];

    if (!$url&&!$page)
    {
        //$url = translateURL($title);
    }

    mysql_query("UPDATE menu SET `title`='$title', `link`='$url', `page`='$page', `position`='$position', `public`='$public',`parent`='$parent' WHERE id=$id");
    $_SESSION["message"] = "Пункт меню изменён";
    echo'<script>window.location="index.php?page=show_menu";</script>';
    exit();
}