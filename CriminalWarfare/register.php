<!doctype html>
<?php
include_once "inclu/connect.php";
$dbh = dbconnect();

if($_SERVER['REQUEST_METHOD'] == "POST")  {
	$email 	  	= strtolower($_POST['email']);
	$email2 	= strtolower($_POST['email2']);
	$password 	= $_POST['password'];
	$password2	= $_POST['password2'];
	$username 	= $_POST['username'];
	$signupDate	= $signupDate = date('H:i:s A, y-m-d');
	$salt = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";
			if(empty($email)){
				$status = "You did not enter a email-address! <br />";
			}
			if(empty($password)){
				$status = "You did not enter a password! <br />";
			}
			if(empty($username) OR strlen($username) <= 2){
				$status = "Username should be at least 3 characters<br />";
			}

			if($password != $password2){
				$status = "Your passwords do not match.";
			}
			if($email != $email2){
				$status = "Your emails do not match.";
			}

			$sql= "SELECT email FROM users WHERE email = '$email'"; 
			$stmt1 = $dbh->query($sql); 
			$stmt1->execute(array(':email' => "$email"));
			$row = $stmt1->fetch();
				if(strtolower($email) == strtolower($row['email']) AND strlen($email) >= 2){
				$status = "That email already exist";
			}

			$sql= "SELECT username FROM users WHERE username = '$username'"; 
			$stmt = $dbh->query($sql); 
			$stmt->execute(array(':username' => strtolower("$username")));
			$row = $stmt->fetch();
				if(strtolower($username) == strtolower($row['username']) AND strlen($username) >= 3){
				$status = "That username already exist";
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   				$status = "That email is not a valid e-mail address.";
			}

			if (preg_match('/\s/',$username)){
				$status = "Spaces in usernames are not allowed.";
			}

			// check to see username and email don't exist
				elseif(!empty($email) AND !empty($password) AND !empty($username) AND $password == $password2 AND strtolower($email) == strtolower($email2) AND strlen($username) >= 3 AND $stmt->rowCount() == 0 AND $stmt1->rowCount() == 0 AND filter_var($email, FILTER_VALIDATE_EMAIL) AND preg_match('/\s/',$username) == FALSE) {	
				$sql = "INSERT INTO users (username,email,password,signedup,verify_key) VALUES (:username,:email,:password,:signedup,:verify_key)";
				$q = $dbh->prepare($sql);
				$verify_key = sha1(rand());
				$q->bindValue(':username', $username);
				$q->bindValue(':email', $email);
				$q->bindValue(":password", hash("sha256", $password.$salt), PDO::PARAM_STR);
				$q->bindValue(':signedup', $signupDate);
				$q->bindValue(':verify_key', $verify_key);
				$q->execute();
				$status = "Your details have been registered and a activation link has been mailed to you. Please " . '<a href="index.php">Login</a> after you have activated your account.';
				// send email
				$message = "Hi $username,\r\nCriminal Warfare is waiting for you, still want to be the next criminal? Verify your account by clicking the link below!\r\nhttp://".$_SERVER['SERVER_NAME']."/verify.php?username=$username&verify_key=$verify_key";
				$message = wordwrap($message, 110, "\r\n");
				mail($email, 'Criminal Warfare Registration', $message);
			}

}

echo'<html>
	<head>
		<title>Register page - Criminal Warfare</title>
		<link type="text/css" rel="stylesheet" href="login.css" />
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body><div class="container">
			<div class="loginbox">
		';
			if (!empty($status)) { echo '<center><div style="font-weight:bold;">' . "$status</div<hr> </center>"; }
		echo '<p><center>Register Process</center></p>

		<hr>

			<form name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">

				<label>Username
				</label>	   
				<input type="text" name="username" value="" />

				<label>E-Mail address
				</label>
				<input type="text" name="email" value="" />

				<label>Verify E-Mail address
				</label>
				<input type="text" name="email2" value="" />

				<label>Password
				</label>	    
				<input type="password" name="password" value="" />

				<label>Verify Password
				</label>	    
				<input type="password" name="password2" value="" />

				<button type="submit" name="submit" value="Register"/>Register</button>
				<hr>
				Go back to <a href="index.php">Login</a>

			</form>
		</div>
	</body>
</html>';

