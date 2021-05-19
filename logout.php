<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	logout.php
	Logs the user out of their current session.
-->

<style>
	<?php include 'music.css'; ?>
</style>

<?php
	// Clears SESSION array
	session_start();
	$_SESSION = array();

	// Sets session to an old name and cookie to a time in the past, clearing the session
	setcookie(session_name(), '', time() - 2592000, '/');
	session_destroy();

	// Returns user to the login screen
	echo "You have successully logged out. Returning to the home screen momentarily...";
	header('Refresh: 3;URL=login_form.php');
	exit();
?>