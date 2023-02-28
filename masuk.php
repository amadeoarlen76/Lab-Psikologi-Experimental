<?php
session_start();
//set session biar gabisa diakses by URL

$_SESSION['login'] = false;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Lab Psikologi Universitas Gunadarma</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Selamat Datang</h1>
	<h2>Laboratorium Psikologi<br>Universitas Gunadarma</h2>
	<div class="kotak_login">
		<p class="tulisan_login">Silahkan Melakukan Login</p>

		<form action="login.php" method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" class="form_login" required>
			
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" class="form_login" required>
			
			<input type="submit" value="Login" class="tombol_login">
			<input type="reset" class="tombol_reset" value="Batal">
		</form>
		
	</div>


</body>
</html>
