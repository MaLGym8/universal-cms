<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title"  <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
                if($Page["h1"]):
                    echo $Page["h1"];
                else:
                    echo $Page["title"];
                endif;
                ?></h1>
    </div>
</div>

<div class="container">
    <div class="inner">
<?php
$currentPage=intval($_GET["page"]);
$num=sitequantity1;
$result = $db->read_all("SELECT COUNT(*) as rec FROM `news` WHERE `type`=1  AND `public`=1");
$posts = $result[0]["rec"];



$total = intval(($posts - 1) / $num) + 1;

if(empty($currentPage) or $currentPage < 0) $currentPage = 1;
if($currentPage > $total) {
    //$currentPage = $total;
}
$start = $currentPage * $num - $num;
for($i = 1; $i < 7; $i++)
{
    if($currentPage + $i <= $total)
        $navigation[1][$i] = '<a href="?page='.($currentPage + $i) .'">'.($currentPage + $i).'</a>';
    if( $currentPage - $i > 0)
        $navigation[0][$i] = '<a href="?page='.($currentPage - $i) .'">'.($currentPage - $i).'</a>';
}

if ($currentPage != 1) $pervpage = '<a class="first" href="?page=1"><<<</a> <a class="prev" href="?page='.($currentPage-1).'"><</a>';
if ($currentPage != $total) $nextpage = '<a class="next" href="?page='.($currentPage+1).'">></a> <a class="last" href="?page='.$total.'">>>></a> ';
if( $navigation[0] ||  $navigation[1])
{
    $navigation[3] = $currentPage;
    $navigation[4] = $pervpage;
    $navigation[5] = $nextpage;
    @natcasesort($navigation[0]);
}
//============================================

$newsQ = $db->read_all("SELECT `id`,`url`,`title`,`text`,`date_add`,`image`,`public` FROM `news` WHERE `type`=1  AND `public`=1 ORDER by `date_add` DESC LIMIT $start, $num");


if($newsQ)
{
    echo"<div class='news-all'>";
    foreach($newsQ as $newsR)
    {
        echo'<div class="item-news">
                                <div class="item-news-p">
                                    <a class="newstitle" href="'.$base_url.'news/'.$newsR["url"].'">'.$newsR["title"].'</a> <span class="date-right">'.date("d.m.Y",strtotime($newsR["date_add"])).'</span><br clear="all"/>
                                    <div class="photo"><a href="'.$base_url.'news/'.$newsR["url"].'"><img src="'.$base_url.$newsR["image"].'"/></a></div>
                                    '.CutTextNews($newsR["text"],1020).'
                                </div>
                                <span class="read-more"><a  href="'.$base_url.'news/'.$newsR["url"].'">Читать далее...</a></span><br clear="all"/>
                            </div>';
    }
    echo"</div>";
}else{


}

if ($navigation&&$newsQ)
{
    echo '<div class="navigation-page">';
    echo $navigation[4];
    if($navigation[0])
        foreach ($navigation[0] as $item){
            echo $item;
        }

    echo'<a class="current" href="?page='.$navigation[3].'">'.$navigation[3].'</a>';
    if($navigation[1])
        foreach ($navigation[1] as $item){
            echo $item;
        }
    echo $navigation[5];
    echo'</div>';
}
?>
        </div>
</div>
