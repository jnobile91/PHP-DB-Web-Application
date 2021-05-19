<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	user_login.php
	Process required for checking if login credentials are correct.
	If invalid, prompts the user to retry.
-->

<?php

	session_start();
	require_once "login.php";
	require_once "functions.php";

	// Sanitizes user input
    if (isset($_POST['username']) && (isset($_POST['password'])) ) {
        $username = mysql_entities_fix_string($conn, $_POST['username']);
        $password = mysql_entities_fix_string($conn, $_POST['password']);
    }
    else {
        //header("Location:login.html");
        die( "Username and password must be entered.");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Compares user input $username to compare against password
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    // Runs if username is returned from SELECT query
    if(mysqli_num_rows($result) > 0)
    {
        // Fetches result as associative array to compare data
        while($row = mysqli_fetch_assoc($result))
        {
            $email = $row['email'];
            $username = $row['username'];
            $hashed_pw = $row['hashed_pw'];
            $salt1 = $row['salt1'];
            $salt2 = $row['salt2'];
        }

        // Creates token with salt1 and salt2 to compare against user's hashed_pw
        $token = hash('sha256', "$salt1+$password+$salt2");

        // Checking for match between token and hashed_pw
        if ($token === $hashed_pw)
        {
            // Begins session if password is correct
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            header('location:home.php');
        }
        else{

            echo "Invalid username or password. Please try again. ";
            echo "<a href='login_form.php'>Login</a>";
        }
    }
	
    // Otherwise sends the user back to login
    else{
        echo "Invalid username or password. Please try again. ";
        echo "<a href='login_form.php'>Login</a>";
    }
	
?>