<?php

class DB extends Misc
{
	private $connection;
	private $db_host;
	private $db_username;
	private $db_password;
	private $db_database;
	private $show_query = false;

	function __construct()
	{
		global $_show_query, $_db_host, $_db_username, $_db_password, $_db_database;
		$this->db_host = $_db_host;
		$this->db_username = $_db_username;
		$this->db_password = $_db_password;
		$this->db_database = $_db_database;
		$this->show_query = $_show_query;
	}
	function connect()
	{
		$this->connection = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_database);
		if ($this->connection->connect_errno) {
			die("Connection failed: " . $this->connection->connect_error);
		}
		return $this->connection;
	}

	function disconnect()
	{
		$this->connection->close();
	}

	/*
	* @param string $table select all record from table
	* @param string $field select field of from table
	* @param string|null $where select query where condition, default value is NULL
	*/
	function query_select(string $table, string $fields = "*", string|null $where = null)
	{
		try {
			$query = "SELECT {$fields} FROM {$table}" . ($where !== null ? " WHERE {$where}" : "");
			if ($this->show_query) {
				echo $query . "<br />";
			}
			$result = $this->connection->query($query);
			$data = $result->fetch_all(MYSQLI_ASSOC);
			return count($data) === 1 ? $data[0] : $data;
		} catch (Exception $e) {
			die("Mysql Error: {$e->getMessage()}");
		}
	}

	/*
	* @param string $table table name of record insert
	* @param array $values values array contains field => value
	*/
	function query_insert(string $table, array $values)
	{
		try {
			$count = count($values);
			if (!$count) return false;
			$fields = [];
			$val = [];
			foreach ($values as $k => $v) {
				$fields[] = $this->connection->real_escape_string(trim($k));
				if ($k == 'password') {
					$val[] = '"' . $this->passwordHash($v) . '"';
				} else {
					$val[] = '"' . $this->connection->real_escape_string(trim($v)) . '"';
				}
			}
			$query = "INSERT INTO {$table} (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $val) . ")";
			if ($this->show_query) {
				echo $query . "<br />";
			}
			return $this->connection->query($query);
		} catch (Exception $e) {
			die("Mysql Error: {$e->getMessage()}");
		}
	}

	/*
	* @param string $table table name of record update
	* @param array $values values array contains field => value
	* @param string $where update query where condition
	*/
	function query_update(string $table, array $values, string $where)
	{
		try {
			$count = count($values);
			if (!$count) return false;
			$fields = [];
			foreach ($values as $k => $v) {
				if ($k == 'password') {
					$fields[] = "{$k} = CONCAT('*', UPPER(SHA1(UNHEX(SHA1('{$v}')))))";
				} else {
					$fields[] = "{$k} = " . trim($v);
				}
			}
			$query = "UPDATE {$table} SET " . implode(', ', $fields) . " WHERE {$where}";
			if ($this->show_query) {
				echo $query . "<br />";
			}
			return $this->connection->query($query);
		} catch (Exception $e) {
			die("Mysql Error: {$e->getMessage()}");
		}
	}

	/*
	* @param string $value 
	*/
	function real_escape_string(string $value)
	{
		return $this->connection->real_escape_string($value);
	}
}
