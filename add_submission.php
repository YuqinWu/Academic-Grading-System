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
$title = $_GET['title'];
$school = $_SESSION['school'];
$code = $_SESSION['code'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];

$query1 = "DELETE IGNORE FROM Submission
        WHERE student = '$email'
        AND assignment_title = '$title'
        AND course_code = '$code'
        AND school_code = '$school';";
		
$query2 = "INSERT INTO Submission VALUES('$email', '$title', '$code', '$school', CURRENT_TIMESTAMP(), 0, 0);";

//$query = "CALL addSubmission('$email', $school, $code, '$type', '$title')";
$result = mysqli_query($dbcon, $query1)
  or die('Query1 failed: ' . mysqli_error($dbcon));

mysqli_free_result($result);
mysqli_next_result($dbcon);

$result = mysqli_query($dbcon, $query2)
  or die('Query2 failed: ' . mysqli_error($dbcon));

print "Submitted successfully!";

// Printing courses in HTML
print'<br>Back to <a href= "submission.php?title='.$title.'">'.$title.'</a>';
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 