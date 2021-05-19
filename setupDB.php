<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	setupDB.php
	Code required to initially set up the database.
-->

<?php

/* 
The following should be run in CMD prompt to initialize the database:

mysql -u root
CREATE DATABASE music;
USE music;
CREATE USER IF NOT EXISTS 'jim'@'localhost' IDENTIFIED BY 'mypasswd';
GRANT ALL ON music.* TO 'jim' @ 'localhost';

*/

	// Calls login.php to identify the user.
    require_once  'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
	
	// Checks to see if a connection was established.
    if ($conn->connect_error) die ($conn->connect_error);

    // This query creates the users table.
    $query = "CREATE TABLE IF NOT EXISTS users (
      email VARCHAR(60) NOT NULL UNIQUE,
      username VARCHAR(20) NOT NULL UNIQUE,
      hashed_pw VARCHAR(64) NOT NULL UNIQUE,
      salt1 VARCHAR(30) NOT NULL,
      salt2 VARCHAR(30) NOT NULL,
      PRIMARY KEY (username)
    )";

    $result = $conn->query($query);
	
	// Checks to see if a connection was established. Prints error message if no.
    if (!$result) die ("Database access failed: " . $conn->error);
	
	// Otherwise, outputs success message.
    else echo "Users table created successfully.<br>";

	// Creates second query to make a new table for music.
    $query2 = "CREATE TABLE IF NOT EXISTS music (
      songID INT NOT NULL AUTO_INCREMENT,
	  artist VARCHAR(50) NOT NULL,
      album VARCHAR(50) NOT NULL,
	  song VARCHAR(50) NOT NULL,
      genre VARCHAR(50) NOT NULL,
      releaseYear INT NOT NULL,
      PRIMARY KEY (songID)
    )";

    $result2 = $conn->query($query2);
	// Checks to see if a connection was established. Prints error message if no.
    if (!$result2) die ("Database access failed: " . $conn->error);
	
	// Otherwise, outputs success message.
    else echo "Music table created successfully.<br>";

?>
