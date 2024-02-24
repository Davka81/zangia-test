<div class="sticky flex flex-column flex-item-start flex-justify-start h-screen w-full p-20 bg-lightgray">
	<div class="p-20 mb-30">
		<a href="/dashboard" class="block">
			<img src="/public/img/logo.png" alt="Zangia Test" />
		</a>
	</div>
	<div class="navigation w-full">
		<ul>
			<?php foreach ($menu as $i) : ?>
				<?php if (in_array($session->session_read('user')['role'], $i["type"])) : ?>
					<li>
						<a href="/page/<?= $i['url'] ?>" class="menu flex flex-item-center flex-justify-start p-6 mb-6 rounded-6 gray medium-bold <?= $_SERVER['REQUEST_URI'] == "/page/{$i['url']}" ? 'bg-black' : 'bg-lightgray'; ?>">
							<span class="menu-icon block w-24 h-24 mr-10"></span>
							<span><?= $i['title'] ?></span>
						</a>
					</li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
	</div>
</div>