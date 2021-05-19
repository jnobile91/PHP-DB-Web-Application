<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	register_form.php
	Allows a new user to register for the website.
-->

<?php
    session_start();
	require_once "login.php";
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error){
		die("Fatal Error.");
	}
    if(isset($_SESSION['username']))
    {
        // Redirects to the home screen if user is already logged in
        header("Location:home.php");
    }
    require_once 'navigation_bar.php';
?>
<!DOCTYPE html>
<script src="user_validation.js"></script>
<html>
<head>
    <!--<meta charset="UTF-8">-->
    <title>Music Database Registration</title>
	<style>
		.signup {
			border:1px solid #999999;
			font: normal 14px helvetica;
			color: #444444;
		}
	</style>
</head>
<body>
<table class="signup" border="0" cellpadding="2" cellspacing="5">
    <th colspan="2" align="center">User Registration Form</th>
    
	<form method="post" action="register_process.php" onsubmit="return validate(this)">
	
	<form method="post" action="register_process.php";>
        <tr><td>Username:</td>
            <td><input type="text" maxlength="50" name="username"></td></tr>
        <tr><td>Email:</td>
            <td><input type="text" maxlength="50" name="email"></td></tr>
        <tr><td>Password:</td>
            <td><input type="password" maxlength="20" name="password"></td></tr>
        <tr><td>Confirm Password:</td>
            <td><input type="password" maxlength="20"  name="confirm_password"></td></tr>
        <tr><td colspan="2" align="center"><input type="submit" value="Signup"></td></tr>
        <tr><td>Already a member? <a href ="user_form.php">Login here.</a>
        </td></tr>
    </form>
</table>
</body>
</html>