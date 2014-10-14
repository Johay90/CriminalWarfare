<?php
session_start();
?>

<!doctype html>
		<html>
		<head>
		<title>Main Forum - Criminal Warfare</title>
		<link type="text/css" rel="stylesheet" href="main.css" />
		<link type="text/css" rel="stylesheet" href="forum.css" />
		<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
		</head>
		</html>
<?php

include "inclu/connect.php";
include_once "inclu/menu.php";

not_logged_in();
$dbh = dbconnect();

$sql2 = "SELECT access FROM users WHERE username = '" . $_SESSION['user'] . "'";
$fMod = $dbh->query($sql2);
$fModRow = $fMod->fetch(PDO::FETCH_ASSOC);


	if (isset($_POST['submit_new'])){
		$title = htmlspecialchars($_POST['title']);
		// max 65 chars
		$message = nl2br($_POST['message']);
		// max 65,335
		$level = $_POST['level'];
		$hack = false;
		$date = $date = date('y-m-d H:i:s');

			if (empty($title)){
				$new_status = "You did not enter a title";
			}

			if (empty($message)){
				$new_status = "You did not enter a message";
			}

		$sql = "SELECT access FROM users WHERE username = '" . $_SESSION['user'] . "'";
		$result = $dbh->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC); 

			if (isset($level) AND $row['access'] >= 2) {
				$post_level = $level;
			}

			elseif (isset($level) AND $row['access'] <= 2){
				$hack = true;
				$new_status = "You don't have the access to set this level of topic";
			}

			else{
				$post_level = "1";
			}

				if (!empty($message) AND !empty($title) AND $hack == false){
					$sql = "INSERT INTO forum (username, title, message, last_active, level, date_created) VALUES (:username, :title, :message, :last_active, :level, :date_created)";
					$stmt = $dbh->prepare($sql);
					$stmt->bindValue(':username', $_SESSION['user']);
					$stmt->bindValue(':title', $title);
					$stmt->bindValue(':message', $message);
					$stmt->bindValue(':last_active', $date);
					$stmt->bindValue(':level', $post_level);
					$stmt->bindValue(':date_created', $date);
					$stmt->execute();

					redirect("forum.php");
					$sql = "SELECT COUNT(*) FROM forum";
					$result = $dbh->query($sql);
					$fetch = $result->fetch(PDO::FETCH_ASSOC);
					$data = $fetch['COUNT(*)'];

						if ($data >= 45){
							$lastrow = "SELECT last_active FROM forum WHERE level = 1 ORDER by last_active ASC LIMIT 1";
							$r = $dbh->query($lastrow);
							$rdata = $r->fetch(PDO::FETCH_ASSOC);
							$sql = "DELETE FROM forum WHERe level = 1 AND last_active = :last_active_row LIMIT 1";
							$result = $dbh->prepare($sql);
							$result->bindValue(':last_active_row', $rdata['last_active']);
							$result->execute();
						}
				}
	}

	if (!empty($_GET['newtopic'])){

		echo '<div class="container">

				<div class="contentwrap">
					<div class="content">


		<center><table width="50%"></center>
		<tr><th>Crate a new topic</th></td>
					';

	 if (!empty($new_status)) { echo "$new_status <br /><br />"; }

		echo '<form name="newtopic" method="POST" action="'. $_SERVER['PHP_SELF'] . "?newtopic=" . $_GET['newtopic'] . '">';
		echo '

		<tr><td>
		<input type="text" name="title" value="" class="newtopic" />';

				if ($fModRow['access'] >= 2){
					echo '<select name="level">
					<option value="1" selected="selected">Normal</option>
					<option value="2">Sticky</option>
					<option value="3">Important</option>
					<option value="4">Announcement</option>
					</select>';
				}

		echo '<textarea name="message" rows="7"></textarea><br />

		<button type="submit" name="submit_new" value="Submit" style="float: right; width:100px;" />Submit</button>
		</tr></td></div></div>';

	}

