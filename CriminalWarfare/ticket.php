<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Ticket System</title>
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
echo '
	<div class="container">

			<div class="contentwrap">
				<div class="content">to do</div></div></div>';
?>