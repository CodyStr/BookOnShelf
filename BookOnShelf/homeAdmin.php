<?php
	session_start();
	require 'dbconfig/config.php';
	if (isset($_SESSION['login']) && $_SESSION['login'] == true):
?>
<!DOCTYPE html>
<html>
<head>
<title>Home page</title>
<link rel="stylesheet" type ="text/css" href="style.css">
	  
</head>

<body id="Admin_page">
	<div id="banner">
		<h1>BookOnShelf Beheerder</h1>
		<div id="menu">
			<ul>
			<li><h3>Welkom, <?php echo $_SESSION['username'] ?></h3></li>
			<li><form class="form_logout" action="home.php" method="post">
					<input name="logout_btn" type="submit" id="logout_btn" value="Log uit"/>
				</form></li>
			</ul>
		</div>
	</div>
	<div id="UsersTable">
		<?php
			$query = "SELECT * FROM users";
			$sth = $conn->query($query);
			if($sth->rowCount() > 0){
				$data = $sth->fetchAll();

				echo '<table width="70%" border="1" cellpadding="5">
					<tr>
					<th>ID</th>
					<th>Gebruikersaam</th>
					<th>Voornaam</th>
					<th>Achternaam</th>
					</tr>';

				foreach($data as $row)
				{
					echo '<tr>
							<td>'.$row["UserID"].'</td>
							<td>'.$row["UserName"].'</td>
							<td>'.$row["FirstName"].'</td>
							<td>'.$row["LastName"].'</td>
						</tr>';
				}

				echo '</table>';
			}else{
				echo '<p>Er zijn geen gebruikers beschikbaar</p>';
			}
			
		?>
	</div>
	<p>Gebruiker toevoegen klik <a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">hier.</a>
  	</p>
  		<div id="light" class="white_content">
			<p>Gebruiker toevoegen</p> 
		
			<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Sluit.</a>
  		</div>
  			<div id="fade" class="black_overlay">
			</div>
				<p>Een random stsukje tekst :D</p>
			<?php
				if(isset($_POST['logout_btn'])){
					session_destroy();
					header('Location: index.php');
				}
	?>
	
</body>
</html>

<?php endif; if(!$_SESSION['login'] == true) header('Location: index.php'); ?>