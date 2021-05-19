<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	register_process.php
	This file contains the process for adding a new user to the "users" table
	within the database, allowing the user to log in using their credentials later.
-->

<?php
    require_once "login.php";
    require_once "functions.php";
	// Runs the user_validation.js script during register_process, utilizing the code at the bottom of this file
    echo "<script src='user_validation.js'> </script>";
	
	$username = $email = $password = $confirm_password = "";
	$conn = new mysqli($hn, $un, $pw, $db);

	// Sanitizes user input for all fields
	if (isset($_POST['username']))
		$username = mysql_entities_fix_string($conn, $_POST['username']);
	if (isset($_POST['email']))
		$email = mysql_entities_fix_string($conn, $_POST['email']);
	if (isset($_POST['password']))
		$password = mysql_entities_fix_string($conn, $_POST['password']);
	if (isset($_POST['confirm_password']))
		$confirm_password = mysql_entities_fix_string($conn, $_POST['confirm_password']);

	// Checks to see if all fields meet validation criteria
	$fail  = validate_username($username);
	$fail .= validate_email($email);
	$fail .= validate_password($password);
	$fail .= validate_conf_password($confirm_password, $password);


	echo "<!DOCTYPE html>\n<html><head><title>Music Form</title>";
    require_once 'navigation_bar.php';

	// Checks to see if "fail" is clear, then hashes password and adds user to the database
	if ($fail == "")
	{
		$salt1 = randomString(10);
		$salt2 = randomString(10);
		$token = hash('sha256', "$salt1+$password+$salt2");
		
		add_user($conn, $username, $email, $token, $salt1, $salt2);

		echo "<h2>Congratulations <font color = #7b00c7>$username</font>, you are now registered!</br></h2>";
		echo "<a href='user_form.php'>Login</a>";
		exit;
	}
	

	// This references "validate(this)" function, defined in user_validation.js
	echo <<<_END

	<!-- HTML/JavaScript section -->

	<body>
		<table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
		  <th colspan="2" align="center">List of Music</th>

			<tr><td colspan="2">Sorry, the following errors were found<br>
			  in your form: <p><font color=red size=1><i>$fail</i></font></p>
			</td></tr>

		  <form method="post" action="register_process.php" onSubmit="return validate(this)">
			<tr><td>Username</td>
			  <td><input type="text" maxlength="50" name="username" value="$username">
			</td></tr><tr><td>Email</td>
			  <td><input type="text" maxlength="50" name="email"  value="$email">
			</td></tr><tr><td>Password</td>
			  <td><input type="password" maxlength="20" name="password" value="$password">
			</td></tr><tr><td>Confirm Password</td>
			  <td><input type="password" maxlength="20" name="confirm_password" value="$confirm_password">
			</td></tr><tr><td colspan="2" align="center"><input type="submit"
			  value="Signup"></td></tr>
			</td></tr>
			  <tr><td>Already a member? <a href ="user_form.php">Login here.</a>
			</td></tr>
		  </form>
		</table>
	</body>
	</html>

_END;
?>






