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