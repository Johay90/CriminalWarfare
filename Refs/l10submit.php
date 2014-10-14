<?php 
require('db_connection.php');
$dbh = dbconnect();

$ref = $_POST['refid'];
$email = $_POST['email'];
$region = $_POST['region'];
$amount = $_POST['amount'];

if (empty($ref)){
	echo "Please enter your referal link";
	die();
}

	if (empty($email)){
		echo "Please enter your email address";
		die();
	}

		if (empty($region)){
			echo "We didn't recognize that region";
			die();
		}

			if (empty($amount)){
				echo "Please use the drop down menu to choose the amount of referals you wish to order";
				die();
			}

else{
	try {
	    $sql = "INSERT INTO pre_order (email, region, amount, ref_id, status) VALUES ('$email', '$region', '$amount', '$ref', 0)";
	    $sth = $dbh->query($sql); 
	    echo "Your details have been sent. We will be in touch shortly regarding your order.";
		} 
			catch(PDOExepction $e) {
			    echo $e->getMessage();
			}
}

?>