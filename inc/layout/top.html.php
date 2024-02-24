<div class="top flex flex-item-center flex-justify-between p-6 pl-40 pr-20 border-b border-gray">
	<h1><?= $user->get_current_page() ?></h1>
	<a href="/page/profile.php" class="gray">
		<div class="profile rounded-9999 cursor flex flex-item-center transition-all gap-10 p-8">
			<div class="bg-avatar rounded-full h-32 w-32">
			</div>
			<div>
				<div class="mb-4"><?= $session->session_read('user')['role'] == 1 ? 'Admin' : 'User' ?></div>
				<div class="bold"><?= $session->session_read('user')['email'] ?></div>
			</div>
		</div>
	</a>
</div>