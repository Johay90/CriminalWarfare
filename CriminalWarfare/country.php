<?php
session_start();
?>
<!doctype html>
<html>
<head>
<title>Criminal Warfare - Travel</title>
<link type="text/css" rel="stylesheet" href="main.css" />
 <link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
</html>
<?php
include "inclu/connect.php";
include_once "inclu/menu.php";
include_once "inclu/class.php";
not_logged_in();
jail();
script_check();

if(isset($_POST['submit'])){

	echo '<div class="container">

				<div class="contentwrap">
					<div class="content">
						<div style="padding-left: 5px;">';

	$sql = "SELECT id FROM airlines WHERE id = '".$_GET['id']."'"; // where is wrong need to change it to $_POST airline chosen
	$result = $dbh->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);

	$obj = new travel($_SESSION['user']);

	$que = "SELECT wealth from users where username = '".$_SESSION['user']."'";
	$run = $dbh->query($que);
	$money = $run->fetch(PDO::FETCH_ASSOC);

	if($obj->calcCost($_POST['country'], $_GET['id']) >= $money['wealth']){

		echo "You don't have enough money to travel to this zone.";
		die();
	}

	$same = "SELECT * FROM users WHERE username = '".$_SESSION['user']."'";
	$runz = $dbh->query($same);
	$rowZ = $runz->fetch(PDO::FETCH_ASSOC);

	if ($rowZ['country'] == $_POST['country']){

		echo "You cannot fly to the same zone you're currently in";
		die();
	}

	$obj->travel($_POST['country'], 15, $row['id']);
	$obj->lumpsum();


	echo "Welcome to ".$obj->country;

		if (isset($obj->lumpsum)){
				echo "<hr><br />As a thank you to flying to the least populaated area you have been given <b>$" . number_format($obj->lumpsum, "0") . "</b> by the local gov." ;
		}

	}

if ($_GET['id'] AND !isset($_POST['submit'])){

	echo '<div class="container">

				<div class="contentwrap">
					<div class="content">
						<div style="padding-left: 5px;">';

	$query = "SELECT * FROM airlines WHERE id = '".$_GET['id']."'";
	$run = $dbh->query($query);

	if($run->rowCount() == 0){

		echo "This airline does not exist";
		die();

	}


	$fuel = "SELECT fuel FROM airlines WHERE id = '".$_GET['id']."'";
	$exe = $dbh->query($fuel);
	$row = $exe->fetch(PDO::FETCH_ASSOC);

	if ($row['fuel'] <= 376){

		echo "This airline doens't have enough fuel to run.";
		die();
	}

echo '<table style="float:left;" width="80%"><tr><th>Travel</th></tr>';

echo '<form name="news" method="POST" action="'. $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] . '">';

			$sql = "SELECT * from travel WHERE username = '".$_SESSION['user']."'";
			$result = $dbh->query($sql);
			$row1 = $result->fetch(PDO::FETCH_ASSOC);

				if ($result->rowCount() == 0){

				$sql = "SELECT name FROM countries ORDER BY population DESC";
				$result = $dbh->query($sql);
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);

					foreach ($rows as $row) {

					$sql = "SELECT country FROM users WHERE username = '".$_SESSION['user']."'";
					$result = $dbh->query($sql);
					echo '<tr><td><center><input type="radio" name="country" value="' . $row['name'] . '">'. $row['name'] ;

					$sql1 = "SELECT id FROM airlines WHERE id = '".$_GET['id']."'"; 
					$result1 = $dbh->query($sql1);
					$row1 = $result1->fetch(PDO::FETCH_ASSOC);

					$obj = new travel($_SESSION['user']);
					echo " ($" . ($obj->calcCost($row['name'], (int)$row1['id'])) .")";
					echo "</center><br />";
					}

			echo '<div style="float:right"><button type="submit" name="submit" value="Travel" />Travel</button></div></td></tr></table>';

			$sql = "SELECT name FROM countries WHERE bonusday = 1";
	 		$result = $dbh->query($sql);
	 		$row2 = $result->fetch(PDO::FETCH_ASSOC);

			echo '<table width="20%" style="float:right;"><tr><th>Bonus exp</th></tr> 
			<tr><td>Our system is currently granting double experiance in<b> '.$row2['name'] . '</b> for the rest of today!</td></tr></table></form><div class="spacer">';

				}else{

				$last_access = time();
				$sql = "UPDATE travel SET access_time = $last_access WHERE username = '".$_SESSION['user']."'";
				$update = $dbh->query($sql);

				$sql = "SELECT access_time FROM travel WHERE username = '".$_SESSION['user']."'";
				$result = $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);

				$read1 = date('Y-m-d H:i:s', $row['access_time']);
				$read2 = date('Y-m-d H:i:s', $row1['time_left']);

				$timeleft = date('H:i:s', strtotime($read2)+15-strtotime($read1));

				echo "You can travel again in $timeleft";
				}
		
	echo '</div></div></div></body></html>';
}
if (!$_GET['id']){

			echo '<div class="container">

				<div class="contentwrap">
					<div class="content">';

			$sql = "SELECT * from travel WHERE username = '".$_SESSION['user']."'";
			$result = $dbh->query($sql);
			$row1 = $result->fetch(PDO::FETCH_ASSOC);

				if ($result->rowCount() == 1){

					$last_access = time();
				$sql = "UPDATE travel SET access_time = $last_access WHERE username = '".$_SESSION['user']."'";
				$update = $dbh->query($sql);

				$sql = "SELECT access_time FROM travel WHERE username = '".$_SESSION['user']."'";
				$result = $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);

				$read1 = date('Y-m-d H:i:s', $row['access_time']);
				$read2 = date('Y-m-d H:i:s', $row1['time_left']);

				$timeleft = date('H:i:s', strtotime($read2)+15-strtotime($read1));

				echo "You can travel again in $timeleft";

				}else{


					echo '<table width="70%" style="float:left"><tr><th>

					<form name="choose_airline" method="GET" action="'. $_SERVER['PHP_SELF'] . '">';

					echo 'Choose an Airline</th></tr>';
					echo '<tr><td class="subheader"><span style="padding-left: 5px;">Airlines must have the required fuel to function</span></td></tr>';

					$sql = "SELECT * FROM airlines";
					$result = $dbh->query($sql);
					$rows = $result->fetchAll(PDO::FETCH_ASSOC);

					foreach ($rows as $row){

					echo '<tr><td><center>
					<input type="radio" name="id" value="'.$row['id'].'">' . $row['name'] . " [$" . $row['cpm'] . ' Cost Per Mile]';

					}
					echo '<br /><br /><button type="submit" name="">Proceed</button></center></td></tr>

					</table>

					<table width="30%" style="float:right;"><tr><th>Cost Per Mile</th></tr>
					<tr><td>The Airline owners set their own Cost Per Mile between $1 - $5. Your flight will be calculated by the number of miles 
					to your destination and the Cost Per Mile. The airlines also need to counter in Fuel Consumption within their price and current cost of Fuel.
					</td></tr>
					</table>

					</div></div>';
				}
}
?>