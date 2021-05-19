<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	not_logged_in.php
	Sent here from "is_logged_in.php" file. If the user is not
	logged in this file will force the user to log in and redirect them
	to the login screen.
-->

<style>
	<?php include 'music.css'; ?>
</style>

<?php

	header('Refresh: 5; URL="login_form.php"');
	echo "You must be logged in to access this page.<br>Log in by using the link below, or you will be redirected momentarily.<br>";
	echo "<a href='login_form.php'><font color = white> Login</a>";

?>