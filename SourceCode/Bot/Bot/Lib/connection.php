<?php

class Connection
{
	const  host_name = "localhost";
	const  database_name="jobsrec";
	const  user_name = "root";
	const  user_pass = "";

	public $mysql_connection;

	public  function connect()
	{
		$this->mysql_connection = mysqli_connect(
				Connection::host_name,
				Connection::user_name,
				Connection::user_pass,
				Connection::database_name);
		if(!$this->mysql_connection)
		{
			die("Can't connect!");
		}
	}

	public function close()
	{
		mysqli_close($this->mysql_connection);
	}

	public function __construct()
	{
	}
	public function getConnection()
	{
		return $this->mysql_connection;
	}

	public function read($sql)
	{
		$data = mysqli_query($this->mysql_connection, $sql);
		return $data;
	}

	public function write($sql)
	{
		return mysqli_query($this->mysql_connection, $sql);
	}
}
?>