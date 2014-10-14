<!doctype html>
<html>
<head>
			<title>Verify your Account - Criminal Warfare</title>
			<link type="text/css" rel="stylesheet" href="login.css" />
			<link type="text/css" rel="stylesheet" href="forum.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>

<?php
include_once "inclu/connect.php";
$dbh = dbconnect();

if ($_POST['submit']){

	$sql = "SELECT * FROM users WHERE email = '".$_POST['email']."'";
	$run = $dbh->query($sql);
	$row = $run->fetch(PDO::FETCH_ASSOC);

	if ($run->rowCount() == 0){
		$status = "No such email exist in our databse.";
	}

	if ($run->rowCount() == 1){

		if ($row['verify'] == 1){
			$status = "Your account is already verified.";
		}

		if ($row['verify'] == 0){
			$email = $_POST['email'];
			$username = $row['username'];
			$verify_key = $row['verify_key'];
			$message = "Hi $username,\r\nCriminal Warfare is waiting for you, still want to be the next criminal? Verify your account by clicking the link below!\r\nhttp://".$_SERVER['SERVER_NAME']."/verify.php?username=$username&verify_key=$verify_key";
				$message = wordwrap($message, 110, "\r\n");
				mail($email, 'Criminal Warfare Registration - Activation Reminder', $message);
				$status = "A new link has been emailed to you. Make sure to check your junk folder.";
		}

	}

}

if (!empty($_GET['username']) AND !empty($_GET['verify_key'])){
	$sql = "SELECT * FROM users WHERE username = '".$_GET['username']."' AND verify_key ='".$_GET['verify_key']."' AND verify = 1";
			$status = "This account is already activated! Proceed to <a href='index.php'>Login</a>";
		}

if (!empty($_GET['username']) AND !empty($_GET['verify_key'])){
	$sql = "SELECT * FROM users WHERE username = '".$_GET['username']."' AND verify_key ='".$_GET['verify_key']."' AND verify = 0";
	$run = $dbh->query($sql);
		if ($run->rowcount() == 1){
			$sql = "UPDATE users SET verify = 1 WHERE username = '".$_GET['username']."'";
			$run = $dbh->query($sql);
			$status = "Your account has been activated! Proceed to <a href='index.php'>Login</a>";
		}
}

		echo'<body><div class="container">
			<div class="loginbox">
		';
			if (!empty($status)) { echo '<center><div style="font-weight:bold;">' . "$status</div><br /><br /><hr> </center>"; }


if (empty($_GET['username']) OR empty($_GET['verify_key']) AND !isset($_POST['submit'])){
	echo '

	<form name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">

				<label>E-Mail address
				</label>
				<input type="text" name="email" value="" />

				<button type="submit" name="submit" value="Resend"/>Resend Activation</button>
				<hr>
				Go back to <a href="index.php">Login</a>

			</form>';
}