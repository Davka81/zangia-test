<?php
class Session
{
	function __construct()
	{
		session_start();
	}

	/*
	* @param string $key global session key
	* @param string|array $value global session value
	*/
	function session_write(string $key, string|array $value)
	{
		if (is_array($value)) {
			foreach ($value as $k => $v) {
				$_SESSION[trim($key)][trim($k)] = trim($v);
			}
		} else {
			$_SESSION[trim($key)] = trim($value);
		}
	}

	/*
	* @param string $key global session key
	*/
	function session_read(string $key)
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
	}

	function session_clear()
	{
		foreach ($_SESSION as $k => $v) {
			if ($k !== "user") {
				unset($_SESSION[$k]);
			}
		}
	}

	function session_destroy()
	{
		session_unset();
	}
}
