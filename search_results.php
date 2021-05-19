<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	search_results.php
	Displays the search results from "search.php".
-->

<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
	}
	require_once 'login.php';
	require_once 'is_logged_in.php';
	require_once 'functions.php';

	$column = $val = "";
	$conn = mysqli_connect($hn, $un, $pw, $db);
	
	if (isset($_POST['column'])) {
		$column = mysql_entities_fix_string($conn, $_POST['column']);
	}
	if (isset($_POST['music'])) {
		$music = mysql_entities_fix_string($conn, $_POST['music']);
	}
?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Search Results</title>
        <!--
		<link rel="stylesheet"type="text/css" href="music.css"/>
		-->
        <?php require_once 'navigation_bar.php'; ?>
    </head>
	<?php
		$conn = mysqli_connect($hn, $un, $pw, $db);
		
		if($column == 'song')
		{
			$query = "SELECT * FROM music WHERE song = '$music'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result)==0)
			{
				echo "<h3>Your song was not found, try again <a href='search.php'>here. </a></h3>";
			}
		}
		else if ($column == 'artist')
		{
			$query = "SELECT * FROM music WHERE artist = '$music'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result)==0)
			{
				echo "<h3>Your song was not found, try again <a href='search.php'>here. </a></h3>";
			}
		}
		else if ($column == 'album')
		{
			$query = "SELECT * FROM music WHERE album = '$music'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result)==0)
			{
				echo "<h3>Your song was not found, try again <a href='search.php'>here. </a></h3>";
			}
		}
		else if ($column == 'genre')
		{
			$query = "SELECT * FROM music WHERE genre = '$music'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result)==0)
			{
				echo "<h3>Your song was not found, try again <a href='search.php'>here. </a></h3>";
			}
		}
		else if ($column == 'releaseYear')
		{
			$query = "SELECT * FROM music WHERE releaseYear = '$music'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result)==0)
			{
				echo "<h3>Your song was not found, try again <a href='search.php'>here. </a></h3>";
			}
		}
		else // This will be Song ID
		{
			$query = "SELECT * FROM music WHERE songID = '$music'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result)==0)
			{
				echo "<h3>Your song was not found, try again <a href='search.php'>here. </a></h3>";
			}
		}



	echo "<h2><font color = #7b00c7>".$username."</font>'s search results:</h2>";
	echo "<table><tr><th>Song ID</th><th>Artist</th><th>Album</th><th>Song</th><th>Genre</th><th>Release Year</th></tr>";

	while ($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		for($i = 0; $i < 6; $i++)
		{
			echo "<td>$row[$i]</td>";
		}
		echo "</tr>";
	}
	echo "</table><br><br>";
	?>