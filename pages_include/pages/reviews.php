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



<div class="container">
    <div class="inner" id="slider_reviews">
		<?=$Page["text"]?>
		<? include_once("modules/reviews/reviews_php.php");?>

        <br clear="all"/>
        <div class="reviews_buttons"><a class="button" onclick="return false" id="otzit-PopUp-Open">Оставьте Ваш отзыв</a></div>
</div>


	</div>
</div>

<script>
$(document).ready(function(){
	setInterval(function(){
			$("#slider_reviews").removeAttr("data-jcarousel");
	$("#slider_reviews").removeAttr("data-jcarouselswipe");
	$("#slider_reviews").removeAttr("data-jcarouselautoscroll");
	$("#slider_reviews").removeAttr("style");
	$("#slider_reviews ul").removeAttr("style");
	},100);

});
</script>
