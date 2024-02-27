</div>
</main>
<div id="modal" class="hide">
	<div class="modal-bg"></div>
	<div class="modal-content">
		<div class="modal-header">
			<h2><?= $session->session_read('title') ?></h2>
		</div>
		<div class="modal-body">
			<p><?= $session->session_read('description') ?></p>
		</div>
		<div class="modal-footer">
			<button class="bg-green white" onclick="<?= $session->session_read('click') ?? "modalToggle()" ?>">Ok</button>
		</div>
	</div>
</div>
<?php
if ($session->session_read('show_modal') == 1) {
	$session->show_modal();
}
?>
</body>

</html>