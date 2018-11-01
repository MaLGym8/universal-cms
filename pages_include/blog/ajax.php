<?php
require("../../config.php");
require_once("../../libs/functions.php");

if(isset($_POST["ajaxloadblog"]))
{
    if($_POST["ajaxloadblog"]==1)
    {
        $limit = $_POST["limit"];
        $limit2 = $limit;
        $catid = $_POST["catid"];


        if($catid)
            $newsQ = $db->read_all("SELECT * FROM `blog` WHERE `cat`='$catid' ORDER by `date_add` DESC LIMIT $limit, $limit");
        else
            $newsQ = $db->read_all("SELECT * FROM `blog` ORDER by `date_add` DESC LIMIT $limit, $limit");




        if($newsQ)
        {

            foreach($newsQ as $newsR)
            {
                if($newsR)
                {

                /*
                 *
                 * <div class="item-news-p">
                                            <a class="newstitle" href="'.$base_url.'articles/'.$newsR["url"].'">'.$newsR["title"].'</a> <span class="date-right">'.date("d.m.Y",strtotime($newsR["date_add"])).'</span><br clear="all"/>

                                            '.CutTextNews($newsR["text"],1020).'
                                        </div>
                                        <span class="read-more"><a  href="'.$base_url.'articles/'.$newsR["url"].'">Читать далее...</a></span><br clear="all"/>
                 *
                 * */
                if($newsR["image"])
                    $IMAGE = ' background-image: url(\'/'.$newsR["image"].'\'); ';
                else
                    $IMAGE = "";

                $catname = $db->read("SELECT * FROM `blog_cats` WHERE `id`='".$newsR["cat"]."'");


                $str .= include("module.php");}
            }

        }
        $str = str_replace("111111","",$str);
        //echo $str;

    }
}