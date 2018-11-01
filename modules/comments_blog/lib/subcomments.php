<?
function subcomments($id)
{
	global $id_pref, $c_tab, $url_type, $uid, $wait_good, $theme_path;
	include('modules/comments_blog/config_comments.php');
	$res = mysql_query("select * from ".$c_tab." where url_id like '".$uid."' and parent_id='".$id."' order by id ASC", $con) or die ("Error! query - show");
	$subs='';
	while($arr = mysql_fetch_array($res, MYSQL_NUM))
	{
		if($arr[5]!="" and $url_type=="df"){$name = '<a target="_blank" href="'.$arr[5].'">'.$arr[4].'</a>';}
		elseif($arr[5]!="" and $url_type=="nf"){$name = '<a target="_blank" rel="nofollow" href="'.$arr[5].'">'.$arr[4].'</a>';}
		elseif($arr[5]!="" and $url_type=="js"){$name = '<a onclick="location.href=\''.$arr[5].'\'">'.$arr[4].'</a>';}
		else{$name = $arr[4];}
	
		if($arr[9]==0){$text = $arr[7].templater($theme_path."wait_for_good.php", "[#wait_good]", $wait_good);}
		else{$text = $arr[7];}
		//$text = $arr[7].templater($theme_path."wait_for_good.php", "[#wait_good]", $wait_good);
		$keys = array("[#id]","[#name]","[#date]","[#text]");
		$vals = array($id_pref.$arr[0],$name,$arr[8],$text);
		$subs=$subs.templater($theme_path."subcomment.php", $keys, $vals);
	}
	
	return $subs;
}
?>