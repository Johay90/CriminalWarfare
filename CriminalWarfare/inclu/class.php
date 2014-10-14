<?php 
require_once("inclu/connect.php");
$dbh = dbconnect();

class UpdateUser {
	// properties
	var $user;
	var $rank;
	var $nRank;
	var $money;
	var $nMoneyStatus;

	// function = method
	public function WealthStatus(){
		global $dbh;
		$sql = "SELECT wealth FROM users WHERE username = '$this->user'";
		$result = $dbh->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$this->money = $row['wealth'];
		if ($this->money <= 9999) {
			$this->nMoneyStatus = "Broke";
		}
		if ($this->money >= 10000) {
			$this->nMoneyStatus = 'Strap for Cash';
		}
		if ($this->money >= 100000) {
			$this->nMoneyStatus = 'Gets by';
		}
		if ($this->money >= 1000000) {
			$this->nMoneyStatus = 'Rich';
		}
		if ($this->money >= 10000000) {
			$this->nMoneyStatus = 'On the Rich List';
		}
		if ($this->money >= 100000000) {
			$this->nMoneyStatus = 'More money than sense';
		}
		if ($this->money >= 100000000000) {
			$this->nMoneyStatus = 'Billionaire'; 
		}
		return $this->nMoneyStatus;
	}
	public function RankStatus(){
		global $dbh;
		include_once "inclu/message.class.php";

		$sql = "SELECT * FROM users WHERE username = '$this->user'";
		$result = $dbh->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$this->rank = $row['rank_exp'];

		if ($this->rank <= 749) {
			$this->nRank = "Scumbag";
		}
		if ($this->rank >= 750 AND $this->rank <= 2499) {
			$this->nRank = "Pickpocket";
			if ($row['rank'] != "Pickpocket"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to [b] Pickpocket [/b]! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 2500 AND $this->rank <= 5999) {
			$this->nRank = "Shoplifter";
			if ($row['rank'] != "Shoplifter"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to [b] Shoplifter [/b]! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 6000 AND $this->rank <= 17999) {
			$this->nRank = "Burglar";
			if ($row['rank'] != "Burglar"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to [b] Burglar [/b]! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 18000 AND $this->rank <= 39999) {
			$this->nRank = "Fraudster";
			if ($row['rank'] != "Fraudster"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Fraudster </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 40000 AND $this->rank <= 85999) {
			$this->nRank = "Armed Robber";
			if ($row['rank'] != "Armed Robber"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Armed Robber </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 86000 AND $this->rank <= 149999) {
			$this->nRank = "Associate";
			if ($row['rank'] != "Associate"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Associate </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 150000 AND $this->rank <= 219999) {
			$this->nRank = "Organized Criminal";
			if ($row['rank'] != "Organized Criminal"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Organized Criminal </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 220000 AND $this->rank <= 309999) {
			$this->nRank = "Enforcer";
			if ($row['rank'] != "Enforcer"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Enforcer </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 310000 AND $this->rank <= 459999) {
			$this->nRank = "Soldier";
			if ($row['rank'] != "Soldier"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Soldier </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 460000 AND $this->rank <= 634999) {
			$this->nRank = "Caporegime";
			if ($row['rank'] != "Caporegime"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Caporegime </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 635000 AND $this->rank <= 864999) {
			$this->nRank = "Underboss";
			if ($row['rank'] != "Underboss"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Underboss </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 865000 AND $this->rank <= 1199999) {
			$this->nRank = "Don";
			if ($row['rank'] != "Don"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Don </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		if ($this->rank >= 1200000) {
			$this->nRank = "Godfather";
			if ($row['rank'] != "Godfather"){
				$obj = new message();
				$obj->SendMessage($this->user, "Rank up", "Congratiations, you have successfully ranked up to <b> Godfather </b>! <br /><br />Note: These messages will be transfered over to the notfication bar/ticker.");
			}
		}
		return $this->nRank;
	}
	public function updateUser(){
		$var = new UpdateUser($_SESSION['user']);
		$update = $var->WealthStatus();
		global $dbh;
		$sql = "UPDATE users SET money_status = '$update' WHERE username = '$this->user'";
		$result = $dbh->prepare($sql);
		$result->execute();
		$rank_update = $var->RankStatus();
		$sql1 = "UPDATE users SET rank = '$rank_update' WHERE username = '$this->user'";
		$result1 = $dbh->prepare($sql1);
		$result1->execute();
		$var->population();
	}
	public function population(){
		global $dbh;

		$sql = "SELECT country FROM users";
		$result = $dbh->query($sql);
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);

		foreach ($rows as $row){

			$sql = "SELECT country FROM users WHERE country = '".$row['country']."'";
			$result = $dbh->query($sql);

			$count = $result->rowCount();

			$sql1 = "UPDATE countries SET population = '$count' WHERE name = '".$row['country']."'";
			$update = $dbh->query($sql1);
		}
	}
	public function __construct(){
		$this->user = $_SESSION['user'];
	}
}
class core{

	public $today;
	public $current_day;
	public $user;
	public $exptocalc;

	public function CreateAirline($owner, $name, $price, $bank, $fuel){

		
		global $dbh;
		$this->price = $price;

		$sql = "INSERT INTO airlines (owner, name, bank, fuel) VALUES (:owner, :name, :bank, :fuel)";
		$result = $dbh->prepare($sql);
		$result->bindValue(':owner', $owner);
		$result->bindValue(':name', $name);
		$result->bindValue(':bank', $bank);
		$result->bindValue(':fuel', $fuel);
		$result->execute();

		$this->takeMoney($this->price);
	}

	public function DropProp($type, $username){
		// type = type of prop should match the db such ass $type = airlines)
		// username must be dead or banned
	}

	public function takeMoney($money){
		$this->money = $money;

		global $dbh;

		$sql = "UPDATE users SET wealth = wealth -'$this->money' WHERE username = '$this->user'";
		$result = $dbh->query($sql);

	}

	public function giveMoney($money){
		$this->money = $money;

		global $dbh;

		$sql = "UPDATE users SET wealth = wealth +'$this->money' WHERE username = '$this->user'";
		$result = $dbh->query($sql);

	}

	public function addExp($amount){

		$this->amount = $amount;
		global $dbh;

		$sql = "SELECT rank_exp FROM users WHERE username = '$this->user'";
		$result = $dbh->query($sql);

		$sql = "UPDATE users SET rank_exp = rank_exp +$this->amount WHERE username = '$this->user'";
		$result = $dbh->query($sql);

	}

	public function bonusday(){

		global $dbh;
		
		$this->current_day = $current_day = date('D');

		if ($this->current_day == "Thu"){
			$sql = "UPDATE countries SET bonusday = 1 WHERE id = 1";
			$result = $dbh->query($sql);
		}

		if ($this->current_day == "Fri"){
			$sql = "UPDATE countries SET bonusday = 0 WHERE id = 1";
			$result = $dbh->query($sql);

			$sql = "UPDATE countries SET bonusday = 1 WHERE id = 2";
			$result = $dbh->query($sql);
		}

		if ($this->current_day == "Sat"){
			$sql = "UPDATE countries SET bonusday = 0 WHERE id = 2";
			$result = $dbh->query($sql);

			$sql = "UPDATE countries SET bonusday = 1 WHERE id = 3";
			$result = $dbh->query($sql);
		}

		if ($this->current_day == "Sun"){
			$sql = "UPDATE countries SET bonusday = 0 WHERE id = 3";
			$result = $dbh->query($sql);

			$sql = "UPDATE countries SET bonusday = 1 WHERE id = 4";
			$result = $dbh->query($sql);
		}

		if ($this->current_day == "Mon"){
			$sql = "UPDATE countries SET bonusday = 0 WHERE id = 4";
			$result = $dbh->query($sql);

			$sql = "UPDATE countries SET bonusday = 1 WHERE id = 5";
			$result = $dbh->query($sql);
		}

		if ($this->current_day == "Tue"){
			$sql = "UPDATE countries SET bonusday = 0 WHERE id = 5";
			$result = $dbh->query($sql);

			$sql = "UPDATE countries SET bonusday = 1 WHERE id = 6";
			$result = $dbh->query($sql);
		}

		if ($this->current_day == "Wed"){
			$sql = "UPDATE countries SET bonusday = 0 WHERE id = 6";
			$result = $dbh->query($sql);

			$sql = "UPDATE countries SET bonusday = 1 WHERE id = 7";
			$result = $dbh->query($sql);
		}

		$this->exptocalc = $this->exptocalc/4*16+128*5/8*2;

		return $this->exptocalc;
	}
	public function __construct(){

		global $dbh;

		$this->user = $_SESSION['user'];
	}
}

class travel extends core{

	public $user;
	public $miles;
	public $cpm; // cost per mile
	public $cost;
	public $time;
	public $timer;
	public $country;
	public $lumpsum;
	public $airline;
	public $fuel;

	public function airline(){
		// code after countries is working
		// default airline = default cooldown, high price
		// later on do maintain airline feature if you own a airline
	}
	public function addExp(){

		$this->addExp = $addExp;
		global $dbh;

		$sql = "SELECT rank_exp FROM users WHERE username = '$this->user'";
		$result = $dbh->query($sql);

		$exp = $result / 90;
		$res = $exp + 150;
		$this->addExp = floor($res);

		$sql = "UPDATE users SET rank_exp =  rank_exp +$this->addExp WHERE username = '$this->user'";
		$result = $dbh->query($sql);

	}
	public function calcCost($country, $airline){

		global $dbh;
		$this->bonusDay();
		$this->country = $country;
		$this->cpm = $cpm;
		$this->miles = $miles;
		$this->cost = $cost;
		$this->airline = $airline;

		$sql1 = "SELECT cpm FROM airlines WHERE id = $this->airline";
		$result1 = $dbh->query($sql1);
		$row1 = $result1->fetch(PDO::FETCH_ASSOC);

		$this->cpm = (int)$row1['cpm'];

		$sql = "SELECT country FROM users WHERE username = '$this->user'";
		$result = $dbh->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);

		if ($row['country'] == "Germany" AND $this->country == "England" OR $this->country=="Germany" AND $row['country'] == "England"){
			$this->miles = 632;
		}

		if ($row['country'] == "France" AND $this->country == "England" OR $this->country=="France" AND $row['country'] == "England"){
			$this->miles = 604;
		}

		if ($row['country'] == "Sweden" AND $this->country == "England" OR $this->country=="Sweden" AND $row['country'] == "England"){
			$this->miles = 1332;
		}

		if ($row['country'] == "United States" AND $this->country == "England" OR $this->country=="United States" AND $row['country'] == "England"){
			$this->miles = 4417;
		}

		if ($row['country'] == "Netherlands" AND $this->country == "England" OR $this->country=="Netherlands" AND $row['country'] == "England"){
			$this->miles = 405;
		}

		if ($row['country'] == "China" AND $this->country == "England" OR $this->country=="China" AND $row['country'] == "England"){
			$this->miles = 4873;
		}

		if ($row['country'] == "France" AND $this->country == "Germany" OR $this->country=="France" AND $row['country'] == "Germany"){
			$this->miles = 642;
		}

		if ($row['country'] == "Sweden" AND $this->country == "Germany" OR $this->country=="Sweden" AND $row['country'] == "Germany"){
			$this->miles = 885;
		}

		if ($row['country'] == "United States" AND $this->country == "Germany" OR $this->country=="United States" AND $row['country'] == "Germany"){
			$this->miles = 4885;
		}

		if ($row['country'] == "Netherlands" AND $this->country == "Germany" OR $this->country=="Netherlands" AND $row['country'] == "Germany"){
			$this->miles = 295;
		}

		if ($row['country'] == "China" AND $this->country == "Germany" OR $this->country=="China" AND $row['country'] == "Germany"){
			$this->miles = 4500;
		}

		if ($row['country'] == "Sweden" AND $this->country == "France" OR $this->country=="Sweden" AND $row['country'] == "France"){
			$this->miles = 500;
		}

		if ($row['country'] == "United States" AND $this->country == "France" OR $this->country=="United States" AND $row['country'] == "France"){
			$this->miles = 1000;
		}

		if ($row['country'] == "Netherlands" AND $this->country == "France" OR $this->country=="Netherlands" AND $row['country'] == "France"){
			$this->miles = 2000;
		}

		if ($row['country'] == "China" AND $this->country == "France" OR $this->country=="China" AND $row['country'] == "France"){
			$this->miles = 4486;
		}

		if ($row['country'] == "United States" AND $this->country == "Sweden" OR $this->country=="United States" AND $row['country'] == "Sweden"){
			$this->miles = 4761;
		}

		if ($row['country'] == "Netherlands" AND $this->country == "Sweden" OR $this->country=="Netherlands" AND $row['country'] == "Sweden"){
			$this->miles = 937;
		}

		if ($row['country'] == "China" AND $this->country == "Sweden" OR $this->country=="China" AND $row['country'] == "Sweden"){
			$this->miles = 4000;
		}

		if ($row['country'] == "Netherlands" AND $this->country == "United States" OR $this->country=="Netherlands" AND $row['country'] == "United States"){
			$this->miles = 4661;
		}

		if ($row['country'] == "China" AND $this->country == "United States" OR $this->country=="China" AND $row['country'] == "United States"){
			$this->miles = 7223;
		}

		if ($row['country'] == "China" AND $this->country == "Netherlands" OR $this->country=="China" AND $row['country'] == "Netherlands"){
			$this->miles = 4649;
		}


		$this->cost = $this->cpm*$this->miles;

		return $this->cost;
	}

	public function travel($country, $timer, $airline){
		$this->country = $country;
		$this->time = $time;
		$this->time = time();
		$this->timer = time()-$time-$timer = $timer;
		$this->airline = $airline;
		global $dbh;

		$sql = "SELECT * FROM countries WHERE name = '$this->country'";
		$rcount = $dbh->query($sql);

		if ($rcount->rowCount() == 1){

			$sql = "SELECT * FROM travel WHERE username = '$this->user'";
			$result = $dbh->query($sql);

			if ($result->rowCount() == 0){

				$sql = "INSERT INTO travel (country, username, time_left) VALUES (:country, '$this->user', '$this->time')";
				$result = $dbh->prepare($sql);
				$result->bindValue(':country', $this->country);
				$result->execute();

				$obj = new travel($this->user);
				$obj->calcCost($this->country, $this->airline);
				$obj->addExp();
				$obj->airlineBalance($obj->calcCost($this->country, $this->airline), $this->airline);

				$this->fuelUsage($obj->calcCost($this->country, $this->airline), $this->airline);

				$obj1 = new core($this->user);
				$obj1->takeMoney($obj->calcCost($this->country, $this->airline));

				$sql = "UPDATE users SET country = '$this->country' WHERE username = '$this->user'";
				$result = $dbh->query($sql);
			}		
		}
		return $this;
	}

	public function airlineBalance($addto, $airlineID){

		global $dbh;
		$this->addto = $addto;
		$this->airlineID = $airlineID;

		$sql = "UPDATE airlines SET bank = bank + :addto WHERE id = $airlineID";
		$run = $dbh->prepare($sql);
		$run->bindValue(':addto', $addto);
		$run->execute();
	}

	public function fuelUsage($cost, $airlineID){

		global $dbh;
		$this->cost = $cost;

		$this->fuel = $this->cost / 2;
		$this->fuel = $this->fuel/100 * 2;
		$this->fuel = floor($this->fuel);

		$sql = "UPDATE airlines SET fuel = fuel -:fuel WHERE id = $airlineID";
		$run = $dbh->prepare($sql);
		$run->bindValue(':fuel', $this->fuel);
		$run->execute();


		return $this->fuel;
	}

	public function lumpsum(){

		global $dbh;

		if (!isset($this->lumpsum)){
			$sql = "SELECT name FROM countries ORDER BY population DESC LIMIT 8";
			$result = $dbh->query($sql);
			$fetch = $result->fetch(PDO::FETCH_ASSOC);
			
			if ($fetch['name'] != $this->country) {

				$chance = rand(1,10000);
				if ($chance >= 9850){

					$rand = rand(1000000, 10000000);
					$this->lumpsum = $rand;

					$sql = "UPDATE users SET wealth = wealth +'$this->lumpsum' WHERE username = '$this->user'";
					$result = $dbh->query($sql);
				}
			}
		}
	}

	public function __construct(){

		$this->user = $_SESSION['user'];

	}
}


class crime extends core{

	public $user;

		public function UpdateLevel(){ // change to private

			global $dbh;

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM crimestats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

				// update level based on exp
			if ($row['exp'] > 5000 && $row['exp'] < 15000){
				$sql = "UPDATE crimestats SET level = 2 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 2){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 15000 && $row['exp'] < 45000){
				$sql = "UPDATE crimestats SET level = 3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 3){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 45000 && $row['exp'] < 99000){
				$sql = "UPDATE crimestats SET level = 4 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 4){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 99000 && $row['exp'] < 200000){
				$sql = "UPDATE crimestats SET level = 5 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 5){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 200000 && $row['exp'] < 355000){
				$sql = "UPDATE crimestats SET level = 6 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 6){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 355000 && $row['exp'] < 550000){
				$sql = "UPDATE crimestats SET level = 7 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 7){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 550000 && $row['exp'] < 1300000){
				$sql = "UPDATE crimestats SET level = 8 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 8){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 1300000 && $row['exp'] < 2850000){
				$sql = "UPDATE crimestats SET level = 9 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 9){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 2850000){
				$sql = "UPDATE crimestats SET level = 10 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}

		}

		public function SuccessCrimeExp(){ // change to private

			global $dbh;

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM crimestats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			if ($row['level'] == 1){
				$sql = "UPDATE crimestats SET exp = exp + 66 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 2){
				$sql = "UPDATE crimestats SET exp = exp + 68*2 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 3){
				$sql = "UPDATE crimestats SET exp = exp + 70*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 4){
				$sql = "UPDATE crimestats SET exp = exp + 71*4 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 5){
				$sql = "UPDATE crimestats SET exp = exp + 74*5 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 6){
				$sql = "UPDATE crimestats SET exp = exp + 76*6 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 7){
				$sql = "UPDATE crimestats SET exp = exp + 81*7 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 8){
				$sql = "UPDATE crimestats SET exp = exp + 84*8 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 9){
				$sql = "UPDATE crimestats SET exp = exp + 91*9 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 10){
				$sql = "UPDATE crimestats SET exp = exp + 100*10 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}

		}

		public function FailCrimeExp(){

			global $dbh;

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM crimestats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			if ($row['level'] == 1){
				$sql = "UPDATE crimestats SET exp = exp + 33 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 2){
				$sql = "UPDATE crimestats SET exp = exp + 34*2 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 3){
				$sql = "UPDATE crimestats SET exp = exp + 35*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 4){
				$sql = "UPDATE crimestats SET exp = exp + 36*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 5){
				$sql = "UPDATE crimestats SET exp = exp + 37*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 6){
				$sql = "UPDATE crimestats SET exp = exp + 38*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 7){
				$sql = "UPDATE crimestats SET exp = exp + 40*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 8){
				$sql = "UPDATE crimestats SET exp = exp + 42*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 9){
				$sql = "UPDATE crimestats SET exp = exp + 44*3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}
			if ($row['level'] == 10){
				$sql = "UPDATE crimestats SET exp = exp + 46*10 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
			}

		}

		public function CalcChance($pass){

			global $dbh;
			$this->pass = $pass;

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM crimestats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			if ($this->pass == "pass"){

				if ($row['level'] == 1){
					$rand = rand(4, 8);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 2){
					$rand = rand(4, 7);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 3){
					$rand = rand(4, 6);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 4){
					$rand = rand(4, 5);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 5){
					$rand = rand(3, 5);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 6){
					$rand = rand(3, 4);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 7){
					$rand = rand(2, 4);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 8){
					$rand = rand(2, 3);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 9){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 10){
					$sql = "UPDATE crimestats SET chance = 100 WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}

			}

			if ($this->pass == "fail"){

				if ($row['level'] == 1){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 2){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 3){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 4){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 5){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 6){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 7){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 8){
					$rand = rand(1, 2);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 9){
					$rand = rand(0, 1);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 10){
					$rand = rand(1, 3);
					$sql = "UPDATE crimestats SET chance = CASE WHEN chance + $rand > 100 THEN 100 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
			}
		}

		public function Crime($attempt){

			$this->attempt = $attempt;
			global $dbh;

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM crimestats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

					//execute
			$this->UpdateLevel();
			$this->CalcChance($this->attempt);

			$update = "UPDATE crimestats SET attempts = attempts + 1 WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($update);

			$scriptSQL = "UPDATE users SET count = count+3 WHERE username = '".$this->user."'";
			$scriptRUN = $dbh->query($scriptSQL);

			if ($this->attempt == "pass"){
				$this->SuccessCrimeExp();
				$update1 = "UPDATE crimestats SET success = success + 1 WHERE user_id = '".$userROW['id']."'";
				$result1 = $dbh->query($update1);

				if ($row['level'] == 1){
					$rand = rand(100, 400);
					$this->giveMoney($rand);
					$this->addExp(rand(50, 75));

					return $rand;
				}
				if ($row['level'] == 2){
					$rand = rand(300, 600);
					$this->giveMoney($rand);
					$this->addExp(rand(75, 125));

					return $rand;
				}
				if ($row['level'] == 3){
					$rand = rand(400, 800);
					$this->giveMoney($rand);
					$this->addExp(rand(90, 150));

					return $rand;
				}
				if ($row['level'] == 4){
					$rand = rand(500, 1200);
					$this->giveMoney($rand);
					$this->addExp(rand(150, 250));

					return $rand;
				}
				if ($row['level'] == 5){
					$rand = rand(600, 1400);
					$this->giveMoney($rand);
					$this->addExp(rand(250, 350));

					return $rand;
				}
				if ($row['level'] == 6){
					$rand = rand(700, 2000);
					$this->giveMoney($rand);
					$this->addExp(rand(350, 450));

					return $rand;
				}
				if ($row['level'] == 7){
					$rand = rand(800, 2500);
					$this->giveMoney($rand);
					$this->addExp(rand(550, 650));

					return $rand;
				}
				if ($row['level'] == 8){
					$rand = rand(1500, 4000);
					$this->giveMoney($rand);
					$this->addExp(rand(650, 750));

					return $rand;
				}
				if ($row['level'] == 9){
					$rand = rand(1700, 5000);
					$this->giveMoney($rand);
					$this->addExp(rand(850, 1000));

					return $rand;
				}
				if ($row['level'] == 10){
					$rand = rand(3000, 10000);
					$this->giveMoney($rand);
					$this->addExp(rand(1100, 1200));

					return $rand;
				}

			}

			if ($this->attempt == "fail"){
				$this->FailCrimeExp();
				$update = "UPDATE crimestats SET fail = fail + 1 WHERE user_id = '".$userROW['id']."'";
				$result = $dbh->query($update);
				$this->addExp(rand(25, 50));
			}
		}

		public function __construct(){

			$this->user = $_SESSION['user'];

		}

	}


	class jail extends core {

		public $user;

		public function SendToJail(){

			global $dbh;

			$getuserSQL = "SELECT * FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$existSQL = "SELECT * FROM jailstats WHERE user_id = '".$userROW['id']."'";
			$existRESULT = $dbh->query($existSQL);
			$existROW = $existRESULT->fetch(PDO::FETCH_ASSOC);

			$injailSQL = "SELECT * FROM jail WHERE user_id = '".$userROW['id']."'";
			$injailRESULT = $dbh->query($injailSQL);

			if ($injailRESULT->rowCount() == 0){

				$insert = "INSERT INTO jail (user_id, time_left, rank, username, access_time, link) VALUES (:user_id, :time_left, :rank, :username, :access_time, :link)";
				$insertEXE = $dbh->prepare($insert);
				$insertEXE->bindValue(':user_id', $userROW['id']);
				$insertEXE->bindValue(':time_left', time());
				$insertEXE->bindValue(':rank', $existROW['rank']);
				$insertEXE->bindValue(':username', $userROW['username']);
				$insertEXE->bindValue(':access_time', time());
				$insertEXE->bindValue(':link', sha1(rand()));
				$insertEXE->execute();
			}
		}

		public function JailRank(){
			global $dbh;

			$sql = "SELECT * FROM jailstats WHERE username = '".$_SESSION['user']."'";
			$run = $dbh->query($sql);
			$row = $run->fetch(PDO::FETCH_ASSOC);

			if ($row['exp'] <= 1000){
				$sql = "UPDATE jailstats SET rank = 'Beginner Jail Breaker' WHERE username ='".$this->user."'";
				$run = $dbh->query($sql);
			}

			if ($row['exp'] >= 1001 && $row['exp'] <= 7000){
				$sql = "UPDATE jailstats SET rank = 'Bagman', chance = 5 WHERE username ='".$this->user."'";;
				$run = $dbh->query($sql);
			}

			if ($row['exp'] >= 7001 && $row['exp'] <= 39999){
				$sql = "UPDATE jailstats SET rank = 'Bodyguard', chance = 15 WHERE username ='".$this->user."'";
				$run = $dbh->query($sql);
			}

			if ($row['exp'] >= 40000 && $row['exp'] <= 174999){
				$sql = "UPDATE jailstats SET rank = 'Safecracker', chance = 30 WHERE username ='".$this->user."'";
				$run = $dbh->query($sql);
			}

			if ($row['exp'] >= 175000 && $row['exp'] <= 650000){
				$sql = "UPDATE jailstats SET rank = 'Mastermind', chance = 40 WHERE username ='".$this->user."'";
				$run = $dbh->query($sql);
			}

			if ($row['exp'] >= 650001){
				$sql = "UPDATE jailstats SET rank = 'Professional Jail Breaker', chance = 50 WHERE username ='".$this->user."'";
				$run = $dbh->query($sql);
			}

		}

		public function BreakJail($id){

			$this->id = $id;
			global $dbh;

			$sql1 = "SELECT * FROM jailstats WHERE username = '".$this->user."'";
			$result = $dbh->query($sql1);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			$up = "UPDATE jailstats SET total = total+1 WHERE username = '".$this->user."'";
			$runup = $dbh->query($up);

			$scriptSQL = "UPDATE users SET count = count+2 WHERE username = '".$this->user."'";
			$scriptRUN = $dbh->query($scriptSQL);

			$rand = rand($row['chance'], 110);

			if ($rand >= 100){
				$this->SuccessBreakJail($this->id);
				$this->JailRank();
				$up = "UPDATE jailstats SET success = success+1 WHERE username = '".$this->user."'";
				$runup = $dbh->query($up);
				return "true";
			}

			if ($rand <= 99){
				$this->FailJailBreak($this->id);
				$this->JailRank();
				$up = "UPDATE jailstats SET fail = fail+1 WHERE username = '".$this->user."'";
				$runup = $dbh->query($up);
				return "false";
			}
		}

		public function FailJailBreak($id){

			$this->id = $id;
			global $dbh;

			$sql1 = "SELECT * FROM jailstats WHERE username = '".$this->user."'";
			$result = $dbh->query($sql1);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			if ($row['rank'] == "Beginner Jail Breaker"){
				$this->addExp(rand(3, 6));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(25, 50));
				$runupdate->execute();
			}

			if ($row['rank'] == "Bagman"){
				$this->addExp(rand(4, 8));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(25, 50));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Bodyguard"){
				$this->addExp(rand(8, 12));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(25, 50));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Safecracker"){
				$this->addExp(rand(15, 20));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(25, 50));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Mastermind"){
				$this->addExp(rand(15, 25));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(25, 50));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Professional Jail Breaker"){
				$this->addExp(rand(17, 30));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(25, 50));
				$runupdate->execute();
			} 

		}

		public function SuccessBreakJail($id){

			global $dbh;
			$this->id = $id;

		// delete user out of jail
			$sql = "DELETE FROM jail WHERE link = '".$this->id."'";
			$run = $dbh->query($sql);

		// give power rank exp based on jail rank
			$sql1 = "SELECT * FROM jailstats WHERE username = '".$this->user."'";
			$result = $dbh->query($sql1);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			if ($row['rank'] == "Beginner Jail Breaker"){
				$this->addExp(rand(5, 10));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(150, 200));
				$runupdate->execute();
			}

			if ($row['rank'] == "Bagman"){
				$this->addExp(rand(5, 15));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(150, 200));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Bodyguard"){
				$this->addExp(rand(10, 25));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(150, 200));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Safecracker"){
				$this->addExp(rand(15, 45));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(150, 200));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Mastermind"){
				$this->addExp(rand(20, 50));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(150, 200));
				$runupdate->execute();
			} 

			if ($row['rank'] == "Professional Jail Breaker"){
				$this->addExp(rand(25, 70));
				$update = "UPDATE jailstats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
				$runupdate = $dbh->prepare($update);
				$runupdate->bindValue(':exp', exp+rand(150, 200));
				$runupdate->execute();
			} 

		}


		public function __construct(){

			$this->user = $_SESSION['user'];

		}

	}

	class gta extends core{
		//TODO: add to garage, garage, timer, script check,
		// cars page (have speed, grip etc each have their own score then a overall score)
		public $user;

		public function DoGTA(){

			global $dbh;

			$sql1 = "SELECT * FROM gtastats WHERE username = '".$this->user."'";
			$result = $dbh->query($sql1);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			$rand = mt_rand(1, 100); 
			$successrate = $row['chance'];

			$this->UpdateLevel();

			if ($rand <= $successrate){
				$this->SucessfulGTA();
				$this->CalcChance("pass");
				return true;
			}

			if ($rand >= $successrate){
				$this->FailGTA();
				$this->CalcChance("fail");
				return false;
			}
		}

		public function CalcChance($pass){

			global $dbh;
			$this->pass = $pass;

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM gtastats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			if ($this->pass == "pass"){

				$rand = rand(3, 6);

				if ($row['level'] == 1){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 70 THEN 70 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 2){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 65 THEN 65 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 3){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 60 THEN 60 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 4){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 55 THEN 55 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 5){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 50 THEN 50 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
			}

			if ($this->pass == "fail"){

				$rand = rand(2, 3);

				if ($row['level'] == 1){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 70 THEN 70 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 2){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 65 THEN 65 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 3){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 60 THEN 60 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 4){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 55 THEN 55 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
				if ($row['level'] == 5){
					$sql = "UPDATE gtastats SET chance = CASE WHEN chance + $rand > 50 THEN 50 ELSE chance + $rand END WHERE user_id = '".$userROW['id']."'";
					$update = $dbh->query($sql);
				}
			}
		}

		public function UpdateLevel(){

			global $dbh;

			$getuserSQL = "SELECT id FROM users WHERE username = '".$_SESSION['user']."'";
			$getuserRESULT = $dbh->query($getuserSQL);
			$userROW = $getuserRESULT->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM gtastats WHERE user_id = '".$userROW['id']."'";
			$result = $dbh->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

				// update level based on exp
			if ($row['exp'] > 5000 && $row['exp'] < 15000){
				$sql = "UPDATE gtastats SET level = 2 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 2){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 15000 && $row['exp'] < 85000){
				$sql = "UPDATE gtastats SET level = 3 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 3){
					$sql1 = "UPDATE gtastats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 85000 && $row['exp'] < 206000){
				$sql = "UPDATE gtastats SET level = 4 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 4){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
			if ($row['exp'] > 206000){
				$sql = "UPDATE gtastats SET level = 5 WHERE user_id = '".$userROW['id']."'";
				$update = $dbh->query($sql);
				if ($row['level'] != 5){
					$sql1 = "UPDATE crimestats SET chance = 0 WHERE user_id = '".$userROW['id']."'";
					$update1 = $dbh->query($sql1);
				}
			}
		}

		public function SucessfulGTA(){
			global $dbh;

			$update = "UPDATE gtastats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
			$runupdate = $dbh->prepare($update);
			$runupdate->bindValue(':exp', exp+rand(150, 200));
			$runupdate->execute();
			
			$sql1 = "SELECT * FROM gtastats WHERE username = '".$_SESSION['user']."'";
			$result1 = $dbh->query($sql1);
			$row1 = $result1->fetch(PDO::FETCH_ASSOC);

			$this->CalcChance("pass");

			if ($row1['level'] == 1){
				$this->addExp(rand(150, 185));
				$sql = "SELECT * FROM cars WHERE class IN (1) ORDER BY RAND() LIMIT 1";
				$result= $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			}

			if ($row1['level'] == 2){
				$this->addExp(rand(165, 225));
				$sql = "SELECT * FROM cars WHERE class IN (1,2) ORDER BY RAND() LIMIT 1";
				$result= $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			}

			if ($row1['level'] == 3){
				$this->addExp(rand(250, 425));
				$sql = "SELECT * FROM cars WHERE class IN (1,2,3) ORDER BY RAND() LIMIT 1";
				$result= $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			}

			if ($row1['level'] == 4){
				$this->addExp(rand(550, 1100));
				$sql = "SELECT * FROM cars WHERE class IN (1,2,3,4) ORDER BY RAND() LIMIT 1";
				$result= $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			}

			if ($row1['level'] == 5){
				$this->addExp(rand(2500, 3500));
				$sql = "SELECT * FROM cars WHERE class IN (1,2,3,4,5) ORDER BY RAND() LIMIT 1";
				$result= $dbh->query($sql);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			}

			for ($i=0; $i<=250; $i++) { 
				$this->carDmg = $carDmg = mt_rand(0, 100);
			}

			$this->carname = $carname = $row['name'];
			$this->calcPerchent = $calcPerchent = ($carDmg / 100) * $row['worth'];
			$this->newCarWorth = $newCarWorth = floor($row['worth']-$calcPerchent);

			$garageSQL = "INSERT INTO garage (username, car_id, name, worth, dmg, country) VALUES (:username, :car_id, :name, :worth, :dmg, :country)";
			$prep = $dbh->prepare($garageSQL);
			$prep->bindValue(":username", strtolower($this->user));
			$prep->bindValue(":car_id", $row['id']);
			$prep->bindValue(":name", $this->carname);
			$prep->bindValue(":worth", $this->newCarWorth);
			$prep->bindValue(":dmg", $this->carDmg);
				// get user country current country -_-
				$sql = "SELECT country FROM users WHERE username = '".$this->user."'";
				$run = $dbh->query($sql);
				$cnt = $run->fetch(PDO::FETCH_ASSOC);
			$prep->bindValue(":country", $cnt['country']);
			$prep->execute();

			return $this->newCarWorth;
		}

		public function FailGTA(){
			global $dbh;

			$update = "UPDATE gtastats SET exp = exp+:exp WHERE username = '".$_SESSION['user']."'";
			$runupdate = $dbh->prepare($update);
			$runupdate->bindValue(':exp', exp+rand(150, 200));
			$runupdate->execute();

			$sql1 = "SELECT * FROM gtastats WHERE username = '".$_SESSION['user']."'";
			$result1 = $dbh->query($sql1);
			$row1 = $result1->fetch(PDO::FETCH_ASSOC);

			if ($row1['level'] == 1){
				$this->addExp(rand(50, 100));
			}
			if ($row1['level'] == 2){
				$this->addExp(rand(100, 150));
			}
			if ($row1['level'] == 3){
				$this->addExp(rand(150, 200));
			}
			if ($row1['level'] == 4){
				$this->addExp(rand(250, 300));
			}
			if ($row1['level'] == 5){
				$this->addExp(rand(450, 500));
			}

		}

		public function __construct(){

			$this->user = $_SESSION['user'];
		}


	}	
