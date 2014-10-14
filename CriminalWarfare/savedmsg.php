<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Saved Messages</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>

<?php
include "inclu/connect.php";
include "inclu/menu.php";
include "inclu/message.class.php";
not_logged_in();
$dbh = dbconnect();
$ID = $_GET['id'];
$reply = $_POST['reply'];
$del = $_POST['delete'];
$obj = new message;
		//delete
		if (isset($del)){
			echo '<div class="content">' . $obj->Delete_SaveMessage();
			echo '</div>';
		}
		// display messages
		if (empty($ID)){
			$sql = "SELECT * FROM save_messsage WHERE sendto = '". $_SESSION["user"] . "'";
			$stmt = $dbh->query($sql);
			$rows = $stmt->fetchAll(PDO::FETCH_BOTH); // we use fetchall as it's a foreach if normal if just use fetch else it brings back 2 assocs
			echo '<div class="container">

				<div class="contentwrap">
					<div class="content">';

			echo '<center><table><tr><th colspan="3">Saved Messages</th></tr>
			<tr><td class="subheader"><center>From</center>
			</td><td class="subheader"><center>Title</center></td><td class="subheader"><center>Date</center></td></tr>';

				foreach ($rows as $row) {

					$squeel = "SELECT id from users WHERE username = '".$row['sentfrom']."'";
					$ressie = $dbh->query($squeel);
					$link = $ressie->fetch(PDO::FETCH_ASSOC);

					echo '<tr><td style="width:10%"><center><a href="profile.php?id=' . $link['id'] . '">' . $row["sentfrom"] . "</center></td>";
					echo '<td style="width:80%"><center>' . '<a href="savedmsg.php?id=' .  $row['id'] .'">' . $row["title"]  . "</a></center></td>";
					echo "<td><center>" . $row['date'] . "</td></tr></center>";

				}

			echo "</center></table></div>";

		}

		if (!empty($ID)){
			$ID = $_GET['id'];
			$sql = "SELECT * FROM save_messsage WHERE id = $ID AND sendto = '" . $_SESSION["user"] . "'";
			$stmt = $dbh->query($sql);
			$row = $stmt->fetch(); 
			$_SESSION['msgid'] = $ID;
			$_SESSION['save_msgid'] = $ID;
			

			echo '<div class="container">

				<div class="contentwrap">
					<div class="content">';

					$squeel = "SELECT id from users WHERE username = '".$row['sentfrom']."'";
					$ressie = $dbh->query($squeel);
					$link = $ressie->fetch(PDO::FETCH_ASSOC);

			echo '<center><table width="70%"></center><tr><th>From: <a href="profile.php?id=' . $link['id'] . '">' . $row['sentfrom'] . ' </a>(' . $row['date'] . ")</th></tr>";
			echo '<tr><td class="subheader"><center>' . $row['title'] . "</center></td></tr>";
			echo '<tr><td><div style="padding-left:5px;">' . nl2br(bbtag(linebreak($row['message']))) . '</div></td></tr></table>';
			echo '</div>
			<center>
			<div style="display:inline-block;">
			<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">
			<button type="submit" name="delete" value="Delete"/>Delete</button>
			</div></center></form>';
		}
?>