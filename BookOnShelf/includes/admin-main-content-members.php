	<div id="admin-main-content-members">
		<h1>Gebruikers</h1>
				<?php
			if(isset($_POST['add_btn']))
			{	
				$username = $_POST['username'];
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$cpassword = $_POST['cpassword'];
				
				if($password==$cpassword)
				{
					$query= $conn->prepare("SELECT username FROM Members WHERE username =:username");
					$query->bindValue('username', $username);
					$query->execute();
					
					$query2= $conn->prepare("SELECT email FROM Members WHERE email =:email");
					$query2->bindValue('email', $email);
					$query2->execute();
					
						if ($query->fetch(PDO::FETCH_ASSOC)) {
							echo '<div id="errormsg">Username is al geregistreerd! Probeer opnieuw...</div>';
						}else if ($query2->fetch(PDO::FETCH_ASSOC)) {
								echo '<div id="errormsg">E-mail is als geregistreerd! Probeer opnieuw...</div>';
						}
						else {
							if(isset($_POST["add_btn"])){
								$hostname='localhost';
								$dbname='bos';
								$username='root';
								$password='';
								try {
								$dbh = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
								$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$sql = "INSERT INTO Members (Username, Firstname, Lastname, Email, Password)
									VALUES ('".$_POST["username"]."','".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["email"]."','".$_POST["password"]."')";
							if ($dbh->query($sql)) {
								echo '<div id="goodmsg">Nieuw lid succesvol toegevoegd</div>';
							}else {
								echo '<div id="errormsg">Er is iets fout gegaan met registreren(DB)</div>';
							}
						$dbh = null;
							}
							catch(PDOException $e) {
								echo $e->getMessage();
							}	
						}
					}
				} else{
					echo '<div id="errormsg">Wachtwoorden komen niet overheen! Probeer opnieuw...</div>';
				}
			}
		?>
		<div id="UsersTable">
			<form class="members-form" method="post" autocomplete="off">
				<?php
					if (isset($_POST['delete_btn']))
					{
						$MemberID = $_POST["delete_btn"];
						$query3 = $conn->prepare("DELETE FROM Members WHERE MemberID =:MemberID");
						$query3->bindvalue('MemberID', $MemberID);
						$query3->execute();
					} else {
						
					}
				?>
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
							<th class="field2 cross">Verwijder</th>	
							</tr>';

						foreach($data as $row)
						{
							echo '<tr>
									<td>'.$row["MemberID"].'</td>
									<td>'.$row["username"].'</td>
									<td>'.$row["firstname"].'</td>
									<td>'.$row["lastname"].'</td>
									<td>'.$row["email"].'</td>
									<td><input type="submit" value="' . $row['MemberID'] . '" name="delete_btn"/></td>
								</tr>';
						}
						echo '</table>';
					}
					else{
						echo '<p>Er zijn geen gebruikers beschikbaar</p>';
					}
				?>
			</form>
		</div>
			<p>Gebruiker toevoegen klik <a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Toevoegen</a>
			</p>
				<div id="light" class="white_content">
					
					<center><h1>Gebruiker toevoegen</h1></center>
			<form class="myform2" action="homeAdmin.php?page=Gebruikers" method="post" autocomplete="off">
				<input name="username" type="text" class="field username" placeholder="Gebruikersnaam" required oninvalid="this.setCustomValidity('Vul een gebruikersnaam in.')" oninput="setCustomValidity('')"/><br>
				<input name="firstname" type="text" class="field username" placeholder="Voornaam" required oninvalid="this.setCustomValidity('Vul een voornaam in.')" oninput="setCustomValidity('')"/><br>
				<input name="lastname" type="text" class="field username" placeholder="Achternaam" required oninvalid="this.setCustomValidity('Vul een achternaam in.')" oninput="setCustomValidity('')"/><br>
				<input name="email" type="email" class="field email" placeholder="E-mail" required oninvalid="this.setCustomValidity('Vul een E-mail in.')" oninput="setCustomValidity('')"/><br>
				<input name="password" type="password" class="field password" placeholder="Wachtwoord" required oninvalid="this.setCustomValidity('Vul een wachtwoord in')" oninput="setCustomValidity('')"/><br>
				<input name="cpassword" type="password" class="field password" placeholder="Bevestig wachtwoord" required oninvalid="this.setCustomValidity('Vul het wachtwoord opnieuw in.')" oninput="setCustomValidity('')"/><br>
				<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" id="close_btn">Sluit</a>
				<input name="add_btn" type="submit" id="add_btn" value="Toevoegen"/>
			</form> 
				</div>
					<div id="fade" class="black_overlay">
					</div>
				<p>Een random stsukje tekst :D</p>
			<div id="copyright">
				<p>&copy; ScanYours-Arnhem</p>
			</div>
	</div>