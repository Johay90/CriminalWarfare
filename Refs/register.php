<?php
require('db_connection.php');
$dbh = dbconnect();
?>

<form name="input" action="reg2.php" method="POST">
Username: <input type="text" name="username"> </input> <br />
E-mail:   <input type="text" name="email"> </input> <br />
Confirm-email:   <input type="text" name="email2"> </input> <br />
Password: <input type="password" name="password"> </input><br />
Confirm Password: <input type="password" name="password2"> </input><br />
<input type="submit" value="Submit">