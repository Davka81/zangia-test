document.addEventListener('DOMContentLoaded', function () {
	// do something
});

function toggleEye(item) {
	item.classList.toggle('eye-off');
	var elm = item.previousElementSibling;
	if (elm.type == 'password') {
		elm.type = 'text';
	} else {
		elm.type = 'password';
	}
}

function modalToggle() {
	let modal = document.getElementById('modal');
	modal.classList.toggle('hide')
}

function urlChange(url) {
	window.location.href = url;
}