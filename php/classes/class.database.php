<?php
class mysqlDB{
	function __construct($host, $username, $password){
		$this -> connection = mysql_connect($host, $username, $password);
		if (!$this -> connection) {
			die("Not connected : " . mysql_error());
		}		
	}
	
	public function selectDB($database){
		$this -> current_database = mysql_select_db($database, $this->connection);
		if (!$this -> current_database) {
			die("Can't use database : " . mysql_error());
		}
	}
	
	public function performQuery($query){
		if (!$this -> current_database) {
			die("Please choose a database first! :" . mysql_error());
		}
		
		$resource = mysql_query($query);
		
		if (!$resource) {
			die('Invalid query: ' . mysql_error());
		}
		else
		{
			return $resource;
		}		
	}
}

?>
