
<div class="block-news">
    <div class="title">Новости</div>
    <?

    $NewsR = $db->read_all("SELECT `id`,`url`,`title`,`text`,`date_add`,`image`,`public` FROM `news` WHERE `type`=1 AND public=1 ORDER by `date_add` DESC LIMIT 2");



    foreach($NewsR as $newsR){echo'<div class="item-news"><div class="item-news-p"><a class="newstitle" href="'.$base_url.'news/'.$newsR["url"].'">'.$newsR["title"].'</a> <span class="date-right">'.date("d.m.Y",strtotime($newsR["date_add"])).'</span><br clear="all"/>';
if($newsR["image"]){
echo '<div class="photo"><a href="'.$base_url.'news/'.$newsR["url"].'"><img src="'.$base_url.$newsR["image"].'" alt="'.$newsR["title"].'"/></a></div>'; }
echo CutTextNews($newsR["text"],510).'
</div>
<span class="read-more"><a  href="'.$base_url.'news/'.$newsR["url"].'">Читать далее...</a></span><br clear="all"/>
</div>';
    }

    ?>
</div>

