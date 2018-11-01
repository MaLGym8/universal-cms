<?php
session_start();
include_once("../config.php");


$config["dbhost"] = $Config->mysql_config["host"];
$config["dbname"] = $Config->mysql_config["dbname"];
$config["dbuser"] = $Config->mysql_config["user"];
$config["dbpassword"] = $Config->mysql_config["passw"];

mysql_connect($config["dbhost"],$config["dbuser"],$config["dbpassword"]) or die(mysql_error());
mysql_select_db($config["dbname"])or die(mysql_error());
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET NAMES utf8");

?>