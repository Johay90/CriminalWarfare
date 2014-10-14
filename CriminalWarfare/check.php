<?php
session_start();
?>
<!doctype html>
<html>
<head>
<title>Criminal Warfare - Script Test</title>
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

 $sql = "SELECT * FROM users WHERE username = '".$_SESSION["user"]."' AND count <= 39";
 $result = $dbh->query($sql);
     if ($result->rowCount() >= 1){
     	 echo '<div class="container">

			<div class="contentwrap">
				<div class="content">You are not currently ready for an anti-bot test!';
				die();
	}

require_once("inclu/anti_script/ayah.php");
$ayah = new AYAH();
if (array_key_exists('submit', $_POST))
{
        // Use the AYAH object to see if the user passed or failed the game.
        $score = $ayah->scoreResult();

        if ($score)
        {
                // This happens if the user passes the game. In this case,
                // we're just displaying a congratulatory message.
                echo '<div class="container">

			<div class="contentwrap">
				<div class="content">Congratulations: You passed the anti-bot test and the account limitations are now lifted.';
				$sql = "UPDATE users SET count = 0 WHERE username = '".$_SESSION['user']."'";
				$run = $dbh->query($sql);
        }
        else
        {
        		// This happens if the user does not pass the game.
                echo '<div class="container">
				<div class="contentwrap">
				<div class="content">Sorry, but we were not able to verify you as a human. The anti-bot test will reload shortly.';
				echo '<script type="text/javascript">setTimeout(function(){window.location.href="check.php";},7000);</script>';
        }
}

if (!isset($_POST['submit'])){
echo '<div class="container">

			<div class="contentwrap">
				<div class="content">

				<table align="center" width="40%">

				<tr><th style="padding-left: 5px;">Anti-Bot Check!</th></tr>

				<tr><td style="padding-lefT: 5px;">Unfortunately we have had to implement this page to stop botting and scripting of our features.
				This is to protect the game as a whole - And to make sure you are a human (not a robot!) and that you are playing legitimately. You 
				will see this page every so often. <br /><br />

				Once you have completed the game, hit the submit button below. 

				<form method="post" action="">';
		            echo "<center>" . $ayah->getPublisherHTML();
		    
		        
		        echo '<input type="Submit" name="submit" value=" Submit ">

		        </center>

				</tr></td>
				</table>';
			}