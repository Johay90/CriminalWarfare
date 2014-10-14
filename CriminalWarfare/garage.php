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

if ($_SERVER["REQUEST_METHOD"] == POST) {

	if (isset($_POST['sellall'])){

		$sql = "SELECT SUM(worth) FROM garage WHERE username ='".$_SESSION['user']."'";
		$res = $dbh->query($sql);
		$total = $res->fetch(PDO::FETCH_ASSOC);

		echo "You sucessfully sold cars for <b> $" . number_format($total['SUM(worth)'], 0);

		$update = "UPDATE users SET wealth = wealth + '".$total['SUM(worth)']."' WHERE username = '".$_SESSION['user']."'";
		$updateres = $dbh->query($update);
	}

}

elseif ($_SERVER["REQUEST_METHOD"] == GET){

	echo '<div class="container">
		<div class="contentwrap">
		<div class="content">

		<table width="100%" id="diff">

		<col width="5">
		<col width="25">
		<col width="10">
		<col width="10">
		<col width="15">

		<tr><th colspan="5">Garage</tr></th>
		<tr><td class="subheader" colspan="1" align="center"><span>Select</span></td>
		<td class="subheader" colspan="1" align="center"><span>Car</span></td>
		<td class="subheader" colspan="1" align="center"><span>Damage (%)</span></td>
		<td class="subheader" colspan="1" align="center"><span>Value</span></td>
		<td class="subheader" colspan="1" align="center"><span>Country</span></td>
		</tr>';

		try {
    $total = $dbh->query('
        SELECT
            COUNT(*)
        FROM
            garage
    ')->fetchColumn();
    if ($total >= 1){
	    $limit = 15;
	    $pages = ceil($total / $limit);
	    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
	        'options' => array(
	            'default'   => 1,
	            'min_range' => 1,
	        ),
	    )));
	    $offset = ($page - 1)  * $limit;
	    $start = $offset + 1;
	    $end = min(($offset + $limit), $total);
	    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">Prev</a>' : '<span class="disabled"></span> <span class="disabled"></span>';
	    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page" align="right">Next</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled"></span> <span class="disabled"></span>';
	    echo '<div id="paging"><div style="float: left">', $prevlink, '</div><div style="float: right">', $nextlink, ' </p></div>';
	    $stmt = $dbh->prepare('
	        SELECT
	            *
	        FROM
	            garage
	        ORDER BY
	            id
	        LIMIT
	            :limit
	        OFFSET
	            :offset
	    ');
	    $stmt->bindParam(':limit', $limit, PDO:: PARAM_INT);
	    $stmt->bindParam(':offset', $offset, PDO:: PARAM_INT);
	    $stmt->execute();
	    if ($stmt->rowCount() > 0) {
	        $stmt->setFetchMode(PDO::FETCH_ASSOC);
	        $iterator = new IteratorIterator($stmt);

			/*$sql = "SELECT * FROM garage WHERE username = '".$_SESSION['user']."'";
			$run = $dbh->query($sql);
			$rows = $run->fetchAll(PDO::FETCH_ASSOC);*/

			foreach ($iterator as $row) {

				echo '<tr>
				<td style="padding-left: 5px" align="center"><input type="checkbox" name="chk" value="'.$row['id'].'"></td>
				<td style="padding-left: 5px" align="center">'.$row['name'].'</td>
				<td style="padding-left: 5px" align="center">'.$row['dmg'].'</td>
				<td style="padding-left: 5px" align="center">$'.number_format($row['worth'], 0).'</td>
				<td style="padding-left: 5px" align="center">'.$row['country'].'</td>
				</tr>';
			}
		}

    }

} catch (Exception $e) {
    echo '<p>', $e->getMessage(), '</p>';
}

		echo '</table>
		<form name="form" method="POST" action="'. $_SERVER['PHP_SELF'] . '">

		<center> <!-- Lets use a tag that not longer exist ^_^ -->
		<br /><button type="submit" name="sellSct">Sell Selected Cars</button>
		<button type="submit" name="sellall">Sell All</button>
		<button type="submit" name="rprSct">Repair Selected Cars</button><br /><br />
		<button type="submit" name="mvecar">Move Selected Cars To: </button>
		<select name="countries">';

		$sql = "SELECT name FROM countries";
		$run = $dbh->query($sql);
		$rows = $run->fetchAll(PDO::FETCH_ASSOC);

		foreach ($rows as $row){
			echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
		}
		
		echo '</select>
		</form>
		</center>


		';

}