if (empty($_GET['newtopic'])){
echo '<div class="container">

			<div class="contentwrap">
				<div class="content">

<table width="100%" style="border: none;">
<tbody>
<tr>
<td valign="top" align="center" width="50%">

	<div class="Left">
		<table width="100%" style="border-bottom:1px solid black;"> <!--- table for left col   -->
			<tbody>
			<tr><th valgin="top">Main Forum Header <a href="forum.php?newtopic=true">[New Topic]</a></th></tr>
				<tr>
					<td>
						<table width="100%" style="border: none;" id="diff">
							<tbody>';
									
							try {

    							// Find out how many items are in the table
						   		$total = $dbh->query('
						        SELECT
						            COUNT(*)
						        FROM
						            forum
						    ')->fetchColumn();

						    // How many items to list per page
						    $limit = 15;

						    // How many pages will there be
						    $pages = ceil($total / $limit);

						    // What page are we currently on?
						    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
						        'options' => array(
						            'default'   => 1,
						            'min_range' => 1,
						        ),

						    )));

						    // paging

						    // Calculate the offset for the query
						    $offset = ($page - 1)  * $limit;

						    // Some information to display to the user
						    $start = $offset + 1;
						    $end = min(($offset + $limit), $total);

						    // The "back" link
						    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
						   
						    // The "forward" link
						    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
						   
						    // Display the paging information
						    $page_info = '<div id="paging"><p>'. $prevlink .' Page '. $page . ' of '. $pages .' pages, displaying '. $start .'-' .$end . ' of '. $total .' results ' .$nextlink .' </p>';

						    // Do we have any results?
						    if ($stmt->rowCount() > 0) {
						        // Define how we want to fetch the results
						        $stmt->setFetchMode(PDO::FETCH_ASSOC);
						        $iterator = new IteratorIterator($stmt);
						    } 

						} catch (Exception $e) {
						    echo '<p>', $e->getMessage(), '</p>';
						}

								$sql = "SELECT id,username,title,level FROM forum ORDER BY level DESC, last_active DESC LIMIT $limit OFFSET $offset"; // ORDER BY LEVEL DESC, last_activity DESC/ASC;
								$result = $dbh->query($sql);
								$rows = $result->fetchAll(PDO::FETCH_ASSOC);

								foreach($rows as $row){
									$sql3 = "SELECT locked FROM forum WHERE id = '" . $row['id'] . "'";
									$lock = $dbh->query($sql3);
									$lockrow = $lock->fetch(PDO::FETCH_ASSOC);
									$sql1 = "SELECT comment FROM forum_reply WHERE topic_id = '" . $row['id'] . "'";
									$result1 = $dbh->query($sql1);

										if ($row['level'] == 1){ $levelOfPost = ""; }
										if ($row['level'] == 2){ $levelOfPost = "<b>Sticky:</b> "; }
										if ($row['level'] == 3){ $levelOfPost = "<b>Important:</b> "; }
										if ($row['level'] == 4){ $levelOfPost = "<b>Announcement:</b> "; }
										if ($lockrow['locked'] == 0) $lockstatus = "";
										if ($lockrow['locked'] == 1) $lockstatus = "<b> (Locked)</b>";

								echo '<tr id="diff">';
								echo '<td align="left" width="60%">'. '<span style="padding-left: 2px;"></span><a href="forum.php?id=' . $row['id'] . '">' .  "$levelOfPost" . $row['title'] . "$lockstatus</a>";
								
								$sql = "SELECT fmod_toggle,username FROM users WHERE username ='".$_SESSION['user']."'";
								$result = $dbh->query($sql);
								$data = $result->fetch(PDO::FETCH_ASSOC);
								
								if ($fModRow['access'] >= 2 AND $data['fmod_toggle'] == 1){ 
									echo ' [';
									echo '<a href="forum.php?id='.$row['id'].'&deletetopic='.$row['id'].'">D </a>';
									echo '<a href="forum.php?id='.$row['id'].'&locktopic='.$row['id'].'">&nbsp L </a>';
									echo '<a href="forum.php?id='.$row['id'].'&unlocktopic='.$row['id'].'">&nbsp U </a>';
									echo '<a href="forum.php?id='.$row['id'].'&stickytopic='.$row['id'].'">&nbsp S </a>';
									echo '<a href="forum.php?id='.$row['id'].'&importtopic='.$row['id'].'">&nbsp I </a>';
									echo '<a href="forum.php?id='.$row['id'].'&annountopic='.$row['id'].'">&nbsp A </a>';
									echo '<a href="forum.php?id='.$row['id'].'&normaltopic='.$row['id'].'">&nbsp N]</a></td>';
								}

								echo '<td align="center" width="20%">'. $result1->rowCount() . '</td>';

								$squeel = "SELECT id from users WHERE username = '".$row['username']."'";
								$ressie = $dbh->query($squeel);
								$link = $ressie->fetch(PDO::FETCH_ASSOC);

								echo '<td align="right" width="20%"><a class="linkname" href="profile.php?id=' . $link['id'] . '">' . $row['username'] . '</a></td>';
								echo '</tr>';

							}

								echo '</tbody>
							</table>
					</td>
				</tr>
			</tbody>
		</table>

		';
		if (isset($page_info)) { echo $page_info; }
		// mod sorta panel
		if ($fModRow['access'] >= 2){
			echo '<a href="forum.php?forum_mod=cleanall">[Clean forum]&nbsp;</a> <a href="forum.php?forum_mod=toggle">[Toggle Mod Links]</a>';
	}
		if ($_GET['forum_mod']){
		if ($fModRow['access'] == 1){
			redirect("log_out.php");
		}
		if ($fModRow['access'] >= 2 AND $_GET['forum_mod'] == cleanall){
			$sql = "DELETE FROM forum WHERE level = 1";
			$result = $dbh->prepare($sql);
			$result->execute();
			redirect("forum.php");
		}
		if ($fModRow['access'] >= 2 AND $_GET['forum_mod'] == toggle){
			$sql = "SELECT fmod_toggle,username FROM users WHERE username ='".$_SESSION['user']."'";
			$result = $dbh->query($sql);
			$data = $result->fetch(PDO::FETCH_ASSOC);
				if ($data['fmod_toggle'] == 0) {$toggle = 1;}elseif($data['fmod_toggle'] == 1) { $toggle = 0;}
			$sql = "UPDATE users SET fmod_toggle = :toggle WHERE username = :user";
			$result = $dbh->prepare($sql);
			$result->bindValue(':toggle', $toggle);
			$result->bindValue(':user', $_SESSION['user']);
			$result->execute();
			redirect("forum.php");
		}
	}
	echo'</div>
			<br /><br />
