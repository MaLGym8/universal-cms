<div class="logo_cert">
    <div class="inner">
        <div class="title">Наши сертификаты</div>

        <div class="float_logo_cert">
            <div class="jcarousel-wrapper">
                <div class="models-carusel"><ul>
                        <?
                        $result = mysql_query ("SELECT * FROM images_content WHERE public=1 and cat=4 ORDER BY sort");
                        if (!$result) { echo "<p class='error'>Запрос на выборку данных из базы не прошёл</p>";}
                        if (mysql_num_rows($result) > 0) {
                            $myrow = mysql_fetch_array ($result);
                            do {
                                if($myrow["fullimg"])
                                {
                                    echo '<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="'.$myrow["description"].'" href="/'.$myrow["fullimg"].'"><img src="'.$myrow["thumb"].'"/></a></li>';
                                }
                            }
                            while ($myrow = mysql_fetch_array($result)); }
                        else { echo "<p class='error'>В базе нет записей</p>"; }
                        ?>
                </div>
                <p class="jcarousel-pagination-models">

                </p>
            </div>
        </div>

    </div>
</div>