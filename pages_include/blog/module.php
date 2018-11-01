<?php
if($newsR) {
    if($newsR["background_color"]) $COLOR = ' background-color: '.$newsR["background_color"].'; '; else $COLOR = "";
	if($newsR["background_text"]) $COLOR_TEXT = ' style="color: '.$newsR["background_text"].'"; '; else $COLOR_TEXT = "";


	if($catname["url"])
		$URLBLOG = "/blog/" . $catname["url"] . "/" . $newsR["url"]."";
	else
		$URLBLOG = "/blog/" . $newsR["url"]."";


    echo '<div class="blog-item" style="' /*.$IMAGE*/ .$COLOR. '"">
        <div class="cat-name"'.$COLOR_TEXT.'>' . $catname["name"] . '</div>
        <div class="blog-title"><a'.$COLOR_TEXT.' href="'.$URLBLOG.'">' .$newsR["title"] . '</a></div>';
        echo '<div class="blog-text"'.$COLOR_TEXT.'>';
		if(!empty($newsR["meta_d"])) {echo $newsR["meta_d"];} else { echo CutTextNews($newsR["text"], 100,"utf-8");}
		echo '</div>';
		//echo '<div class="blog-text"'.$COLOR_TEXT.'> ' . $catname["meta_d"] . '</div>';
        echo '<div class="blog-date"'.$COLOR_TEXT.'> ' . date("d-m-Y", strtotime($newsR["date_add"])) . '</div> </div>';
}