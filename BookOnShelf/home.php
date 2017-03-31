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

<body id="home_page">

	<div id="banner">
		<h1>BookOnShelf</h1>
		<div id="menu">
			<ul>
			<li><h3>Welkom, <?php echo $_SESSION['username']?></h3></li>
			<li><form class="form_logout" action="home.php" method="post">
					<input name="logout_btn" type="submit" id="logout_btn" value="Log uit"/>
				</form></li>
			</ul>
		</div>
	</div>
	<?php
		if(isset($_POST['logout_btn'])){
			session_destroy();
			header('Location: index.php');
		}
	?>
	
</body>
</html>

<?php endif; if(!$_SESSION['login'] == true) header('Location: index.php'); ?>