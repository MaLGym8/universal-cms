<?php
//Добавление меню
function Add_Menu()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление меню</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">
        Заголовок:<br/>
        <input type="text" name="title" value=""/><br />';


    echo'        Ссылка <small>(на файл или на внешний ресурс, если на файл - ставим /)</small>:<br/>
        <input type="text" name="url" value="" id="pageURL"/><br />
        <span id="pagePAGE">
        Страница <small>(созданная страница из БД pages)</small>:<br/>
        <select name="page"><option value="">Выберите страницу</option>';

    $queryPages = mysql_query("SELECT * FROM `pages` where public=1 ORDER by title ASC");
    $resultPages = mysql_fetch_array($queryPages);
    do {
        if ($resultPages) {
            echo "<option value='" . $resultPages["url"] . "'>" . $resultPages["title"] . "</option>";
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
        echo '<option value="' . $result_parent["0"] . '">' . $result_parent["1"] . '</option>';
        //if($result_parent[0]==7)
        //{
        //  echo '<option value="26">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Создание сайтов</option>';
        //  echo '<option value="27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дополнительные услуги</option>';
        // }


    } while ($result_parent = mysql_fetch_array($query_parent));
    echo '

</select><br />';




    $last = mysql_fetch_array(mysql_query("SELECT * FROM `menu` ORDER by id DESC LIMIT 1"));
    $last = $last["id"]+1;

    echo'Позиция:<br/> <input type="text" name="position" value="'.$last.'" class="w50"/><br />

        <b style="color:green">Вкл</b>/Выкл <input type="checkbox" name="public" value="1" checked/><br />

        <input type="submit" name="add_menu" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Добавление меню
if(isset($_POST["add_menu"]))
{
    $title = $_POST["title"];
    $url = $_POST["url"];
    $page = $_POST["page"];
    $position = $_POST["position"];
    $public = $_POST["public"];
    $parent = $_POST["parent"];
    if (!$url&&!$page)
    {
      //  $url = translateURL($title);
    }

    mysql_query("INSERT INTO `menu` (`title`, `link`, `page`, `position`, `public`,`parent`) VALUES ('$title', '$url', '$page', '$position', '$public','$parent')");
    $_SESSION["message"] = "Пункт меню добавлен";
    echo'<script>window.location="index.php?page=show_menu";</script>';
    exit();
}