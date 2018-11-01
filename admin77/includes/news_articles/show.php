<?php
//Просмотр новостей
function Show_News()
{?>
    <script>
        $(document).ready(function () {
            $(".public-news").click(function () {
                var id = $(this).attr("idnews");
                var OBJ = $(this);

                var post = 'updatenews=' + id;
                $.post("", post, function (theResponse) {
                    OBJ.html(theResponse);
                });
            });
        });
    </script>
    <?

    $Count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `news`"));

    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Все новости/статьи (' . $Count[0] . ') <span class="header-small" style="color:green">(новости - зеленого фона)</span> <span class="header-small">(статьи - белого)</span><a href="index.php?page=add_news" class="event-button">Добавить новость/статью</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><form action="" method="post">
			<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
    				<th>#</th>
                    <th>Название</th>
                    <th>Текст</th>
                    <th>Дата добавления</th>
                    <th>Публикация</th>
    				<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    $num = COUNTPAGE;
    $pg = "show_news";
    $page = $_GET["num"];
    $result = mysql_query("SELECT COUNT(*) FROM  `news`");
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

    $query = mysql_query("SELECT * FROM `news` ORDER by id DESC LIMIT $start, $num");
    while ($postrow[] = mysql_fetch_array($query)) {
        ;
    }
    for ($i = 0; $i < $num; $i++) {
        if ($postrow[$i]) {
            if ($postrow[$i]["type"] == 1) {
                $style = "background:#e8f8c9;";
            } else {
                $style = '';
            }
			if ($postrow[$i]["public"] == 1) {
                $style_public = '';
            } else {
                $style_public = 'opacity:0.5;';
            }

            if($postrow[$i]["public"])
            {
                $public1 = "<b class='on'>Вкл</b>/Выкл";
            }else{
                $public1 = "Вкл/<b class='off'>Выкл</b>";
            }
            echo '<tr style="' . $style . $style_public. '"><!--<td><input type="checkbox" name="news[' . $postrow[$i]["id"] . ']" value="' . $postrow[$i]["id"] . '"></td>-->
            <td>' . $postrow[$i]["id"] . '</td>
            <td><a  href="index.php?page=edit_news&id=' . $postrow[$i]["id"] . '">' . $postrow[$i]["title"] . '</a></td>
            <td>' . $postrow[$i]["meta_d"] . '</td>
            <td>' . $postrow[$i]["date_add"] . '</td>
			<td><span idnews="'.$postrow[$i]["id"].'" class="public-news">'.$public1.'</span></td>

            <td><a  href="index.php?page=edit_news&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			
            <td><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_news=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </td>
            </tr>';
        }
    }


    echo '
			</tbody>
			</table>
            <!--<input type="submit" name="delete_news" style="float:left;margin-left:15px;" value="Удалить"><br />-->
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
if(isset($_GET["delete_news"]))
{
    $id = $_GET["delete_news"];

    $result = mysql_fetch_array(mysql_query("SELECT * FROM `news` WHERE id=$id"));
    @unlink("../".$result["image"]);
    @unlink("../".str_replace("small","big",$result["image"]));

    mysql_query("DELETE FROM news WHERE id=$id");
    $_SESSION["message"] = "Новость удалена";
    echo'<script>window.location="index.php?page=show_news";</script>';
    exit();
}
if(isset($_POST["delete_news"]))
{
    $items = $_POST["news"];
    foreach($items as $id)
    {
        $result = mysql_fetch_array(mysql_query("SELECT * FROM `news` WHERE id=$id"));
        @unlink("../".$result["image"]);
        @unlink("../".str_replace("small","big",$result["image"]));

        mysql_query("DELETE FROM news WHERE id=$id");
    }
    $_SESSION["message"] = "Новости удалены";
    echo'<script>window.location="index.php?page=show_news";</script>';
    exit();
}

//Обновление публикации
if(isset($_POST["updatenews"]))
{
    $id = intval($_POST["updatenews"]);
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `news` WHERE id=$id"));
    if($result)
    {
        if($result["public"]==1)
        {
            mysql_query("UPDATE `news` SET `public`=0 WHERE id=$id");
            echo "Вкл/<b class='off'>Выкл</b>";
        }else{
            mysql_query("UPDATE `news` SET `public`=1 WHERE id=$id");
            echo "<b class='on'>Вкл</b>/Выкл";
        }

    }else{
        echo "0";
    }
    exit();

}