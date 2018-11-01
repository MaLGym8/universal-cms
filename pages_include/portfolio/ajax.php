<?php
require("../../config.php");
require_once("../../libs/functions.php");

if(isset($_POST["ajaxloadportfolio"]))
{
    if($_POST["ajaxloadportfolio"]==1)
    {
        $limit = $_POST["limit"];
        $limitload = $_POST["limitload"];
        $limit2 = $limitload;
        $tagid = $_POST["tagid"];
        $query = $_POST["query"];


        if($tagid)
        {
            $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` INNER JOIN tags_ids ON tags_ids.tag_id = '".$tagid."' AND tags_ids.obj_id=portfolio_item.id WHERE `portfolio_item`.`cat`=2 ORDEr by `portfolio_item`.sort ASC LIMIT $limit,$limit2");
        }else{
            if($query)
                $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` WHERE id!=0 $query ORDEr by sort ASC LIMIT $limit,$limit2");
            else
                $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` ORDEr by sort ASC LIMIT $limit,$limit2");

        }




        $resultPortfCat = mysql_fetch_array($queryPortfCat);
        do
        {
            if($resultPortfCat)
            {
                $str .= include("module.php");

            }
        }while($resultPortfCat = mysql_fetch_array($queryPortfCat));



echo $str;


    }
}