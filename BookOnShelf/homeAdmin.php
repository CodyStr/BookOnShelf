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
	<div id="sideMenu">
		
		<h3>Menu</h3>
		<a href="#">Gebruikers</a>
		<a href="#">Boeken</a>
		
	</div>
	<div id="admin-main-content-members">
		<div id="UsersTable">
			<?php
				$query = "SELECT * FROM Members";
				$sth = $conn->query($query);
				if($sth->rowCount() > 0)
				{
					$data = $sth->fetchAll();

					echo '<table>
						<tr>
						<th>ID</th>
						<th class="field2 username2">Gebruikersaam</th>
						<th class="field2 username2">Voornaam</th>
						<th class="field2 username2">Achternaam</th>
						<th class="field2 email2">E-mail</th>
						</tr>';

					foreach($data as $row)
					{
						echo '<tr>
								<td>'.$row["MemberID"].'</td>
								<td>'.$row["Username"].'</td>
								<td>'.$row["Firstname"].'</td>
								<td>'.$row["Lastname"].'</td>
								<td>'.$row["Email"].'</td>
							</tr>';
					}

					echo '</table>';
				}
				else{
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
			<div id="copyright">
				<p>&copy; ScanYours-Arnhem</p>
			</div>
	</div>
	<?php
		if(isset($_POST['logout_btn']))
		{
			session_destroy();
			header('Location: index.php');
		}
	?>
</body>
</html>

<?php endif; if(!$_SESSION['login'] == true) header('Location: index.php'); ?>