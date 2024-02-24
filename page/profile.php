<?php
require_once "../config/config.php";
require_once "{$_basedir}/inc/header.php";

$user = new User();
$user->check_login_permission();

require_once "{$_basedir}/inc/header.html.php";
require_once "{$_basedir}/inc/layout/header.html.php";
?>
Profile Page
<?php
require_once "{$_basedir}/inc/layout/footer.html.php";
require_once "{$_basedir}/inc/footer.html.php";
require_once "{$_basedir}/inc/footer.php";
