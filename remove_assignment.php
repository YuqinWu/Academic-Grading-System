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
$school = $_SESSION['school'];
$code = $_SESSION['code'];
$title = $_GET['title'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];

$query = "DELETE FROM Assignment
        WHERE school_code = '$school'
        AND course_code = '$code'
        AND title = '$title'";

$result = mysqli_query($dbcon, $query)
  or die('Query1 failed: ' . mysqli_error($dbcon));


print "Delete successfully!";

// Printing courses in HTML
header("Location: course_info.php?code=$code&school=$school");
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 