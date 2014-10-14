<?php
session_start();
?>
<!doctype html>
<html>
<head>
<title>Criminal Warfare - Search User </title>
<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
</html>

<?php
include "inclu/connect.php";
include_once "inclu/menu.php";
$dbh = dbconnect();
not_logged_in();
$user = $_POST['user'];

		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if (empty($user)){
				$status = "You forgot to type the user you which to search for.";
			}
		}

echo '<div class="container">

				<div class="contentwrap">
					<div class="content">';

echo '<table width="60%" align="center"><tr><th>Search User</th></tr>';

echo '<form name="news" method="POST" action="'. $_SERVER['PHP_SELF'] . '">
<div style="display:inline-block">
<tr><td align="center">Username:
<input type="text" name="user" value=""/>
<button type="submit" name="submit" value="search" />Search</button>';
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$sql = "SELECT username,id FROM users WHERE username = '". $user . "'";
		$stmt = $dbh->query($sql);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (empty($user)){
			$status = "You forgot to type the user you which to search for.";
		}
		if ($stmt->rowCount() >= 1){
			echo "<center>Users found: <b>";
			foreach ($rows as $row) {
				echo '<a href="profile.php?id=' . $row['id'] . '">' . $row['username'] ."</a><br />";
			}
			echo "</center>";
		}
		if($stmt->rowCount() == 0){
			echo "<br />No user with that name could be found";
		}
	}



echo '</td></tr></table></div></div></form></body></html>';
?>