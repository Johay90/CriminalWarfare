<?php
session_start();
?>

<?php
include('db_connection.php');
not_logged_in();

echo "You are now logged in as <b>" . $_SESSION['user'] . " <a href='preorder.php'>Pre-Order</a> || <a href='destroy.php'>[Logout]</a>";

?>