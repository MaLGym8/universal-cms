<?php
function templater($file, $keys, $vals)
{
	$text = file($file);
	$text = @implode("", $text);
	$text = trim($text);
	$text = str_replace($keys, $vals, $text);
	return $text;
}
?>