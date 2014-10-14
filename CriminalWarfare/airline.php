<?php
session_start();
?>
<!doctype html>
<html><head>

			<title>Criminal Warfare - Airline</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
			</html>

<?php 

include_once "inclu/connect.php";
include_once "inclu/menu.php";
include_once "inclu/class.php";

not_logged_in();
jail();
script_check();
$dbh = dbconnect();

if(!$_GET['manage']){

	if(isset($_POST['submit'])){
		
		if (isset($_POST['airline'])){

			$i = "SELECT * from airlines WHERE owner = '".$_SESSION['user']."'";
			$k = $dbh->query($i);
			$count = $k->rowCount();

			if ($count == 1){

				$status = "You already have an airline company.";

			}

			$name = strip_tags(trim($_POST['airline']));
			$username = $_SESSION['user'];

				if (empty($name)){

					$status = "To create a new Airline, you must give it a name.";
				}

			$sql = "SELECT wealth FROM users WHERE username = '$username'";
			$money = $dbh->query($sql);
			$row = $money->fetch(PDO::FETCH_ASSOC);

				if ($row['wealth'] <= 10000000){

					$status = "You do not have $10,000,000 to create an airline company.";
				}

			$sql1 = "SELECT * FROM airlines";
			$limit = $dbh->query($sql1);

				if ($limit->rowCount() == 5){

					$status = "No Airline slots are currently avilable.";
				}

				if (!empty($name) AND $row['wealth'] >= 10000000 AND $limit->rowCount() != 5 AND $count != 1){

					$obj = new core();
					$obj->CreateAirline($username, $name, 10000000, 0, 0);

					$status = "Airline <b>$name</b> has been created.";
				}
		}
	}

			echo '<div class="container">

			<div class="contentwrap">
				<div class="content">';

				echo '<table width="100%"><tr><th>Create a new airline</th></tr>

				<form name="create_airline" method="POST" action="' . $_SERVER['PHP_SELF'] . '">';

				if (isset($status)) echo "$status <br /><br />";

				echo '<tr><td class="subheader"><span style="padding-left: 5px;">A new airline costs $10,000,000! </span></tr></td>

				<tr><td><div style="padding-left:5px;"> Company Name

				<input type="text" name="airline" value="">

				<button type="submit" name="submit" value="Create" />Create</button></form>
				<form name="create_airline" method="POST" action="airline.php?manage=yes" >
				<center><button type="submit" name="manage">Manage Airline</button></form></center>

				</div></tr></td></table>';
}

if($_GET['manage']){

	$none = "SELECT * FROM airlines WHERE owner = '".$_SESSION['user']."'";
	$zero = $dbh->query($none);
	$counterinho = $zero->rowCount();



	if (isset($_POST['submit_name'])) {

		$chgname = $_POST['airline'];

			if(!empty($chgname)){

				$sql = "SELECT wealth FROM users WHERE username ='".$_SESSION['user']."'";
				$result = $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);

					if($row['wealth'] >= 5000000){
										
						$sql = "UPDATE airlines SET name = '$chgname' WHERE owner ='".$_SESSION['user']."'";
						$result = $dbh->query($sql);
		
						$obj = new core;
						$obj->takeMoney(5000000);
		
						$manage_status = "Name Change sucessful!";
					}

					elseif($row['wealth'] <= 4999999){

						$manage_status = "You do not have enough money to change this company name!";
					}
			}
	}
		if (isset($_POST['submit_cpm'])) {	

			$cpm = $_POST['cpm'];

				if(!empty($cpm)){

					if ($cpm >= 6 OR $cpm <= 0){

						$manage_status = "Cost Per Mile can only be between $1 and $5";
					}


					if ($cpm >= 0 AND $cpm <= 5){

						$sql = "UPDATE airlines SET cpm = '$cpm' WHERE owner = '".$_SESSION['user']."'";
						$update = $dbh->query($sql);

						$manage_status = "CPM updated.";
					}
				}
		}	

	if(isset($_POST['withdraw_all'])){

		$sql = "SELECT bank FROM airlines WHERE owner ='".$_SESSION['user']."'";
		$result = $dbh->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);

			if($row['bank'] >= 1){

				$obj = new core;
				$obj->giveMoney($row['bank']);

				$sql = "UPDATE airlines SET bank = 0 WHERE owner = '".$_SESSION['user']."'";
				$update = $dbh->query($sql);

				$manage_status = "<b>$" . number_format($row['bank'], "0") . "</b> has been added to your account.";
			}

			elseif($row['bank'] <= 1){
				$manage_status = "You need to have money in the Compnay Account before withdrawing it.";
			}
	}


	$sql = "SELECT * FROM airlines WHERE owner ='".$_SESSION['user']."'";
	$result = $dbh->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);


	echo '<div class="container">

			<div class="contentwrap">
				<div class="content">';

			if ($counterinho == 0){

		echo "You do not own a Airline to manage..";

		}else{

			echo '<table width="69%" style="float:left">

			<form name="update_airline" method="POST" action="' . $_SERVER['PHP_SELF'] . '?manage=yes">';

			if (isset($manage_status)){ echo "$manage_status<br /><br />"; }

			echo '<tr><th>Manage Company Name</th></tr>

			<tr><td class="subheader"><span style="padding-left: 5px;">Company Information</span></td></tr>

			<tr><td><span style="padding-left: 5px;">Company Name: &nbsp;&nbsp;' . $row['name'];


		echo '<br /><span style="padding-left: 5px;">	Company Balance:</span> &nbsp;&nbsp;$' . number_format($row['bank'], "0");


		echo '<br /><span style="padding-left: 5px;">	Fuel left:</span> &nbsp;&nbsp;' . number_format($row['fuel'] / 100, "0") . " Lts ";


		echo '<br /><span style="padding-left: 5px;">	Current Cost Per Mile:</span> &nbsp;&nbsp;$' . number_format($row['cpm'], "0");


		echo '<br /><span style="padding-left: 5px;">  Change Company name:
				
		
			<input type="text" name="airline" value="">
			

			<button type="submit" name="submit_name">Update Airline Name</button>
			* It costs $5,000,000 to change name </tr><td></table><table style="float:right" width="30%">

			<tr><th>Send Company</tr></th>

			<tr><td>Send Company to:

			<input type="text" name="sendto" value="" disabled="disabled"><br />
			<button type="submit" name="namezzz" disabled="disabled">Send Airline!</button>* Currently disabled.</tr></td></table>

			<table style="float:right; margin-top: 1em;" width="30%">

			<tr><th>Manage Company CPM</tr></th>

			<tr><td>
			Set Cost Per Mile (CPM):
			
			<select name="cpm">
				<option value="1">$1</option>
				<option value="2">$2</option>
				<option value="3">$3</option>
				<option value="4">$4</option>
				<option value="5">$5</option>
			</select><br />

			<button type="submit" name="submit_cpm">Update Airline CPM</button></tr></td></table>

			<table width="69%" style="float: left; margin-top: 1em;">

			<tr><th>Withdraw Company Money</th></tr>
			<tr><td>

			<button type="submit" name="withdraw_all">Withdraw All</button> * Fuel will be added automatically once you buy it from the Fuel Station. You are also able to set sponserships up with the Fuel Station owners.
			</div></tr><td></table>';
		}
}

?>