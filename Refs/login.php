<?php
session_start();
?>

<?php 
include('db_connection.php');

if (isset($_SESSION["user"])){
        redirect("member.php");
   }

   
$dbh = dbconnect();
if(!isset($_SESSION['user'])){
	if(isset($_POST['submit']))  {
	$dbh = dbconnect();
	$password = $_POST['password'];
	$username = strtolower($_POST['username']);
	$salt = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";
	$pHash = hash('sha256', $password.$salt);

		if(empty($password)){
		$status = "You did not enter a password! <br />";
		}
			if(empty($username)){
			$status = "You did not enter a username! <br />";
			}
				// wrong password
				$sql = "SELECT username,password FROM users WHERE username = '$username' AND password = '$pHash'";
				$result = $dbh->query($sql);
				if($result->rowcount() == 0){
				$status = "Incorrect Password.";
				}
					// username doens't exist
					$sql = "SELECT username FROM users WHERE username = '$username'"; 
					$result = $dbh->query($sql);
					if($result->rowCount() == 0){
					$status = "That username doens't exist";
					}
						$sql = "SELECT username,password FROM users WHERE username = '$username' AND password = '$pHash' AND verify = 0";
						$result = $dbh->query($sql);
						if($result->rowcount() == 1){
							$status = "Verify your e-mail address.";
						}

							// log them in
							$sql1 = "SELECT username,password FROM users WHERE username = '$username' AND password = '$pHash' AND verify = 1";
							$result1 = $dbh->query($sql1);
							if($result1->rowcount() == 1){
							logged_in();
							$status = "You are now logged in.". $_SESSION["user"] . " Retun to <a href='index.php'>Home</a>";
							}
					}

					echo '<html>
					<form class="login" name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">
					';
						if (!empty($status)) { echo "<b>$status</b>"; }
						echo '

					<p style="font-size: 1.2em;">Login</p>
					Username
					<input type="text" name="username" value="" /><br />
			
				
      				<label for="password">Password</label>
      				<input type="password" name="password" id="password" value=""><br />
   					
    			 	<br /><button type="submit" name="submit">Login</button>

    			 	<a href="register.php">Register</a>
  					

					</form>
					</body>
					</html>';
					}

?>