</td>

	<td valign="top" align="center" width="50%">

	<div class="Right">

	<table width="100%"> <!--- table for right col   -->';

	if (!empty($_GET['id'])){

	$sql = "SELECT message,username,date_created, title FROM forum WHERE id = '" . $_GET['id'] . "'"; // ORDER BY LEVEL DESC, last_activity DESC/ASC;
	$result = $dbh->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);

	echo '	<table width="95%">
				<tbody>
					<tr>
						<th colspan="1" width="100%">' . $row['title'];

						if ($fModRow['access'] >= 2){ echo '<a href="forum.php?id='.$_GET['id'].'&deletetopic='.$_GET['id'].'">(Delete)</a>';}
						echo '</span></th>';


						$squeel = "SELECT id from users WHERE username = '".$row['username']."'";
						$ressie = $dbh->query($squeel);
						$link = $ressie->fetch(PDO::FETCH_ASSOC);

					echo '</tr><td class="subheader">' . '<p class="alignleft"><span>Created by: </span><a href="profile.php?id=' . $link['id'] . '">' . $row['username'] . '</a></p>'

					. '<p class="alignright"><span>Thread created: </span>' . $row['date_created'] . '</p></td><tr>

					</tr><tr>';

						echo '<td valgin="top"><div style="padding:3px 3px 3px 3px;">' . bbtag(linebreak($row['message'])) . '</div></td>

					</tr>
				</tbody>
		</table>';
		

