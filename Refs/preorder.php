<?php
session_start();
?>

<?php
require('db_connection.php');
not_logged_in();
$dbh = dbconnect();
?>
<html><body>
<?php echo "
	<table style='width:50%' border='1'>
	<tr>
		<th>E-mail</th>
		<th>Region</th>
		<th>Ref ID</th>
		<th>Number of Refs</th>
		<th>Status</th>
		<th>Action</th>
		<th>Documentation</th>
	</tr>
	";

$sth = $dbh->prepare("SELECT * FROM pre_order");
$sth->execute();

$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($result as $row){
		echo "<tr>";
		echo "<td align='center'>" . $row['email'] 	. "</td>";
		echo "<td align='center'>" . $row['region'] 	. "</td>";
		echo "<td align='center'>" . $row['ref_id']	. "</td>";
		echo "<td align='center'>" . $row['amount']    . "</td>";
		echo "<td align='center'>";
			if ($row['status'] == 1){
				echo "<font color='Red'>New Order</font>";
			}
				if ($row['status'] == 2){
					echo "<font color='Orange'>In Progress</font>";
				}
					if ($row['status'] == 3){
						echo "<font color='Green'>Completed</font>";
					}
						if ($row['status'] == 0){
							echo "<font color='black'><b>Declined</b></font>";
						}

		echo "</td>";
		echo "<td align='center'>";
		echo "<form name='Accept Order' action=" .  $_SERVER['PHP_SELF'] . " method='post'><input type='submit' value='Accept'>";
		echo "<form name='Complete Order' action=" .  $_SERVER['PHP_SELF'] . " method='post'><input type='submit' value='Complete'>";
		echo "<form name='Decline Order' action=" .  $_SERVER['PHP_SELF'] . " method='post'><input type='submit' value='Decline'></td>";
		echo "<td align='center'>Documentation</td>"; // have it open up smth regarding the id of row.
		echo "</tr>";
	}
?>

</table>
</body>
</html>