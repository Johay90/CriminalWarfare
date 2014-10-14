<?php
session_start();

// Don't

class message{

	public $username;

	public function SendMessage($msgTo, $title, $message){
		$this->msgTo = $msgTo;
		$this->title = $title;
		$this->message = linebreak(strip_tags($message));
		$date = $date = date('y-m-d H:i:s');

			try {
				$dbh = dbconnect();
				$sql = "INSERT INTO send_message (sendto,title,message,sentfrom,date) VALUES (:sendto,:title,:message,:sentfrom,:date)";
				$q = $dbh->prepare($sql);
				$q->bindValue(':sendto', $this->msgTo);
				$q->bindValue(':title', $this->title);
				$q->bindValue(':message', $this->message);
				$q->bindValue(':sentfrom', $_SESSION["user"]);
				$q->bindValue(':date', $date);
				$q->execute();
				}
			catch (PDOException $err) {
				echo "A database error: <br />";
				echo $err->getMessage();
			}

		return "Message was sucessfully sent to<b> " . $this->msgTo . "</b>";
	}

	public function reply(){
		$dbh = dbconnect();
		$sql = "SELECT * FROM send_message WHERE id =" . $_SESSION['msgid'];
		$stmt = $dbh->query($sql);
		$row = $stmt->fetch(); 
		$_SESSION['reply_title'] = "RE: " . $row['title'];
		$_SESSION['reply_date'] = $row['date'];
		$_SESSION['reply_sendto'] =  $row['sentfrom'];
		unset($_SESSION['msgid']);
		redirect("message.php");
	}

	public function delete(){
		$dbh = dbconnect();
		$sql = "DELETE FROM send_message WHERE id =" . $_SESSION['msgid'];
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		unset($_SESSION['msgid']);
		return "Message deleted";
	}

	public function SaveMessage($from, $title, $message){
		$this->from = $from;
		$this->title = $title;
		$this->message = $message;
		$date = $date = date('y-m-d H:i:s');
		unset($_SESSION['save_msgid']);
			try {
				$dbh = dbconnect();
				$sql = "INSERT INTO save_messsage (sendto,sentfrom,title,message,date) VALUES (:sendto,:sentfrom,:title,:message,:date)";
				$q = $dbh->prepare($sql);
				$q->bindValue(':sendto', $_SESSION["user"]);
				$q->bindValue(':sentfrom', $this->from);
				$q->bindValue(':title', $this->title);
				$q->bindValue(':message', $this->message);
				$q->bindValue(':date', $date);
				$q->execute();
				return "Message Saved";
				// TODO don't let users save same message.
				}
			catch (PDOException $err) {
				return "A database error: <br />";
				return $err->getMessage();
				}
		}

	public function Delete_SaveMessage(){
		$dbh = dbconnect();
		$sql = "DELETE FROM save_messsage WHERE id =" . $_SESSION['save_msgid'];
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		unset($_SESSION['save_msgid']);
		return "Message Deleted";
	}

	public function __construct(){ // this function is for the $obj = new person
     	$this->username  = $_SESSION["user"];
    }

}