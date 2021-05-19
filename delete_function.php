<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	delete_function.php
	This is a separate php file that contains the functionality necessary
	to delete records from the database.
-->

<?php

	session_start();
	require_once "navigation_bar.php";
    require_once "login.php";
	require_once 'is_logged_in.php';
	$conn = mysqli_connect($hn, $un, $pw, $db);
	if ($conn->connect_error) {
		die("Fatal Error");
	}
	
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
	}
	
    $deleteRecord = $_POST['songID'];
    $query = "DELETE FROM music WHERE songID = '$deleteRecord'";
    $result = mysqli_query($conn, $query);
	
	if ($result) {
		echo "<h2><font color = #7b00c7>".$username."</font> successfully deleted record with Song ID: '$deleteRecord'<br></h2>";
	}
	else if (!$result) {
		die("Database access failed.");
	}

?>