<?php

// Connection parameters 
$host = '127.0.0.1';
$username = 'yuqinwu';
$password = '83995160';
$database = 'yuqinDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
//print 'Connected successfully!<br>';

if($_REQUEST['password'] != $_REQUEST['confirm_password'])
{
	die("password does not match, Please try again! <a href='sign_up.html'>Sign up</a>");
}
// Getting the input parameters:
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$pwd = $_REQUEST['password'];
$con_password = $_REQUEST['confirm_password'];
$identity = $_REQUEST['identity'];

//print "information provided: $email, $password, $identity";
$slquery = "CALL checkEmail('$email');";
$selectresult = mysqli_query($dbcon, $slquery)
	or die('Query failed: ' . mysqli_error($dbcon));

if (mysqli_num_rows($selectresult) > 0) 
{
	print "<br><b>Email used, please try another one <a href='sign_up.html'>Sign up</a></b>";
	mysqli_store_result();
	$selectresult->free();
}
else
{
	mysqli_free_result($selectresult);
	mysqli_next_result($dbcon);
	// Sign up this user
	$query = "CALL Signup('$email','$name','$pwd', $identity);";

	$result = mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	print "Sign_up successfully! Now please <a href='grading_system.php'>log in</a>";
	mysqli_free_result($result);
}

// Closing connection
mysqli_close($dbcon);
?> 