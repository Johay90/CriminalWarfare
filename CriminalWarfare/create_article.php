<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title> Criminal Warfare - Create Article</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>
<?php
include "inclu/connect.php";
include "inclu/menu.php";
not_logged_in();
$dbh = dbconnect();

if($_SERVER['REQUEST_METHOD'] == "POST")  {
$title = $_POST['title'];
$username = $_SESSION["user"];
$article = nl2br(htmlspecialchars($_POST['article']));
$date = date('Y-m-d');
$sql = "SELECT username FROM article WHERE username = '$username'";
$result = $dbh->query($sql);

		if($result->rowcount() >= 15){
			$status = "You already have the maximum number of articles on this blog.";
		}

			if (!empty($title) AND !empty($article) AND $result->rowCount() <= 15){
				$sql = "INSERT INTO article (title, article, username, date) VALUES (:title, :article, :username, :date)";
				$r = $dbh->prepare($sql);
				$r->bindValue(':title', $title);
				$r->bindValue(':article', $article);
				$r->bindValue(':username', $username);
				$r->bindValue(':date', $date);
				$r->execute();	
				$status = "Article Added";
			}
				if (empty($title)){
					$status = "You did not enter a title <br />";
				}
						if (empty($article)){
							$status = "You forgot to add your article!";
					}

}
   

		echo '<html><body> <div class="container">

			<div class="contentwrap">
				<div class="content">';
			if (!empty($status)) {
				echo "<center> $status </center> <br />";
			}
		echo '<center><table width="70%"></center><tr><th>Post an article</th></tr>';

		echo '<form name="post_article" method="POST" action="'. $_SERVER['PHP_SELF'] . '">

		<tr><td>Title:
		<input type="text" name="title" value="" style="width:96%;"/>

		<textarea name="article" rows="12" cols="30"></textarea>

		<div style="float: right;"><button type="submit" name="submit" value="Submit Article"/>Submit Article</button></div>

		</tr></td></table></form></div></body></html>';
?>