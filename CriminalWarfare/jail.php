<?php
session_start();
?>
<!doctype html>
<html>
<head>
<title>Criminal Warfare - Jail</title>
<link type="text/css" rel="stylesheet" href="main.css" />
 <link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
</html>
<?php
include "inclu/connect.php";
include_once "inclu/menu.php";
include_once "inclu/class.php";
not_logged_in();
script_check();

echo '<div class="container">

			<div class="contentwrap">
				<div class="content">';

				echo '<table style="float:left;" colspan="2" width="25%">

	<col width="50">
	<col width="50">';

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			// INSERT INFO if new user 	

			$existSQL = "SELECT user_id FROM jailstats WHERE user_id = '".$userROW['id']."'";
			$existRESULT = $dbh->query($existSQL);

			if ($existRESULT->rowCount() == 0){

				$insert = "INSERT INTO jailstats (user_id, username) VALUES (:user_id, :username)";
				$insertEXE = $dbh->prepare($insert);
				$insertEXE->bindValue(':user_id', $userROW['id']);
				$insertEXE->bindValue(':username', $_SESSION['user']);
				$insertEXE->execute();
			}

			if (isset($_POST['long'])){

				$select = "SELECT * FROM jail WHERE user_id = 9000";
				$run = $dbh->query($select);

				if ($run->rowCount() == 0){

					$insert = "INSERT INTO jail (user_id, time_left, rank, username, access_time, link) VALUES (:user_id, :time_left, :rank, :username, :access_time, :link)";
					$insertEXE = $dbh->prepare($insert);
					$insertEXE->bindValue(':user_id', 9000);
					$insertEXE->bindValue(':time_left', time());
					$insertEXE->bindValue(':rank', "Professional Jail Breaker");
					$insertEXE->bindValue(':username', "bot");
					$insertEXE->bindValue(':access_time', time());
					$insertEXE->bindValue(':link', sha1(rand()));
					$insertEXE->execute();
				}else{
					echo "This bot is already in Jail";
				}

			}

			if (isset($_POST['short'])){

				$select = "SELECT * FROM jail WHERE user_id = 9001";
				$run = $dbh->query($select);

				if ($run->rowCount() == 0){

					$insert = "INSERT INTO jail (user_id, time_left, rank, username, access_time, link) VALUES (:user_id, :time_left, :rank, :username, :access_time, :link)";
					$insertEXE = $dbh->prepare($insert);
					$insertEXE->bindValue(':user_id', 9001);
					$insertEXE->bindValue(':time_left', time());
					$insertEXE->bindValue(':rank', "Beginner Jail Breaker");
					$insertEXE->bindValue(':username', "bot");
					$insertEXE->bindValue(':access_time', time());
					$insertEXE->bindValue(':link', sha1(rand()));
					$insertEXE->execute();
				}else{
					echo "This bot is already in Jail";
				}

			}

			if (isset($_POST['getout'])){

				$select = "SELECT * FROM jail where username = '".$_SESSION['user']."'";
				$run = $dbh->query($select);

				if ($run->rowCount() == 1){
					
					$del = "DELETE FROM jail where username = '".$_SESSION['user']."'";
					$run = $dbh->query($del);

				}else{

					echo "YOU AINT IN THIS JAIL FOOL";

				}
			}

			if (isset($_GET['id'])){
				$obj = new jail();
				

				// checks

				$check1 = "SELECT * FROM jail WHERE username = '".$_SESSION['user']."'";
				$runcheck1 = $dbh->query($check1);

				if ($runcheck1->rowCount() == 1){
					$status = "You cannot break as you're currently in jail";
				}

				$check2 = "SELECT * FROM jail WHERE link = '".$_GET['id']."'";
				$runcheck2 = $dbh->query($check2);

				if ($runcheck2->rowCount() == 0 && $runcheck1->rowCount() == 0){
					$status = "This user is no longer in jail";
				}

				if ($runcheck2->rowCount() == 1 && $runcheck1->rowCount() == 0){

						if ($obj->BreakJail($_GET['id']) == "false"){
							$status = "You were unsuccesful and have now been put in jail";
							$obj->SendToJail();
						}

						else{
							$status = "You were succesful";
						}
				}
			}

	if (isset($status)){ echo "<center>$status</center><br />";}

	$sqlzie = "SELECT * FROM jailstats WHERE username = '".$_SESSION['user']."'";
	$runzie = $dbh->query($sqlzie);
	$rowzie = $runzie->fetch(PDO::FETCH_ASSOC);

	echo '<tr><th colspan="2">Jail Statistics</th></tr>';

	echo '<tr><td class="subheader" colspan="2"><span style="padding-left: 5px;">Your jail statistics for your account lifespan.</span></td></tr>';

	echo '<tr><td style="border:1px solid black;padding-left: 5px;">Total Jail Attempts</td>

			 <td style="padding-left: 5px;border-bottom:1px solid black;">'.$rowzie['total'].'</td></tr>';


	echo '<tr><td style="border:1px solid black;padding-left: 5px;">Failed breaks</td>

			 <td style="padding-left: 5px;border-bottom:1px solid black;">'.$rowzie['fail'].'</td></tr>';


	echo '<tr><td style="border:1px solid black;padding-left: 5px;">Sucessful breaks</td>

			 <td style="padding-left: 5px;border-bottom:1px solid black;">'.$rowzie['success'].'</td></tr>';

	echo '<tr><td style="border-right:1px solid black;padding-left: 5px;">Rank</td>

	 <td style="padding-left: 5px;border-bottom:1px solid black;">';

	 echo $rowzie['rank']. '</td></tr>';

	echo '</table>';

		echo '<table width="74%" style="float:right; margin-left: 5px; margin-bottom: 10px;">
			<tr><th>Jail</tr></th>

			<tr><td style="padding-bottom:5px;">You can easily break a criminal out of jail by pressing the "Break" button to the right of their name, 
			the higher jail rank you are the better chance you have of successfully breaking this person out of jail. <br /><br />

			As with our other rank features on Criminal Warfare as you gain ranks you get more advantages from such ranks, the jail rank is no different. 
			The higher jail rank you are, the better global rank experience you will gain, and of course, as stated above - The better chance you have at breaking jail. 
			Be aware though, failed jailed breaks will put you into jail, unable to break at all and rely on a friend or foe to break you out!';

	echo "</table>";

	echo '<table width="15%" align="center" colspan="3" style="margin-top: 120px; clear: both;">';
			
			echo '<tr><th colspan="3">Break Jail</th></tr>

			<col width="33">
			<col width="33">
			<col width="33">';

			$select = "SELECT * from jail";
			$query = $dbh->query($select);
			$updaterows = $query->fetchAll();

			foreach ($updaterows as $row){
				$last_access = time();
				$sql1 = "UPDATE jail SET access_time = $last_access";
				$update = $dbh->query($sql1);
			}

			// we have to run above query to get the new timeleft (else it won't update when new row is inserted or deleted)

			$sql = "SELECT * FROM jail";
			$result = $dbh->query($sql);
			$rows = $result->fetchAll();

			foreach ($rows as $row){

					$timer = date('Y/m/d H:i:s', $row['access_time']);
					$timer2 = date('Y/m/d H:i:s', $row['time_left']);

					echo '<tr>
						  <td align="center" style="padding-left:10px; border: 1px solid black;"><a href="profile.php?id='.$row['user_id'].'">'.$row['username']."</a></td>";

					if ($row['rank'] == "Beginner Jail Breaker"){ $timeleft = 30; }
					if ($row['rank'] == "Bagman"){ $timeleft = 45; }
					if ($row['rank'] == "Bodyguard"){ $timeleft = 60; }
					if ($row['rank'] == "Safecracker"){ $timeleft = 75; }
					if ($row['rank'] == "Mastermind"){ $timeleft = 110; }
					if ($row['rank'] == "Professional Jail Breaker"){ $timeleft = 180; }

					echo '<td align="center" style="padding-left:10px; border: 1px solid black;">'.date('i:s', strtotime($timer2)+$timeleft-strtotime($timer))."</td>";

					echo '<td align="center" style="padding-left:10px; border: 1px solid black;"><a href="jail.php?id='.$row['link'].'">'.'Break</a></td>';
					
					echo '</tr>';

		}


			echo '</table>';

			echo '<table align="center" style="margin-top: 100px;"><tr><th>Debug</th></tr>

				 <tr><td class="subheader" style="padding-left: 5px; padding-right: 5px;"><span>This is only for testing purposes and will later be removed</span></td></tr>

				 <tr><td align="center">

				 <form class="login" name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">
				 <button type="submit" name="long">Jailbot: 300 Seconds</button>
				 <button type="submit" name="short">Jailbot: 30 Seconds</button>
				 <button type="submit" name="getout">Break yourself</button></form>

				 </tr></td>

				</table>';

