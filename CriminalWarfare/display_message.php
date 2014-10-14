<?php
ob_start();
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Messages</title>
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>

<?php
include "inclu/connect.php";
include_once "inclu/menu.php";
include "inclu/message.class.php";
require_once "inclu/ArticlePages.class.php";
not_logged_in();
$dbh = dbconnect();
$ID = $_GET['id'];
$reply = $_POST['reply'];
$del = $_POST['delete'];
$save = $_POST['save'];
$obj = new message;
		// reply
		if (isset($reply)){
			$obj->reply();
		}
		//delete
		if (isset($del)){
			echo '<div class="content">' . $obj->delete();
			echo '</div>';
		}
		//save
		if (isset($save)){
			$sql = "SELECT * FROM send_message WHERE id = " . $_SESSION['save_msgid'];
			$stmt = $dbh->query($sql);
			$row = $stmt->fetch(); 
			$from = $row['sentfrom'];
			$title = $row['title'];
			$message = $row['message'];
			echo '<div class="content">' . $obj->SaveMessage($from, $title, $message);
			echo '</div>';
		}
		// display messages
		if (empty($ID)){
			$sql = "SELECT * FROM send_message WHERE sendto = '". $_SESSION["user"] . "' ORDER BY id desc" . $pages->limit;
			$stmt = $dbh->query($sql);
			$result = $stmt->rowCount();
			$pages = new Paginator;
			$pages->items_total = $result;
			$pages->mid_range = 3;
			$pages->items_per_page = 10;
			$pages->paginate();
			$rows = $stmt->fetchAll(PDO::FETCH_BOTH); // we use fetchall as it's a foreach if normal if just use fetch else it brings back 2 assocs

			echo '<div class="container">

			<div class="contentwrap">
				<div class="content">';


			echo '<center><table id="diff"><tr><th colspan="3">View Messages [ View Page: ' . $pages->display_pages() . ']</th></tr>
			<tr><td class="subheader"><center>From</center>
			</td><td class="subheader"><center>Title</center></td><td class="subheader"><center>Date</center></td></tr>';

				foreach ($rows as $row) { 

					$squeel = "SELECT id from users WHERE username = '".$row['sentfrom']."'";
					$ressie = $dbh->query($squeel);
					$link = $ressie->fetch(PDO::FETCH_ASSOC);

					echo '<tr><td style="width:10%"><center><a href="profile.php?id=' . $link['id'] . '">' . $row["sentfrom"] . "</a></center></td>";
					echo '<td style="width:80%"><center>' . '<a href="display_message.php?id=' .  $row['id'] .'">' . $row["title"]  .  "</a> ";
					if ($row['visitied'] == 0){ echo '<div style="color:red;display:inline-block">  (new message)</div>'; }
					echo "</center></td>";
					echo "<td><center>" . $row['date'] . "</td></tr></center>";
				}
				echo '
				</div></table></div>';
		}
		// LIMIT TO 10 PER PAGE

		if (!empty($ID)){
			$ID = $_GET['id'];
			$sql = "SELECT * FROM send_message WHERE id = $ID AND sendto = '" . $_SESSION["user"] . "'";
			$stmt = $dbh->query($sql);
			$row = $stmt->fetch(); 
			$_SESSION['msgid'] = $ID;
			$_SESSION['save_msgid'] = $ID;
				if (!isset($_COOKIE['firstvisit']) ){ 
						setcookie('firstvisit', time());
						$SQL = "UPDATE send_message SET visitied = 1 WHERE id = $ID";
						$update = $dbh->prepare($SQL);
						$update->execute();
				}
				elseif (isset($_COOKIE['firstvisit']) ){ // bug fix
						setcookie('firstvisit', time());
						$SQL = "UPDATE send_message SET visitied = 1 WHERE id = $ID";
						$update = $dbh->prepare($SQL);
						$update->execute();
				}
			echo '<div class="container">

			<div class="contentwrap">
				<div class="content">';

				$squeel = "SELECT id from users WHERE username = '".$row['sentfrom']."'";
				$ressie = $dbh->query($squeel);
				$link = $ressie->fetch(PDO::FETCH_ASSOC);

			echo '<table width="100%"><tr><th>From: <a href="profile.php?id=' .$link['id'] . '">' . $row['sentfrom'] . ' </a>(' . $row['date'] . ")</th></tr>";
			echo '<tr><td class="subheader"><center>' . $row['title'] . "</center></td></tr>";
			echo  '<tr><td><div style="padding-left: 5px;">' . bbtag($row['message']) . '</div></td></tr></table>';

			echo '<center>
			<div style="display:inline-block;">

			<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">

			<button type="submit" name="delete" value="Delete"/>Delete</button>
			<button type="submit" name="reply" value="Reply"/>Reply</button>
			<button type="submit" name="save" value="Save Message"/>Save Message</button>

			</div></form>';
		}

?>