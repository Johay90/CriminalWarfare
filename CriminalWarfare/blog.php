<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Staff Blogs</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>

<?php
// TODO: Add functions so all usernames in db are lowercas.
include "inclu/connect.php";
include_once "inclu/menu.php";
require_once "inclu/ArticlePages.class.php";
	if(!isset($_SESSION["user"])){
		die();
	}
$dbh = dbconnect();

	$sql = "SELECT id FROM article";
	$stmt = $dbh->query($sql);
	$result = $stmt->rowCount();

	$pages = new Paginator;
	$pages->items_total = $result;
	$pages->mid_range = 3;
	$pages->items_per_page = 3;
	$pages->paginate();

		$sql = "SELECT title,article,username,date,id FROM article ORDER BY id DESC ". $pages->limit; 
		$result = $dbh->query($sql);
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);


		echo '<html><body> <div class="container">

			<div class="contentwrap">
				<div class="content">';

					echo '<center><table width="50%"></center><tr><th>Page Management</th></tr> <tr><td><center>View article page: ' . $pages->display_pages() . "<br />This blog is limited to 3 articles per page</center> </td></tr></table><br />";
	


		foreach($rows as $row){
			$title = $row['title'];
			$sql = "SELECT id FROM article WHERE title = '$title'"; 
			$result = $dbh->query($sql);
			$result->fetchAll(PDO::FETCH_ASSOC);

			echo '<table width="100%">';

			echo '<tr><th>' . $row['title'] . '<a href="view_article.php?id=' .  $row['id'] . '"> (View article)</a>';

					// del article link
					if ($row['username'] == $_SESSION['user']){
							echo '  <a href="blog.php?del=' . $row['id'] . '">(Delete this Article)</a>';
					}

					$squeel = "SELECT id from users WHERE username = '".$row['username']."'";
					$ressie = $dbh->query($squeel);
					$link = $ressie->fetch(PDO::FETCH_ASSOC);

				echo '</th></tr><tr><td class="subheader"><span style="padding-left: 5px;">This article was by </span><a href="profile.php?id=' . $link['id'] . '">' . $row['username'] . "</a><span> and was posted </span>" . $row['date'];

					 // count comments per article
					 $sql = "SELECT arcid FROM comments WHERE arcid = " . $row['id'];
			   		 $stmt = $dbh->query($sql);
			   		 $result = $stmt->rowCount();

				echo "<span> and has </span> $result <span> comments </span> </td></tr>";

				echo '<tr><td style="padding-left: 5px; padding-bottom: 5px;">' . bbtag(linebreak($row['article'])) . "</td></tr>";
						echo "</table><br /><br />";
		}


// limit per page
echo '<center><table width="50%"></center><tr><th>Page Management</th></tr> <tr><td><center>View article page: ' . $pages->display_pages() . "<br />This blog is limited to 3 articles per page</center> </td></tr></table><br />";
// delete article
if ($_GET['del']) {
	$ID = $_GET['del'];
	$sql = "DELETE from article WHERE id = $ID AND username = '" . $_SESSION['user'] . "'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	redirect("blog.php");
}
?>