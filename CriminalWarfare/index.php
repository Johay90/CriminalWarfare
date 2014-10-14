<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Index page - Criminal Warfare</title>
			<link type="text/css" rel="stylesheet" href="login.css" />
			<link type="text/css" rel="stylesheet" href="forum.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
<?php
include_once "inclu/connect.php";
include_once "inclu/menu.php";
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

					echo '<html><body><div class="container">

					<div class="box">

					<h2>Alpha Devlopment</h2>
					<p>This is currently the testing site for Criminal Warfare.</p>

					<hr>

					<h2>Private Devlopment</h2>

					<p>CriminalWarfare is a text-based game giving players the opportunity to experience being a member of a modern Mafia. 
					Bringing you features such as doing solo crimes or teaming up with friends to compete in organised activities to take bigger loads. 
					Bringing both player reputation and Mafia reputation so not only can you become the strongest criminal on the game but also strongest Mafia.
					More information on game features and release dates coming soon, stay tuned and connect with us on social media below.

					</div>

					<div class="loginbox">
					<form class="login" name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">
					';
						if (!empty($status)) { echo "<center><b>$status</b><hr></center>"; }
						echo '

					<p style="font-size: 1.2em;"><center>Login</p></center><hr class="loginbox">
					<label>Username</label>
					<input type="text" name="username" value="" /><br />
			
				
      				<label for="password">Password</label>
      				<input type="password" name="password" id="password" value=""><br />
   					
    			 	<center><br /><button type="submit" name="submit">Login</button><hr></center>

    			 	<center><a href="verify.php">Resend Activation</a> | <a href="forgot_pass.php">Forgotten Password</a> | <a href="register.php">Register</a></center>
  					

					</form>
					</div>

					</div>
					</body>
					</html>';
					}

if(isset($_SESSION['user'])){
	$title = $_POST['title'];
	$news = nl2br($_POST['news']);
	$date = $date = date('y-m-d H:i:s');
	$sql = "SELECT * FROM news ORDER BY id DESC "; 
	$result = $dbh->query($sql);
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);

	echo '<!DOCTYPE html><body><head>

	<link type="text/css" rel="stylesheet" href="main.css" /></head>

	<div class="container">

			<div class="contentwrap">
				<div class="content">';

					foreach($rows as $row){

						$title = $row['title'];

						$sql = "SELECT id FROM news WHERE title = '$title'"; 
						$del_id = $_GET['delete'];
						$result = $dbh->query($sql);
						$result->fetchAll(PDO::FETCH_ASSOC);

						echo '<table width="100%">';

							echo '<tr><th>' . $row['title'];

							if ($stmt->rowCount() == 1){
									$sql = "SELECT * FROM news";
									$stmt = $dbh->query($sql);
									$stmt->fetch();
									echo '<a class="news" href="index.php?delete=' . $row['id'] . '">[Delete]</a>';
								}

								$squeel = "SELECT id from users WHERE username = '".$row['username']."'";
								$ressie = $dbh->query($squeel);
								$link = $ressie->fetch(PDO::FETCH_ASSOC);

							echo '</th></tr>
							<tr><td class="subheader"><p class="alignleft"><span>Posted by </span><a href="profile.php?id=' . $link['id'] . '">' . $row['username'] . '</a></p> 
							<p class="alignright"><span>Submitted on date: </span>' . $row['date'] . '</td></tr></p>';

								$sql = "SELECT * FROM users WHERE access = 5 AND username = '". $_SESSION["user"] . "'";
								$stmt = $dbh->query($sql);
						echo '<tr><td style="padding-left: 5px;">';
						echo  $row['news'];
						echo '</td></tr></table><br />';

					}

	if(!empty($del_id)){
		$sql = "SELECT * FROM users WHERE access = 5 AND username = '". $_SESSION["user"] . "'";
		$stmt = $dbh->query($sql);
		if ($stmt->rowCount() == 1){
			$sql = "DELETE FROM news WHERE id = $del_id";
			$smnt = $dbh->prepare($sql);
			$smnt->execute();
			redirect("index.php");
			}
		}

			if($_SERVER['REQUEST_METHOD'] == "POST"){
				if (empty($title)){
					$status = "You forgot to add a title";
				}
				if (empty($news)){
					$status = "If you submit news, at least add news.";
				}
				$sql = "SELECT * FROM users WHERE access = 5 AND username = '". $_SESSION["user"] . "'";
				$stmt = $dbh->query($sql);
				if ($stmt->rowCount() != 1){
					$status = "You are no admin!";
				}
				if (!empty($title) AND !empty($news) AND $stmt->rowCount() == 1){
					$sql = "INSERT INTO news (title,news,username,date) VALUES (:title,:news,:username,:date)";
					$i = $dbh->prepare($sql);
					$i->bindValue(":title", $_POST['title']);
					$i->bindValue(":news", $news);
					$i->bindValue(":username", $_SESSION["user"]);
					$i->bindValue(":date", $date);
					$i->execute();
					$status = "News has been posted!";
					redirect("index.php");
				}
			}

				// post news if user access 5 (super admin)
				$sql = "SELECT * FROM users WHERE access = 5 AND username = '". $_SESSION["user"] . "'";
				$stmt = $dbh->query($sql);
					if ($stmt->rowCount() == 1){
						echo '<table width="40%" id="tablecenter">
						<tr><th>Post News</th></tr>';

						echo '<form name="news" method="POST" action="'. $_SERVER['PHP_SELF'] . '">

						<tr><td>Title:
						<input type="text" name="title" value="" class="postnews" /></tr></td>

						<tr><td><textarea name="news" rows="7" class="postnews"></textarea></tr></td>

						<tr><td><center><button type="submit" name="submit" value="Submit News" />Submit News</button></center></tr></td>

						</table></form></div></div></div></body></html>';
					}
	}

?>