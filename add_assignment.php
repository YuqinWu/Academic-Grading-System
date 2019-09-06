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
$title = $_REQUEST['title'];
$type = $_REQUEST['type'];
$maxscore = $_REQUEST['max_score'];
$due = $_REQUEST['due'];
$school = $_SESSION['school'] ;
$code = $_SESSION['code'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];

$query = "INSERT INTO Assignment VALUES('$title', '$type', '$code', '$school', '$maxscore', '$due');";

//$query = "CALL addSubmission('$email', $school, $code, '$type', '$title')";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

//print '<hr><a href= "course_info.php?code='.$code.'&school='.$school.'"><button>Back</button></a>';
header("Location: course_info.php?code=$code&school=$school");
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);

?> 