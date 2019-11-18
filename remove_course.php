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
$school = $_GET['school'];
$code = $_GET['code'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];

$query = "UPDATE Course
		SET professor = NULL
        WHERE code='$code' 
        AND school_code = '$school'
        AND professor = '$email';";

if($identity == 1)
{
	$query = "DELETE FROM Enrollment
		WHERE school_code = '$school'
		AND course_code = '$code'
        AND student = '$email';";
}

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

// Printing courses in HTML
header("Location: profile.php");
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 