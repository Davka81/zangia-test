<?php
class Misc extends Session
{
	public bool $showModal = false;

	/*
	* @param bool $status
	*/
	function needModal(bool $status)
	{
		$this->showModal = $status;
	}

	/*
	* @param string $password
	*/
	function passwordHash($password)
	{
		return password_hash(trim($password), PASSWORD_BCRYPT, ['cost' => 12]);
	}

	function clear_post()
	{
		unset($_POST);
	}

	function show_modal()
	{
		echo "<script>\n";
		echo "document.addEventListener('DOMContentLoaded', function () {
			modalToggle();
		})\n";
		echo "</script>\n";
	}

	function get_current_page()
	{
		global $menu;
		foreach ($menu as $i) {
			if ($_SERVER['REQUEST_URI'] == "/page/{$i['url']}") {
				return $i['title'];
			}
		}
	}
}
