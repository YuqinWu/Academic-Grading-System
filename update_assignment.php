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
$type = $_REQUEST['type'];
$max_score = $_REQUEST['max_score'];
$due = $_REQUEST['due'];
$title = $_SESSION['$title'];

$school = $_SESSION['school'] ;
$code = $_SESSION['code'];

$query = "UPDATE Assignment SET type = '$type', maximum_score = '$max_score', due_date = '$due' WHERE title = '$title' AND course_code = '$code' AND school_code = '$school';";

//$query = "CALL addSubmission('$email', $school, $code, '$type', '$title')";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

header("Location: course_info.php?code=$code&school=$school");
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);

?> 