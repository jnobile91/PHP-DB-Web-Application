<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	functions.php
	This file contains all of the functions to be used throughout the website.
-->

<?php

	// Sanitizes the user's input
	function mysql_entities_fix_string($conn, $string)
	{
		return htmlentities(mysql_fix_string($conn, $string));
	}
	
	function mysql_fix_string($conn, $string)
	{
		if (get_magic_quotes_gpc()) $string = stripslashes($string);
			return $conn->real_escape_string($string);
	}
	
	// Creates a string of user specified 'length' with random characters
	// To be used later to salt password
	function randomString($length)
	{
		$listOfChars = "1234567890-=qwertyuiop[]asdfghjkl;'zxcvbnm,./!@#$%^&*()_+";
		$size = strlen($listOfChars);
		$randString = "";
		for ($i = 0; $i < $length; $i++)
		{
			$randString .= $listOfChars[rand(0, $size - 1)];
		}
		return $randString;
	}

	// Validates PHP username
	function validate_username($val)
	{
		$hn = "localhost";
		$db = "music";
		$un = "jim";
		$pw = "mypasswd";
		$conn = mysqli_connect($hn, $un, $pw, $db);

		if (!$conn) {
			die("Could not successfully connect to the database.");
		}
		
		$query = "SELECT * FROM users WHERE username = '$val'";
		$result = mysqli_query($conn, $query);
		
		// Performs check for existing user
		if (mysqli_num_rows($result) > 0) {
			return "That username already exists.<br>";
		}
		else if ($val == "") {
			return "No value entered in 'username' field.<br>";
		}
		else if (strlen($val) < 5) {
			return "Username must be 5 or more characters.<br>";
		}
		else if (preg_match("/[^a-zA-Z0-9_-]/", $val)) {
			return "Can not use special characters in username.<br>";
		}
		return "";
	}

	// Validates password
	function validate_password($val)
	{
		if ($val == "") {
			return "No value entered in 'password' field.<br>";
		}
		else if (strlen($val) < 6) {
			return "Password must be 6 or more characters.<br>";
		}
		else if (!preg_match("/[a-z]/", $val) ||
				!preg_match("/[A-Z]/", $val) ||
				!preg_match("/[0-9]/", $val)) {
			return "Passwords require at least one lower case letter, one upper case letter, and one number.<br>";
		}
		return "";
	}
	
	// Validates confirmed password/repeated password
	function validate_conf_password($val1, $val2) {
		if ($val1 == "") {
			return "No value entered in 'confirm password' field.<br>";
		}
		else if ($val1 !== $val2) {
			return "Password and confirmed password do not match.<br>";
		}
		return "";
	}
	
	// Validates email address
	function validate_email($val) {
		if ($val == "") {
			return "No value entered in 'email' field.<br>";
		}
		else if (!((strpos($val, ".") > 0) &&
				(strpos($val, "@") > 0)) ||
				preg_match("/[^a-zA-Z0-9.@_-]/", $val)) {
			return "The email address entered is invalid.<br>";
		}
		return "";
	}

	// Validates song name
	function validate_song($val)
	{
		if ($val == "") {
			return "No value entered in 'song' field.<br>";
		}
		return "";
	}

	// Validates artist
	function validate_artist($val)
	{
		if ($val == "") {
			return "No value entered in 'artist' field.<br>";
		}
		return "";
	}
	
	// Validates album
	function validate_album($val)
	{
		if ($val == "") {
			return "No value entered in 'album' field.<br>";
		}
		return "";
	}
	
	// Validates genre
	function validate_genre($val)
	{
		if ($val == "") {
			return "No value entered in 'genre' field.<br>";
		}
		return "";
	}
	
	// Validates release year
	function validate_release_year($val)
	{
		if ($val == "") {
			return "No value entered in 'release year' field.<br>";
		}
		else if ($val <= 0) {
			return "Invalid year entered in 'release year' field.<br>";
		}
		return "";
	}
	
	// Validates songID
	function validate_song_id($val)
	{
		if ($val == "") {
			return "No value entered in 'Song ID' field.<br>";
		}
		else if (preg_match("/[^0-9]/", $val)) {
			return "Only digits are allowed in field 'Song ID'<br>";
		}
		return "";
	}
	
	// Checks to see if a song ID exists in the database
	function check_if_exists($val)
	{
		
		$hn = "localhost";
		$db = "music";
		$un = "jim";
		$pw = "mypasswd";
		$conn = mysqli_connect($hn, $un, $pw, $db);
		

		if (!$conn) {
			die("Could not successfully connect to the database.");
		}
		
		$query = "SELECT * FROM music WHERE songID = '$val'";
		$result = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($result) > 0) {
			return "That song ID already exists in the database.<br>";
		}
		return "";
	}
	
	// Checks to see if a specific song exists in the database, excluding song ID
	function check_if_song_exists($val1, $val2)
	{
		
		$hn = "localhost";
		$db = "music";
		$un = "jim";
		$pw = "mypasswd";
		$conn = mysqli_connect($hn, $un, $pw, $db);
		

		if (!$conn) {
			die("Could not successfully connect to the database.");
		}
		
		$query = "SELECT * FROM music WHERE artist = '$val1' AND song = '$val2'";
		$result = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($result) > 0) {
			return "That artist + song combination already exists in the database.<br>";
		}
		return "";
	}
	
	// Adds user if validated
	function add_user($conn, $username, $email, $hashed_pw, $salt1, $salt2)
	{
		$query = "INSERT INTO users(email, username, hashed_pw, salt1, salt2)
				VALUES('$email', '$username', '$hashed_pw', '$salt1', '$salt2')";
		$result = $conn->query($query);
		if (!$result) {
			die($conn->error);
		}
	}
	
	// Adds song entry into music database
	function add_song($conn, $songID, $artist, $album, $song, $genre, $releaseYear)
	{
		// $songID and $releaseYear must be cast into an int in order to be properly entered into the database
		$songIDInt = (int)$songID;
		$releaseYearInt = (int)$releaseYear;
		
		$query = "INSERT INTO music(songID, artist, album, song, genre, releaseYear)
				VALUES('$songIDInt', '$artist', '$album', '$song', '$genre', '$releaseYearInt')";
		$result = $conn->query($query);
		
		if (!$result) {
			die($conn->error);
		}
	}
		
	// Deletes song entry from music database
	function delete_song($conn) {
		$val = $_POST['songID'];
		$query = "DELETE FROM music WHERE songID = '$val'";
		//$result = mysqli_query($conn, $query);
		$result = $conn->query($query);
		
		if (!$result) {
			die($conn->error);
		}
		else if ($result) {
			echo "You did it!";
		}
	}
?>