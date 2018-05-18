<?php
//Connection Variables
$host        = "host=HOST_HERE";
$port        = "port=PORT_HERE";
$dbname      = "dbname=DBNAME_HERE";
$credentials = "user=USER_HERE password=PASSWORD_HERE";

//GET Variables
$memberId = $_GET["memberid"];
$memberIp = $_GET["memberip"];

//Connect to the database
$dbConnection = pg_connect("$host $port $dbname $credentials");

//If the member doesn't have this IP stored, then store it within the database
$queryCheckIP =<<<EOF
      SELECT * FROM "IPRecord" WHERE "memberId"=$memberId AND "memberIp"='$memberIp';
EOF;
$result = pg_query($dbConnection, $queryCheckIP);
if(!pg_num_rows($result)) {
	$queryInsertIP =<<<EOF
      INSERT INTO "IPRecord" ("memberId","memberIp") VALUES ($memberId, '$memberIp');
EOF;
	if(pg_query($dbConnection, $queryInsertIP)) {
		echo "IP Address was added onto the record!";
	} else {
		echo pg_last_error($dbConnection);
	}
} else {
	echo "IP Address already stored!";
}

pg_close($dbConnection); //close the database
?>