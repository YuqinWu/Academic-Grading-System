<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html> <head>
<title>Log in</title>
</head>

<body>
<h1>Grading System</h1>
<h1>Please Log in</h1>

<form method=get action="login.php">
Email:<br>
<input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><BR>
Password:<br>
<input type="password" name="password"><BR><BR>
<input type="submit" value="Log in">
</form>

<a href="sign_up.html">Sign up</a>
<br>
<a href="datawarehouse.php">Data warehouse</a>
<hr>