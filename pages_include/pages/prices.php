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




<div class="pagetext construktor">
	<div class="inner">
    

<script src="/pages_include/services/module_block/constructor_cen.js"></script>
<? include_once("pages_include/services/module_block/construktors_cen/tarif4.php");?>
 
 




</div>


    </div>
</div>






<? 
//$formtitle = "";

//$linkbrief = ""; //0 - выкл.
include_once("modules/forms/bottom/bottom_block.php");?>

</div>