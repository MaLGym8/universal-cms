<?php
//Просмотр категорий
function Show_Cms()
{
    $tableName = "cms";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));


    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">CMS (' . $count[0] . ')  <a href="index.php?page=add_cms" class="event-button">Добавить CMS</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content catstable"><form action="" method="post">
			<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
    				<th>#</th>
                    <th></th>
                    <th width="250">Название</th>
                    <th width="250">URL</th>
                    <th>Имя меню</th>
                    <th>Краткое описание</th>
                    <th>Ключевые слова</th>
                    <th>H1</th>
                    <th>Описание</th>
    				<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    $num = COUNTPAGE;
    $pg = "show_cats";
    $page = $_GET["num"];
    $result = mysql_query("SELECT COUNT(*) FROM  `$tableName` WHERE `parent`=0");
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

    $query = mysql_query("SELECT * FROM `$tableName` WHERE `parent`=0 ORDER by id LIMIT $start, $num");
    while ($postrow[] = mysql_fetch_array($query)) {

    }
    for ($i = 0; $i < $num; $i++) {
        if ($postrow[$i]) {

            //$text = mb_substr(trim($text),0,50,'UTF-8');

            //$Cat = mysql_fetch_array(mysql_query("SELECT * FROM `cms` WHERE `parent`='".$postrow[$i]["parent"]."'"));

            //$cat = mysql_fetch_array(mysql_query("SELECT * FROM `cms` WHERE `id`=".$postrow[$i]["parent"].""));

            echo '<tr>
            <td>' . $postrow[$i]["id"] . '</td>
            <td><img width="50" src="../' . $postrow[$i]["image"] . '"/></td>
            <td><a  href="index.php?page=edit_cms&id=' . $postrow[$i]["id"] . '"><b>' . $postrow[$i]["title"] . '</b></a></td>
            <td class="urloverflow150"><a  href="index.php?page=edit_cms&id=' . $postrow[$i]["id"] . '"><b>' . $postrow[$i]["url"] . '</b></a></td>
            <td>' . $postrow[$i]["menu"] . '</td>
            <td>' . $postrow[$i]["meta_d"] . '</td>
            <td>' . $postrow[$i]["meta_k"] . '</td>
            <td>' . $postrow[$i]["h1"] . '</td>
            <td>' . CutTextNews($postrow[$i]["desc"],200) . '</td>
            <td align="center"><a  href="index.php?page=edit_cms&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_cms=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';

            $QC1 = mysql_query("SELECT * FROM `cms` WHERE `parent`='".$postrow[$i]["id"]."'");
            $RC1 = mysql_fetch_array($QC1);
            do{
                if($RC1){

                    echo '<tr >
            <td >' . $RC1["id"] . '</td>
            <td ><img width="50" src="../' . $RC1["image"] . '"/></td>
            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_cms&id=' . $RC1["id"] . '">' . $RC1["title"] . '</a></td>  
            <td class="urloverflow150">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_cms&id=' . $RC1["id"] . '">' . $RC1["url"] . '</a></td>
            <td>' . $RC1["menu"] . '</td>
            <td>' . $RC1["meta_d"] . '</td>
            <td>' . $RC1["meta_k"] . '</td>
            <td>' . $RC1["h1"] . '</td>
            <td>' . CutTextNews($RC1["desc"],200) . '</td>
            <td align="center"><a  href="index.php?page=edit_cms&id=' . $RC1["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_cms=' . $RC1["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';



                    $QC2 = mysql_query("SELECT * FROM `cms` WHERE `parent`='".$RC1["id"]."'");
                    $RC2 = mysql_fetch_array($QC2);
                    do{
                        if($RC2){

                            echo '<tr >
            <td >' . $RC2["id"] . '</td>
             <td ><img width="50" src="../' . $RC2["image"] . '"/></td>
            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_cms&id=' . $RC2["id"] . '"><i>' . $RC2["title"] . '</i></a></td>            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_cms&id=' . $RC2["id"] . '"><i>' . $RC2["url"] . '</i></a></td>
            <td>' . $RC2["menu"] . '</td>
            <td>' . $RC2["meta_d"] . '</td>
            <td>' . $RC2["meta_k"] . '</td>
            <td>' . $RC2["h1"] . '</td>
            <td>' .CutTextNews( $RC2["desc"],200) . '</td>
            <td align="center"><a  href="index.php?page=edit_cms&id=' . $RC2["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_cms=' . $RC2["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';







                        }
                    }while($RC2 = mysql_fetch_array($QC2));






                }
            }while($RC1 = mysql_fetch_array($QC1));


        }
    }


    echo '
			</tbody>
			</table>
            <!--<input type="submit" name="delete_cms" style="float:left;margin-left:15px;" value="Удалить"><br />-->
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












//Удаление категории
if(isset($_GET["delete_cms"]))
{
    $id = $_GET["delete_cms"];
    $resultCat = mysql_fetch_array(mysql_query("SELECT * FROM `cms` WHERE id=$id"));
    @unlink("../".$resultCat["image"]);
    @unlink("../".str_replace("small","big",$resultCat["image"]));
    mysql_query("DELETE FROM `cms` WHERE id=$id");

    $_SESSION["message"] = "CMS удалена";
    echo'<script>window.location="index.php?page=show_cms";</script>';
    exit();

}