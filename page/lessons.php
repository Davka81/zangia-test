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

<?php if (isset($_GET['id'])) : ?>
	<div class="w-340">
		<form action="" method="post">
			<div class="form-item">
				<input name="name" type="text" required placeholder="Lesson Title" value="<?= $user->error ? $_POST["text"] : "" ?>" />
			</div>
			<div class="form-item">
				<input name="image" type="file" required placeholder="Lesson Title" value="<?= $user->error ? $_POST["text"] : "" ?>" />
			</div>
		</form>
	</div>
<?php else : ?>
	<div class="grid grid-cols-12 gap-20">
		<div class="card flex flex-column rounded-10 col-span-3 border border-lightgray cursor">
			<div class="card-img rounded-tl-10 rounded-tr-10">
				<img src="/public/img/lesson.jpeg" />
			</div>
			<div class="p-20">
				<h3 class="mb-10">Lessson Title</h3>
				<p>Question: 10</p>
			</div>
		</div>
		<div class="card flex flex-column rounded-10 col-span-3 border border-lightgray cursor">
			<div class="card-img rounded-tl-10 rounded-tr-10">
				<img src="/public/img/lesson.jpeg" />
			</div>
			<div class="p-20">
				<h3 class="mb-10">Lessson Title</h3>
				<p>Question: 10</p>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php
require_once "{$_basedir}/inc/layout/footer.html.php";
require_once "{$_basedir}/inc/footer.html.php";
require_once "{$_basedir}/inc/footer.php";
