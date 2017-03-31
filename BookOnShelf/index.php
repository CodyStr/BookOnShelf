<?php
	session_start();
	$_SESSION['login'] = false;
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type ="text/css" href="style.css">
	  
</head>

<body id="login_page" style="background-color: #7f8c8d">

	<div id="banner_img">
		<img src="images/banner.jpg">
	</div>
	<div id="main-wrapper">
		<center><h1>Welkom</h1></center>
			<form class="myform" action="index.php" method="post" autocomplete="off">
				<input name="username" type="text" class="field username" placeholder="Gebruikersnaam" required oninvalid="this.setCustomValidity('Vul een gebruikersnaam in.')" oninput="setCustomValidity('')"/><br>
				<input name="password" type="password" class="field password" placeholder="Wachtwoord" required oninvalid="this.setCustomValidity('Vul een wachtwoord in.')" oninput="setCustomValidity('')"/><br>
				<a href="register.php" id=register_link>Registreren?</a>
				<input name="login" type="submit" id="login_btn" value="Login"/>
			</form>
			<?php
				if(isset($_POST['login']))
				{
					$username = $_POST['username'];
					$password = $_POST['password'];

					$query= $conn->prepare("SELECT username, isadmin FROM users WHERE username =:username AND password =:password");
					$query->bindValue('username', $username);
					$query->bindValue('password', $password);
					$query->execute();
					
					if ($row = $query->fetch(PDO::FETCH_ASSOC)) 
					{
						$isadmin = $row['isadmin'];

						if ($isadmin)
						{
							$_SESSION['username'] = $username;
							$_SESSION['login'] = true;
							header('location:homeAdmin.php');
						}
						else{
							$_SESSION['username'] = $username;
							$_SESSION['login'] = true;
							header('location:home.php');
						}
					}
					else{
						echo '<div id="errormsg">Gebruikersnaam en wachtwoord komen niet overeen, of u moet nog registreren.</div>';
					}
				}
			?>
	</div>
</body>
</html>