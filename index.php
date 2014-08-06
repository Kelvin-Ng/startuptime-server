<html>
	<head>
		<title>StartUpTime Server</title>
		<link rel="stylesheet" href="index.css">
	</head>
	<body>
		<h1>StartUpTime Server</h1>
		<table align="center">
			<tr class="table_head">
				<td>Rank</td>
				<td>Boot Time (s)</td>
			</tr>
<?
	include 'config.php';

	$handle = new mysqli($host, $username, $password);
	$handle->select_db($db_name);
	$result = $handle->query(
		'SELECT DISTINCT time FROM times ORDER BY time ASC');

	$i = 0;
	while ($row = $result->fetch_row())
	{
		$i++;
?>
			<tr class="<? echo $i % 2 ? 'table_row_odd' : 'table_row_even' ?>">
				<td><? echo $i?></td>
				<td><? echo $row[0]?></td>
			</tr>
<?
	}
?>
		</table>
	</body>
</html>
