<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
    <div class="inner">
        <? include_once("blocks/breadcrumbs.php");?>
        <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["title"];
            ?></h1>
    </div>
</div>

<div class="inner">



<ul class="cause">
        <?
        $result = mysql_query ("SELECT * FROM images_content WHERE cat=2 and public=1 ORDER BY sort");
        if (!$result) { echo "<p class='error'>Запрос на выборку данных из базы не прошёл</p>";}
        if (mysql_num_rows($result) > 0) {
            $myrow = mysql_fetch_array ($result);
            do {
                if($myrow["fullimg"])
                {
                    echo '
                    <li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="'.$myrow["description"].'" href="/'.$myrow["fullimg"].'"><img src="/'.$myrow["thumb"].'" alt="" />
        </a></li>
';
                }
            }
            while ($myrow = mysql_fetch_array($result)); }
        else { echo "<p class='error'>В базе нет записей</p>"; }
        ?>
        </ul></div>