<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Site Stats</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>

<?php
include "inclu/connect.php";
include_once "inclu/menu.php";
not_logged_in();
$dbh = dbconnect();

	echo '<div class="container">

			<div class="contentwrap">
				<div class="content">

				<table width="100%"><tr><th colspan="6">Site Stats</th></tr>
	</div>
		<tr>
		<td class="subheader" width="16%"><span style="padding-left: 5px;">Number of Signups</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM users";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Online users</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM users_online";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Total Banned Users</span></td>
		<td align="center" width="16%" style="border: 1px solid black">Do at later date</td>


		</tr><tr>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Number of unactivated users</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM users WHERE access = 0";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Number of activated users</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM users WHERE access = 1";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Number of Mods</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM users WHERE access = 4";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>

		</tr><tr>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Number of Forum Topics</span></td>
		<td align="center" width="16%" style="border: 1px solid black">Do at later date</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Average online users</span></td>
		<td align="center" width="16%" style="border: 1px solid black">Do at later date</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Number of Admins</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM users WHERE access = 5";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>

		</tr><tr>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Number of Forum comments</span></td>
		<td align="center" width="16%" style="border: 1px solid black">Do at later date</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Total messages sent</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM send_message";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Total messages saved</span></td>
		<td align="center" width="16%" style="border: 1px solid black">';
		$sql = "SELECT * FROM save_messsage";
		$stmt = $dbh->query($sql); 
		echo $stmt->rowCount() . '</td>
	
		<tr><th style="background-color: #33CCFF" colspan="6">Last 24 hours</th></tr>

		<tr>
		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>


		</tr><tr>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		</tr><tr>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		</tr><tr>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		<td class="subheader" width="16%"><span style="padding-left: 5px;">Do at later date</span></td>
		<td align="center" width="16%" style="border: 1px solid black"></td>

		</table><table width="50%" style="float:left" id="diff">
		<tr>
		<th colspan="3">Last 10 signups</th></tr>

		<tr>
		<td class="subheader" align="center" width="16%"><span>Name</span></td>
		<td class="subheader" align="center" width="16%"><span>Sign up time</span></td>
		<td class="subheader" align="center" width="16%"><span>Rank</span></td>
	
		</tr>';
		$sql = "SELECT username,signedup,id FROM users ORDER BY id LIMIT 10";
		$stmt = $dbh->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($result as $row){

		echo '<tr><td align="center" width="16%"><a href="profile.php?id=' . $row['id'] . '">' . $row['username'] . '</a></td>';
		echo '<td align="center" width="16%">'. $row['signedup'] . '</td>';
		echo '<td align="center" width="16%">'. "need to add" . '</td>';

		'</tr>';
		}
		echo '</table>
		<table width="50%" style="float:right;" id="diff">
		<tr><th colspan="3">Last 10 Kills</th></tr><tr>

		<td class="subheader" align="center" width="16%"><span>Name</span></td>
		<td class="subheader" align="center" width="16%"><span>Death time</span></td>
		<td class="subheader" align="center" width="16%"><span>Rank</span></td></tr>';

		$sql = "SELECT username,signedup FROM users ORDER BY id LIMIT 10";
		$stmt = $dbh->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($result as $row){

		echo '<tr><td align="center" width="16%">'. "need to add" . '</td>';
		echo '<td align="center" width="16%">'. "need to add" . '</td>';
		echo '<td align="center" width="16%">'. "need to add" . '</td>';

		'</tr>';

	}

	
		echo '</table>
		</div></div>';

		?>