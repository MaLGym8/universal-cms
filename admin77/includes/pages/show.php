<?php
//Просмотр страниц
function Show_Pages()
{
    ?>
    <script>
        $(document).ready(function () {
            $(".public-page").click(function () {
                var id = $(this).attr("idpage");
                var OBJ = $(this);

                var post = 'updatepage=' + id;
                $.post("", post, function (theResponse) {
                    OBJ.html(theResponse);
                });
            });
        });
    </script>
    <?
    $tableName = "pages";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));


    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Страницы (' . $count[0] . ')  <a href="index.php?page=add_page" class="event-button">Добавить страницу</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><form action="" method="post">
			<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
    				<th>#</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>H1</th>
					<th>Meta_d (Meta_k)</th>
					<th>Вкл/Выкл</th>
					<th>Тип</th>
    				<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    $num = COUNTPAGE;
    $pg = "show_pages";
    $page = $_GET["num"];
    $result = mysql_query("SELECT COUNT(*) FROM  `$tableName`");
    $posts = mysql_result($result, 0);

    $total = intval(($posts - 1) / $num) + 1;
    $page = intval($page);

    if (empty($page) or $page < 0) {
        $page = 1;
    }
    if ($page > $total) {
        $page = $total;
    }
    $start = $page * $num - $num;

    $query = mysql_query("SELECT * FROM `$tableName` ORDER by id LIMIT $start, $num");
    while ($postrow[] = mysql_fetch_array($query)) {
        
    }
    for ($i = 0; $i < $num; $i++) {
        if ($postrow[$i]) {

            switch($postrow[$i]["include_file"])
            {
                case "0": $public1 = "<b style='color:#00278c;'>БД</b>";break;
                case "1": $public1 = "<b style='color:#008c2e;'>БД-Файл</b>";break;
                case "2": $public1 = "<b style='color:#8c0000;'>Файл</b>";break;
            }
			switch($postrow[$i]["public"])
            {
                case "1": $public2 = "<b class='on'>Вкл</b>/Выкл";break;
                case "0": $public2 = "Вкл/<b class='off'>Выкл</b>";break;
            }
			
			
			if(!empty($postrow[$i]["meta_k"])) {$textbold = 'style="background:#FFEBB7"';} else {$textbold = '';}


            $text = strip_tags($postrow[$i]["text"]);
            $text = mb_substr(trim($text),0,10,'UTF-8');
            echo '<tr ';
			 if(!$postrow[$i]["public"]) {echo 'style="opacity:0.5"';}
			echo '>
            <!--<td><input type="checkbox" name="pages[' . $postrow[$i]["id"] . ']" value="' . $postrow[$i]["id"] . '"></td>-->
            <td>' . $postrow[$i]["id"] . '</td>
            <td><a  href="index.php?page=edit_page&id=' . $postrow[$i]["id"] . '">' . $postrow[$i]["title"] . '</a></td>
            <td class="urloverflow150">' .$postrow[$i]["url"] . '</td>
            <td>' .$postrow[$i]["h1"] . '</td>
			<td '.$textbold.'>' .$postrow[$i]["meta_d"] . '</td>
			<td><span idpage="'.$postrow[$i]["id"].'" class="public-page">'.$public2.'</span></td>
			<td><span idpage="'.$postrow[$i]["id"].'" /*class="public-page"*/>'.$public1.'</span></td>
            <td><a  href="index.php?page=edit_page&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="right"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_page=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';
        }
    }


    echo '
			</tbody>
			</table>
            <!--<input type="submit" name="delete_pages" style="float:left;margin-left:15px;" value="Удалить"><br />-->
            </form>
			</div>
		</div>
		</article>';

    if ($page != 1) {
        $pervpage
            = '<li><a href="index.php?page=' . $pg . '&num=1"><<<</a> <a href="index.php?page=' . $pg . '&num=' . ($page
                - 1)
            . '"> < </a></li>';
    }
    if ($page != $total) {
        $nextpage
            = '<li><a href="index.php?page=' . $pg . '&num=' . ($page + 1) . '"> > </a> <a href= "index.php?page=' . $pg
            . '&num=' . $total . '"> >>> </a></li>';
    }

    if ($page - 8 > 0) {
        $page8left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 8) . '">' . ($page - 8) . '</a> </li> ';
    }
    if ($page - 7 > 0) {
        $page7left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 7) . '">' . ($page - 7) . '</a> </li> ';
    }
    if ($page - 6 > 0) {
        $page6left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 6) . '">' . ($page - 6) . '</a> </li> ';
    }
    if ($page - 5 > 0) {
        $page5left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 5) . '">' . ($page - 5) . '</a> </li> ';
    }
    if ($page - 4 > 0) {
        $page4left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 4) . '">' . ($page - 4) . '</a> </li> ';
    }
    if ($page - 3 > 0) {
        $page3left = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 3) . '">' . ($page - 3) . '</a></li> ';
    }
    if ($page - 2 > 0) {
        $page2left = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 2) . '">' . ($page - 2) . '</a> </li>';
    }
    if ($page - 1 > 0) {
        $page1left = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 1) . '">' . ($page - 1) . '</a></li>';
    }

    if ($page + 8 <= $total) {
        $page8right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 8) . '">' . ($page + 8) . '</a></li>';
    }
    if ($page + 7 <= $total) {
        $page7right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 7) . '">' . ($page + 7) . '</a></li>';
    }
    if ($page + 6 <= $total) {
        $page6right = ' <li><a href= "index.php?page=' . $pg . '&num=' . ($page + 6) . '">' . ($page + 6) . '</a></li>';
    }
    if ($page + 5 <= $total) {
        $page5right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 5) . '">' . ($page + 5) . '</a></li>';
    }
    if ($page + 4 <= $total) {
        $page4right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 4) . '">' . ($page + 4) . '</a></li>';
    }
    if ($page + 3 <= $total) {
        $page3right = ' <li><a href= "index.php?page=' . $pg . '&num=' . ($page + 3) . '">' . ($page + 3) . '</a></li>';
    }
    if ($page + 2 <= $total) {
        $page2right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 2) . '">' . ($page + 2) . '</a></li>';
    }
    if ($page + 1 <= $total) {
        $page1right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 1) . '">' . ($page + 1) . '</a></li>';
    }

    if ($posts > $num) {
        echo '
<div class="page-count" align="center" style="float:Left;">
    <ul>
      ' . $pervpage . $page8left . $page7left . $page6left . $page5left . $page4left . $page3left . $page2left
            . $page1left . '<li><a href=""  class="active">' . $page . '</a></li>' . $page1right . $page2right
            . $page3right . $page4right . $page5right . $page6right . $page7right . $page8right . $nextpage . '
    </ul>
 </div>';

    }
}




