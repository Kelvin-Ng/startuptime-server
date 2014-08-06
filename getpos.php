<?
	include 'config.php';

	$time = $_GET['time'];
	$mac = substr($_GET['mac'], 0, 17);

	$handle = new mysqli($host, $username, $password);
	$handle->select_db($db_name);
	
	if ($stmt = $handle->prepare('INSERT INTO times VALUES(?, ?) ON DUPLICATE KEY UPDATE mac=?, time=?'))
	{
		$stmt->bind_param('sisi', $mac, $time, $mac, $time);
		$stmt->execute();
	}
	else
	{
		echo -2;
		die;
	}
	
	if ($stmt = $handle->prepare('SELECT COUNT(IF(time<?, 1, NULL)), COUNT(*) FROM times'))
	{
		$stmt->bind_param('i', $time);
		$stmt->execute();
		$stmt->bind_result($pos, $total_num);
		$stmt->fetch();
		$pos++;

		echo "$pos/$total_num";
	}
	else
	{
		echo -1;
	}
?>
