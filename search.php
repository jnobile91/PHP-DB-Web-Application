<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	search.php
	Allows a user to search through the "music" database for specific records.
-->

<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="music.css"/>
    <?php require_once 'navigation_bar.php'; ?>
</head>
<body>
    <?php
	session_start();
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
	}
	require_once 'login.php';
	require_once 'is_logged_in.php';
	
    echo "<h2>Search <font color = #7b00c7>".$username."</font>'s list of music</h2>";
    ?>

    <form method="post" action="search_results.php";>
        <h3>Search criteria: </h3>
           <fieldset>
                <select name="column" size="1">
                    <option value="song">Song Name</option>
                    <option value="artist">Artist</option>
                    <option value="album">Album</option>
                    <option value="genre">Genre</option>
                    <option value="releaseYear">Release Year</option>
					<option value="songID">Song ID</option>
                </select>
               <input type="text" name="music"/><br>
               <input type="submit" value="Search Music"/><br>
               <input type="reset" value="Reset"/><br>
           </fieldset>
    </form>
</body>
</html>