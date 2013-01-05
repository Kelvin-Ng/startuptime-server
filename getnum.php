<?
	include "config.php"

	$handle = new mysqli($host, $username, $password);
	$handle->select_db($db_name);
	$result = $handle->query(
		"select time from time");
	$num = $result->num_rows;
	echo $num;
?>
