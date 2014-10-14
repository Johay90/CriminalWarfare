<?php
session_start();
?>
<!doctype html>
<html><head>

			<title>Criminal Warfare - Grand Theft Auto</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
			</html>

<?php 

include_once "inclu/connect.php";
include_once "inclu/menu.php";
include_once "inclu/class.php";

not_logged_in();
jail();
script_check();


			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			// INSERT INFO if new user 	

			$existSQL = "SELECT user_id FROM gtastats WHERE user_id = '".$userROW['id']."'";
			$existRESULT = $dbh->query($existSQL);

			if ($existRESULT->rowCount() == 0){

				$insert = "INSERT INTO gtastats (user_id, username) VALUES (:user_id, :username)";
				$insertEXE = $dbh->prepare($insert);
				$insertEXE->bindValue(':user_id', $userROW['id']);
				$insertEXE->bindValue(':username', $_SESSION['user']);
				$insertEXE->execute();
			}

	if (isset($_POST['submit'])){
		$obj = new gta();
			if ($obj->DoGTA() == true){
				echo '<div class="container">
					  <div class="contentwrap">
					  <div class="content">'
					  ."You sucessfully stole ".$obj->carname." with ".$obj->carDmg."% damage</div</div></div>";
					}

			else {
				echo '<div class="container">
					  <div class="contentwrap">
		   			  <div class="content">
					  You failed</div</div></div>';
					}
	}else{

		$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$existSQL = "SELECT * FROM gtastats WHERE user_id = '".$userROW['id']."'";
			$existRESULT = $dbh->query($existSQL);
			$existROW = $existRESULT->fetch(PDO::FETCH_ASSOC);

		echo '<div class="container">
					<div class="contentwrap">
						<div class="content">';

		echo '<table style="float:left;" colspan="2" width="25%">

		<col width="90">
		<col width="10">';

		echo '<tr><th colspan="2">Grand Theft Auto Statistics</th></tr>';

		echo '<tr><td class="subheader" colspan="2"><span style="padding-left: 5px;">Your Grand Theft Auto statistics for your account lifespan.</span></td></tr>';

		echo '<tr><td style="border:1px solid black;padding-left: 5px;">Total Grand Theft Auto Attempts</td>

				 <td style="padding-left: 5px;border-bottom:1px solid black;">test</td></tr>';


		echo '<tr><td style="border:1px solid black;padding-left: 5px;">Failed Attempts</td>

				 <td style="padding-left: 5px;border-bottom:1px solid black;">test</td></tr>';


		echo '<tr><td style="border-right:1px solid black;padding-left: 5px;">Sucessful Grand Theft Autos</td>

				 <td style="padding-left: 5px;border-bottom:1px solid black;">test</td></tr>';

		echo '</table>';

		echo '<table width="45%" style="float:left; margin-left: 5px;">
				<tr><th>Commit a Grand Theft Auto</tr></th>
				<tr><td><img width="100%" src="img/gta.jpg" style="height: 100px;" ></td></tr>

		<tr>';

		echo '<td style="background-color:red; height: 20px; color: white; font-size: 1.1em;" align="center">';

		echo 'Level 1</td></tr>';

		echo 	'<tr><td class="subheader" style="padding-left: 5px;"><span>Commit a Grand Theft Auto</span></td></tr>';

		echo    '<tr><td align="center">';

		echo 'You see an old helpless lady on the street drop her shopping, rob the bitch. ('; 


		echo  $existROW['chance']."%)".'

				<form class="login" name="login" method="POST" action="'. $_SERVER['PHP_SELF'] . '">
				<br /><button type="submit" name="submit">Commit Grand Theft Auto</button></form>
						</td></tr>';


				echo '</table>';


				echo '<table width="25%"  style="float:left; margin-left: 5px;">
					<tr><th >Level information</tr></th>
					<tr><td style="padding-left: 5px;">When you start your journey on Criminal Warfare you begin with a Level 1 Grand Theft Auto status, 
					each level has a certain amount of experience you will need to gain before you can move up levels.<br /><br /> Each level has a different advantage to the previous level,
					be it more rank experience or better cars. You can use these cars to either make profit (sell them in Garage) or use in other Criminal Warfare features such as the Organized Crimes page for bigger payouts. <br /><br />
					The cars you have a chance of winning or below.<br /><br />
					<b>Level 1: </b> $100 - $400, small amount of experience<br />



					
					</tr></td>
					</table>';
				}

