<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Messages</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>

<?php
include "inclu/connect.php";
include "inclu/message.class.php";
include_once "inclu/menu.php";
not_logged_in();
$dbh = dbconnect();


		echo '<div class="container">

			<div class="contentwrap">
				<div class="content">';

		echo '<form name="send_message" method="POST" action="'. $_SERVER['PHP_SELF'] . '">';

		if($_SERVER['REQUEST_METHOD'] == "POST")  {
		$to = strtolower($_POST['sendto']);
		$message = nl2br(htmlspecialchars($_POST['message']));
		$title = $_POST['title'];
			if (empty($to)){
				$status = "You did not enter who you want to send the message to";
			}
			if (empty($title)){
				$status = "You did not enter a title!";
			}
			$sql = "SELECT username FROM users WHERE username = '$to'";
			$stmt = $dbh->query($sql);
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (empty($message)){
				$status = "Please enter a message";
			}
			$username = new message;
			if ($to == $username->username){
				$status = "You can't send a message to yourself";
			}
			// check to see if user exist, change this when i convert the login/register/users to OOP.
			elseif ($stmt->rowCount() == 0) {
				$status = "You can't send a message if that user doens't exist";
			}
				// send message
				if (!empty($to) AND !empty($message) AND !empty($title) AND $stmt->rowCount() == 1 AND $to !== $username->username){
					$obj = new message();
					echo $obj->SendMessage($to, $title, $message);
				}

			if (!empty($status)){
				echo "$status <hr>";
			}
		}
		?>
		<center><table width="70%"></center><tr><th>Send Message</th></tr>

		<tr><td><div style="padding-left: 5px;">Send to:
		<input type="text" style="width:20%;" name="sendto" value=<?php echo '"' ?><?php if (isset($_SESSION['reply_sendto'])) { echo $_SESSION['reply_sendto']; 
		unset($_SESSION['reply_sendto']);}?><?php echo '"' ?> />

		<br />Title:
		<input type="text" style="width:60%;" name="title" value=<?php echo '"' ?><?php if (isset($_SESSION['reply_title'])) { echo $_SESSION['reply_title']; 
		unset($_SESSION['reply_title']);}?><?php echo '"' ?> /></div>
		<br />
		<textarea name="message" rows="20" cols="30"></textarea>

		<button type="submit" name="submit" value="Send Message"/>Send Message</button></td></tr></table>

		</form></div></body></html>';

		<?php echo "</div>";	
?>