<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	add.php
	This file is responsible for adding a record to the previously
	established database "music".
-->

<?php

	session_start();
	require_once 'login.php';
	require_once 'is_logged_in.php';
	require_once 'functions.php';
	require_once 'navigation_bar.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) {
		die ("Fatal error.");
	}
	
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
	}

  if (isset($_POST['songID']) &&
	  isset($_POST['artist']) &&
      isset($_POST['album']) &&
      isset($_POST['song']) &&
      isset($_POST['genre']) &&
      isset($_POST['releaseYear']))
	  {
		$songID = mysql_entities_fix_string($conn, $_POST['songID']);
		$artist = mysql_entities_fix_string($conn, $_POST['artist']);
		$album = mysql_entities_fix_string($conn, $_POST['album']);
		$song = mysql_entities_fix_string($conn, $_POST['song']);
		$genre = mysql_entities_fix_string($conn, $_POST['genre']);
		$releaseYear = mysql_entities_fix_string($conn, $_POST['releaseYear']);
	  }

	$fail = validate_song_id($songID);
	$fail .= validate_artist($artist);
	$fail .= validate_album($album);
	$fail .= validate_song($song);
	$fail .= validate_genre($genre);
	$fail .= validate_release_year($releaseYear);
	$fail .= check_if_exists($songID);
	$fail .= check_if_song_exists($artist, $song);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Song</title>
        <link rel=stylesheet" type="text/css" href="music.css"/>
        <?php require_once 'navigation_bar.php'; ?>
        <?php
            if ($fail == "")
            {
                add_song($conn, $songID, $artist, $album, $song, $genre, $releaseYear);
				
                $query = "SELECT * FROM music WHERE songID = '$songID'";
                $result = mysqli_query($conn, $query);

                echo "<h2><font color = #7b00c7>".$username."</font> successfully added the following song to the Music table:<br></h2>";
                echo "<table><tr><th>Song ID</th><th>Artist</th><th>Album</th><th>Song</th><th>Genre</th><th>Release Year</th></tr>";


                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    for($i = 0; $i < 6; $i++)
                    {
                        echo "<td>$row[$i]</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
				
            }
        ?>
    </head>

    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h2>Add Music to the Database</h2>
            <h3>The following errors were found:<br><font color=black size=3><?php if($_SERVER['REQUEST_METHOD']=="POST"){ echo $fail;} ?></font></h3>
            <fieldset>
                <legend>Add Music</legend>
				<input class ="addmusic" type="text" name="songID" placeholder="Song ID"/><br>
                <input class ="addmusic" type="text" name="artist" placeholder="Artist"/><br>
                <input class ="addmusic" type="text" name="album" placeholder="Album"/><br>
                <input class ="addmusic" type="text" name="song" placeholder="Song Name"/><br>
                <input class ="addmusic" type="text" name="genre" placeholder="Genre"/><br>
				<input class ="addmusic" type="text" maxlength="4" name="releaseYear" placeholder="YYYY"/><br>
                <input type="submit" value="Add Music"/><br><br>
                <input type="reset" value="Reset"/><br>
            </fieldset>
        </form>
    </body>
</html>