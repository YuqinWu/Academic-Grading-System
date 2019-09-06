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
$school = $_GET['school'];
$code = $_GET['code'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];

$query = "CALL addEnrollment('$email', '$code', '$school', $identity);";

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

header("Location: profile.php");
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 