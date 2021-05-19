<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	login_form.php
	Prompts user for login credentials. Otherwise informs user that they must register an account to proceed.
-->

<?php
	session_start();
	
	// Checks to see if the user is already logged in,
	// if true redirects to home screen.
    if(isset($_SESSION['username']))
    {
        header("Location:home.php");
    }
    require_once 'navigation_bar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <?php require_once 'navigation_bar.php';?>
	<link rel=stylesheet" type="text/css" href="music.css"/>
</head>
<body>
    <table border="0" cellpadding="2" cellspacing="5">
        <th colspan="2" align="center">Sign In</th>
        <form method="post" action="user_login.php">
            <tr>
                <td>Username</td>
                <td><input type="text" maxlength="50" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" maxlength="20" name="password"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Sign In" ></td>
            </tr>
            <tr>
                <td>Not a member? <a href ="register_form.php">Sign up here</a></td>
            </tr>
        </form>
    </table>
</body>
</html>