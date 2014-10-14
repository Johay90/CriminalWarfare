<?php
session_start();
?>

<!doctype html>
<html>
<head>

			<title>Criminal Warfare - Commit a Crime</title>
			<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
			<meta content="utf-8" http-equiv="encoding">
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>

			</head>

<?php

include_once "inclu/menu.php";
include_once "inclu/connect.php";
not_logged_in();
insert();
jail();
script_check();

$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
$getuserRESULT = $dbh->query($getuserSQL);
$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM crimestats WHERE user_id = '".$userROW['id']."'";
$result = $dbh->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

		if(isset($_POST['submit'])){

			$accessSQL = "SELECT user_id FROM crimes WHERE user_id = '".$row['user_id']."'";
			$accessQUERY = $dbh->query($accessSQL);

			if ($accessQUERY->rowCount() == 0){

							$obj = new crime();

							// build crime chance (pass/fail)

							$chance = nil;
							$rand = rand($row['chance'], 200);

							if ($rand >= 100 && $row['chance'] > 25){
								$chance = "pass";
							}
							elseif($rand <= 99 && $row['chance'] > 25){
								$chance = "fail";
							}
							else{
								$chance = "fail";
							}

							// execute crime based on pass/fail
							if ($chance == "pass"){
								echo '<div class="container">
									<div class="contentwrap">
									<div class="content"> You were successful in your crime attempt and managed to get $' . $obj->Crime("pass");

									$sql = "INSERT INTO crimes (user_id, time_left) VALUES ('".$row['user_id']."', '".time()."')";
									$result = $dbh->prepare($sql);
									$result->execute();
									die();
							}

							if ($chance == "fail"){
										$jailrand = rand(1, 2);
								 		$obj->Crime("fail");
										echo '<div class="container">
										<div class="contentwrap">
										<div class="content">';

										if ($jailrand == 1){
											echo 'You failed to commit the crime. However, you did manage to evade the poice!';
										}

										if ($jailrand == 2){
											$newobj = new jail();
											$newobj->SendToJail();
											echo 'You failed to commit the crime and was caught by the police!';
										}

										$sql = "INSERT INTO crimes (user_id, time_left) VALUES ('".$row['user_id']."', '".time()."')";
										$result = $dbh->prepare($sql);
										$result->execute();
										die();
							}
						}
					}



		$accessSQL = "SELECT user_id FROM crimes WHERE user_id = '".$row['user_id']."'";
		$accessQUERY = $dbh->query($accessSQL);

		if ($accessQUERY->rowCount() == 1){
			$last_access = time();
			$sql = "UPDATE crimes SET access_time = $last_access WHERE user_id = '".$row['user_id']."'";
			$update = $dbh->query($sql);

			$sql = "SELECT * FROM crimes WHERE user_id = '".$row['user_id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			$read1 = date('Y/m/d H:i:s', $row['access_time']);
			$read2 = date('Y/m/d H:i:s', $row['time_left']);
			$jsdate = date('Y/m/d H:i:s', strtotime($read2)+120);

			$timeleft = date('s', strtotime($read2)+120-strtotime($read1));

			echo '<div class="container">
						<div class="contentwrap">
						<div class="content">
						<table width="20%" align="center">
						<tr><th>Cooldown!</th></tr>

						<tr><td><span style="padding-left: 5px;">You cannot do another crime for another </span><div id="timer" style="display: inline">';

						?>
						<script type="text/javascript">
						$(document).ready(function() {

					    setInterval(function (){

					    	d = new Date();
   							utc = d.getTime() + (d.getTimezoneOffset() * 60000);
					        var date2 = new Date(utc);
					        var date1 = new Date("<?php echo $jsdate ?>");
					        var Diff = date1 - date2; 
					        var diffSeconds = Math.floor(Diff/1000);

					        $('#timer').html(diffSeconds);

					        if (diffSeconds <= 1){
					        	window.location.href="crime.php";
					        }

					    }, 500);
					});

						</script>


						<?php
						echo "</div> seconds";

		}



if(!isset($_POST['submit']) && $accessQUERY->rowCount() == 0){

	echo '<div class="container">
				<div class="contentwrap">
					<div class="content">';

	echo '<table style="float:left;" colspan="2" width="25%">

	<col width="90">
	<col width="10">';

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM crimestats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

	echo '<tr><th colspan="2">Crime Statistics</th></tr>';

	echo '<tr><td class="subheader" colspan="2"><span style="padding-left: 5px;">Your crime statistics for your account lifespan.</span></td></tr>';

	echo '<tr><td style="border:1px solid black;padding-left: 5px;">Total Crime Attempts</td>

			 <td style="padding-left: 5px;border-bottom:1px solid black;">'.$row['attempts'].'</td></tr>';


	echo '<tr><td style="border:1px solid black;padding-left: 5px;">Failed Attempts</td>

			 <td style="padding-left: 5px;border-bottom:1px solid black;">'.$row['fail'].'</td></tr>';


	echo '<tr><td style="border-right:1px solid black;padding-left: 5px;">Sucessful Crimes</td>

			 <td style="padding-left: 5px;border-bottom:1px solid black;">'.$row['success'].'</td></tr>';

	echo '</table>';

	echo '<table width="45%" style="float:left; margin-left: 5px;">
			<tr><th>Commit a Crime</tr></th>
			<tr><td><img width="100%" src="img/dollars.jpg" style="height: 100px;" ></td></tr>

	<tr>';

	if ($row['level'] <= 4) { echo '<td style="background-color:red; height: 20px; color: white; font-size: 1.1em;" align="center">';} 
	if ($row['level'] >= 5 && $row['level'] < 7) { echo '<td style="background-color:orange; height: 20px; color: white; font-size: 1.1em;" align="center">';} 
	if ($row['level'] >= 7) { echo'<td style="background-color:green; height: 20px; color: white; font-size: 1.1em;" align="center">';} 

	echo 'Level '.$row['level'].'</td></tr>';

	echo 	'<tr><td class="subheader" style="padding-left: 5px;"><span>Commit a Crime</span></td></tr>';

	echo    '<tr><td align="center">';

	if ($row['level'] == 1){ 
	echo 'You see an old helpless lady on the street drop her shopping, rob the bitch.'; }
	if ($row['level'] == 2){ 
	echo 'Rob your local corner store'; }
	if ($row['level'] == 3){ 
	echo 'Burgle one of the local houses'; }
	if ($row['level'] == 4){ 
	echo 'Rob a drug dealer'; }
	if ($row['level'] == 5){ 
	echo 'Sell Stolen personal information'; }
	if ($row['level'] == 6){ 
	echo 'Rob a local bank'; }
	if ($row['level'] == 7){ 
	echo 'Kidnap and demand a ransom'; }
	if ($row['level'] == 8){ 
	echo 'Rob a national bank'; }
	if ($row['level'] == 9){ 
	echo 'Rob a government official'; }
	if ($row['level'] == 10){ 
	echo 'Commit Credit Card Fraud'; }




	echo ' ('.$row['chance'].'%)

			<form class="login" name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">
			<br /><button type="submit" name="submit">Commit Crime</button></form>
					</td></tr>';


			echo '</table>';

			echo '<table width="25%"  style="float:left; margin-left: 5px;">
				<tr><th >Level information</tr></th>
				<tr><td style="padding-left: 5px;">When you start your journey on Crime Warfare you begin with a Level 1 Crime status, 
				each level has a certain amount of experience you will need to gain before you can move up levels.<br /><br /> Each level has a different advantage to the previous level,
				be it more rank experience, more money or items you can use to sell or use on other Crime Warfare features such as the Organized Crimes page for bigger payouts. <br /><br />
				These advantages are listed below.<br /><br />
				<b>Level 1: </b> $100 - $400, small amount of experience<br />
				<b>Level 2: </b> $300 - $600, small amount of experience greater than Level 1<br />
				<b>Level 3: </b> $400 - $800, small amount of experience greater than Level 2<br />
				<b>Level 4: </b> $500 - $1200, small amount of experience greater than Level 3<br />
				<b>Level 5: </b> $600 - $1400, small amount of experience greater than Level 4<br />
				<b>Level 6: </b> $700 - $2000, small amount of experience greater than Level 5<br />
				<b>Level 7: </b> $800 - $2500, chance of large amount of experiance<br />
				<b>Level 8: </b> $1500 - $4000, chance of large amount of experiance greater than Level 7 <br />
				<b>Level 9: </b> $1700 - $5000, chance of large amount of experiance greater than Level 8<br />
				<b>Level 10: </b>$3000 - $10,000, massive experiance<br /><br />

				<i> * Crime names WILL be redone to more of a message (sentence length, storyline etc). Items will be added to Level 6 or higher.<br /><br />

				*** Crime Level Experiance rankbar will be added to the rankbars/person stats page, and it will need to be purchased (when the game is released, obv).</i>



				
				</tr></td>
				</table>';


					echo '</div</div></div>';
}
?>