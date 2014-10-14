<!doctype html>
<html>
<head>
			<title>Forgotten Password - Criminal Warfare</title>
			<link type="text/css" rel="stylesheet" href="login.css" />
			<link type="text/css" rel="stylesheet" href="forum.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>


<?php
include_once "inclu/connect.php";
$dbh = dbconnect();

if (isset($_POST['submit'])){

	$username = $_POST['username'];

	$sql = "SELECT * FROM users WHERE username = '$username'";
	$run = $dbh->query($sql);
	$row = $run->fetch(PDO::FETCH_ASSOC);

	if ($run->rowCount() == 0){
		$status = "This username doens't exist.";
	}

	if ($run->rowcount() == 1){

	$email = $row['email'];
	$verify_key = $row['verify_key'];

	$message = "Hi, $username\r\nThis email address has just requested a new password on Criminal Warfare, click the link below to generate a new password!\r\nhttp://".$_SERVER['SERVER_NAME']."/forgot_pass.php?username=$username&verify_key=$verify_key";
	$message = wordwrap($message, 110, "\r\n");
	mail($email, 'Criminal Warfare Password Instructions', $message);

	$status = "Follow the instructions enclosed inside the email that's just been sent.";

	}

}

	if (!empty($_GET['username']) AND !empty($_GET['verify_key']) AND !isset($_POST['submit'])){

		$sql1 = "SELECT * FROM users WHERE username = '".$_GET['username']."'";
		$run1 = $dbh->query($sql1);
		$row1 = $run1->fetch(PDO::FETCH_ASSOC);

		if (strtolower($_GET['username']) != strtolower($row1['username']) OR strtolower($_GET['verify_key']) != strtolower($row1['verify_key'])){
			$status = "Unathorlized request, make sure you clicked the correct link within the email.";
		}

		if (strtolower($_GET['username']) == strtolower($row1['username']) && strtolower($_GET['verify_key']) == strtolower($row1['verify_key'])){
			$salt = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

			$email = $row1['email'];
			$rand = md5(mt_rand(12, 64));

			$update = "UPDATE users SET password = :password WHERE username = '".$_GET['username']."'";
			$run = $dbh->prepare($update);
			$run->bindValue(":password", hash("sha256", $rand.$salt), PDO::PARAM_STR);
			$run->execute();

			$username = $_GET['username'];

			$message = "Hi, $username\r\nYou have just requested a new password on Criminal Warfare, your new password is: $rand";
			$message = wordwrap($message, 210, "\r\n");
			mail($email, 'Criminal Warfare New Password', $message);

			$status = "A new password has been sent to your email.";
		}
	}

	if (!empty($_GET['username']) OR !empty($_GET['verify_key']) AND !isset($_POST['submit'])){
	echo '<body><div class="container">
			<div class="loginbox">';

				if (!empty($status)) { echo '<center><div style="font-weight:bold;">' . "$status</div<hr> </center>"; }

	}

if (empty($_GET['username']) OR empty($_GET['verify_key']) AND !isset($_POST['submit'])){
echo '<body><div class="container">
			<div class="loginbox">';

				if (!empty($status)) { echo '<center><div style="font-weight:bold;">' . "$status</div<hr> </center>"; }
				echo '<p><center>Lost Password</center></p>';

		echo '<hr>

			 	<form name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">';

				echo '<label>Username
				</label>
				<input type="text" name="username" value="" />

				<button type="submit" name="submit" value="Send new password!"/>Send new password!</button>
				<hr>
				Go back to <a href="index.php">Login</a>

			</form>
		</div>
	</body>
</html>';
}