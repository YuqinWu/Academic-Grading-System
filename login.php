<?php

// Connection parameters 
$host = 'localhost';
$username = 'yuqinwu';
$password = '83995160';
$database = 'yuqinDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
//print 'Connected successfully!<br>';

// Getting the input parameters:
$email = $_REQUEST['email'];
$pwd = $_REQUEST['password'];

$slquery = "CALL checkEmail('$email');";
$result = mysqli_query($dbcon, $slquery)
	or die('Query failed: ' . mysqli_error($dbcon));

if (mysqli_num_rows($result)==0) 
{
	print "<br><b>invalid email</b>";
	print "<br><b>Back to <a href='grading_system.php'>log in</a> </b>";
}
else
{
	$tuple = mysqli_fetch_array($result);
	if($tuple['password'] == $pwd)
	{
		// Start the session
		session_start();
		// Set session variables
		$_SESSION['email'] = $email;
		$_SESSION['name'] = $tuple['name'];
		$_SESSION['identity'] = $tuple['type'];
		header("Location: profile.php");
	}
	else
		print "<br><b>Wrong password! Back to <a href='grading_system.php'>log in</a> </b>";
}
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 