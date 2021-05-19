<!--
	I certify that this submission is my own original work.
	Joe Nobile
	R01730447
	Music Database
	delete.php
	Displays a list of all music in the database, then prompts the user_error
	to select which song to delete.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Delete Music</title>
        <link rel="stylesheet" type="text/css" href="music.css"/>
        <?php require_once 'navigation_bar.php'; ?>
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
		
		<form method="post" action="delete_function.php">
			<h2>Choose a song that you would like to remove:</h2><br>
				<?php
					$query = "SELECT songID FROM music";
					$result = mysqli_query($conn, $query);
					echo "<select name='songID' size='1'>";
					while($row = mysqli_fetch_array($result))
					{
						$data = $row[0];
						echo "<option value='".$data."'>".$data."</option>";
					}
					echo "</select>";
					
				?>
				<input type = "submit" value="Delete Song"/><br>
		</form>
	</body>
</html>