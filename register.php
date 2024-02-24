<?php
require_once "./config/config.php";
echo "{$_basedir}/inc/header.php";
require_once "{$_basedir}/inc/header.php";

$user = new User();
$user->register();

require_once "{$_basedir}/inc/header.html.php";
?>
<div class="col-span-3">
	<div class="flex flex-column flex-item-center flex-justify-center h-full w-full p-60">
		<h3 class="form-title mb-30 blue">Get more things done with Loggin platform.</h3>
		<p class="blue mb-50">Access to the most powerfull tool in the entire design and web industry.</p>
		<img src="/public/img/dashboard.png" class="form-img" />
	</div>
</div>
<div class="col-span-9">
	<div class="flex flex-column flex-item-center flex-justify-center h-full bg-green">
		<div class="w-340">
			<h1 class="form-title mb-70 white">Zangia Online Test</h1>
			<div class="form-links white">
				<a href="/" class="white underline mr-20">Login</a>
				<a href="register.php" class="white underline semi-bold">Register</a>
			</div>
			<form action="register.php" method="post" class="flex flex-column">
				<div class="form-item">
					<input name="firstname" type="text" required placeholder="Firstname" value="<?= $user->error ? $_POST["firstname"] : "" ?>" />
				</div>
				<div class="form-item">
					<input name="lastname" type="text" required placeholder="Lastname" value="<?= $user->error ? $_POST["lastname"] : "" ?>" />
				</div>
				<div class="form-item">
					<input name="email" type="email" required placeholder="Email" value="<?= $user->error ? $_POST["email"] : "" ?>" />
				</div>
				<div class="form-item relative">
					<input name="password" type="password" required placeholder="Password" value="<?= $user->error ? $_POST["password"] : ""  ?>" />
					<i class="eye eye-off" onclick="toggleEye(this)"></i>
				</div>
				<div class="form-item relative">
					<input name="password-repeat" type="password" required placeholder="Password Repeat" value="<?= $user->error ? $_POST["password-repeat"] : ""  ?>" />
					<i class="eye eye-off" onclick="toggleEye(this)"></i>
				</div>
				<div class="form-item">
					<button type="submit" class="green medium-bold button-white">Register</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
require_once "{$_basedir}/inc/footer.html.php";
require_once "{$_basedir}/inc/footer.php";
