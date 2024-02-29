<?php
require_once "../config/config.php";
require_once "{$_basedir}/inc/header.php";

$user = new User();
$user->check_login_permission();

require_once "{$_basedir}/inc/header.html.php";
require_once "{$_basedir}/inc/layout/header.html.php";
?>
<div class="mb-30 flex flex-justify-end">
  <a href="/page/lessons.php<?= isset($_GET['id']) ? "" : "?id=new" ?>" class="transition-all py-9 px-20 rounded-6 border border-eee gray bg-lightgray medium-bold"><?= isset($_GET['id']) ? "Back" : "Create" ?></a>
</div>


<?php
require_once "{$_basedir}/inc/layout/footer.html.php";
require_once "{$_basedir}/inc/footer.html.php";
require_once "{$_basedir}/inc/footer.php";
