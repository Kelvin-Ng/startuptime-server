<?
	include "config.php"

	$time = $_GET['time'];
	$mac = $_GET['mac'];
	$handle = new mysqli($host, $username, $password);
	$handle->select_db($db_name);
	$result = $handle->query(
		"select time from time where mac = '$mac'");
	if ($result->num_rows == 0)
	{
		$handle->query("insert into time values('$mac', $time)");
	}
	else
	{
		$last_time = $result->fetch_row();
		if ($time < $last_time[1])
			$handle->query(
			"update time set time=$time");
	}
	$result = $handle->query(
		"select time from time where time < $time");
	$pos = $result->num_rows + 1;
	echo $pos;
?>