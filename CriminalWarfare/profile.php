<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Profile</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>
<?php
include_once "inclu/menu.php";
include_once "inclu/connect.php";
not_logged_in();
$dbh = dbconnect();
$id = $_GET['id'];

	if (!empty($id)){
		$sql = "SELECT * FROM users WHERE id = $id";
		$result = $dbh->query($sql);
		$rows = $result->fetch(PDO::FETCH_ASSOC); 

		$sql1 = "SELECT * FROM users_online WHERE username = '" . $rows['username'] . "'";
		$result1 = $dbh->query($sql1);


		echo '<div class="container">

				<div class="contentwrap">
					<div class="content">
					<table width="90%" align="center"><tr><th colspan="4" >' . $rows['username'] . "'s Profile Page</th></tr></div>";

		echo '	<tr>
		<td class="subheader"><span style="padding-left: 5px;">Username</span></td>
		<td align="center">' . $rows['username'] . '</td>
		<td class="subheader"><span style="padding-left: 5px;">Status</span></td>
		<td align="center" style="border: 1px solid black">';
			if ($result1->rowCount() == 1) { 	echo '<div style="color:#00CC00">Online</div>'; } 
			else { 								echo '<div style="color:#FF0000">Offline</div>'; }
		echo '</td>
		</tr><tr>

		<td class= "subheader"><span style="padding-left: 5px;">Rank</span></td>
		<td align="center" style="border: 1px solid black">';
		if ($rows['access'] == 0){ echo "Banned"; }
		elseif ($rows['access'] == 1){ echo "User"; }
		elseif ($rows['access'] == 2){ echo "Donator"; }
		elseif ($rows['access'] == 3){ echo "Forum Moderator"; }
		elseif ($rows['access'] == 4){ echo "Site Moderator"; }
		elseif ($rows['access'] == 5){ echo '<div style="color:red;font-weight:bold;">Site Administrator</div>';
		echo'</td>'; }

		echo '<td class= "subheader"><span style="padding-left: 5px;">Signed Up</span></td>
		<td align="center" style="border: 1px solid black">' . $rows['signedup'] . '</td>

		</tr><tr>';
		echo'<td class= "subheader"><span style="padding-left: 5px;">Power Rank</span></td>
		<td align="center" style="border: 1px solid black">'. $rows['rank'] . '</td>';

		echo'<td class= "subheader"><span style="padding-left: 5px;">Wealth</span></td>
		<td align="center" style="border: 1px solid black">'. $rows['money_status'] . '</td></tr>';

		echo'<tr><td class= "subheader" colspan="4" align="center"><span style="padding-left: 5px;">Quote</span></td></tr>
		<tr><td align="center" style="border: 1px solid black" colspan="4">'. bbtag($rows['profile']) . '</td>';

			echo '</tr><table>';

		echo '</div></div>';
	}
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$text = linebreak(strip_tags($_POST['profile_text']));
	$submit_text = $_POST['update_profile'];
	$view = $_POST['view_profile'];
	$passsubmit = $_POST['chng_pass'];

		if (isset($submit_text)){
			if (!isset($text)){
				$status = "A error occured..";
			}
			if (isset($text)) {
				$sql = "UPDATE users SET profile = :profile_text WHERE username = '" . $_SESSION['user'] . "'";
				$r = $dbh->prepare($sql);
				$r->bindValue(':profile_text', $text);
				$r->execute();
				$status = "Profile Updated";
			}
		}
		if (isset($view)){
			$sql = "SELECT * FROM users WHERE username = '" . $_SESSION['user'] . "'";
			$r = $dbh->query($sql);
			$row = $r->fetch();
			if ($row['username'] == $_SESSION['user']){
				redirect('profile.php?id=' . $row['id']);
			}
		}
			if (isset($passsubmit)){
				$password = $_POST['currpass'];
				$newpass1 = $_POST['newpass2'];
				$salt = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";
				$newpass = $_POST['newpass'];
				$oldpHash = hash('sha256', $password.$salt);
				$newpHash = hash('sha256', $newpass.$salt);
				$username = $_SESSION['user'];

				if ($password){
						$sql = "SELECT password FROM users WHERE username = '$username' AND password = '$oldpHash'";
						$result = $dbh->query($sql);
							if($result->rowcount() == 0){
								$pass_status = "Incorrect current password.";
							}
				}
					if ($password AND !empty($newpass) AND $newpass == $newpass1) {
					$sql = "SELECT password FROM users WHERE username = '$username' AND password = '$oldpHash'";
					$result = $dbh->query($sql);
						if($result->rowcount() == 1){
							$sql = "UPDATE users SET password = :newpass WHERE username = '$username'";
							$stmt = $dbh->prepare($sql);
							$stmt->bindValue(':newpass', $newpHash);
							$stmt->execute();
							$pass_status = "Changed password.";
						}
					}
					if ($newpass != $newpass1){
						$pass_status = "Your new passwords do not match";
					}	
					if (empty($password) OR empty($newpass1) OR empty($newpass)){
						$pass_status = "Make sure you filled out the relevant fields (not leaving any blank).";
					}
			}
}

	if (empty($id)){;
		echo '<div class="container">

				<div class="contentwrap">
					<div class="content">';

		if (!empty($status)) { echo "$status <br /><br />"; }
		echo '<table width="100%"><tr><th>Update Profile</th></tr>';
		echo '<form name="profile" method="POST" action="'. $_SERVER['PHP_SELF'] . '">';
		$sql = "SELECT profile FROM users WHERE username = '" . $_SESSION['user'] . "'";
		$r = $dbh->query($sql);
		$fetch = $r->fetch(PDO::FETCH_ASSOC);
		echo '<tr><td><textarea name="profile_text" rows="20" cols="210">' . $fetch['profile'] . '</textarea>';

		echo '<center><button type="submit" name="update_profile" value="Update Profile" />Update Profile</button>
		<button type="submit" name="view_profile" value="View Profile" />View Profile</button>
		</tr></td></table><br />';

		if (!empty($pass_status)) { echo "$pass_status<br /><br />"; }
		echo '<table width="80%" align="center"><tr><th>Change Password</th></tr>
		<form name="profile" method="POST" action="">

		<tr><td>Current Password
		<input type="password" name="currpass" value="">

		New Password
		<input type="password" name="newpass" value="">

		Verify Password:
		<input type="password" name="newpass2" value="">

		<button type="submit" name="chng_pass" value="Change Password" />Change Password</button>
		</form></div></td></tr></table>'; 
	}
?>