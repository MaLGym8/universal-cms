<div class="top-bg">
     
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["title"];
            ?></h1>

        <? if(!empty($Page["meta_d"])):?>
            <h2 class="small_desc" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?=$Page["meta_d"];?></h2>
        <? endif;?>
    </div>
</div>

<div class="container"><div class="inner">

<? echo'<div class="current-news">
                  <img align="left" class="imgnews" src="'.$base_url.$Page["image"].'"/>'.$Page["text"].'
				  <span class="date-right">'.date("d.m.Y",strtotime($Page["date_add"])).'</span>
			<br>
                    <span class="all-news"><a href="'.$base_url.'articles">Вернуться к списку статей</a></span>
                </div>';


?>
    </div>
</div>

