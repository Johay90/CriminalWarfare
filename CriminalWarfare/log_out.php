<?php
session_start();
?>
<?php
include "inclu/connect.php";
	if (isset($_SESSION['user'])){
		if (isset($_SERVER['HTTP_COOKIE'])) {
   			 $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
   			 foreach($cookies as $cookie){
      	     $parts = explode('=', $cookie);
        	 $name = trim($parts[0]);
        	 setcookie($name, '', time()-1000);
        	 setcookie($name, '', time()-1000, '/');
    		}
    		session_destroy();
    		echo "<span>You have been logged out. Return to <a href='index.php'>Home</a></span>";
		}
	}else{
		echo "<span>You can't logout without a session! Return to <a href='index.php'>Home</a></span> ";
}
?>
<!doctype html>
<html>
<head>
			<title>Criminal Warfare - Logout</title>
			<link type="text/css" rel="stylesheet" href="main.css" />
			<script type="text/javascript" src="script.js"></script>
			</head>
</html>