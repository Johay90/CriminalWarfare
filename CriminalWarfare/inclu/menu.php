<?php
ob_start();
include_once "inclu/connect.php";
online_check();
$dbh = dbconnect();
if(isset($_SESSION['user'])){
		
			echo '<div class="menu">

			<div id="heading1">
			<h1>General<hr></h1></div>

			<ul class="heading1">

			<li class="heading1"><a href="index.php">News</a><br /></li>
			<li class="heading1"><a href="ticket.php">Ticket System</a></li>

			</ul>

			<div id="heading2">
			<h1>Community</h1><hr></div>

			<ul class="heading2">

			<li class="heading2"><a href="forum.php">Main Forum</a></li>
			<li class="heading2"><a href="blog.php">Staff Blog</a></li>
			<li class="heading2"><a href="create_article.php">Post a blog</a></li>

			</ul>

			<div id="heading4">

			<h1>Messaging<hr></h1></div>

			<ul class="heading4">

			<li class="heading4"><a href="display_message.php">Display Message</a><br /></li>
			<li class="heading4"><a href="message.php">Send Message</a><br /></li>
			<li class="heading4"><a href="savedmsg.php">Saved Messages</a></li>

			</ul>

			<div id="heading5">

			<h1>Gameplay<hr></h1></div>

			<ul class="heading5">

			<li class="heading5"><a href="country.php">Travel</a><br /></li>
			<li class="heading5"><a href="airline.php">Airlines</a></li>
			<li class="heading5"><a href="crime.php">Commit a Crime</a></li>
			<li class="heading5"><A href="jail.php">Jail</a></li>
			<li class="heading5"><A href="gta.php">Grand Theft Auto</a></li>
			<li class="heading5"><A href="garage.php">Garage</a></li>
			<li class="heading5"><A href="debug.php">Debug</a></li>


			</ul>

			<div id="heading6">

			<h1>Messaging<hr></h1></div>

			<ul class="heading6">

			<li class="heading6"><a href="stats.php">Site Stats</a><br /></li>
			<li class="heading6"><a href="search.php">Search User</a><br /></li>
			<li class="heading6"><a href="online.php">Users Online</a><br /></li>
			<li class="heading6"><a href="profile.php">Profile</a></li>

			</ul>


		</div>

		<div class="statusbar">

		<h1>Personal Stats</h1><hr>';

		$sql = "SELECT * FROM send_message WHERE visitied = 0 AND sendto = '". $_SESSION["user"] . "' ORDER BY id desc";
		$stmt = $dbh->query($sql);
			if ($stmt->rowCount() >= 1){ echo '<center><a href="display_message.php">You have mail!</a><br /></center>'; }else{ echo "<center><p>You don't have mail</center></p><br />"; }
		echo '<p>Username: <span>' . $_SESSION["user"] . '</span> <a href="log_out.php">(logout)</a>';

			$sql = "SELECT rank FROM users WHERE username ='" . $_SESSION['user'] . "'";
			$stmt = $dbh->query($sql);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			echo "<br />Rank: <span>" .$result['rank'] . "</span>";
			$sql = "SELECT wealth FROM users WHERE username ='" . $_SESSION['user'] . "'";
			$stmt = $dbh->query($sql);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			echo "<br />Money: <span>$".number_format($result['wealth'], 0) . "</span>";
			$sql = "SELECT country FROM users WHERE username ='" . $_SESSION['user'] . "'";
			$stmt = $dbh->query($sql);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			echo "<br />Country:<span> ".($result['country']) . "</span></p>";
			echo "</div></html></body>";

		echo '</div>';
	}
?>