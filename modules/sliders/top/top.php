
<div class="index-slider">
<?if ($MODULES[24][2]==1):?>

    <div class="inner">

    <div class="jcarousel-wrapper">
        <div class="jcarousel">
            <ul>
                <?
				$sliderQuery = $db->read_all("SELECT * FROM `sales` ORDER by position ASC LIMIT 4");
				if($sliderQuery)
				{
					foreach($sliderQuery as $slide)
					{
						?>
						<li slidertext="<?=$slide["name"]?>">
                    <div class="string-1">
                    <a href="/<?=$slide["url"]?>"><?=$slide["h1"]?></a></div>
                    <div class="dop_string"><?=$slide["dop_text"]?></div>
                    <?php /*?><div class="string-2"><?=$actiondeadline?></div><?php */?>
                    <div class="string-3"><a class="button slider-button" href="/<?=$slide["url"]?>">Подробнее</a></div>
					<?if($slide["background"]){?>
                    <div class="slide-image"><img src="/<?=$slide["background"]?>"/></div>
					<?}?>
                </li>
						<?
					}
				}
				?>
                
            </ul>
        </div>
        <div class="head-navigation"></div>


        <a href="#" class="jcarousel-control-prev-index" style="opacity: 0;">&lsaquo;</a>
        <a href="#" class="jcarousel-control-next-index" style="opacity: 0;">&rsaquo;</a>

        <p class="jcarousel-pagination-index" <?php /*?>style="opacity: 0;"<?php */?>>

        </p>
        
    </div>
    </div>
<?endif;?>
</div>