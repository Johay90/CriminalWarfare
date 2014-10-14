<?php
session_start();
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Debug</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre:300,400,700,300italic,400italic,700italic|Bitter' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>

<?php
include "inclu/connect.php";
include "inclu/menu.php";
not_logged_in();
$dbh = dbconnect();

$sql = "SELECT * FROM users WHERE username = '".$_SESSION['user']."'";
$result = $dbh->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

echo '<div class="container">

				<div class="contentwrap">
					<div class="content">
					
					<table align="center" width="50%"><tr><th>Testing</th></tr>

					<tr><td style="padding-left: 5px;">The purpose of this page is to help with testing. Documenting values you will be 
					getting for each action you do. I will also show some data from the database which may not mean much to you, but may help with testing.</td></tr></table><br />';


					// acocunt info

							echo '<table align="left" colspan="2" width="49%"><tr><th colspan="2">Crime Information</th></tr>

					<col width="50">
					<col width="50">

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 1 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 50 - 75 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 2 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 75 - 125 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 3 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 90 - 150 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 4 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 150 - 250 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 5 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 250 - 350 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 6 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 350 - 450 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 7 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 550 - 650 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 8 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 650 - 750 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 9 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 850 - 1000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Level 10 experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 1100 - 1200 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Fail experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 25 - 50 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 1 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $100 - $400 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 2 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $300 - $600 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 3 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $400 - $800 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 4 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $500 - $1,200 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 5 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $600 - $1,400 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 6 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $700 - $2,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 7 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $800 - $2,500 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 8 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $1,500 - $4,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 9 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $1,700 - $5,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - level 10 money</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $3,000 - $10,000 </span></td></tr>

					</table>';

					echo '<table align="right" colspan="2" width="49%"><tr><th colspan="2">Account Information</th></tr>

					<col width="50">
					<col width="50">

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">ID</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>'.$row['id'].'</span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Username</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>'.$row['username'].'</span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Access level</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>'.$row['access'].'</span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Forum mod toggle</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>'.$row['fmod_toggle'].'</span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Sciprt check count</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>'.$row['count'].'</span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Verify</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>'.$row['verify'].'</span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Current Rank Experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>'.$row['rank_exp'].'</span></td></tr>

					</table>';

					// rank info

					echo '<table align="right" colspan="2" width="49%" style="margin-top: 10px"><tr><th colspan="2">Rank Information</th></tr>

					<col width="50">
					<col width="50">

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Scumbag</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span>0 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Pickpocket</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 750 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Shoplifter</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 2,500 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Burglar</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 6,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Fraudster</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 18,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Armed Robber</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 40,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Associate</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 86,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Organized Criminal</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 150,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Enforcer</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 220,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Soldier</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 310,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Caporegime</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 460,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Underboss</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 635,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Don</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 865,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Total Experience for Godfather</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 1,200,000 </span></td></tr>

					</table>';

					echo '<table align="left" colspan="2" width="49%" style="margin-top: 10px;"><tr><th colspan="2">Money Information</th></tr>

					<col width="50">
					<col width="50">

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Amount for Broke</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $0 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Amount for Strap for Cash</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $10,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Amount for Gets by</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $100,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Amount for Rich</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $1,000,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Amount for On the Rich List</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $10,000,000 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Amount for More money than sense</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $100,000,000 </span></td></tr>

					
					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Amount for Billionaire</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> $1,000,000,000 </span></td></tr>

					</table>';

					echo '<table align="right" colspan="2" width="49%" style="margin-top: 10px"><tr><th colspan="2">Travel Information</th></tr>

					<col width="50">
					<col width="50">

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Experience for flying</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> Current Experiance / 90 + 150 (round down) </span></td></tr>

					</table>';

					echo '<table align="right" colspan="2" width="49%" style="margin-top: 10px"><tr><th colspan="2">Jail Information</th></tr>

					<col width="50">
					<col width="50">

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Beginner Jail Breaker experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 5 - 10 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Bagman experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 5 - 15 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Bodyguard experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 10 - 25 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Safecracker experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 15 - 45 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Mastermind experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 20 - 50 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Successful - Professional Jail Breaker experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 25 - 70 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Fail - Beginner Jail Breaker experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 3 - 6 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Fail - Bagman experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 4 - 8</span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Fail - Bodyguard experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 8 - 12 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Fail - Safecracker experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 15 - 20 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Fail - Mastermind experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 15 - 25 </span></td></tr>

					<tr><td align="right" style="border: 1px solid black; padding: 5px;">Fail - Professional Jail Breaker experience</td>
					<td class="subheader" align="left" style="border: 1px solid black; padding: 5px;"><span> 17 - 30 </span></td></tr>

					</table>';

					echo "<div style='clear: both;'></div></div></div></div>"; // clear both for a spacer hack