//Удаление
if(isset($_GET["delete_page"]))
{
    $id = $_GET["delete_page"];
    mysql_query("DELETE FROM pages WHERE id=$id");
    $_SESSION["message"] = "Страница удалена";
    echo'<script>window.location="index.php?page=show_pages";</script>';
    exit();
}
if(isset($_POST["delete_pages"]))
{
    $items = $_POST["pages"];
    foreach($items as $id)
    {
        mysql_query("DELETE FROM pages WHERE id=$id");
    }
    $_SESSION["message"] = "Страницы удалены";
    echo'<script>window.location="index.php?page=show_pages";</script>';
    exit();
}

//Обновление публикации
if(isset($_POST["updatepage"]))
{
    $id = intval($_POST["updatepage"]);
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `pages` WHERE id=$id"));
    if($result)
    {
        if($result["public"]==1)
        {
            mysql_query("UPDATE `pages` SET `public`=0 WHERE id=$id");
            $result1 = mysql_fetch_array(mysql_query("SELECT `id` FROM `menu` WHERE `title`='".$result['title']."'"));
            if ($result1){
                mysql_query("UPDATE `menu` SET `public`=0 WHERE id=".$result1['id']);
            }
            echo "Вкл/<b class='off'>Выкл</b>";
        }else{
            mysql_query("UPDATE `pages` SET `public`=1 WHERE id=$id");
            $result1 = mysql_fetch_array(mysql_query("SELECT `id` FROM `menu` WHERE `title`='".$result['title']."'"));
            if ($result1){
                mysql_query("UPDATE `menu` SET `public`=1 WHERE id=".$result1['id']);
            }
            echo "<b class='on'>Вкл</b>/Выкл";
        }

    }else{
        echo "0";
    }
    exit();

}