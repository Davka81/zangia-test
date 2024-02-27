<?php
$_root = dirname(__FILE__);
$_basedir = "{$_root}/..";
$_db_host = 'localhost';
$_db_username = 'root';
$_db_password = 'davka22';
$_db_database = "zangia";
$_show_query = true;

$menu = [
	[
		"url" => "profile.php",
		"title" => "Profile",
		"type" => [0]
	],
	[
		"url" => "dashboard.php",
		"title" => "Dashboard",
		"type" => [1, 2]
	],
	[
		"url" => "lesson.php",
		"title" => "Lessons",
		"type" => [1, 2]
	],
	[
		"url" => "users.php",
		"title" => "Users",
		"type" => [1]
	],
	[
		"url" => "logout.php",
		"title" => "Logout",
		"type" => [1, 2]
	]
];
