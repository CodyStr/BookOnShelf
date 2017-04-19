<?php
	session_start();
	$_SESSION['login'] = false;
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" type ="text/css" href="style.css">
	  
</head>

<body id="register_page" style="background-color: #7f8c8d">

	<div id="main-wrapper">
		<center><h1>Registreren</h1></center>
			<form class="myform" action="register.php" method="post" autocomplete="off">
				<input name="username" type="text" class="field username" placeholder="Gebruikersnaam" required oninvalid="this.setCustomValidity('Vul een gebruikersnaam in.')" oninput="setCustomValidity('')"/><br>
				<input name="firstname" type="text" class="field username" placeholder="Voornaam" required oninvalid="this.setCustomValidity('Vul een voornaam in.')" oninput="setCustomValidity('')"/><br>
				<input name="lastname" type="text" class="field username" placeholder="Achternaam" required oninvalid="this.setCustomValidity('Vul een achternaam in.')" oninput="setCustomValidity('')"/><br>
				<input name="email" type="email" class="field email" placeholder="E-mail" required oninvalid="this.setCustomValidity('Vul een E-mail in.')" oninput="setCustomValidity('')"/><br>
				<input name="password" type="password" class="field password" placeholder="Wachtwoord" required oninvalid="this.setCustomValidity('Vul een wachtwoord in')" oninput="setCustomValidity('')"/><br>
				<input name="cpassword" type="password" class="field password" placeholder="Bevestig wachtwoord" required oninvalid="this.setCustomValidity('Vul het wachtwoord opnieuw in.')" oninput="setCustomValidity('')"/><br>
				<a href="index.php"><input type="button" id="back_btn" value="Terug"/></a>
				<input name="submit_btn" type="submit" id="signup_btn" value="Registreer"/>
			</form>
		
		<?php
			if(isset($_POST['submit_btn']))
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
					} else if ($query2->fetch(PDO::FETCH_ASSOC)) {
						echo '<div id="errormsg">E-mail is als geregistreerd! Probeer opnieuw...</div>';
					}
					else {
						if (isset($_POST["submit_btn"])){
							$hostname='95.170.86.104';
							$username='codymax_root';
							$password='Qwerty6';
							try {
								$dbh = new PDO("mysql:host=$hostname;dbname=codymax_bos",$username,$password);
								$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$sql = "INSERT INTO Members (Username, Firstname, Lastname, Email, Password)
									VALUES ('".$_POST["username"]."','".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["email"]."','".$_POST["password"]."')";
								if ($dbh->query($sql)) {
									echo '<div id="goodmsg">U bent succesvol geregistreed, u kunt nu inloggen.</div>';
								} else {
								echo '<div id="errormsg">Er is iets fout gegaan met registreren(DB)</div>';
								}
							$dbh = null;
							}
							catch(PDOException $e) {
								echo $e->getMessage();
							}
						}
					}
				} else {
					echo '<div id="errormsg">Wachtwoorden komen niet overheen! Probeer opnieuw...</div>';
				}
			}
		?>
		
	</div>
	
</body>
</html>