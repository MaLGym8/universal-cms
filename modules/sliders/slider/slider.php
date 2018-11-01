<div class="slider">
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <?
            $result = mysql_query ("SELECT * FROM images_content WHERE public=1 and cat=1 ORDER BY sort LIMIT 210");
            if (!$result) { echo "<p class='error'>Запрос на выборку данных из базы не прошёл</p>";}
            if (mysql_num_rows($result) > 0) {
                $myrow = mysql_fetch_array ($result);
                do {
                    if($myrow["fullimg"])
                    {


                        if(!empty ($myrow["link"])) {echo '<a href="'.$myrow["link"].'">';}
                        echo '<img src="'.$base_url.$myrow["fullimg"].'" data-thumb="'.$base_url.$myrow["fullimg"].'" title="<b style=\'float:left;\'>'.$myrow["description"].'</b>';
                        //echo '<b style=\'float:right;\'></b>';
                        echo '" />';
                        if(!empty ($myrow["link"])) {echo '</a>';}

                    }
                }
                while ($myrow = mysql_fetch_array($result)); }
            ?>

        </div>




        <? /*echo '<!--<div id="htmlcaption" class="nivo-html-caption">
                        <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
                    </div>-->'*/ ?>

    </div></div>

<link rel="stylesheet" href="<?=$base_url?>modules/sliders/slider/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$base_url?>modules/sliders/slider/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {
        $('#slider').nivoSlider({
            pauseTime:5000,
            controlNav: true,
            effect:"fade"

        });
    });
</script>