<?php
session_start();
if(!isset($_SESSION['email']))
	die('Direct access not permitted');

// Connection parameters 
$host = 'localhost';
$username = 'yuqinwu';
$password = '83995160';
$database = 'yuqinDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter:
$score = $_REQUEST['score'];
$title = $_SESSION['title'];
$school = $_SESSION['school'] ;
$code = $_SESSION['code'];
$student = $_SESSION['student'];
$identity = $_SESSION['identity'];

$query = "UPDATE Submission SET score = '$score', graded = 1 WHERE student = '$student' AND assignment_title = '$title' AND course_code = '$code' AND school_code = '$school';";

//$query = "CALL addSubmission('$email', $school, $code, '$type', '$title')";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

header("Location: submission.php?title=$title");
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);

?> 