<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	is_logged_in.php
	Checks to see if the user is logged in, otherwise redirects
	to "not_logged_in.php" to prompt login attempt.
-->

<?php

	if (!isset($_SESSION['username']))
	{
		header("Location: not_logged_in.php");
	}

?>