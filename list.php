<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	list.php
	Displays a list of all records in the database.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>List of Music</title>
        <link rel="stylesheet" type="text/css" href="music.css"/>
        <?php require_once 'navigation_bar.php';?>
    </head>
    <body>
		<?php
			session_start();
			require_once 'login.php';
			require_once 'is_logged_in.php';
			$conn = new mysqli($hn, $un, $pw, $db);
			$query = "SELECT * FROM music ORDER BY songID";
			$result = mysqli_query($conn, $query);
			
			if (!$result) {
					die($conn->error);
			}
			
			if(isset($_SESSION['username']))
			{
				$username = $_SESSION['username'];
			}

			echo "<h2><font color = #7b00c7> ".$username."</font>'s list of music:</h2><br><br>";
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
		?>
	</body>
</html>