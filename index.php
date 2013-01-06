<html>
	<head>
		<title>StartUpTime Server</title>
	</head>
	<body>
		<h1>StartUpTime Server</h1>
		<table>
			<tr>
				<td>Rank</td>
				<td>Boot Time</td>
			</tr>
<?
	include "config.php";

	$handle = new mysqli($host, $username, $password);
	$handle->select_db($db_name);
	$result = $handle->query(
		"select distinct time from time order by time asc");
	$time = $result->fetch_row();
	for ($i = 0; i < $result->num_rows; $i++)
	{
?>
			<tr>
				<td><? echo $i + 1 ?></td>
				<td><? echo $time[i][0]?></td>
			</tr>
<?
	}
?>
		</table>
	</body>
</html>
