<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	login.php
	Declares variable required to access other pages.
-->

<?php
	$hn = 'localhost';
	$un = 'jim';
	$pw = 'mypasswd';
	$db = 'music';
	$conn = new mysqli($hn, $un, $pw, $db); // TEST - Not sure if adding this here breaks functionality
	if(!$conn){
		die("Could not connect to database.");
	}
?>