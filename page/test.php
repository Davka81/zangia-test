<?php
require_once "../config/config.php";
require_once "{$_basedir}/inc/header.php";

$user = new User();
$user->check_login_permission();

$lesson = new Lesson();
$lesson->get($_GET['lesson']);

require_once "{$_basedir}/inc/header.html.php";
require_once "{$_basedir}/inc/layout/header.html.php";
?>
<div class="mb-30 flex flex-justify-end">
  <a href="/page/lessons.php<?= isset($_GET['id']) ? "" : "?id=new" ?>" class="transition-all py-9 px-20 rounded-6 border border-eee gray bg-lightgray medium-bold"><?= isset($_GET['id']) ? "Back" : "Create" ?></a>
</div>

<?php if (isset($_GET['id'])) : ?>
  <div class="flex flex-justify-center">
    <div class="w-540 border border-gray p-20 rounded-10 bg-white">
      <h1 class="mb-30">Create a Lesson</h1>
      <form action="/page/lessons.php?id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <div class="form-item">
          <input name="name" type="text" required placeholder="Lesson Title" value="<?= $user->error ? $_POST["text"] : "" ?>" />
        </div>
        <div class="form-item">
          <img src="" />
          <input name="image" type="file" accept="image/jpg, image/jpeg, image/png" required value="<?= $user->error ? $_POST["image"] : "" ?>" />
        </div>
        <div class="form-item">
          <button type="submit">Save</button>
        </div>
      </form>
    </div>
  </div>
<?php else : ?>
  <div class="grid grid-cols-12 gap-20">
    <?php foreach ($lesson->read() as $lesson) : ?>
      <a href="/pages/test.php?lesson=<?=$lesson['id']?>" class="col-span-3">
        <div class="card flex flex-column rounded-10 border border-lightgray">
          <div class="card-img rounded-tl-10 rounded-tr-10">
            <img src="/public/img/uploads/<?= $lesson['image'] ?>" />
          </div>
          <div class="p-20">
            <h3 class="mb-10"><?= $lesson['name'] ?></h3>
            <p>Question: 10</p>
          </div>
        </div>
      </a>
    <?php endforeach ?>
  </div>
<?php endif; ?>
<?php
require_once "{$_basedir}/inc/layout/footer.html.php";
require_once "{$_basedir}/inc/footer.html.php";
require_once "{$_basedir}/inc/footer.php";
