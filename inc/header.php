<?php
spl_autoload_register(function ($class_name) {
	global $_basedir;
	require_once "{$_basedir}/class/" . strtolower($class_name) . ".class.php";
});

$db = new DB();
$db->connect();
$session = new Session();