try {

    // Find out how many items are in the table
    $rtotal = $dbh->query("
        SELECT
            COUNT(*)
        FROM
            forum_reply
        WHERE
        topic_id = '".$_GET['id']."'
    ")->fetchColumn();

    // How many items to list per page
    $limit = 10;

    // How many pages will there be
    $rpages = ceil($rtotal / $limit);

    // What page are we currently on?
    $rpage = min($rpages, filter_input(INPUT_GET, 'rpage', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    if ($rtotal > 0){
    $offset = ($rpage - 1)  * $limit;
}
    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $rtotal);

    // The "back" link
    $prevlink = ($rpage > 1) ? '<a href="?id='.$_GET['id'] . '&rpage=1" title="First page">&laquo;</a> <a href="?id='.$_GET['id'] . '&rpage=' . ($rpage - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($rpage < $rpages) ? '<a href="?id='.$_GET['id'] . '&rpage=' . ($rpage + 1) . '" title="Next page">&rsaquo;</a> <a href="?id='.$_GET['id'] . '&rpage=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // Display the paging information
    echo '<div id="paging"><p>', $prevlink, ' Page ', $rpage, ' of ', $rpages, ' pages, displaying ', $start, '-', $end, ' of ', $rtotal, ' results ', $nextlink, ' </p></div>';

    // Prepare the paged query
    $stmt = $dbh->prepare("
        SELECT
            *
        FROM
            forum_reply
            WHERE topic_id='".$_GET['id']."'
        ORDER BY
            date_posted DESC
        LIMIT
            :limit
        OFFSET
            :offset");
    // Bind the query params
    $stmt->bindParam(':limit', $limit, PDO:: PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO:: PARAM_INT);
    $stmt->execute();

    // Do we have any results?
    if ($stmt->rowCount() > 0) {
    	
        // Define how we want to fetch the results
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($stmt);
     
        // Display the results
        foreach ($iterator as $row) {
            echo '<table width="95%">

				<tbody>

				<tr>';

				$squeel = "SELECT id from users WHERE username = '".$row['username']."'";
				$ressie = $dbh->query($squeel);
				$link = $ressie->fetch(PDO::FETCH_ASSOC);

				echo '<th><div class="alignleft"><a href="profile.php?id=' . $link['id'] . '">' . $row['username'] . "</a> - " . $row['date_posted'];

				if ($row['username'] == $_SESSION['user'] AND $fModRow['access'] == 1){ echo '<a href="forum.php?id='.$_GET['id'].'&deleterpy='.$row['id'].'">(Delete)</a>';}

				if ($fModRow['access'] >= 2){ echo '<a href="forum.php?id='.$_GET['id'].'&deleterpy='.$row['id'].'">(Delete)</a>';}

			echo '</div></th></tr><tr>
			<td valgin="top" width="95%"><div style="padding:3px 3px 3px 3px;"> ' . bbtag(linebreak($row['comment'])) . '</div></td>
			</tr><br />';
				
			echo '
			</tbody>
			</table>';
        }

    } else{
  
    }

} catch (Exception $e) {
    echo '<p>', $e->getMessage(), '</p>';
}
						    

	echo'	<br /><br /><br />';

	// start mod powers, delete and edit

	// delete reply
	if (!empty($_GET['id']) AND $_GET['deleterpy']){
		$sql = "SELECT username,access FROM users WHERE username = '" . $_SESSION['user'] ."'";
		$result = $dbh->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$sql1 = "SELECT username from forum_reply WHERE id ='" . $_GET['deleterpy'] . "'";
		$result1 = $dbh->query($sql1);
		$row1 = $result1->fetch(PDO::FETCH_ASSOC);
			if ($row1['username'] != $_SESSION['user'] AND $row['access'] == 1){
				$selfReplyDel = "You do not have permission to delete this reply.";
			}
			if ($row1['username'] == $_SESSION['user'] OR $row['access'] >= 2){
				$sql = "DELETE FROM forum_reply WHERE id = :selfdel";
				$result = $dbh->prepare($sql);
				$result->bindValue(':selfdel', $_GET['deleterpy']);
				$result->execute();
				redirect("forum.php?id=" . $_GET['id']);
			}
	}
	//forum_mod+ may only delete topic only
	if (!empty($_GET['id']) AND $_GET['deletetopic']){
		$sql = "SELECT username,access FROM users WHERE username = '" . $_SESSION['user'] ."'";
		$result = $dbh->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);
			if ($row['access'] >= 2) {
				$sql = "DELETE FROM forum WHERE id = :del";
				$result = $dbh->prepare($sql);
				$result->bindValue(':del', $_GET['deletetopic']);
				$result->execute();
				redirect("forum.php");
			}
	}
	// lock topic
	if (!empty($_GET['id']) AND $_GET['locktopic']){
		if ($fModRow['access'] >= 2) {
		$sql = "UPDATE forum SET locked = 1 WHERE id = '" . $_GET['locktopic'] . "'";
		$result = $dbh->prepare($sql);
		$result->execute();
		redirect("forum.php?id=" . $_GET{'id'});
		}
	}
	// unlock topic
	if (!empty($_GET['id']) AND $_GET['unlocktopic']){
		if ($fModRow['access'] >= 2) {
		$sql = "UPDATE forum SET locked = 0 WHERE id = '" . $_GET['unlocktopic'] . "'";
		$result = $dbh->prepare($sql);
		$result->execute();
		redirect("forum.php?id=" . $_GET{'id'});
		}
	} // sticky topic
	if (!empty($_GET['id']) AND $_GET['stickytopic']){
		if ($fModRow['access'] >= 2) {
		$sql = "UPDATE forum SET level = 2 WHERE id = :id";
		$result = $dbh->prepare($sql);
		$result->bindValue(':id', $_GET['stickytopic']);
		$result->execute();
		redirect("forum.php?id=" . $_GET{'id'});
		}
	} // important
	if (!empty($_GET['id']) AND $_GET['importtopic']){
		if ($fModRow['access'] >= 2) {
		$sql = "UPDATE forum SET level = 3 WHERE id = :id";
		$result = $dbh->prepare($sql);
		$result->bindValue(':id', $_GET['importtopic']);
		$result->execute();
		redirect("forum.php?id=" . $_GET{'id'});
		}
	} // Announcement
	if (!empty($_GET['id']) AND $_GET['annountopic']){
		if ($fModRow['access'] >= 2) {
		$sql = "UPDATE forum SET level = 4 WHERE id = :id";
		$result = $dbh->prepare($sql);
		$result->bindValue(':id', $_GET['annountopic']);
		$result->execute();
		redirect("forum.php?id=" . $_GET{'id'});
		}
	} //normal
	if (!empty($_GET['id']) AND $_GET['normaltopic']){
		if ($fModRow['access'] >= 2) {
		$sql = "UPDATE forum SET level = 1 WHERE id = :id";
		$result = $dbh->prepare($sql);
		$result->bindValue(':id', $_GET['normaltopic']);
		$result->execute();
		redirect("forum.php?id=" . $_GET{'id'});
		}
	}
	// reply code
	if (!empty($_GET['id']) AND ($_GET['reply'] == t)) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$reply_msg = nl2br($_POST['reply']);
			$replyDate = $replyDate = date('y-m-d H:i:s');
			if (empty($reply_msg)){
				$reply_status = "You must type a reply.";
			}
			if (!empty($reply_msg)){
				$sql = "INSERT INTO forum_reply (username, topic_id, comment, date_posted) VALUES (:username, :topic_id, :comment, :date_posted)";
				$update = "UPDATE forum SET last_active = :date_posted WHERE id = '" . $_GET['id'] . "'";
				$r = $dbh->prepare($update);
				$r->bindValue(':date_posted', $replyDate);
				$r->execute();
				$result = $dbh->prepare($sql);
				$result->bindValue(':username', $_SESSION['user']);
				$result->bindValue(':topic_id', $_GET['id']);
				$result->bindValue(':comment', $reply_msg);
				$result->bindValue(':date_posted', $replyDate);
				$result->execute();
				redirect("forum.php?id=" . $_GET['id']);
			}

		}
		elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
			$reply_status = "You must hit the submit reply button to post a comment.";
		}

	}
	echo '<table width="95%">';
	if (!empty($reply_status)) { echo "$reply_status <hr>"; }
	$sql3 = "SELECT locked FROM forum WHERE id = '" . $_GET['id'] . "'";
	$lock = $dbh->query($sql3);
	$lockrow = $lock->fetch(PDO::FETCH_ASSOC);
	echo '<tr><th>Post Reply</th></tr>
		  <form name="reply" method="POST" action="'. $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] . '&reply=t">';
	echo '<tr><td><textarea name="reply" rows="10"';
	if ($lockrow['locked'] == 1){
		echo 'disabled></textarea>';
		}	
	else echo "></textarea>";

	echo '<button style="float: right" type="submit" name="submitreply" value="Post Reply"/>Post Reply</button>
	</td></tr></table>
		</form></div>

</table>';
}
}
echo'</td>
</div></div>
</div>
</tr>
</tbody>
</table>
</div>'; 
?>