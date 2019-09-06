<?php
session_start();
if(!isset($_SESSION['email']))
	die('Direct access not permitted');

// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'yuqinwu';
$password = '83995160';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter:
$code = $_REQUEST['code'];
$school = $_REQUEST['school'];
$term = $_REQUEST['term'];
$section = $_REQUEST['section'];
$name = $_REQUEST['name'];
$website = $_REQUEST['website'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];
str_replace("'", "", $school);
str_replace("'", "", $code);

$query = "INSERT INTO Course VALUES('$code', '$school', '$term', '$section', '$name', '$email', '$website');";

//$query = "CALL addSubmission('$email', $school, $code, '$type', '$title')";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

header("Location: profile.php");
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);

?> 