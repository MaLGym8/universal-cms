<?php
//Просмотр отзывов
function Show_Reviews()
{
    $tableName = "comments";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));

    ?>
    <script>
        $(document).ready(function () {
            $(".public-page").click(function () {
                var id = $(this).attr("idpage");
                var OBJ = $(this);

                var post = 'updatereview=' + id;
                $.post("", post, function (theResponse) {
                    OBJ.html(theResponse);
                });
            });
        });
    </script>
    <?

    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Отзывы (' . $count[0] . ')  <a href="index.php?page=add_review" class="event-button">Добавить отзыв</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><form action="" method="post">
			<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
    				<th>#</th>
					<th>Фото</th>
                    <th>Имя</th>
					<th>Контакт</th>
					<th>Услуга</th>
					<th>Текст</th>
                    <th style="min-width:80px;">Дата</th>
    				<th style="min-width:80px;">Вкл/Выкл</th>
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

    $query = mysql_query("SELECT * FROM `$tableName` ORDER by date DESC LIMIT $start, $num");
    while ($postrow[] = mysql_fetch_array($query)) {
        ;
    }
    for ($i = 0; $i < $num; $i++) {
		
		if (!$postrow[$i]["photo"]) {$photorew = "../images/chcomments/nophoto.png";}
		else {$photorew = "../files/reviews_photos/".$postrow[$i]["photo"]."";}
		
        if ($postrow[$i]) {

            if( $postrow[$i]["public"]==0)
            {
                $opacity = "style='opacity:0.5'";
            }else{
                $opacity="";
            }

            switch($postrow[$i]["public"])
            {
                case "1": $public2 = "<b class='on'>Вкл</b>/Выкл";break;
                case "0": $public2 = "Вкл/<b class='off'>Выкл</b>";break;
            }

            $text = strip_tags($postrow[$i]["text"]);
            $text = mb_substr(trim($text),0,50,'UTF-8');
			
			$linkText = str_replace("www.","",$postrow[$i]["link"]);
            $linkText = str_replace("http://","",$linkText);
            $linkText = str_replace("mailto:","",$linkText);
			
            echo '<tr '.$opacity.'>
            <!--<td><input type="checkbox" name="pages[' . $postrow[$i]["id"] . ']" value="' . $postrow[$i]["id"] . '"></td>-->
            <td>' . $postrow[$i]["id"] . '</td>
			<td><a  href="index.php?page=edit_review&id=' . $postrow[$i]["id"] . '"><img width="50" src="' . $photorew . '"></a></td>
            <td><a  href="index.php?page=edit_review&id=' . $postrow[$i]["id"] . '">' . $postrow[$i]["name"] . '</a></td>
			<td><a rel="nofollow" href="http://'.$linkText.'"  target="_blank">'.$linkText.'</a></td>
			<td>' .$postrow[$i]["type"] . '</td>
			<td>' . $text . '...</td>
            <td>' .$postrow[$i]["date"] . '</td>
            <td><span idpage="'.$postrow[$i]["id"].'" class="public-page">'.$public2.'</span></td>
            <td><a  href="index.php?page=edit_review&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="right"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_review=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
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



if(isset($_GET["delete_review"]))
{
    $id = $_GET["delete_review"];
    if($id)
    {
        $result = mysql_fetch_array(mysql_query("SELECT * FROM comments WHERE id=$id"));
        @unlink("../files/reviews_photos/".$result["photo"]);
        @unlink("../files/reviews_photos/full/".$result["photo"]);
        mysql_query("DELETE FROM `comments` WHERE `id`='$id'");
    }
    echo '<script>window.location="index.php?page=reviews";</script>';
    exit();

}


//Обновление публикации
if(isset($_POST["updatereview"]))
{
    $id = intval($_POST["updatereview"]);
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `comments` WHERE id=$id"));
    if($result)
    {
        if($result["public"]==1)
        {
            mysql_query("UPDATE `comments` SET `public`=0 WHERE id=$id");
            echo "Вкл/<b class='off'>Выкл</b>";
        }else{
            mysql_query("UPDATE `comments` SET `public`=1 WHERE id=$id");
            echo "<b class='on'>Вкл</b>/Выкл";
        }

    }else{
        echo "0";
    }
    exit();

}