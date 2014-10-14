<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - View Article</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>
<?php
include "inclu/connect.php";
include_once "inclu/menu.php";
$ID = $_GET['id'];
not_logged_in();
$dbh = dbconnect();

	$sql = "SELECT title,article,username,date,id FROM article WHERE id = $ID";
	$result = $dbh->query($sql);
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);

		foreach($rows as $row){
			echo '<html><body> <div class="container">

			<div class="contentwrap">
				<div class="content">';

			echo '<table width="100%"><tr>';
			echo '<th>' . $row['title'] . '</th></tr>';
			echo '<td class="subheader"><div style="padding-left: 5px;"><span> This article was by </span>' . $row['username'] . "<span> and was posted </span>" . $row['date'] . "</div></td></tr>";
			echo  '<tr><td><div style="padding-left: 5px;">'. nl2br(bbtag(linebreak($row['article']))) . '</div></td></tr>';
			echo '</table><br />';
		}

//comments
$sql = "SELECT cid,username,comment,arcid FROM comments WHERE arcid = $ID";
$result = $dbh->query($sql);
$comment = $result->fetchAll(PDO::FETCH_ASSOC);
foreach($comment as $row){
	echo '<html><body><table width="50%">';
	echo '<tr><th> ' . $row['username'] ;
	
		if ($row['username'] == $_SESSION['user']){

			echo '<a href="view_article.php?id=' . $ID . "&del_comment=" . $row['cid'] . '"> (Delete this comment)</a></th></tr>';
			$del = $_GET['del_comment'];

				if (isset($_GET['del_comment'])){

					$sql = "DELETE from comments WHERE cid = $del AND username = '" . $_SESSION['user'] . "'";
					$stmt = $dbh->prepare($sql);
					$stmt->execute();
					$del_status = "Deleted your comment.";

				}
	}
	echo '<tr><td>';
	echo  nl2br(bbtag(linebreak($row['comment'])));
	echo '</td></tr></table><br />';
}

// post a comment
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$username = $_SESSION['user'];
	$comment = nl2br($_POST['comment']);
	$article = $_POST['id'];
		// checks
		if(empty($comment)){
			$post_status = "Please make sure you write a comment";
		}
		if(empty($article)){
			$post_status = "Invalid article";
		}
			/// inserrt 
			if (!empty($comment) AND !empty($article)){
				try {
					$sql = "INSERT INTO comments (username,comment,arcid) VALUES (:username,:comment,:article)";
					$q = $dbh->prepare($sql);
					$q->bindValue(':username', $username);
					$q->bindValue(':comment', $comment);
					$q->bindValue(':article', $article);
					$q->execute();
					$post_status = "Comment posted.";
				}
				catch (PDOException $err) {  
		            $post_status = "Database connection has failed: ";
		            $err->getMessage() . "<br/>";
				}
			}
	}
echo '<center><table width="50%"></center><tr><th>Post a Comment</th></tr>';
echo '<form name="comment" method="POST" action="'. $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] .'">
<tr><td> <input type="hidden" name="id" readonly="true" value="' .  $ID . '">';
// gave del_status + post_status strings so they was not empty + so I can relate to what the script is doing. We use header so we see new content.
if (!empty($del_status)) {  redirect("view_article.php?id=" . $ID); }
if (!empty($post_status)){  redirect("view_article.php?id=" . $ID); }

echo '<textarea name="comment" rows="4" cols="50"></textarea><br />

<div style="float: right;"><button type="submit" name="submit" value="Submit Comment"/>Submit Comment</button></div>

</form></div></tr></td></table><br />

</body></html>';
?>