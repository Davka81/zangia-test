<?php
require_once "../config/config.php";
require_once "{$_basedir}/inc/header.php";
$user = new User();
$user->logout();
