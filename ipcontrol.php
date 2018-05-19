<?php
//Connection Variables
$host        = "host=HOST_HERE";
$port        = "port=PORT_HERE";
$dbname      = "dbname=DBNAME_HERE";
$credentials = "user=USER_HERE password=PASSWORD_HERE";

//POST Variables
$password = "CREATE_PASSWORD_HERE";
$guessedPassword = $_POST["guessedPassword"];
?>

<html>
<body>
<header>
	<title>IP Control</title>
</header>
<main>
<?php
//Check if the guessed password is correct
if($guessedPassword == $password) {
	//connect to the database
	$dbConnection = pg_connect("$host $port $dbname $credentials");
	echo '
		<form method="POST">
			Search Member ID Information:</br>
			<input id="infoText" type="number" name="searchId">
			<input hidden value="'.$password.'" name="guessedPassword"></label>
			<input type="submit" value="Search">
		</form>
		<form method="POST">
			IP Ban Member ID:</br>
			<input id="banText" type="number" name="banId">
			<input hidden value="'.$password.'" name="guessedPassword"></label>
			<input type="submit" value="Ban">
		</form>
		<form method="POST">
			Unban IP of Member ID:</br>
			<input id="unbanText" type="number" name="unbanId">
			<input hidden value="'.$password.'" name="guessedPassword"></label>
			<input type="submit" value="Unban">
		</form>
	';
	
	//initiate the submitted command
	if(isset($_POST["searchId"])) {
		//get the information on a memberId
		$memberId = $_POST["searchId"];
		echo '<p style="color: green; font-weight: bold">IP Information on Member ID '.$memberId.':</p>';
		$queryInfo =<<<EOF
		SELECT * FROM "IPRecord" WHERE "memberId"=$memberId;
EOF;
		$result = pg_query($dbConnection, $queryInfo);
		if(pg_num_rows($result)) {
			while($row = pg_fetch_assoc($result)) {
				$memberId = $row['memberId'];
				$memberIp = $row['memberIp'];
				$bannedStatus = $row['banned'];
				if($bannedStatus == "f") {
					$bannedStatus = "Not IP Banned!";
				} else {
					$bannedStatus = "Yes, IP Banned!";
				}
				echo '- IP Address: '.$memberIp.' ~ IP Banned Status: '.$bannedStatus.'</br>';
			}
		} else {
			echo '<p style="color: red">Info Error: No IP Address in the database for member id: '.$memberId.'</p>';
		}
	} else if(isset($_POST["banId"])) {
		//set an IP ban on the memberId
		$memberId = $_POST["banId"];
		$queryBan =<<<EOF
		SELECT * FROM "IPRecord" WHERE "memberId"=$memberId;
EOF;
		$result = pg_query($dbConnection, $queryBan);
		if(pg_num_rows($result)) {
			while($row = pg_fetch_assoc($result)) {
				$memberIp = $row['memberIp'];
				$querySetBan =<<<EOF
				UPDATE "IPRecord" set banned = true WHERE "memberId"=$memberId AND "memberIp"='$memberIp';
EOF;
				pg_query($dbConnection, $querySetBan);
				shell_exec("sudo iptables -A INPUT -s " . $memberIp . " -j DROP");
				echo '<p style="color: green">Banned IP Address '.$memberIp.' of member id '.$memberId.'</p>';
			}
		} else {
			echo '<p style="color: red">Ban Error: No IP Address in the database for member id: '.$memberId.'</p>';
		}
	} else if(isset($_POST["unbanId"])) {
		//set an unban on the IP of the memberId
		$memberId = $_POST["unbanId"];
		$queryBan =<<<EOF
		SELECT * FROM "IPRecord" WHERE "memberId"=$memberId;
EOF;
		$result = pg_query($dbConnection, $queryBan);
		if(pg_num_rows($result)) {
			while($row = pg_fetch_assoc($result)) {
				$memberIp = $row['memberIp'];
				$querySetUnBan =<<<EOF
				UPDATE "IPRecord" set banned = false WHERE "memberId"=$memberId AND "memberIp"='$memberIp';
EOF;
				pg_query($dbConnection, $querySetUnBan);
				shell_exec("sudo iptables -D INPUT -s " . $memberIp . " -j DROP");
				echo '<p style="color: green">Unbanned IP Address '.$memberIp.' of member id '.$memberId.'</p>';
			}
		} else {
			echo '<p style="color: red">Unban Error: No IP Address in the database for member id: '.$memberId.'</p>';
		}
	}
} else if(isset($guessedPassword)) {
	//show the input password form, with an incorrect password text
	echo '
		<form method="POST" action="ipcontrol.php">
			Enter password to enter the console:</br>
			<input type="password" name="guessedPassword" placeholder="Enter Password...">
			<input type="submit" value="Submit">
		</form>
		<p style="color: red">Incorrect password!</p>
		<h4>Programmed by Shadowsych:
			<a href="https://github.com/Shadowsych" target="blank">https://github.com/Shadowsych</a>
		</h4>
	';
} else {
	//show the input password form
	echo '
		<form method="POST" action="ipcontrol.php">
			Enter password to enter the console:</br>
			<input type="password" name="guessedPassword" placeholder="Enter Password...">
			<input type="submit" value="Submit">
		</form>
		<h4>Programmed by Shadowsych:
			<a href="https://github.com/Shadowsych" target="blank">https://github.com/Shadowsych</a>
		</h4>
	';
}
?>
</main>
<footer>
</footer>
</body>
</html>