<?

function parentcomments()
{
	global $id_pref, $c_max, $url_type, $c_tab, $uid, $reply, $wait_good, $theme_path;
	include('modules/comments_blog/config_comments.php');
	mysql_query('SET NAMES utf8');
	$res = mysql_query("select * from ".$c_tab." where url_id like '".$uid."' and parent_id='0' and `public`=1 order by id ASC limit 0,".$c_max, $con) or die ("Error! query - show");
	while($arr = mysql_fetch_array($res, MYSQL_NUM))
	{
		if($arr[5]!="" and $url_type=="df"){$name = '<a target="_blank" href="'.$arr[5].'">'.$arr[4].'</a>';}
		elseif($arr[5]!="" and $url_type=="nf"){$name = '<a target="_blank" rel="nofollow" href="'.$arr[5].'">'.$arr[4].'</a>';}
		elseif($arr[5]!="" and $url_type=="js"){$name = '<a onclick="location.href=\''.$arr[5].'\'">'.$arr[4].'</a>';}
		else{$name = $arr[4];}
		
		if($arr[9]==0){$text = $arr[7].templater($theme_path."wait_for_good.php", "[#wait_good]", $wait_good);}
		else{$text = $arr[7];}
		$keys = array("[#id]","[#name]","[#date]","[#text]","[#reply]","[#subs]");
		$vals = array($id_pref.$arr[0],$name,$arr[8],$text,$reply,subcomments($arr[0]));
		echo templater($theme_path."comment.php", $keys, $vals);
	}
}

?>