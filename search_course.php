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
$school = $_REQUEST['university'];
$term = $_REQUEST['term'];
$email = $_SESSION['email'];
// Get the attributes of the user with the given username

$query = "SELECT name, code
	FROM Course
	WHERE term = '$term' 
	AND school_code = '$school' AND (professor IS NULL OR professor !='$email');";

if($_SESSION['identity'] == 1)
{
	$query = "SELECT name, code
	FROM Course
	WHERE school_code = '$school' AND term = '$term' 
	AND code NOT IN(SELECT course_code FROM Enrollment WHERE student = '$email');";
}

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "school <b>$school</b> has the following course(s):";
if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no course!</b>";
}
// Printing courses in HTML
print '<ul>';
while ($tuple = mysqli_fetch_array($result)) {
	print 'Code: '.$tuple['code'];
	print '<br> Name: '.$tuple['name'];
	print '<br><a href="add_course.php?code='.$tuple['code'].'&school='.$school.'" onClick="return confirm(\'Are you sure you want to add?\')">Add</a><br><br>';
}
print '</ul>';

print'<br>Back to <a href="profile.php">Profile</a>';
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 