<?php
//Просмотр страниц
function Show_Blog()
{
    $tableName = "blog";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));

    ?>
    <script>
        $(document).ready(function () {
            $(".public-page").click(function () {
                var id = $(this).attr("idpage");
                var OBJ = $(this);

                var post = 'updateblog1=' + id;
                $.post("", post, function (theResponse) {
                    OBJ.html(theResponse);
                });
            });
        });
    </script>
    <?

    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Посты в блоге (' . $count[0] . ')  <a href="index.php?page=add_blog" class="event-button">Добавить пост</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content catstable"><form action="" method="post">
			<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
    				<!--<th>Фото</th>-->
                    <th style="min-width:180px;">SEO Title (Meta_d)</th>
                    <th style="max-width:150px;">URL (Meta_k)</th>
                    <th style="min-width:110px;">Категория</th>
                    <th style="min-width:200px;">H1</th>
					<th style="min-width:80px;">Дата</th>
   			   		<th style="min-width:80px;">Вкл/Выкл</th>
    				<th>Тип</th>
    				<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    $num = COUNTPAGE;
    $pg = "show_blog";
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

    $query = mysql_query("SELECT * FROM `$tableName` ORDER by `date_add` DESC LIMIT $start, $num");
    while ($postrow[] = mysql_fetch_array($query)) {

    }
    for ($i = 0; $i < $num; $i++) {
        if ($postrow[$i]) {

            switch($postrow[$i]["type"])
            {
                case "0": $type1 = "<b style='color:#00278c;'>БД</b>";break;
                case "1": $type1 = "<b style='color:#008c2e;'>БД-Файл</b>";break;
                case "2": $type1 = "<b style='color:#8c0000;'>Файл</b>";break;
            }

            switch($postrow[$i]["public"])
            {
                case "1": $public2 = "<b class='on'>Вкл</b>/Выкл";break;
                case "0": $public2 = "Вкл/<b class='off'>Выкл</b>";break;
            }


            if( $postrow[$i]["public"]==0)
            {
                $opacity = "style='opacity:0.5'";
            }else{
                $opacity="";
            }
			
			if($postrow[$i]["image"])
			{
				$IMAGE = '<img width="70" src="../' . $postrow[$i]["image"] . '"/>';
				$image_bg = 'style="background:#000; color:#fff;">bg';
			}else{
				$IMAGE="";
				$image_bg = '>';
			}
			if(!empty($postrow[$i]["dop_title"])) {$bold_h2 = 'style="background:#FFEBB7"';} else {$bold_h2 = '';}
			if(!empty($postrow[$i]["meta_d"])) {$bold_meta_d = 'style="background:#FFEBB7"';} else {$bold_meta_d = '';}
			if(!empty($postrow[$i]["meta_k"])) {$bold_meta_k = 'style="background:#FFEBB7"';} else {$bold_meta_k = '';}
			

$CAT = mysql_fetch_array(mysql_query("SELECT * FROM `blog_cats` WHERE `id`='".$postrow[$i]["cat"] ."'"));
            echo '<tr '.$opacity.'>';
            //echo '<td>' . $IMAGE . '</td>';
			//echo '<td '.$image_bg.'</td>';
            echo '<td '.$bold_meta_d.'><a  href="index.php?page=edit_blog&id=' . $postrow[$i]["id"] . '"><b>' . $postrow[$i]["title"] . '</b></a></td>
            <td '.$bold_meta_k.'  class="urloverflow150"><a  href="index.php?page=edit_blog&id=' . $postrow[$i]["id"] . '"><b>' . $postrow[$i]["url"] . '</b></a></td>
            <td>' .$CAT["name"] . '</td>
            <td>' . $postrow[$i]["h1"] . '</td>
            <td>' . date("d.m.Y",strtotime($postrow[$i]["date_add"])) . '</td>
                         <td><span idpage="'.$postrow[$i]["id"].'" class="public-page">'.$public2.'</span></td>

            <td>' . $type1 . '</td>
            ';
    echo'
            <td align="center"><a  href="index.php?page=edit_blog&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_blog=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
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









if(isset($_GET["delete_blog"]))
{
    $id = $_GET["delete_blog"];

    @removeDirRec("../files/blog/".$id);

    mysql_query("DELETE FROM blog WHERE id=$id");
    $_SESSION["message"] = "Пост удален";
    echo'<script>window.location="index.php?page=show_blog";</script>';
    exit();
}


//Обновление публикации
if(isset($_POST["updateblog1"]))
{
    $id = intval($_POST["updateblog1"]);
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `blog` WHERE id=$id"));
    if($result)
    {
        if($result["public"]==1)
        {
            mysql_query("UPDATE `blog` SET `public`=0 WHERE id=$id");
            echo "Вкл/<b class='off'>Выкл</b>";
        }else{
            mysql_query("UPDATE `blog` SET `public`=1 WHERE id=$id");
            echo "<b class='on'>Вкл</b>/Выкл";
        }

    }else{
        echo "0";
    }
    exit();

}