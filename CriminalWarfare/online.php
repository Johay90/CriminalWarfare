<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Online Players</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>

<?php
include "inclu/connect.php";
include "inclu/menu.php";
not_logged_in();
$dbh = dbconnect();

echo '<div class="container">

				<div class="contentwrap">
					<div class="content">
					
					<table width="100%"><tr><th>Online Users</th></tr>';

$sql = "SELECT * FROM users_online";
$result = $dbh->query($sql);
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
echo '<tr><td class="subheader"><span style="padding-left: 5px;">Total Users Online: </span>' . $result->rowCount() . '</td></tr><tr><td style="padding-left: 5px;">';
	foreach ($rows as $row){
		$findid = "SELECT id FROM users WHERE username = '" . $row['username'] . "'";
		$res = $dbh->query($findid);
		$id = $res->fetch();
		echo ' <a href="profile.php?id=' . $id['id'] . '">' . $row['username'] . "</a> - ";
	}
echo '</tr></td></table></html></body></div>';
?>