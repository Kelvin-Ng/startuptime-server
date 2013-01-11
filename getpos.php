<?
	include "config.php";

	$time = $_GET['time'];
	$mac = substr($_GET['mac'], 0, 17);

	$handle = new mysqli($host, $username, $password);
	$handle->select_db($db_name);
	
	$result = $handle->query(
		"SELECT time FROM time WHERE mac = '$mac'");
	if ($result->num_rows == 0)
	{
		$handle->query("INSERT INTO time VALUES('$mac', $time)");
	}
	else
	{
		$last_time = $result->fetch_row();
		if ($time < $last_time[0])
			$handle->query(
			"UPDATE time SET time = $time WRERE mac = '$mac'");
	}
	
	$result = $handle->query(
		"SELECT COUNT(*) FROM time WHERE time < $time AND mac != '$mac'");
	$row = $result->fetch_row();
	$result->free();
	$pos = $row[0] + 1;

	$result = $handle->query(
		"SELECT COUNT(*) FROM time WHERE mac != '$mac'");
	$row = $result->fetch_row();
	$result->free();
	$num = $row[0];
	echo "$pos/$num";
?>
