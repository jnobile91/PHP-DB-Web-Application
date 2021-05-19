<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	home.php
	User's home page. Used to navigate the website.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>User Home Page</title>
		<link rel=stylesheet" type="text/css" href="music.css"/>
    </head>
</html>

<?php

	session_start();
	require_once 'login.php';
	require_once 'navigation_bar.php';
	require_once 'is_logged_in.php';

	// Checks to see if the user is logged in, then displays welcome message
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		echo "<h2>Welcome ";
		echo "<font color = #7b00c7>".$_SESSION['username']."</font>";
		echo "!</h2>";
		echo "<br>Please use the navigation bar to get started.";
	}
	// This shouldn't be seen due to the "is_logged_in.php" file being called earlier,
	// but should display a message to prompt the user to login/register if not already logged in.
	else {
		echo "Please <a href='login_form.php'>log in</a> or use the navigation bar to get started!";
	}
	
?>