<?php
class Lesson extends Misc
{
	private $db;
	public $error = false;

	function __construct()
	{
		global $db;
		$this->db = $db;
	}

	function login()
	{
		$this->session_clear();
		$this->error = false;
		if (!empty($_POST)) {
			$val = $this->db->real_escape_string(trim($_POST['emailphone']));

			$user = $this->db->query_select('users', '*', "email = '{$val}'");
			if (array_key_exists('password', $user) && password_verify(trim($_POST['password']), $user['password'])) {
				unset($user['password']);
				$this->session_write('user', $user);
				$this->clear_post();
				header("Location: /page/dashboard.php");
			}

			$user = $this->db->query_select('users', '*', "phone = '{$val}'");
			if (array_key_exists('password', $user) && password_verify(trim($_POST['password']), $user['password'])) {
				unset($user['password']);
				$this->session_write('user', $user);
				$this->clear_post();
				header("Location: /page/dashboard.php");
			}

			$this->error = true;
			$this->session_write('title', 'Error');
			$this->session_write('description', 'Email, Phone or Password is incorrect');
			$this->needModal(true);
			return;
		}
	}

	function logout()
	{
		$this->session_destroy();
		$this->clear_post();
		header("Location: /");
	}

	function register()
	{
		$this->session_clear();
		$this->error = false;
		if (!empty($_POST)) {
			$email = trim($_POST['email']);
			$row = $this->db->query_select("users", "*", "email = '{$email}'");

			if ($row) {
				$this->error = true;
				$this->session_write("title", "Error");
				$this->session_write("description", "Your {$email} already registered. Please choose another email or reset you password using current email");
				$this->needModal(true);
				return;
			}

			$phone = trim($_POST['phone']);
			$row = $this->db->query_select("users", "*", "phone = '{$phone}'");

			if ($row) {
				$this->error = true;
				$this->session_write("title", "Error");
				$this->session_write("description", "Your {$phone} already registered. Please choose another phone number or reset you password.");
				$this->needModal(true);
				return;
			}

			if (trim($_POST["password"]) != trim($_POST["password-repeat"])) {
				$this->error = true;
				$this->session_write("title", "Error");
				$this->session_write("description", "Your password is not same");
				$this->needModal(true);
				return;
			}

			unset($_POST["password-repeat"]);
			$_POST["role"] = 2;
			$user = $this->db->query_insert("users", $_POST);
			if ($user) {
				$this->session_write("title", "Success");
				$this->session_write("description", "Your Registration Complete");
				$this->session_write("click", "urlChange('/')");
				$this->needModal(true);
				return;
			}

			$this->error = true;
			$this->session_write("title", "Error");
			$this->session_write("description", "We can not register you. Please try again later");
			$this->session_write("click", "urlChange('/')");
			$this->needModal(true);
			return;
		}

		return;
	}

	function forget()
	{
		$this->session_clear();
		if (!empty($_POST)) {
			$this->needModal(true);
		}
	}

	/*
	* @param bool $is_admin check page permission
	*/
	function check_login_permission(bool $is_admin = false)
	{
		$this->session_clear();
		$logged_user = $this->session_read('user');
		if (!$logged_user) {
			header("Location: /");
		}

		if ($is_admin && $logged_user['role'] != 1) {
			$this->error = true;
			$this->session_write('title', 'Access Deniad');
			$this->session_write('description', 'You do not have permission');
			$this->session_write('click', 'urlChange(\'/page/dashboard.php\')');
			$this->needModal(true);
		}
	}
}
