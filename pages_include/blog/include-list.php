<?
if($newsQ)
{
    echo"<div class='blog-all'>";
    foreach($newsQ as $newsR)
    {
        if($newsR["image"])
            $IMAGE = ' background-image: url(\'/'.$newsR["image"].'\'); ';
        else
            $IMAGE = "";

        $catname = $db->read("SELECT * FROM `blog_cats` WHERE `id`='".$newsR["cat"]."'");

      include("module.php");
    }
    echo"</div>";
}
?>