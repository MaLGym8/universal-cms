<?php
	$hostname="localhost"; // Имя хоста
	$login="root"; // Логин для подкл. к серверу баз даных
	$pwd=""; // Пароль для подкл. к серверу баз даных
	$db_name="artweb"; // Название базы даных

	$admin_pass="admin";// Пароль администратора
	$system_path="http://artweb/"; // путь к корневой папке комментариев
	$theme_path=$system_path."modules/comments_blog/themes/default/"; // путь к корневой папке темы
	$c_tab="commentsystem"; // таблица с комментариями в БД
	$s_tab="commentsetings"; // таблица с настройками в БД
	$c_max=100; // максимальное количество комментариев
	$url_type="df"; // Режим ссылок на личные сайты, блоги пользователей: df - dofollow (прямая ссылка), nf - nofollow (неиндексируемая ссылка), js - javascript ссылка

	// всякие тонкости
	$id_pref="comment-"; // префикс ида на комментарий (comment-1, comment-2 ...) - для совместимости с другими html элементами
    //подключение к базе
    $con = @mysql_connect($hostname, $login, $pwd) or die("Error! connect-database");
	mysql_query('SET NAMES utf8');
	mysql_select_db($db_name, $con) or die ("Error! select-database");


?>